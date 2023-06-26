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
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="search">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp" id="product-table">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
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
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $product->name }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="{{route('products.show', ['product' => $product->id])}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a url-delete="{{route('products.delete')}}" title="Xóa" class="delete remove-row"  data-id="{{$product->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $product->price }}</span></td>
                                    <td><span class="tbody-text">{{ $product->price_sale}}</span></td>
                                    <td><span class="tbody-text">{{ $product->product_cat?->name}}</span></td>
                                    <td><span class="tbody-text">{!! \App\Helpers\Helper::active($product->active) !!}</span></td>
                                    <td><span class="tbody-text">{{ $product->created_at }}</span></td>
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
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('template/admin/publics/js/products/products.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var instance = new ProductClass();
            instance.run();
        });
    </script>
@endsection