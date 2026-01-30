<?php

namespace App\Jobs;

use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class SendEmailsCampaign implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Campaign $campaign)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->campaign->load('emailList.subscribers');

        foreach ($this->campaign->emailList->subscribers as $subscriber) {
            SendEmailCampaign::dispatch($this->campaign, $subscriber);
        }
    }
}
