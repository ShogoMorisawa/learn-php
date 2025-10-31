@php
    $task = $task ?? null;
    $isEdit = filled($task);
    $submitLabel = $isEdit ? 'タスクを更新' : 'タスクを追加';
@endphp

<form method="POST"
    action="{{ $isEdit ? route('tasks.update', ['task' => $task]) : route('tasks.store') }}"
    class="space-y-6 rounded-2xl border border-white/10 bg-slate-900/70 p-6 shadow-2xl shadow-slate-950/40 backdrop-blur">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    @if ($errors->any())
        <div class="rounded-lg border border-rose-400/40 bg-rose-400/10 px-4 py-3 text-sm text-rose-200">
            入力内容にエラーがあります。各フィールドを確認してください。
        </div>
    @endif

    <div class="space-y-2">
        <label for="title" class="block text-sm font-medium text-slate-200">
            タイトル
        </label>
        <input type="text" name="title" id="title"
            value="{{ old('title', $task?->title ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-slate-950/70 px-4 py-2.5 text-sm text-slate-100 placeholder:text-slate-500 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400/60" />
        @error('title')
            <p class="text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="description" class="block text-sm font-medium text-slate-200">
            概要
        </label>
        <textarea name="description" id="description" rows="4"
            class="w-full rounded-lg border border-white/10 bg-slate-950/70 px-4 py-2.5 text-sm text-slate-100 placeholder:text-slate-500 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400/60">{{ old('description', $task?->description ?? '') }}</textarea>
        @error('description')
            <p class="text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="long_description" class="block text-sm font-medium text-slate-200">
            詳細メモ
        </label>
        <textarea name="long_description" id="long_description" rows="6"
            class="w-full rounded-lg border border-white/10 bg-slate-950/70 px-4 py-2.5 text-sm text-slate-100 placeholder:text-slate-500 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400/60">{{ old('long_description', $task?->long_description ?? '') }}</textarea>
        @error('long_description')
            <p class="text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-wrap items-center gap-3">
        <button type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:bg-indigo-400">
            {{ $submitLabel }}
        </button>
        <a href="{{ $isEdit ? route('tasks.show', ['task' => $task?->id]) : route('tasks.index') }}"
            class="inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-medium text-slate-300 transition hover:text-white hover:underline">
            キャンセル
        </a>
    </div>
</form>
