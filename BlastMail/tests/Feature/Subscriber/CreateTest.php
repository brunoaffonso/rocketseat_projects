<?php

namespace Tests\Feature\Subscriber;

use App\Models\EmailList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a subscriber can be created successfully.
     */
    public function test_subscriber_can_be_created(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();

        $response = $this->actingAs($user)->post(route('subscribers.store', $emailList), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertRedirect(route('subscribers.index', $emailList));
        $this->assertDatabaseHas('subscribers', [
            'email_list_id' => $emailList->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    /**
     * Test that validation fails with missing data.
     */
    public function test_validation_fails_with_missing_data(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();

        $response = $this->actingAs($user)->post(route('subscribers.store', $emailList), [
            'name' => '',
            'email' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email']);
    }
}
