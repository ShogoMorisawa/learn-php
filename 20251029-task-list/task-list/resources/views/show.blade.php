@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="space-y-10">
        <section
            class="rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 via-slate-950 to-slate-950/90 p-10 shadow-2xl shadow-slate-950/40">
            <div class="flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 text-xs uppercase tracking-[0.3em] text-indigo-200/80">
                        Task Detail
                    </div>
                    <h1 class="text-4xl font-semibold tracking-tight text-white md:text-5xl">
                        {{ $task->title }}
                    </h1>
                    <p class="max-w-2xl text-sm leading-relaxed text-slate-200">
                        {{ $task->description }}
                    </p>
                </div>
                <span
                    class="inline-flex h-9 items-center justify-center rounded-full border px-5 text-xs font-semibold uppercase tracking-[0.3em] {{ $task->completed ? 'border-emerald-400/40 bg-emerald-400/15 text-emerald-200' : 'border-amber-400/40 bg-amber-400/15 text-amber-200' }}">
                    {{ $task->completed ? '完了' : '進行中' }}
                </span>
            </div>

            <div class="mt-8 flex flex-wrap gap-4 text-xs text-slate-300">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5">
                    作成: <time datetime="{{ $task->created_at }}">{{ $task->created_at->format('Y/m/d H:i') }}</time>
                </span>
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5">
                    更新: <time datetime="{{ $task->updated_at }}">{{ $task->updated_at->diffForHumans() }}</time>
                </span>
            </div>
        </section>

        <section
            class="rounded-3xl border border-white/10 bg-slate-900/80 p-8 shadow-xl shadow-slate-950/30 backdrop-blur">
            <h2 class="text-lg font-semibold text-white">詳細メモ</h2>
            <p class="mt-4 whitespace-pre-line text-sm leading-7 text-slate-200">
                {{ $task->long_description ?: '詳細メモは未入力です。' }}
            </p>
        </section>

        <div class="flex flex-wrap items-center gap-4">
            <a href="{{ route('tasks.index') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-white/10 px-4 py-2 text-sm font-medium text-slate-200 transition hover:border-indigo-400 hover:text-white">
                一覧に戻る
            </a>
            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"
                class="inline-flex items-center gap-2 rounded-lg border border-indigo-400/40 bg-indigo-500/20 px-4 py-2 text-sm font-semibold text-indigo-200 transition hover:bg-indigo-500/30 hover:text-white">
                編集
            </a>
            <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task->id]) }}">
                @csrf
                @method('PUT')
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg border border-white/10 px-4 py-2 text-sm font-medium text-slate-200 transition hover:border-emerald-400 hover:text-emerald-200">
                    {{ $task->completed ? '未完了に戻す' : '完了にする' }}
                </button>
            </form>
            <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}"
                onsubmit="return confirm('本当に削除しますか？')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg border border-rose-500/40 bg-rose-500/10 px-4 py-2 text-sm font-semibold text-rose-200 transition hover:bg-rose-500/20 hover:text-white">
                    削除
                </button>
            </form>
        </div>
    </div>
@endsection
