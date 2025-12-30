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

    /**
     * Test that duplicate emails in the same list are prevented.
     */
    public function test_duplicate_emails_in_same_list_are_prevented(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();
        $emailList->subscribers()->create([
            'name' => 'Existing User',
            'email' => 'duplicate@example.com',
        ]);

        $response = $this->actingAs($user)->post(route('subscribers.store', $emailList), [
            'name' => 'New User',
            'email' => 'duplicate@example.com',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test that the same email can be added to different lists.
     */
    public function test_same_email_in_different_lists_is_allowed(): void
    {
        $user = User::factory()->create();
        $list1 = EmailList::factory()->create();
        $list2 = EmailList::factory()->create();

        $list1->subscribers()->create([
            'name' => 'User',
            'email' => 'shared@example.com',
        ]);

        $response = $this->actingAs($user)->post(route('subscribers.store', $list2), [
            'name' => 'User',
            'email' => 'shared@example.com',
        ]);

        $response->assertRedirect(route('subscribers.index', $list2));
        $this->assertDatabaseHas('subscribers', [
            'email_list_id' => $list2->id,
            'email' => 'shared@example.com',
        ]);
    }

    /**
     * Test that a soft-deleted email can be re-added to the same list.
     */
    public function test_soft_deleted_email_can_be_re_added(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();
        $subscriber = $emailList->subscribers()->create([
            'name' => 'Deleted User',
            'email' => 'readd@example.com',
        ]);
        $subscriber->delete();

        $response = $this->actingAs($user)->post(route('subscribers.store', $emailList), [
            'name' => 'Re-added User',
            'email' => 'readd@example.com',
        ]);

        $response->assertRedirect(route('subscribers.index', $emailList));
        $this->assertDatabaseHas('subscribers', [
            'email_list_id' => $emailList->id,
            'email' => 'readd@example.com',
            'deleted_at' => null,
        ]);
    }
}
