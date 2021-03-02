<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StatusBadge extends Component
{
    public $status;
    public $color;
    public function render()
    {
        if (in_array($this->status, ['Unpaid', 'Declined', 'Failed', 'Expired', 'Refunded'])) {
            $this->color = 'rose';
        } elseif (in_array($this->status, ['Pending', 'Purchasing', 'Overdue', 'Disputed'])) {
            $this->color = 'yellow';
        } elseif (in_array($this->status, ['Active', 'Completed'])) {
            $this->color = 'green';
        } else {
            $this->color = 'blue';
        }

        return view('livewire.status-badge');
    }
}
