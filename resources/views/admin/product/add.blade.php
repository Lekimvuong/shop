@extends('admin.master')
@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="wrap clearfix">
            @include('admin.sidebar')
            <div id="content" class="fl-right">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        @include('admin.alert')
                        <form method="POST" action="javascript:void(0)" enctype="multipart/form-data" id="form_submit">
                            {{ csrf_field() }}
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" name="name" value="{{ old('name') }}"id="product-name">
                            <label for="code">Mã sản phẩm</label>
                            <input type="text" name="code"value="{{ old('code') }}" id="product-code">
                            <label for="price">Giá sản phẩm</label>
                            <input type="text" name="price" value="{{ old('price') }}" id="price">
                            <label for="price_sale">Giá sale</label>
                            <input type="text" name="price_sale" value="{{ old('price_sale') }}"id="price_sale">
                            <label for="description">Mô tả ngắn</label>
                            <textarea name="description"value="{{ old('description') }}" id="desc" class ="ckeditor"></textarea>
                            <label for="content">Chi tiết</label>
                            <textarea name="content" class ="ckeditor" id="product_content" value=""></textarea>
                            <label>Hình ảnh</label>
                            <div id="uploadFile">
                                <input type="file" name="files[]" url-handle="{{ route('Upload.multifiles') }}"
                                    id="upload-thumb" multiple>
                                <div id="errorMessages" style="display: none; color: red;"></div>
                                <div id="show_images" style="display: flex"></div>
                                <div id="countThumbs"style=" color: red;"></div>
                            </div>
                            <button type="button" name="btn-delete"
                                url-delete="{{ route('Upload.delete') }}"id="deleteImage" style="display: none;">Xóa
                                ảnh</button>
                            <label>Danh mục sản phẩm</label>
                            <select name="cat_id" id ="product-cat">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($productCats as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label>Trạng thái</label>
                        <select name="active" id ="active_product">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1">Công khai</option>
                            <option value="0">Chờ duyệt</option>
                        </select>
                            <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
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
        var instance = new ProductClass();
        instance.run();
    });
</script>
@endsection
