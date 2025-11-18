<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Employer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ユーザーがログインしていない、または雇用主プロフィールが存在しない場合は、雇用主プロフィール作成ページにリダイレクト
        // employerがあれば次に進める。
        if ($request->user() === null || $request->user()->employer === null) {
            return redirect()
                ->route('employer.create')
                ->with('error', 'You must create an employer profile before accessing this page.');
        }

        return $next($request);
    }
}
