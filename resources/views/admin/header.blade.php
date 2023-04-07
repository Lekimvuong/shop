<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ asset('template/admin/publics/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/admin/publics/css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/admin/publics/reset.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/admin/publics/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/admin/publics/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/admin/publics/responsive.css') }}" rel="stylesheet" type="text/css" />

<script src="{{ asset('template/admin/publics/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/admin/publics/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/admin/publics/js/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/admin/publics/js/main.js') }}" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="wp-inner clearfix">
                        <a href="?page=list_post" title="" id="logo" class="fl-left">ADMIN</a>
                        <ul id="main-menu" class="fl-left">
                            <li>
                                <a href="?page=list_post" title="">Trang</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=add_page" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_page" title="">Danh sách trang</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=list_post" title="">Bài viết</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{route('posts.add')}}" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="{{route('posts.list-posts')}}" title="">Danh sách bài viết</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_cat" title="">Danh mục bài viết</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=list_product" title="">Sản phẩm</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=add_product" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_product" title="">Danh sách sản phẩm</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_cat" title="">Danh mục sản phẩm</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" title="">Bán hàng</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=list_order" title="">Danh sách đơn hàng</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_order" title="">Danh sách khách hàng</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=menu" title="">Menu</a>
                            </li>
                        </ul>
                        <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                            <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div id="thumb-circle" class="fl-left">
                                    <img src="{{asset('template/admin/publics/images/admin.jpg')}}">
                                </div>
                                <h3 id="account" class="fl-right">{{Auth::User()->name}}</h3>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="?page=info_account" title="Thông tin cá nhân">Thông tin cá nhân</a></li>
                                <li><a href="{{asset('admin/users/logout')}}" title="Thoát">Thoát</a></li>
                            </ul>
                        </div>
                    </div>
                </div>