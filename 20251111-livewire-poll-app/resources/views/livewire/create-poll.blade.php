<div>
    <form wire:submit="createPoll">
        <label>Poll Title</label>

        <input type="text" wire:model.live="title" />

        <div class="mb-4 mt-4">
            <button class="btn" wire:click.prevent="addOption">投票項目を追加</button>
        </div>

        @error('title')
            <span class="text-red-500">{{ $message }}</span>
        @enderror

        <h3>投票項目</h3>
        @foreach ($options as $index => $option)
            <div class="mb-4">
                <label>Option {{ $index + 1 }}</label>は、
                <input type="text" wire:model.live="options.{{ $index }}" />です。
                @error('options.' . $index)
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <button class="btn" wire:click.prevent="removeOption({{ $index }})">削除</button>
            </div>
        @endforeach

        @error('options.*')
            <span class="text-red-500">{{ $message }}</span>
        @enderror

        <button type="submit" class="btn">Create Poll</button>
    </form>

    <div class="mt-8">
        <h2 class="mb-4 mt-4 text-2xl">Available Polls</h2>

        <livewire:polls />
    </div>
</div>
