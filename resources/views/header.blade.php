<!DOCTYPE html>
<html>
    <head>
        <title>{{$title}}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('template/public/css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('template/public/css/bootstrap/bootstrap.min.css" rel="stylesheet') }}" type="text/css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="{{ asset('template/public/reset.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('template/public/css/carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('template/public/css/carousel/owl.theme.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('template/public/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('template/public/style.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('template/public/responsive.css') }}" rel="stylesheet" type="text/css"/>

        <script src="{{ asset('template/public/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('template/public/js/elevatezoom-master/jquery.elevatezoom.js') }}" type="text/javascript"></script>
        <script src="{{ asset('template/public/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('template/public/js/carousel/owl.carousel.js') }}" type="text/javascript"></script>
        <script src="{{ asset('template/public/js/loadingoverlay.min.js') }}" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('template/admin/publics/js/base.app.js') }}" type="text/javascript"></script>
        <script src="{{ asset('template/public/js/main.js') }}" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="?page=home" title="">Trang chủ</a>
                                    </li>
                                    <li>
                                        <a href="?page=category_product" title="">Sản phẩm</a>
                                    </li>
                                    <li>
                                        <a href="?page=blog" title="">Blog</a>
                                    </li>
                                    <li>
                                        <a href="?page=detail_blog" title="">Giới thiệu</a>
                                    </li>
                                    <li>
                                        <a href="?page=detail_blog" title="">Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="{{ route('main') }}" title="" id="logo" class="fl-left"><img src="/template/public/images/logo.png"/></a>
                            <div id="search-wp" class="fl-left">
                                <form method="POST" action="">
                                    <input type="text" name="s" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                    <button type="submit" id="sm-s">Tìm kiếm</button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0868.771.505</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                @include('home.cart')
                            </div>
                        </div>
                    </div>
                </div>
                