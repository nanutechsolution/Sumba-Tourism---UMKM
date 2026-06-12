<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah ada session 'locale' yang disimpan (id atau en)
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // Default ke ID jika belum ada
            App::setLocale('id');
        }

        return $next($request);
    }
}