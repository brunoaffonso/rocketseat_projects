<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EmailListTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_email_list_with_csv(): void
    {
        $user = User::factory()->create();

        $csvContent = "name,email\nJohn Doe,john@example.com\nJane Doe,jane@example.com";
        $file = UploadedFile::fake()->createWithContent('subscribers.csv', $csvContent)->mimeType('text/csv');

        $response = $this->actingAs($user)->post(route('email-list.store'), [
            'title' => 'My New List',
            'listFile' => $file,
        ]);

        $response->assertRedirect(route('email-list.index'));
        $this->assertDatabaseHas('email_lists', [
            'title' => 'My New List',
        ]);
        $this->assertDatabaseHas('subscribers', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
        $this->assertDatabaseHas('subscribers', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);
    }

    public function test_create_page_renders_with_correct_action(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('email-list.create'));

        $response->assertStatus(200);
        $response->assertSee('action="'.route('email-list.store').'"', false);
        $response->assertSee('method="POST"', false);
    }
}
