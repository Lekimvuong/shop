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
                        <input type="text" name="name" id="name" value = "{{$postCat->name}}" placeholder="Nhập tiêu đề">
                        <label for="description">Mô tả ngắn</label>
                        <textarea name="description" id="description">{{$postCat->description}}</textarea>
                        {{-- <input type="text" name="slug" id="slug"> --}}
                        <label for="content">Nội dung</label>
                        <textarea name="content" id="content" class="ckeditor">{{$postCat->content}}</textarea>
                        <label>Danh mục cha</label>
                        <select name="parent_id">
                            <option value="0" {{ $postCat->parent_id ==0 ? 'selected':'' }}>-- Chọn danh mục --</option>
                            @foreach ($postCats as $postCatParent)
                                <option value="{{ $postCatParent ->id }}" {{ $postCat->parent_id ==$postCatParent->id ? 'selected':'' }}>
                                {{$postCatParent->name}}
                                </option>
                            @endforeach
                        </select>
                        <label for="title">Kích hoạt</label>
                        <div class="radio-check">
                            <input type="radio" id="active" class="mr-4" name="active" {{$postCat->active == 1 ? 'checked' : ''}} value="1">  Có
                        </div>
                        <div class="radio-check">
                            <input type="radio" id="no_active" class="mr-4"  name="active"{{$postCat->active == 0 ? 'checked' : ''}} value="0">  Không
                        </div>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection