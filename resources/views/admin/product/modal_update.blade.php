<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Media</h4>
            </div>
            <div class="modal-body">
                <div id="main-content-wp" class="add-cat-page">
                    <div class="wrap clearfix">
                        <div id="content" class="border-0 p-0">
                            <div class="section" id="detail-page">
                                <div class="section-detail">
                                    <form method="POST">
                                        {{ csrf_field() }}
                                        <label class="mb-0">Hình ảnh</label>
                                        <div id="uploadFile" class="mb-4">
                                            <input type="file" class="pb-3"
                                                url-update="{{ route('Update.image') }}" id="updateThumb">
                                            <div id="errorMessages" style="display: none; color: red;"></div>
                                            <div id="image_show">
                                                <a href="" target="blank">
                                                    <img src="" width="100px" id="urlImage">
                                                </a>
                                            </div>
                                            <input type="hidden" name="thumb" id="thumb" value="">
                                            <input type="hidden" name="name" id="name_image" value="">
                                            <input type="hidden" name="oldName" id="oldThumb" value="">
                                        </div>

                                        <label class="mb-0">Sản phẩm</label>
                                        <select name="product_id">
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        </select>
                                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript" src="{{ asset('template/admin/publics/js/media/Media.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var instance = new MediaClass();
        instance.run();
    });
</script>
