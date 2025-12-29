<?php

namespace Tests\Feature;

use App\Models\EmailList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriberTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_subscriber(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();

        $response = $this->actingAs($user)->post(
            route('subscribers.store', $emailList),
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ]
        );

        $response->assertRedirect(route('subscribers.index', $emailList));
        $this->assertDatabaseHas('subscribers', [
            'email_list_id' => $emailList->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    public function test_subscriber_creation_requires_name(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();

        $response = $this->actingAs($user)->post(
            route('subscribers.store', $emailList),
            [
                'email' => 'john@example.com',
            ]
        );

        $response->assertSessionHasErrors('name');
    }

    public function test_subscriber_creation_requires_valid_email(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();

        $response = $this->actingAs($user)->post(
            route('subscribers.store', $emailList),
            [
                'name' => 'John Doe',
                'email' => 'invalid-email',
            ]
        );

        $response->assertSessionHasErrors('email');
    }
}
