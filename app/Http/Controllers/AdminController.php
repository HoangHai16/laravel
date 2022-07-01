<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Auth;
Session_start();


class AdminController extends Controller
{
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){

        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        // tra ve true/false
        if(Auth::attempt([
            'email' =>  $request->email,
            'password' => $request->password
        ])){
            return view('admin.dashboard');
        }
        else{
            Session::put('message','Tài khoản hoặc mật khẩu không chính xác. Vui lòng nhập lại!');
            return Redirect::to('/admin');
        }

    }
    public function logout(){

        Auth::logout();
        return Redirect::to('/admin');
    }
}
