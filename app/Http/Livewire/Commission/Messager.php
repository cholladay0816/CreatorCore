<?php

namespace App\Http\Livewire\Commission;

use App\Events\CommissionMessage\Send;
use App\Models\Commission;
use App\Models\CommissionMessage;
use Livewire\Component;

class Messager extends Component
{
    public Commission $commission;
    public string $message;
    public array $rules = [
        'message' => 'required|max:256'
    ];
    public function render()
    {
        return view('livewire.commission.messager');
    }

    public function send()
    {
        $this->validate($this->rules);
        $commissionMessage = CommissionMessage::create([
            'commission_id' => $this->commission->id,
            'user_id' => auth()->id(),
            'message' => $this->message
        ]);
        Send::dispatch($commissionMessage);
        $this->message = '';
        $this->emitTo(History::class, 'refresh');
    }
}
