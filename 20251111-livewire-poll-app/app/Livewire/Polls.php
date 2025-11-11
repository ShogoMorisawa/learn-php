<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Poll;
use Livewire\Attributes\On;
use Livewire\Component;

class Polls extends Component
{
    public function render()
    {
        $polls = Poll::with('options.votes')->get();

        return view('livewire.polls', ['polls' => $polls]);
    }

    #[On('poll-created')]
    public function refreshPolls(): void
    {
        // No-op: Livewire re-renders after this method runs.
    }

    public function vote(Option $option)
    {
        $option->votes()->create();
    }
}
