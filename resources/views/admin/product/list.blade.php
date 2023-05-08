@extends('admin.master')
@section('content')
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        @include('admin.sidebar')
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">{{$title}}</h3>
                    <a href="{{route('products.add')}}" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(69)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(51)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt<span class="count">(0)</span> |</a></li>
                            <li class="pending"><a href="">Thùng rác<span class="count">(0)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="search">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    {{-- <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Công khai</option>
                                <option value="1">Chờ duyệt</option>
                                <option value="2">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div> --}}
                    <div class="table-responsive">
                        <table class="table list-table-wp" id="product-table">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Giá Sale</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $t = 0; 
                                @endphp
                                @foreach ($products as $key => $product)
                               
                                @php
                                $t++;
                                @endphp
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text">{{ $t}}</h3></span>
                                    <td><span class="tbody-text">{{ $product->code }}</h3></span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <img src="{{ $product->thumb }}" alt="">
                                        </div>
                                    </td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $product->name }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="{{route('products.show', ['product' => $product->id])}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $product->price }}</span></td>
                                    <td><span class="tbody-text">{{ $product->price_sale}}</span></td>
                                    <td><span class="tbody-text">{{ $product->product_cat?->name}}</span></td>
                                    <td><span class="tbody-text">{!! \App\Helpers\Helper::active($product->active) !!}</span></td>
                                    <td><span class="tbody-text">{{ $product->updated_at }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                </div>
                {!! $products->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('template/admin/publics/js/products/products.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var instance = new UpdateClass();
            instance.run();
        });
    </script>
@endsection