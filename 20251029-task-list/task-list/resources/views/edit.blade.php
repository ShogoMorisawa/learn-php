@extends('layouts.app')

@section('title', 'タスクを編集')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-4 rounded-3xl border border-white/10 bg-slate-900/80 p-8 shadow-xl shadow-slate-950/40 backdrop-blur">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-50">{{ $task->title }}</h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-300">
                    内容を更新して、最新のタスク状態に保ちましょう。完了したらステータスをトグルしておくと一覧でも分かりやすくなります。
                </p>
            </div>
            <div class="flex flex-wrap gap-3 text-xs text-slate-400">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1">
                    作成: <time datetime="{{ $task->created_at }}">{{ $task->created_at->diffForHumans() }}</time>
                </span>
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1">
                    更新: <time datetime="{{ $task->updated_at }}">{{ $task->updated_at->diffForHumans() }}</time>
                </span>
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 px-3 py-1 {{ $task->completed ? 'bg-emerald-400/10 text-emerald-300' : 'bg-amber-400/10 text-amber-200' }}">
                    ステータス: {{ $task->completed ? '完了' : '進行中' }}
                </span>
            </div>
        </div>

        @include('form', ['task' => $task])
    </div>
@endsection
