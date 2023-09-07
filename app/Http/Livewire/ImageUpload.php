<?php

namespace App\Http\Livewire;

use App\Models\CommissionPreset;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;
    public string|null $current_url;
    public string|null $current_path;
    public string $title;
    public string $name;
    public string|null $width;
    public string|null $disk;
    public string|null $model;
    public $image;
    public function render()
    {
        return view('livewire.image-upload');
    }

    public function updatedCurrentPath($path)
    {
        $this->emitUp('updatedCurrentPath', $path);
    }

    public function updatedImage()
    {
        $this->emitUp('uploading', true);
        if(!is_null($this->image)) {
            $this->validate([
                'image' => CommissionPreset::$IMAGE_RULES
            ]);
            $this->emitUp('uploadedImage', $this->image->getRealPath());
        }
        $this->emitUp('uploading', false);
    }

    public function deleteImage()
    {
        if($this->current_path) {
            Storage::disk($this->disk ?? 'do_public')->delete($this->current_path);
        }
        $this->current_path = null;
        $this->current_url = null;
        $this->updatedCurrentPath($this->current_path);

    }
}
