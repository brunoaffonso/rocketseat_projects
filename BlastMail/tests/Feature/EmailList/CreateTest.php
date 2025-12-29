<?php

namespace Tests\Feature\EmailList;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the create form has the correct enctype.
     */
    public function test_create_form_has_correct_enctype(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get(route('email-list.create'));

        $response->assertStatus(200);
        $response->assertSee('enctype="multipart/form-data"', false);
    }

    /**
     * Test that storing a CSV file works.
     */
    public function test_storing_csv_file_works(): void
    {
        $user = \App\Models\User::factory()->create();

        $csvContent = "nome,email\nTest User,test@example.com\nAnother User,another@example.com";
        $file = \Illuminate\Http\UploadedFile::fake()->createWithContent('list.csv', $csvContent);

        $response = $this->actingAs($user)->post(route('email-list.store'), [
            'title' => 'My Test List',
            'listFile' => $file,
        ]);

        $response->assertRedirect(route('email-list.index'));
        $this->assertDatabaseHas('email_lists', [
            'title' => 'My Test List',
        ]);

        $this->assertDatabaseHas('subscribers', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->assertDatabaseHas('subscribers', [
            'name' => 'Another User',
            'email' => 'another@example.com',
        ]);
    }
}
