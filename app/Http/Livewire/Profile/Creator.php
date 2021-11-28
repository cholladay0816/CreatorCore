<?php

namespace App\Http\Livewire\Profile;

use App\Contracts\UpdatesCreatorInformation;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;

class Creator extends Component
{
    public $creator;

    public $user;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new banner for the creator.
     *
     * @var mixed
     */
    public $banner;

    public function mount()
    {
        if (!auth()->user()->creator) {
            \App\Models\Creator::create([
                'user_id' => auth()->user()->id,
            ]);
        }
        $this->user = auth()->user()->fresh();
        $this->creator = $this->user->creator;

        $this->state = $this->creator->withoutRelations()->toArray();
    }

    /**
     * Update the user's profile information.
     *
     * @return void
     */
    public function updateCreatorInformation()
    {
        $this->resetErrorBag();

        Auth::user()->creator->update(
            $this->banner
                ? array_merge($this->state, ['banner' => $this->banner])
                : $this->state
        );

        if (isset($this->banner)) {
            return redirect()->route('profile.show');
        }

        $this->emit('saved');

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteBanner()
    {
        $this->creator->deleteBanner();

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getCreatorProperty()
    {
        return Auth::user()->creator;
    }

    public function render()
    {
        return view('livewire.profile.creator');
    }
}
