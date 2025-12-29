<?php

namespace Tests\Feature\Subscriber;

use App\Models\EmailList;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoftDeleteViewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that deleted subscribers are hidden by default.
     */
    public function test_deleted_subscribers_are_hidden_by_default(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();
        $activeSubscriber = Subscriber::query()->create([
            'email_list_id' => $emailList->id,
            'name' => 'Active User',
            'email' => 'active@example.com',
        ]);
        $deletedSubscriber = Subscriber::query()->create([
            'email_list_id' => $emailList->id,
            'name' => 'Deleted User',
            'email' => 'deleted@example.com',
            'deleted_at' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('subscribers.index', $emailList));

        $response->assertStatus(200);
        $response->assertSee('Active User');
        $response->assertDontSee('Deleted User');
    }

    /**
     * Test that deleted subscribers are shown when show_deleted is true.
     */
    public function test_deleted_subscribers_are_shown_when_requested(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();
        $deletedSubscriber = Subscriber::query()->create([
            'email_list_id' => $emailList->id,
            'name' => 'Deleted User',
            'email' => 'deleted@example.com',
            'deleted_at' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('subscribers.index', [$emailList, 'show_deleted' => 1]));

        $response->assertStatus(200);
        $response->assertSee('Deleted User');
        $response->assertSee('Deleted'); // The indicator text
    }
}
