<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class checklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $users = User::select('users.*', 'role_user.role_id as roleid')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->where('users.id', '=', $user->id)
                ->first();
            if ($users->roleid == 1) {
                return $next($request);
            } else {
                // Toastr::error('Bạn không có quyền truy cập vào trang Admin', 'Đăng nhập thất bại', ["positionClass" => "toast-top-center"]);
                return redirect('admin');
            }
        } else {
            // Toastr::error('Bạn không có quyền truy cập vào trang Admin', 'Đăng nhập thất bại', ["positionClass" => "toast-top-center"]);
            return redirect('admin');
        }
    }
}
