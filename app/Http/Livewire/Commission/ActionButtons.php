<?php

namespace App\Http\Livewire\Commission;

use http\Client\Request;
use Livewire\Component;

class ActionButtons extends Component
{
    public $commission;
    public function render()
    {
        return view('livewire.commission.action-buttons');
    }


    public function destroy()
    {
        \Illuminate\Http\Request::create(route('commissions.destroy', $this->commission), 'DELETE');
        $this->redirect(route('commissions.orders'));
    }
    public function delete()
    {
        \Illuminate\Http\Request::create(route('commissions.destroy', $this->commission), 'DELETE');
        $this->commission->fresh();
    }
}
