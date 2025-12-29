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

    /**
     * Test that storing a CSV file with duplicate emails in the same file fails and rolls back.
     */
    public function test_storing_csv_file_with_duplicates_fails_and_rolls_back(): void
    {
        $user = \App\Models\User::factory()->create();

        $csvContent = "nome,email\nTest User,test@example.com\nTest User Duplicate,test@example.com";
        $file = \Illuminate\Http\UploadedFile::fake()->createWithContent('list.csv', $csvContent);

        $this->actingAs($user)->post(route('email-list.store'), [
            'title' => 'Duplicate List',
            'listFile' => $file,
        ]);

        $this->assertDatabaseMissing('email_lists', [
            'title' => 'Duplicate List',
        ]);
        $this->assertEquals(0, \App\Models\Subscriber::count());
    }

    /**
     * Test that storing an invalid CSV file rolls back transactions.
     */
    public function test_storing_invalid_csv_file_rolls_back(): void
    {
        $user = \App\Models\User::factory()->create();

        // Second row is invalid (missing email)
        $csvContent = "nome,email\nValid User,valid@example.com\nInvalid User,";
        $file = \Illuminate\Http\UploadedFile::fake()->createWithContent('list.csv', $csvContent);

        $this->actingAs($user)->post(route('email-list.store'), [
            'title' => 'Rollback List',
            'listFile' => $file,
        ]);

        $this->assertDatabaseMissing('email_lists', [
            'title' => 'Rollback List',
        ]);
        $this->assertEquals(0, \App\Models\Subscriber::count());
    }
}
