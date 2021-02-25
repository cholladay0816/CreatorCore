<?php

namespace App\Http\Livewire;

use App\Models\Commission;
use Livewire\Component;

class StatusButton extends Component
{
    public $color = 'bg-blue-500';
    public $status;

    public function render()
    {
        if (in_array($this->status, ['Unpaid', 'Declined', 'Failed', 'Expired', 'Refunded'])) {
            $this->color = 'bg-rose-500';
        } elseif (in_array($this->status, ['Pending', 'Purchasing', 'Overdue', 'Disputed'])) {
            $this->color = 'bg-yellow-500';
        } elseif (in_array($this->status, ['Active', 'Completed'])) {
            $this->color = 'bg-green-500';
        } else {
            $this->color = 'bg-blue-500';
        }

        return view('livewire.status-button');
    }
}
