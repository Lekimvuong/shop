@extends('admin.master')
@section('content')
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        @include('admin.sidebar')
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">{{$title}}</h3>
                    <a href="{{route('Upload.add')}}" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        {{-- <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(69)</span></a></li>
                        </ul> --}}
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="search">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                    </div>
                    <div class="table-responsive">
                        <table id="Media_table" class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên ảnh</span></td>
                                    <td><span class="thead-text">Sản phẩm</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $t = 0; 
                                @endphp
                                @foreach ($Medias as $key => $Media)
                               
                                @php
                                $t++;
                                @endphp
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text">{{ $t}}</h3></span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <img src="{{ $Media->thumb }}" alt="">
                                        </div>
                                    </td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <span title="">{{ $Media->name }}</span>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="{{route('Upload.edit', ['media' => $Media->id])}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a url-delete="{{route('Upload.destroy')}}" title="Xóa" data-id="{{$Media->id}}"class="removeRow"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $Media->cat_id->name }}</span></td>
                                    <td><span class="tbody-text">{{$Media->created_at}}</span></td>
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
    <script type="text/javascript" src="{{ asset('template/admin/publics/js/media/Media.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var instance = new MediaClass();
            instance.run();
        });
    </script>
@endsection
