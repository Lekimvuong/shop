@extends('admin.master')
@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="wrap clearfix">
            @include('admin.sidebar')
            <div id="content" class="fl-right">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">{{ $title }}</h3>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        @include('admin.alert')
                        <form method="POST" action="{{ route('Upload.update', ['media' => $media->id])}}">
                            {{ csrf_field() }}
                            <label>Hình ảnh</label>
                            <div id="uploadFile">
                                <input type="file" url-update="{{route('Update.image')}}" id="updateThumb">
                                <div id="errorMessages" style="display: none; color: red;"></div>
                                <div id="image_show">
                                    <a href="" target ="blank">
                                        <img src="{{$media->thumb}}" width ="100px" id = "urlImage">
                                    </a>
                                </div>
                                <input type="hidden" name="thumb" id="thumb" value ="{{$media->thumb}}">
                                <input type="hidden" name="name" id="name_image" value ="{{$media->name}}">
                                <input type="hidden" name="oldName" id ="oldThumb" value ="{{$media->thumb}}">
                            </div>
                            {{-- <button type="button" name="btn-delete"
                                url-delete="{{ route('Upload.delete') }}"id="deleteImage" style="display: none;">Xóa
                                ảnh</button> --}}
                            <label>Sản phẩm</label>
                            <select name="product_id">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($products as $item)
                                <option value="{{ $item->id }}"{{$media->product_id==$item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                                @endforeach
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
    <script type="text/javascript" src="{{ asset('template/admin/publics/js/media/Media.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var instance = new MediaClass();
            instance.run();
        });
    </script>
@endsection
