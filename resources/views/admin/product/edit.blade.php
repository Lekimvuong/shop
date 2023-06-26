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
                            <input type="text" name="name" value="{{$product->name }}"id="product-name">
                            <label for="code">Mã sản phẩm</label>
                            <input type="text" name="code"value="{{$product->code }}" id="product-code">
                            <label for="price">Giá sản phẩm</label>
                            <input type="text" name="price" value="{{$product->price }}" id="price">
                            <label for="price_sale">Giá sale</label>
                            <input type="text" name="price_sale" value="{{$product->price_sale }}"id="price_sale">
                            <label for="description">Mô tả ngắn</label>
                            <textarea name="description" id="desc">{{ $product->description }}</textarea>
                            <label for="content">Chi tiết</label>
                            <textarea name="content" id="desc" class="ckeditor">{{$product->content}}</textarea>
                            <label>Hình ảnh</label>
                            <div id="uploadFile">
                                <input type="file" name="files[]" url-handle="{{ route('Upload.multifiles') }}"
                                    id="upload-thumb" multiple>
                                <div id="errorMessages" style="display: none; color: red;"></div>
                                <div id="show_images" style="display: flex">
                                    @foreach($Medias as $media)
                                    @if($product->id==$media->product_id)
                                    <div class="image_show" data-path="{{$media->thumb}}">
                                        <input type="checkbox"name="delete_image" value="{{$media->thumb}}">Xóa
                                        <a href="" target ="blank">
                                            <img src="{{$media->thumb}}" width ="100px" id = "urlImage">
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div id="countThumbs"style=" color: red;"></div>
                            </div>
                            <button type="button" name="btn-delete"
                                url-delete="{{ route('Upload.delete')}}"id="deleteImage">Xóa
                                ảnh</button>
                            <label>Danh mục sản phẩm</label>
                            <select name="cat_id">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($productCats as $item)
                                <option value="{{ $item->id }}"{{$product->cat_id==$item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label for="active">Kích hoạt</label>
                            <select name="active" id ="active_product">
                                <option value="">-- Chọn trạng thái --</option>
                                <option value="1"{{$product->active == 1 ? 'selected' : ''}}>Công khai</option>
                                <option value="0"{{$product->active == 0 ? 'selected' : ''}}>Chờ duyệt</option>
                            </select>
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
            var instance = new ProductClass();
            instance.run();
        });
    </script>
@endsection
