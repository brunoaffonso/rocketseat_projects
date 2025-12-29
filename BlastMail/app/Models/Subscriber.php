<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriberFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email_list_id',
        'name',
        'email',
    ];

    public function emailList(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailList::class);
    }
}
