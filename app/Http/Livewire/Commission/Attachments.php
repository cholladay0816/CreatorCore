<?php

namespace App\Http\Livewire\Commission;

use App\Models\Attachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class Attachments extends Component
{
    use WithFileUploads;

    public $file;
    public $commission;

    protected $rules = [
        'file' => 'required|file|image|max:4096'
    ];

    public function render()
    {
        return view('livewire.commission.attachments');
    }

    public function updatedFile()
    {
        $this->validate();
        if (!$this->commission->isCreator()) {
            abort(401);
        }
        if (!in_array($this->commission->status, ['Active', 'Overdue'])) {
            abort(401);
        }
        $path = $this->file->store('attachments');
        $attachment = new Attachment();
        $attachment->user_id = auth()->id();
        $attachment->commission_id = $this->commission->id;
        $attachment->path = $path;
        $attachment->size = $this->file->getSize();
        $attachment->type = $this->file->getMimeType();
        $attachment->save();
        return redirect()->to(route('commissions.show', $this->commission));
    }
    public function delete($id)
    {
        $attachment = Attachment::find($id);
        if (!$attachment->canEdit()) {
            abort(401);
        }
        $attachment->delete();
    }
}
