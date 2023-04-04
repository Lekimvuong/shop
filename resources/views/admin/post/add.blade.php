@include('admin.header')
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        @include('admin.sidebar')
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    @include('admin.alert')
                    <form method="POST">
                        <label for="name">Tiêu đề</label>
                        <input type="text" name="name" id="name" placeholder="Nhập tiêu đề">
                        <label for="description">Mô tả ngắn</label>
                        <textarea name="description" id="description"></textarea>
                        {{-- <input type="text" name="slug" id="slug"> --}}
                        <label for="content">Nội dung</label>
                        <textarea name="content" id="content" class="ckeditor"></textarea>
                        <label for="title">Kích hoạt</label>
                        <div class="radio-check">
                            <input type="radio" id="active" class="mr-4" name="active" value="1">Có
                        </div>
                        <div class="radio-check">
                            <input type="radio" id="no_active" class="mr-4" value="0" name="active">Không
                        </div>
                        <label>Danh mục cha</label>
                        <select name="parent_id">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->name }}</option>
                            @endforeach

                        </select>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')
