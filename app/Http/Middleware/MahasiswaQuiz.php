<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaQuiz
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $usr = Auth::user();
            if ($usr->role != 1) {
                if (!isset($usr->mahasiswa)) {
                    return redirect()->route('mahasiswa.quiz');
                }
            }
        }
        return $next($request);
    }
}
