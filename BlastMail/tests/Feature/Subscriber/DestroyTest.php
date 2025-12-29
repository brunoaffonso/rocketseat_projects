<?php

namespace Tests\Feature\Subscriber;

use App\Models\EmailList;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a subscriber can be deleted successfully.
     */
    public function test_subscriber_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();
        $subscriber = Subscriber::query()->create([
            'email_list_id' => $emailList->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response = $this->actingAs($user)->delete(route('subscribers.destroy', [$emailList, $subscriber]));

        $response->assertRedirect(route('subscribers.index', $emailList));
        $this->assertSoftDeleted('subscribers', [
            'id' => $subscriber->id,
        ]);
    }
}
