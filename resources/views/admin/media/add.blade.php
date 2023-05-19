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
                        <form method="POST" action="{{ route('Upload.images') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label>Hình ảnh</label>
                            <div id="uploadFile">
                                <input type="file" name="files[]" url-handle="{{ route('Upload.multifiles') }}"
                                    id="upload-thumb" multiple>
                                <div id="errorMessages" style="display: none; color: red;"></div>
                                <div id="show_images" style="display: flex">
                                </div>
                            </div>
                            <button type="button" name="btn-delete" url-delete="{{ route('Upload.delete') }}"id="deleteImage" style="display: none;">Xóa ảnh</button>
                            <label>Sản phẩm</label>
                            <select name="product_id">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($product_id as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            {{-- <label for="title">Kích hoạt</label>
                            <div class="radio-check">
                                <input type="radio" id="active" class="radio-check-1" name="active" value="1"> Có
                            </div>
                            <div class="radio-check">
                                <input type="radio" id="no_active" class="radio-check-2" value="0" name="active">
                                Không
                            </div> --}}
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
