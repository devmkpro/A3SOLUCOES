<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecurringTask extends Task
{
    use HasFactory;

    protected $fillable = ['recurrence_type', 'recurrence_interval_days', 'recurrence_end_date'];

    public function setRecurrence($type, $interval, $endDate = null)
    {
        $this->recurrence_type = $type;
        $this->recurrence_interval = $interval;
        $this->recurrence_end_date = $endDate;
        $this->save();
    }

    public function getRecurrence()
    {
        return [
            'type' => $this->recurrence_type,
            'interval' => $this->recurrence_interval,
            'end_date' => $this->recurrence_end_date,
        ];
    }

}
