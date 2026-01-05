<?php

namespace Tests\Feature;

use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailTemplateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_email_templates_list(): void
    {
        $user = User::factory()->create();
        EmailTemplate::create([
            'name' => 'Test Template',
            'body' => '<p>Hello world</p>',
        ]);

        $response = $this->actingAs($user)->get(route('email-templates.index'));

        $response->assertStatus(200);
        $response->assertSee('Test Template');
        $response->assertSee('Email Templates');
    }

    public function test_user_can_search_email_templates(): void
    {
        $user = User::factory()->create();
        EmailTemplate::create(['name' => 'Newsletter A', 'body' => '...']);
        EmailTemplate::create(['name' => 'Newsletter B', 'body' => '...']);
        EmailTemplate::create(['name' => 'Welcome Email', 'body' => '...']);

        $response = $this->actingAs($user)->get(route('email-templates.index', ['search' => 'Newsletter']));

        $response->assertStatus(200);
        $response->assertSee('Newsletter A');
        $response->assertSee('Newsletter B');
        $response->assertDontSee('Welcome Email');
    }

    public function test_user_can_create_email_template(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('email-templates.store'), [
            'name' => 'New Template',
            'body' => 'Template body content',
        ]);

        $response->assertRedirect(route('email-templates.index'));
        $this->assertDatabaseHas('email_templates', [
            'name' => 'New Template',
            'body' => 'Template body content',
        ]);
    }

    public function test_user_can_update_email_template(): void
    {
        $user = User::factory()->create();
        $template = EmailTemplate::create(['name' => 'Old Name', 'body' => 'Old Body']);

        $response = $this->actingAs($user)->patch(route('email-templates.update', $template), [
            'name' => 'Updated Name',
            'body' => 'Updated Body',
        ]);

        $response->assertRedirect(route('email-templates.index'));
        $this->assertDatabaseHas('email_templates', [
            'id' => $template->id,
            'name' => 'Updated Name',
            'body' => 'Updated Body',
        ]);
    }

    public function test_user_can_delete_email_template(): void
    {
        $user = User::factory()->create();
        $template = EmailTemplate::create(['name' => 'To Delete', 'body' => '...']);

        $response = $this->actingAs($user)->delete(route('email-templates.destroy', $template));

        $response->assertRedirect(route('email-templates.index'));
        $this->assertDatabaseMissing('email_templates', [
            'id' => $template->id,
        ]);
    }
}
