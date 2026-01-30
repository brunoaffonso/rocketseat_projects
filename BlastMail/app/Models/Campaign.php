<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        $totalOpened = $this->mails()->where('openings', '>', 0)->count();
        $totalClicked = $this->mails()->where('clicks', '>', 0)->count();

        return [
            'sent' => $totalSent,
            'opened' => $totalOpened,
            'clicked' => $totalClicked,
            'open_rate' => $totalSent > 0 ? round(($totalOpened / $totalSent) * 100, 1) : 0,
            'click_rate' => $totalSent > 0 ? round(($totalClicked / $totalSent) * 100, 1) : 0,
        ];
    }
}
