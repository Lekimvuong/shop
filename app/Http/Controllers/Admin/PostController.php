<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreateFormRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function create(){
        return view('admin.post.add', ['title' => 'Thêm mới danh mục']);
     
    }
    function store(CreateFormRequest $request){
        dd(($request)->input());
     
    }
}
