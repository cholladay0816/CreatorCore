<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StatusBadge extends Component
{
    public $status;
    public $bgColor = 'bg-white';
    public $textColor = 'text-gray-800';
    public function render()
    {
        if (in_array($this->status, ['Unpaid', 'Declined', 'Failed', 'Expired', 'Refunded'])) {
            $this->bgColor = 'bg-rose-100';
            $this->textColor = 'text-rose-800';
        } elseif (in_array($this->status, ['Pending', 'Purchasing', 'Overdue', 'Disputed'])) {
            $this->bgColor = 'bg-yellow-100';
            $this->textColor = 'text-yellow-800';
        } elseif (in_array($this->status, ['Active', 'Completed'])) {
            $this->bgColor = 'bg-green-100';
            $this->textColor = 'text-green-800';
        } else {
            $this->bgColor = 'bg-blue-100';
            $this->textColor = 'text-blue-800';
        }
        return view('livewire.status-badge');
    }
}
