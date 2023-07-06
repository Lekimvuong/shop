var SliderClass = function() {
    var ele = {};
    this.run = function() {
        this.init();
        this.bindEvents();
    }

    this.init = function() {
        ele.deleThumb = $('#deleteImage');
        ele.updateThumb = $('#updateThumb');
        ele.postTable = $('#slider-table');
        ele.search = $('#search');
        ele.row = $('.removeRow');
        ele.name = $('#name_slider');
        ele.url = $('#url_slider');
        ele.sortBy = $('#sort_by');
        ele.thumb = $('#thumb');
        ele.nameThumb = $('#name_image');
        ele.active = $('#active_slider');
    }

    this.bindEvents = function() {
        updateThumb();
        createSlider();
        drawPostData();
        removeRow();

    }
    var updateThumb = function() {
        ele.updateThumb.change(function() {
            deleteOldThumb();
            const form = new FormData();
            form.append('file', $(this)[0].files[0]);
            var $url = $(this).attr('url-update');
            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: form,
                processData: false,
                contentType: false,
                url: $url,
                success: function(results) {
                    if (results.error == false) {
                        $("#image_show").html('<a href="' + results.url + '" target="_blank">' +
                            '<img src="' + results.url + '" width="100px" class="image_url"></a>' +
                            '<input type="hidden" name="thumb" id="thumb" value ="' + results.url + '"></input>' +
                            '<input type="hidden" name="name_image" id="name_image" value ="' + results.name + '"></input>'
                        );
                        $("#oldThumb").val(results.public_id);
                        $('#deleteImage').show();
                        deletethumb();
                    } else {
                        var errorMessages = '<ul>';
                        $.each(results.error, function(key, value) {
                            errorMessages += '<li>' + value + '</li>';
                        });
                        errorMessages += '</ul>';
                        $('#errorMessages').html(errorMessages).show();
                    }
                },
            });
        });
    }

    var deleteOldThumb = function() {
        var $input = document.querySelector('#oldThumb').value;
        $.ajax({
            type: 'delete',
            datatype: 'JSON',
            data: { 'input': $input },
            url: '/admin/upload/services/deleteOld',
            success: function(response) {
                if (response.success == true) {

                }
            }
        });

    }
    var deletethumb = function() {
        ele.deleThumb.on('click', function() {
            var $urlImage = [];
            var $url = $(this).attr('url-delete');
            $urlImage.push($('#thumb').val());
            $.ajax({
                url: $url,
                type: 'delete',
                data: { 'urlImage': $urlImage },
                success: function(response) {
                    if (response.success == true) {
                        $("#image_show").empty();
                        $('#deleteImage').hide();
                    }
                }
            })
        })
    }
    var drawPostData = function() {
        var postTable = ele.postTable.DataTable({
            searching: true,
            pagination: true,
            lengthMenu: 20,
            lengthChange: false,
            info: false,
            dom: "lrtip",
        });
        ele.search.on('keyup', function(e) {
            postTable.column(3).search(e.target.value).draw();
        })
    }
    var removeRow = function() {
        ele.row.on('click', function() {
            var $id = $(this).data('id');
            var $url = $(this).attr('url-delete');
            $.app.pushConfirmNoti({
                title: 'Bạn có muốn xóa không ?',
                callback: function() {
                    $.ajax({
                        type: 'DELETE',
                        datatype: 'JSON',
                        data: { 'id': $id },
                        url: $url,
                        success: function(result) {
                            if (result.error == false) {
                                $.app.pushNoty('success');
                                location.reload();
                            } else {
                                $.app.pushNoty('error', 'Lỗi! Vui lòng thử lại');
                            }
                        }
                    });
                }
            });
        })
    }
    var createSlider = function() {
        $('#Slider_Form').on('submit', function() {
            var params = {
                'name': ele.name.val(),
                'url': ele.url.val(),
                'sort_by': ele.sortBy.val(),
                'thumb': ele.thumb.val(),
                'name_thumb': ele.nameThumb.val(),
                'active': ele.active.val()
            }
            $.ajax({
                url: '/admin/Sliders/add',
                type: 'post',
                data: {
                    'params': params,
                },
                success: function(response) {
                    if (response.success == true) {
                        $.app.pushNoty('success');
                        document.querySelector('div.image_show').remove();

                    } else {
                        $.app.pushNoty('error', 'Lỗi! Vui lòng thử lại');
                    }
                }
            })
        })
    }
}