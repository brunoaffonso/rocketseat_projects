<?php

namespace App\Models;

use App\Observers\CampaignObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(CampaignObserver::class)]
class Campaign extends Model
{
    /** @use HasFactory<\Database\Factories\CampaignFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'subject',
        'email_list_id',
        'template_id',
        'track_click',
        'track_open',
        'body',
        'send_at',
    ];

    protected function casts(): array
    {
        return [
            'track_click' => 'boolean',
            'track_open' => 'boolean',
            'send_at' => 'datetime',
        ];
    }

    public function emailList(): BelongsTo
    {
        return $this->belongsTo(EmailList::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(EmailTemplate::class);
    }

    public function mails(): HasMany
    {
        return $this->hasMany(CampaignMail::class);
    }

    public function getStatisticsAttribute(): array
    {
        $totalSent = $this->mails()->count();
        $uniqueOpened = $this->mails()->where('openings', '>', 0)->count();
        $uniqueClicked = $this->mails()->where('clicks', '>', 0)->count();

        $totalOpenings = (int) $this->mails()->sum('openings');
        $totalClicks = (int) $this->mails()->sum('clicks');

        return [
            'sent' => $totalSent,
            'opened' => $uniqueOpened,
            'clicked' => $uniqueClicked,
            'total_openings' => $totalOpenings,
            'total_clicks' => $totalClicks,
            'open_rate' => $totalSent > 0 ? round(($uniqueOpened / $totalSent) * 100, 1) : 0,
            'click_rate' => $totalSent > 0 ? round(($uniqueClicked / $totalSent) * 100, 1) : 0,
        ];
    }
}
