@extends('layouts.app')

@section('title', '新規タスク')

@section('content')
    <div class="space-y-8">
        <div class="rounded-3xl border border-white/10 bg-slate-900/80 p-8 shadow-xl shadow-slate-950/40 backdrop-blur">
            <h1 class="text-3xl font-semibold tracking-tight text-slate-50">新しいタスクを登録</h1>
            <p class="mt-2 max-w-2xl text-sm text-slate-300">
                日々のタスクを整理しましょう。タイトルと概要は必須です。思いついたことは詳細メモに残しておくと便利です。
            </p>
        </div>

        @include('form')
    </div>
@endsection
