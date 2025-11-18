<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options,
        public ?bool $requereOptionAll = true,
        public ?string $value = null,
    ) {
        //
    }

    /**
     * オプション配列を連想配列形式 ['value' => 'label'] に変換する。
     *
     * オプションがリスト配列（例: ['entry', 'intermediate']）の場合、
     * キーと値が同じ連想配列に変換する。
     * オプションが既に連想配列（例: ['entry' => 'Entry Level']）の場合、
     * そのまま返す。
     *
     * @return array<string, string> 値がキー、ラベルが値の連想配列
     */
    public function optionsWithLabels(): array
    {
        return array_is_list($this->options)
            ? array_combine($this->options, $this->options)
            : $this->options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-group');
    }
}
