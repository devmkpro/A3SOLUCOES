<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubTask extends Task
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'expires_at',
        'task_id',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Get the task that owns the SubTask
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Get the data for the SubTask
     * @return array
     */
    public function getData(): array
    {
        $data = parent::getData();
        $data['task_id'] = $this->task_id;
        return $data;
    }

}
