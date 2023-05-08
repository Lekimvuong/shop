@extends('admin.master')
@section('content')
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        @include('admin.sidebar')
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">{{ $title }}</h3>
                    <a href="{{ route('productCat.add') }}" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(10)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(5)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(5)</span></a></li>
                            <li class="trash"><a href="">Thùng rác <span class="count">(0)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="search">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                    </div>
                    <div class="table-responsive">
                        <table id="products-table" class="table cell-border list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">ID</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Parent_id</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                {!! \App\Helpers\Helper::productCat($productCats) !!}
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
    <script type="text/javascript" src="{{asset('template/admin/publics/js/productCat/producCat.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var instance = new productCatClass();
            instance.run();
        }); 
    </script>
@endsection
