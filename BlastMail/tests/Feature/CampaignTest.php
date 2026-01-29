<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\EmailList;
use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    public function test_campaigns_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('campaigns.index'));

        $response->assertStatus(200);
    }

    public function test_campaign_details_can_be_viewed(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();
        $campaign = Campaign::create([
            'name' => 'View Test',
            'subject' => 'Subject',
            'email_list_id' => $emailList->id,
            'body' => 'Body',
            'send_at' => now()->addDay(),
        ]);

        $response = $this->actingAs($user)->get(route('campaigns.show', $campaign));

        $response->assertStatus(200);
        $response->assertSee('View Test');
    }

    public function test_campaign_edit_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();
        $campaign = Campaign::create([
            'name' => 'Edit Test',
            'subject' => 'Subject',
            'email_list_id' => $emailList->id,
            'body' => 'Body',
            'send_at' => now()->addDay(),
        ]);

        $response = $this->actingAs($user)->get(route('campaigns.edit', $campaign));

        $response->assertStatus(200);
        $response->assertSee('Edit Test');
    }

    public function test_campaign_can_be_updated(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();
        $campaign = Campaign::create([
            'name' => 'Original Name',
            'subject' => 'Original Subject',
            'email_list_id' => $emailList->id,
            'body' => 'Original Body',
            'track_click' => false,
            'track_open' => false,
            'send_at' => now()->addDay(),
        ]);

        $response = $this->actingAs($user)->put(route('campaigns.update', $campaign), [
            'name' => 'Updated Name',
            'subject' => 'Updated Subject',
            'email_list_id' => $emailList->id,
            'body' => 'Updated Body',
            'track_click' => true,
            'track_open' => true,
            'schedule_type' => 'later',
            'send_at' => now()->addDays(2)->toDateTimeString(),
        ]);

        $response->assertRedirect(route('campaigns.index'));

        $this->assertDatabaseHas('campaigns', [
            'id' => $campaign->id,
            'name' => 'Updated Name',
            'subject' => 'Updated Subject',
            'track_click' => true,
        ]);
    }

    public function test_new_campaign_can_be_created(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();
        $template = EmailTemplate::factory()->create();

        $response = $this->actingAs($user)->post(route('campaigns.store'), [
            'name' => 'Test Campaign',
            'subject' => 'Test Subject',
            'email_list_id' => $emailList->id,
            'template_id' => $template->id,
            'track_click' => true,
            'track_open' => true,
            'body' => '<p>Test Body</p>',
            'schedule_type' => 'later',
            'send_at' => now()->addDay()->toDateTimeString(),
        ]);

        $response->assertRedirect(route('campaigns.index'));

        $this->assertDatabaseHas('campaigns', [
            'name' => 'Test Campaign',
            'subject' => 'Test Subject',
            'email_list_id' => $emailList->id,
            'template_id' => $template->id,
            'track_click' => true,
            'track_open' => true,
        ]);
    }

    public function test_campaign_can_be_sent_now(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();

        $response = $this->actingAs($user)->post(route('campaigns.store'), [
            'name' => 'Instant Campaign',
            'subject' => 'Instant Subject',
            'email_list_id' => $emailList->id,
            'body' => 'Instant Body',
            'schedule_type' => 'now',
        ]);

        $response->assertRedirect(route('campaigns.index'));

        $this->assertDatabaseHas('campaigns', [
            'name' => 'Instant Campaign',
        ]);

        $campaign = Campaign::where('name', 'Instant Campaign')->first();
        $this->assertNotNull($campaign->send_at);
        // Ensure send_at is close to now (within 5 seconds)
        $this->assertTrue($campaign->send_at->diffInSeconds(now()) < 5);
    }

    public function test_campaign_validation_rules(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('campaigns.store'), [
            'name' => '', // Required
            'subject' => '', // Required
            'email_list_id' => 999, // Exists
            'schedule_type' => 'later',
            'send_at' => now()->subDay()->toDateTimeString(), // After now
        ]);

        $response->assertSessionHasErrors(['name', 'subject', 'email_list_id', 'send_at']);
    }

    public function test_campaign_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();

        $campaign = Campaign::create([
            'name' => 'To Delete',
            'subject' => 'Subject',
            'email_list_id' => $emailList->id,
            'body' => 'Body',
            'send_at' => now()->addDay(),
        ]);

        $response = $this->actingAs($user)->delete(route('campaigns.destroy', $campaign));

        $response->assertRedirect(route('campaigns.index'));

        $this->assertSoftDeleted($campaign);
    }
}
