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
                        <form method="POST" action="{{ route('Upload.images') }}" id = "my_form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label>Hình ảnh</label>
                            <div id="uploadFile">
                                <input type="file" name="files[]" url-handle="{{ route('Upload.multifiles') }}"
                                    id="upload-thumb" multiple>
                                <div id="errorMessages" style="display: none; color: red;"></div>
                                <div id="show_images" style="display: flex">
                                </div>
                                <div id="countThumbs"style=" color: red;"></div>
                            </div>
                            <button type="button" name="btn-delete" url-delete="{{ route('Upload.delete') }}"id="deleteImage" style="display: none;">Xóa ảnh</button>
                            <label>Sản phẩm</label>
                            <select name="product_id" id ="product_category">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($product_id as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div></div>
                            <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('template/admin/publics/js/media/Media.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var instance = new MediaClass();
            instance.run();
        });
    </script>
@endsection
