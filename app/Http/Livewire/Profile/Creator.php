<?php

namespace App\Http\Livewire\Profile;

use App\Contracts\UpdatesCreatorInformation;
use App\Models\CommissionPreset;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Creator extends Component
{
    use WithFileUploads;
    public $creator;

    public $user;

    public bool $uploading = false;

    public $listeners = [
        'updatedCurrentPath' => 'handleUpdatedCurrentPath',
        'uploadedImage' => 'handleImageUpload',
        'uploading' => 'handleUploading'
    ];

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];


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

    public function handleUploading($uploading)
    {
        $this->uploading = $uploading;
    }

    public function handleUpdatedCurrentPath($path) {
        $this->creator->fill(['banner_path' => $path])->save();
    }

    /**
     * Update the user's creator information.
     *
     * @return void
     */
    public function updateCreatorInformation()
    {
        $this->resetErrorBag();
        if(!is_null($this->banner)) {
            $path = $this->banner->storePublicly('/banners');
            Auth::user()->creator->update(
                $this->banner
                    ? array_merge($this->state, ['banner_path' => $path])
                    : $this->state
            );
        }
        else {
            Auth::user()->creator->update(
                $this->state
            );
        }

        $this->emit('saved');

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Delete user's banner photo.
     *
     * @return void
     */
    public function deleteBanner()
    {
        $this->creator->deleteBanner();

        $this->emit('refresh-navigation-menu');
    }

    public function handleImageUpload($image)
    {
        // Update banner object
        $this->banner = new TemporaryUploadedFile($image, 'do_public');
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
