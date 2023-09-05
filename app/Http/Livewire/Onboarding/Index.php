<?php

namespace App\Http\Livewire\Onboarding;

use App\Models\Creator;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{
    public array $form = [
        'account_type' => null,
    ];
    public bool $buyer_verified = false;
    public bool $creator_verified = false;
    public User $user;
    public ?Creator $creator;


    public function mount()
    {
        $this->form['account_type'] = Session::get('account_type');
        $this->refresh();
    }

    public function updatedForm($value, $key)
    {
        Session::put($key, $value);
    }

    public function skip()
    {
        Session::put('skip_onboarding', true);

        $this->redirect(route('dashboard'));
    }

    public function refresh()
    {
        $this->user = auth()->user();
        $this->buyer_verified = $this->user->hasPaymentMethod();
        $this->creator_verified = $this->user->canAcceptPayments();
        $this->creator = $this->user->creator;
    }

    public function onboard()
    {
        $this->user->forceFill([
            'onboarded_at' => now()
        ])->save();
        return $this->redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.onboarding.index');
    }
}
