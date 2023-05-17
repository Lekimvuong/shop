@extends('admin.master')
@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="wrap clearfix">
            @include('admin.sidebar')
            <div id="content" class="fl-right">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">{{$title}}</h3>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        @include('admin.alert')
                        <form method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" name="name" value="{{ $product->name }}"id="product-name">
                            <label for="code">Mã sản phẩm</label>
                            <input type="text" name="code"value="{{ $product->code }}" id="product-code">
                            <label for="price">Giá sản phẩm</label>
                            <input type="text" name="price" value="{{ $product->price }}" id="price">
                            <label for="price_sale">Giá sale</label>
                            <input type="text" name="price_sale" value="{{ $product->price_sale }}"id="price_sale">
                            <label for="description">Mô tả ngắn</label>
                            <textarea name="description" id="desc">{{ $product->description }}</textarea>
                            <label for="content">Chi tiết</label>
                            <textarea name="content" id="desc" class="ckeditor">{{ $product->content }}</textarea>
                            <label>Hình ảnh</label>
                            {{-- <div id="uploadFile">
                                <input type="file" url-update="{{ route('Upload.files') }}" 
                                    id="upload-thumb">
                                <div id="image_show">
                                    <a href="" target ="blank">
                                        <img src="{{$product->thumb}}" width ="100px"alt="">
                                    </a>
                                </div>
                                <input type="hidden" name="thumb" value ="{{$product->thumb}}"id="thumb">
                            </div> --}}
                            <label>Danh mục sản phẩm</label>
                            <select name="cat_id">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($productCats as $item)
                                <option value="{{ $item->id }}"{{$product->cat_id==$item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            {{-- <label>Trạng thái</label>
                            <select name="status">
                                <option value="0">-- Chọn danh mục --</option>
                                <option value="1">Chờ duyệt</option>
                                <option value="2">Đã đăng</option>
                            </select> --}}
                            <label for="title">Kích hoạt</label>
                            <div class="radio-check">
                                <input type="radio" id="active" class="radio-check-1" name="active"{{$product->active == 1 ? 'checked =""':''}} value="1"> Có
                            </div>
                            <div class="radio-check">
                                <input type="radio" id="no_active" class="radio-check-2" value="0"{{$product->active == 0 ? 'checked =""':''}} name="active">
                                Không
                            </div>
                            <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                        </form>
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
            var instance = new UpdateClass();
            instance.run();
        });
    </script>
@endsection
