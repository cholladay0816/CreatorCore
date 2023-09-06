<?php

namespace App\Http\Livewire;

class UpdateProfileInformationForm extends \Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm
{

    public function updatedPhoto()
    {
        $this->validateOnly('photo',
            [
                'photo' => ['nullable', 'image', 'max:1024']
            ]);
    }

}
