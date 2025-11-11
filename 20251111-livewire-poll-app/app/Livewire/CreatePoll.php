<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;

    public $options = ['いち', 'に', 'さん'];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1|max:10',
        'options.*' => 'required|min:1|max:255',
    ];

    protected $messages = [
        'options.*' => 'オプション名は空では登録できません。',
    ];

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '好きなタイトル';
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedOptions($value, $key)
    {
        $this->validateOnly("options.{$key}");
    }

    public function createPoll()
    {
        $this->validate();

        Poll::create(['title' => $this->title])
            ->options()
            ->createMany(collect($this->options)->map(fn ($option) => ['name' => $option])->all());

        $this->title = '';
        $this->options = [''];

        $this->dispatch('poll-created');
    }
}
