<?php

namespace Tests\Unit;

use App\Models\Campaign;
use App\Models\EmailList;
use App\Models\EmailTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    public function test_campaign_can_be_created(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'Test Campaign',
            'subject' => 'Test Subject',
        ]);

        $this->assertDatabaseHas('campaigns', [
            'id' => $campaign->id,
            'name' => 'Test Campaign',
            'subject' => 'Test Subject',
        ]);
        $this->assertInstanceOf(Campaign::class, $campaign);
    }

    public function test_campaign_belongs_to_email_list(): void
    {
        $emailList = EmailList::factory()->create();
        $campaign = Campaign::factory()->create(['email_list_id' => $emailList->id]);

        $this->assertInstanceOf(EmailList::class, $campaign->emailList);
        $this->assertEquals($emailList->id, $campaign->emailList->id);
    }

    public function test_campaign_belongs_to_template(): void
    {
        $template = EmailTemplate::factory()->create();
        $campaign = Campaign::factory()->create(['template_id' => $template->id]);

        $this->assertInstanceOf(EmailTemplate::class, $campaign->template);
        $this->assertEquals($template->id, $campaign->template->id);
    }

    public function test_campaign_is_soft_deletable(): void
    {
        $campaign = Campaign::factory()->create();
        $campaign->delete();

        $this->assertSoftDeleted('campaigns', ['id' => $campaign->id]);
    }
}
