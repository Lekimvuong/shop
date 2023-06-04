@extends('admin.master')
@section('content')
    <div id="main-content-wp" class="list-product-page list-slider">
        <div class="wrap clearfix">
            @include('admin.sidebar')
            <div id="content" class="fl-right">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">{{ $title }}</h3>
                        <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
                    </div>
                </div>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            {{-- <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(69)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(51)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt<span class="count">(0)</span></a></li>
                            <li class="pending"><a href="">Thùng rác<span class="count">(0)</span></a></li>
                        </ul> --}}
                            <form method="GET" class="form-s fl-right">
                                <input type="text" name="s" id="s">
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
                            <table id="slider-table" class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">tên</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Link</span></td>
                                        <td><span class="thead-text">Thứ tự</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $t = 0;
                                    @endphp
                                    @foreach ($sliders as $key => $slider)
                                        @php
                                            $t++;
                                        @endphp
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text">{{ $t }}</h3></span>
                                            <td><span class="tbody-text">{{ $slider->name }}</span></td>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="{{ $slider->thumb}}" alt="">
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title="">{{ $slider->url }}</a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="{{route('slider.show', ['slider' => $slider->id])}}" title="Sửa"  class="edit"><i
                                                                class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a url-delete="{{route('slider.delete')}}"data-id="{{$slider->id}}" title="Xóa" class="removeRow"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text">{{ $slider->sort_by }}</span></td>
                                            <td><span class="tbody-text">{!! \App\Helpers\Helper::active_1($slider->active) !!}</span></td>
                                            <td><span class="tbody-text">{{ $slider->created_at }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
