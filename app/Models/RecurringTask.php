<?php

namespace App\Models;

class RecurringTask extends Task
{

    protected function setRecurrence($type, $interval, $endDate = null)
    {
        $this->recurrence_type = $type;
        $this->recurrence_interval = $interval;
        $this->recurrence_end_date = $endDate;
        $this->save();
    }

    public function getData() : array
    {
        $data = parent::getData();
        $data['recurrence_type'] = $this->recurrence_type;
        $data['recurrence_interval'] = $this->recurrence_interval;
        $data['recurrence_end_date'] = $this->recurrence_end_date;
        return $data;
    }

    

}
