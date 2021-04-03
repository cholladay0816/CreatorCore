<?php

namespace App\Http\Livewire\Creator;

use Livewire\Component;
use Livewire\WithFileUploads;

class Gallery extends Component
{
    use WithFileUploads;

    public $file;
    public $user;

    protected $rules = [
        'file' => 'required|file|image|max:4096'
    ];

    public function render()
    {
        return view('livewire.creator.gallery');
    }

    public function updatedFile()
    {
        $this->validate();
        if ($this->user->id != auth()->id()) {
            $this->addError('file', 'This is not your profile.');
            return null;
        }
        $path = $this->file->store('gallery');
        $gallery = new \App\Models\Gallery();
        $gallery->user_id = auth()->id();
        $gallery->path = $path;
        $gallery->size = $this->file->getSize();
        $gallery->type = $this->file->getMimeType();
        $gallery->save();
        return redirect()->refresh();
    }
    public function delete($id)
    {
        $gallery = \App\Models\Gallery::find($id);
        if ($gallery->user_id != auth()->id()) {
            $this->addError('file', 'You do not have permission to access this resource.');
            return null;
        }
        $gallery->delete();
    }
}
