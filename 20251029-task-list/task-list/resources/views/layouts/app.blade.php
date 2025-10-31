<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @hasSection('title')
            @yield('title') | {{ config('app.name', 'Task List') }}
        @else
            {{ config('app.name', 'Task List') }}
        @endif
    </title>
    @php
        $viteManifestExists = file_exists(public_path('build/manifest.json'));
    @endphp

    @if ($viteManifestExists)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif']
                        },
                        colors: {
                            slate: {
                                950: '#020617'
                            }
                        }
                    }
                }
            };
        </script>
    @endif
    @stack('head')
</head>
<body class="min-h-full bg-slate-950 font-sans text-slate-100">
    <div class="relative isolate flex min-h-screen flex-col">
        <div class="pointer-events-none absolute inset-x-0 -top-40 z-0 transform-gpu overflow-hidden blur-3xl sm:-top-64">
            <div
                class="relative left-1/2 aspect-[1155/678] w-[36rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-indigo-500/30 to-cyan-400/20 opacity-70 sm:w-[72rem]">
            </div>
        </div>

        <header class="z-10 border-b border-white/10 bg-slate-950/70 backdrop-blur">
            <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-6 sm:px-6">
                <a href="{{ route('tasks.index') }}" class="text-lg font-semibold tracking-tight text-slate-50">
                    {{ config('app.name', 'Task List') }}
                </a>
                <nav class="flex items-center gap-3 text-sm">
                    @php
                        $isTasksRoute = request()->routeIs('tasks.index');
                        $isCreateRoute = request()->routeIs('tasks.create');
                    @endphp
                    <a href="{{ route('tasks.index') }}"
                        class="rounded-md px-3 py-1.5 font-medium transition hover:bg-slate-800/70 hover:text-white {{ $isTasksRoute ? 'bg-slate-800/80 text-white' : 'text-slate-300' }}">
                        タスク一覧
                    </a>
                    <a href="{{ route('tasks.create') }}"
                        class="rounded-md px-3 py-1.5 font-medium transition hover:bg-slate-200/10 hover:text-white {{ $isCreateRoute ? 'bg-indigo-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-300 ring-1 ring-inset ring-indigo-400/40 hover:ring-indigo-400/80' }}">
                        新規作成
                    </a>
                </nav>
            </div>
        </header>

        <main class="z-10 mx-auto w-full max-w-5xl flex-1 px-4 py-10 sm:px-6 lg:px-8">
            @if (session('success'))
                <div
                    class="mb-6 flex items-start gap-3 rounded-xl border border-green-400/40 bg-green-500/10 px-4 py-3 text-sm text-green-200 shadow-lg shadow-green-500/20">
                    <span
                        class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-full bg-green-400/70 text-xs font-semibold text-green-950">
                        ✓
                    </span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="z-10 border-t border-white/5 bg-slate-950/80 py-6 text-sm text-slate-500">
            <div class="mx-auto flex max-w-5xl items-center justify-between px-4 sm:px-6">
                <p>© {{ now()->year }} {{ config('app.name', 'Task List') }}</p>
                <p class="hidden sm:block">Laravel &amp; Tailwind でシンプルにタスク管理</p>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
