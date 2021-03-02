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
    public $hasErrors = false;
    protected $rules = [
        'file' => 'required|file|image|max:4096'
    ];

    public function render()
    {
        $this->hasErrors = count($this->getErrorBag()->all()) > 0;
        return view('livewire.commission.attachments');
    }

    public function updatedFile()
    {
        $this->validate();
        if (!$this->commission->isCreator()) {
            $this->addError('file', 'You are not the creator of this commission.');
            return null;
        }
        if (!in_array($this->commission->status, ['Active', 'Overdue'])) {
            $this->addError('file', 'This commission is no longer open for changes.');
            return null;
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
            $this->addError('file', 'This commission is no longer open for changes.');
            return null;
        }
        $attachment->delete();
    }
}
