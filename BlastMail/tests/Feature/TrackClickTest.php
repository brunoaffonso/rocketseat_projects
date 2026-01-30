<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\CampaignMail;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrackClickTest extends TestCase
{
    use RefreshDatabase;

    public function test_click_tracking_increments_count_and_redirects(): void
    {
        $campaign = Campaign::factory()->create();
        $subscriber = Subscriber::factory()->create();
        $campaignMail = CampaignMail::create([
            'campaign_id' => $campaign->id,
            'subscriber_id' => $subscriber->id,
            'uuid' => \Illuminate\Support\Str::uuid()->toString(),
        ]);

        $destinationUrl = 'https://rocketseat.com.br';

        $response = $this->get(route('track.click', [
            'uuid' => $campaignMail->uuid,
            'url' => $destinationUrl,
        ]));

        $response->assertRedirect($destinationUrl);
        $this->assertEquals(1, $campaignMail->fresh()->clicks);
    }

    public function test_click_tracking_redirects_to_home_if_no_url_provided(): void
    {
        $campaign = Campaign::factory()->create();
        $campaignMail = CampaignMail::create([
            'campaign_id' => $campaign->id,
            'subscriber_id' => Subscriber::factory()->create()->id,
            'uuid' => \Illuminate\Support\Str::uuid()->toString(),
        ]);

        $response = $this->get(route('track.click', [
            'uuid' => $campaignMail->uuid,
        ]));

        $response->assertRedirect('/');
    }
}
