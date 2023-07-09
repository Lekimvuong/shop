<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        $data['title'] = 'Trang quản trị';
        return view('admin.home', $data);
    }
}
