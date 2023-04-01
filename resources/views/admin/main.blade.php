<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.header')
</head>

    </div>
    <!-- ./wrapper -->
<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div class="wp-inner clearfix">
                    <a href="?page=list_post" title="" id="logo" class="fl-left">Admin</a>
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
                                    <a href="?page=add_post" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?page=list_post" title="">Danh sách bài viết</a>
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
                        <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                            <div id="thumb-circle" class="fl-left">
                                <img src="template/admin/publics/images/admin.JPG">
                            </div>
                            <h3 id="account" class="fl-right">{{Auth::User()->name}}</h3>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="?page=info_account" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                            <li><a href="{{asset('admin/users/logout')}}" title="Thoát">Thoát</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="main-content-wp" class="list-post-page">
                <div class="wrap clearfix">
                    @include('admin.sidebar')
                    <div id="content" class="fl-right">

@yield('content')
                    </div>
                </div>
            </div>
            @include('admin.footer')
            <div class="wp-inner">
                <p id="copyright">2018 © Admin Theme by Php Master</p>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
