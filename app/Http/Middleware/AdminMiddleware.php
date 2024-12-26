<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

//下記を追加した
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->role_id == User::ADMIN_ROLE_ID){
            return $next($request);
        }
        
        //もし、ユーザーがログインしていない、または管理者でない場合、index ルートにリダイレクトされる
        return redirect()->route('index');
    }
}
