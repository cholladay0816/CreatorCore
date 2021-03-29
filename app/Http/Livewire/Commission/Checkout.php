<?php

namespace App\Http\Livewire\Commission;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Checkout extends Component
{
    public $commission;
    public $stripe_token = null;

    public function render()
    {
        return view('livewire.commission.checkout');
    }
    public function submit()
    {
        $this->dispatchBrowserEvent('generate-stripe-token');
    }
    public function store()
    {
        try {
            $res = $this->commission->attemptCharge($this->stripe_token);
            if ($res->object == 'invoice') {
                Session::flash('success', 'Payment processing, your order should finish shortly.');
                $this->redirect(route('commissions.orders'));
            } else {
                Session::flash('error', 'Payment transaction failed, please try again.');
                return redirect()->refresh();
            }
        } catch (\Exception $exception) {
            Session::flash('error', 'Payment transaction failed, please try again.  Error: '. $exception->getMessage());
            return redirect()->refresh();
        }
    }
}
