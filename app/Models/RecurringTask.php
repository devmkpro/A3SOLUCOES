<?php

namespace App\Models;

class RecurringTask extends Task
{

    protected function setRecurrence($type) : void
    {
        $this->recurrence_type = $type;
        $this->save();
    }

    /**
     * Get the recurrence type for the task.
     * @return string
     */
    public function getData() : array
    {
        $data = parent::getData();
        $data['recurrence_type'] = $this->recurrence_type;
        return $data;
    }

    

}
