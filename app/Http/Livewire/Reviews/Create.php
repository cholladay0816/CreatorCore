<?php

namespace App\Http\Livewire\Reviews;

use App\Models\Review;
use Livewire\Component;

class Create extends Component
{
    public array $review;
    public $title;
    public $commission;
    protected $rules = [
        'review.positive' => 'required|min:0|max:1',
        'review.anonymous' => 'required|min:0|max:1',
        'review.message' => 'nullable|max:255',
    ];

    public function mount()
    {
        $this->review = [
            'user_id' => auth()->id(),
            'commission_id' => $this->commission->id,
            'anonymous' => 1
        ];
    }
    public function render()
    {
        return view('livewire.reviews.create');
    }

    public function submit()
    {
        $this->validate();

        Review::create($this->review);
        $this->redirect(route('commissions.orders'));
    }

    public function cancel()
    {
        back();
    }
}
