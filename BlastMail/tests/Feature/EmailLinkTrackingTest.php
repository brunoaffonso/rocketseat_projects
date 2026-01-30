<?php

namespace Tests\Feature;

use App\Mail\EmailCampaign;
use App\Models\Campaign;
use App\Models\CampaignMail;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailLinkTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_links_are_transformed_into_tracking_urls(): void
    {
        $campaign = Campaign::factory()->create([
            'body' => '<p>Hello, check out <a href="https://google.com">Google</a> and <a href="https://laravel.com">Laravel</a>.</p>',
            'track_click' => true,
        ]);
        $subscriber = Subscriber::factory()->create();
        $campaignMail = CampaignMail::create([
            'campaign_id' => $campaign->id,
            'subscriber_id' => $subscriber->id,
            'uuid' => 'test-uuid-123',
        ]);

        $mailable = new EmailCampaign($campaign, $campaignMail);

        // We can't easily test the rendered markdown because it's rendered in the mail driver,
        // but we can test the data passed to the view.
        // Actually, let's call the content() method directly or use render() if possible.

        $content = $mailable->render();

        $this->assertStringContainsString('track/click/test-uuid-123?url=https%3A%2F%2Fgoogle.com', $content);
        $this->assertStringContainsString('track/click/test-uuid-123?url=https%3A%2F%2Flaravel.com', $content);
    }

    public function test_internal_and_mailto_links_are_not_tracked(): void
    {
        $campaign = Campaign::factory()->create([
            'body' => '<p><a href="#section">Internal</a> and <a href="mailto:test@example.com">Email</a></p>',
            'track_click' => true,
        ]);
        $campaignMail = CampaignMail::create([
            'campaign_id' => $campaign->id,
            'subscriber_id' => Subscriber::factory()->create()->id,
            'uuid' => 'test-uuid-123',
        ]);

        $mailable = new EmailCampaign($campaign, $campaignMail);
        $content = $mailable->render();

        $this->assertStringContainsString('href="#section"', $content);
        $this->assertStringContainsString('href="mailto:test@example.com"', $content);
        $this->assertStringNotContainsString('track/click/', $content);
    }
}
