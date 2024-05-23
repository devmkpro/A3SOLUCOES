<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'user_id', 'expires_at', 'recurrence_type'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Get the user that owns the task.
     * @return BelongsTo
     */

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the data for the task.
     * @return array
     */
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

    /**
     * Get the recurrence type for the task.
     * @return string
     */

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


    public function subTasks(): HasMany
    {
        return $this->hasMany(SubTask::class);
    }

}
