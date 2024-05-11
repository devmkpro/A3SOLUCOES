<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'user_id', 'expires_at', 'recurrence_type', 'recurrence_end_date'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Polymorphic
    public function getData() : array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'expires_at' => $this->expires_at->format('Y-m-d H:i:s'),
        ];
    }

    public function getRecurrenceType() : string
    {
        return match ($this->recurrence_type) {
            'daily' => __('Daily'),
            'weekly' => __('Weekly'),
            'monthly' => __('Monthly'),
            'yearly' => __('Yearly'),
            default => __('Unknown'),
        };
    }

}
