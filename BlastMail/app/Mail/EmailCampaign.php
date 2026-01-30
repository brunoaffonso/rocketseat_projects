<?php

namespace App\Mail;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailCampaign extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Campaign $campaign,
        public ?\App\Models\CampaignMail $campaignMail = null
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->campaign->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.campaign',
            with: [
                'body' => ($this->campaign->track_click && $this->campaignMail)
                    ? $this->processLinks($this->campaign->body)
                    : $this->campaign->body,
                'uuid' => ($this->campaign->track_open && $this->campaignMail)
                    ? $this->campaignMail->uuid
                    : null,
            ],
        );
    }

    protected function processLinks(string $body): string
    {
        return preg_replace_callback('/<a\s+[^>]*?href=["\']([^"\']+)["\']/i', function ($matches) {
            $originalUrl = $matches[1];

            // Avoid tracking internal or mailto links if necessary,
            // but for simplicity we track everything that looks like a URL.
            if (str_starts_with($originalUrl, '#') || str_starts_with($originalUrl, 'mailto:')) {
                return $matches[0];
            }

            $trackingUrl = route('track.click', [
                'uuid' => $this->campaignMail->uuid,
                'url' => $originalUrl,
            ]);

            return str_replace($originalUrl, $trackingUrl, $matches[0]);
        }, $body);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
