@extends('layouts.app')

@section('title', 'タスク一覧')

@section('content')
    <div class="space-y-10">
        <section
            class="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 via-slate-900/80 to-slate-950 p-10 shadow-xl shadow-slate-950/40">
            <div class="absolute inset-y-0 right-0 hidden w-1/3 bg-[radial-gradient(circle_at_30%_30%,rgba(129,140,248,0.35),transparent_60%)] sm:block">
            </div>
            <div class="relative z-10 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-indigo-200/80">Overview</p>
                    <h1 class="mt-2 text-4xl font-semibold tracking-tight text-slate-50 sm:text-5xl">
                        今抱えているタスクを整理しましょう
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm text-slate-300">
                        一覧では最新のタスクから順に確認できます。完了済みかどうか、作成日時、詳細ページへの導線がまとまっています。
                        必要に応じて編集やステータス変更を行ってください。
                    </p>
                </div>
                <div class="grid gap-3 text-right text-sm text-slate-300">
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">合計</p>
                        <p class="text-2xl font-semibold text-white">{{ $tasks->total() }}</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">このページ</p>
                        <p class="text-2xl font-semibold text-white">{{ $tasks->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="relative z-10 mt-6">
                <a href="{{ route('tasks.create') }}"
                    class="inline-flex items-center gap-2 rounded-full bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:bg-indigo-400">
                    <span>新しいタスクを追加</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
            </div>
        </section>

        @if ($tasks->count())
            <div class="space-y-5">
                @foreach ($tasks as $task)
                    <article
                        class="rounded-2xl border border-white/10 bg-slate-900/70 p-6 shadow-lg shadow-slate-950/30 transition hover:border-indigo-400/40 hover:shadow-indigo-400/20">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                            <div class="space-y-2">
                                <h2 class="text-xl font-semibold text-white">
                                    <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                                        class="transition hover:text-indigo-300">
                                        {{ $task->title }}
                                    </a>
                                </h2>
                                <p class="text-sm leading-relaxed text-slate-300">
                                    {{ \Illuminate\Support\Str::limit($task->description, 140) }}
                                </p>
                                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-400">
                                    <span class="inline-flex items-center gap-1 rounded-full border border-white/10 bg-white/5 px-3 py-1">
                                        作成: <time datetime="{{ $task->created_at }}">{{ $task->created_at->diffForHumans() }}</time>
                                    </span>
                                    <span class="inline-flex items-center gap-1 rounded-full border border-white/10 bg-white/5 px-3 py-1">
                                        更新: <time datetime="{{ $task->updated_at }}">{{ $task->updated_at->diffForHumans() }}</time>
                                    </span>
                                </div>
                            </div>
                            <span
                                class="inline-flex h-8 items-center justify-center rounded-full px-4 text-xs font-semibold uppercase tracking-[0.2em] {{ $task->completed ? 'bg-emerald-400/15 text-emerald-200 border border-emerald-400/30' : 'bg-amber-400/15 text-amber-200 border border-amber-400/30' }}">
                                {{ $task->completed ? '完了' : '進行中' }}
                            </span>
                        </div>

                        <div class="mt-6 flex flex-wrap items-center gap-3 text-sm">
                            <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                                class="inline-flex items-center gap-2 rounded-lg border border-white/10 px-4 py-2 text-slate-200 transition hover:border-indigo-400 hover:text-white">
                                詳細を見る
                            </a>
                            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"
                                class="inline-flex items-center gap-2 rounded-lg border border-indigo-400/40 bg-indigo-500/20 px-4 py-2 text-indigo-200 transition hover:bg-indigo-500/30 hover:text-white">
                                編集
                            </a>

                            <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task->id]) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-lg border border-white/10 px-4 py-2 text-slate-200 transition hover:border-emerald-400 hover:text-emerald-200">
                                    {{ $task->completed ? '未完了に戻す' : '完了にする' }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}"
                                onsubmit="return confirm('本当に削除しますか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-lg border border-rose-500/40 bg-rose-500/10 px-4 py-2 text-rose-200 transition hover:bg-rose-500/20 hover:text-white">
                                    削除
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $tasks->links() }}
            </div>
        @else
            <div
                class="rounded-2xl border border-dashed border-white/15 bg-slate-900/60 px-6 py-12 text-center text-slate-300">
                <h2 class="text-lg font-medium text-white">まだタスクがありません</h2>
                <p class="mt-2 text-sm text-slate-400">
                    まずはやることを一件登録してみましょう。小さな一歩が積み重なるほどプロジェクトが進みます。
                </p>
                <a href="{{ route('tasks.create') }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-full bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:bg-indigo-400">
                    タスクを作成する
                </a>
            </div>
        @endif
    </div>
@endsection
