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
                    <form method="POST">
                        <label for="name">Tiêu đề</label>
                        <input type="text" name="name" id="name" placeholder="Nhập tiêu đề">
                         <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug">
                        <label for="description">Mô tả ngắn</label>
                        <textarea name="description" id="description"></textarea>
                        {{-- <input type="text" name="slug" id="slug"> --}}
                        <label for="content">Nội dung</label>
                        <textarea name="content" id="content" class="ckeditor"></textarea>
                        <label>Danh mục cha</label>
                        <select name="parent_id">
                            <option value="0">-- Chọn danh mục --</option>
                            @foreach ($productCats as $productCat)
                                <option value="{{ $productCat->id }}">{{ $productCat->name }}</option>
                            @endforeach
                        </select>
                        <label>Trạng thái</label>
                        <select name="active">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1">Công khai</option>
                            <option value="0">Chờ duyệt</option>
                        </select>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
