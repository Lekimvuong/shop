<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logincontroller extends Controller
{
    public function index()
    {
        return view('admin.users.login', ['title' => 'Đăng nhập hệ thống']);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);
  // Kiểm tra thông tin đăng nhập của người dùng
        if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ], $request->input('remember'))) {

            return redirect()->route('admin');
        }
//lưu thông tin lỗi vào session
        Session::flash('error', 'Email hoặc Password không đúng');
        // Lỗi thì lùi về trang login
        return redirect()->back();
    }
    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect()->route('admin');
    }
}
