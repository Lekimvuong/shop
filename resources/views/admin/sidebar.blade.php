<div id="sidebar" class="fl-left">
    <ul id="sidebar-menu">
        {{-- <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-map icon"></span>
                <span class="title">Trang</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?page=add_page" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?page=list_page" title="" class="nav-link">Danh sách các trang</a>
                </li>
            </ul>
        </li> --}}
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-pencil-square-o icon"></span>
                <span class="title">Bài viết</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('postCats.add')}}" title="" class="nav-link">Thêm mới bài viết </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('postCats.list')}}" title="" class="nav-link">Danh Mục bài viết</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-product-hunt icon"></span>
                <span class="title">Sản phẩm</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('products.add')}}" title="" class="nav-link">Thêm mới sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('products.list')}}" title="" class="nav-link">Danh sách sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('productCat.list')}}" title="" class="nav-link">Danh mục sản phẩm</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-database icon"></span>
                <span class="title">Bán hàng</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?page=list_order" title="" class="nav-link">Danh sách đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a href="?page=list_customer" title="" class="nav-link">Danh sách khách hàng</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <span class="fa fa-cubes icon"></span>
                <span class="title">Khối giao diện</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?page=add_widget" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?page=list_widget" title="" class="nav-link">Danh sách khối</a>
                </li>
                <li class="nav-item">
                    <a href="?page=menu" title="" class="nav-link">Menu</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <i class="fa fa-sliders" aria-hidden="true"></i>
                <span class="title">Slider</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('slider.add')}}" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?page=list_slider" title="" class="nav-link">Danh sách slider</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <i class="fa fa-file-image-o" aria-hidden="true"></i>
                <span class="title">Media</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('Upload.add')}}" title="" class="nav-link">Thêm mới Media</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('Upload.list')}}" title="" class="nav-link">Danh sách media</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
