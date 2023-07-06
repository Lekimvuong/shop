@extends('admin.master')
@section('content')
    <div id="main-content-wp" class="add-cat-page slider-page">
        <div class="wrap clearfix">
            @include('admin.sidebar')
            <div id="content" class="fl-right">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">Thêm Slider</h3>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        @include('admin.alert')
                        <form method="POST" action="javascript:void(0)" id="Slider_Form">
                            {{ csrf_field() }}
                            <label for="title">Tên slider</label>
                            <input type="text" name="name" id="name_slider">
                            <label for="title">Link</label>
                            <input type="text" name="url" value="{{ old('url') }}" id="url_slider">
                            <label for="title">Sắp xếp</label>
                            <input type="text" name="sort_by" value="{{ old('sort_by') }}" id="sort_by">
                            <label>Hình ảnh</label>
                            <div id="uploadFile">
                                <input type="file" url-update="{{ route('Update.image') }}" id="updateThumb">
                                <div id="errorMessages" style="display: none; color: red;"></div>
                                <div id="image_show">
                                </div>
                                <input type="hidden" name="oldThumb" id="oldThumb">
                                <div id="countThumbs"style=" color: red;"></div>
                                <button type="button" name="btn-delete"
                                    url-delete="{{ route('Upload.delete') }}"id="deleteImage" style="display: none;">Xóa
                                    ảnh</button>
                            </div>
                            <label>Trạng thái</label>
                            <select name="active" id="active_slider">
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
    <script type="text/javascript" src="{{ asset('template/admin/publics/js/sliders/sliders.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var instance = new SliderClass();
            instance.run();
        });
    </script>
@endsection
