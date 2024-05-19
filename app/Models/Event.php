<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'notify_emails' => 'array',
        'event_date' => 'datetime',
    ];

    protected $fillable = ['event_title', 'event_description', 'event_date', 'reminder_id', 'notify_emails', 'is_completed'];
}
