var MediaClass = function() {
    var vars = {
        datatable: {},

    };
    var ele = {};
    this.run = function() {
        this.init();
        this.bindEvents();
    }

    this.init = function() {
        ele.thumb = $('#upload-thumb');
        ele.deleThumb = $('#deleteImage');
        ele.updateThumb = $('#updateThumb');
        ele.postTable = $('#Media_table');
        ele.search = $('#search');
        ele.row = $('.removeRow');
    }

    this.bindEvents = function() {
        uploadThumb();
        deletethumb();
        updateThumb();
        drawPostData();
        removeRow();
    }
    var uploadThumb = function() {
        ele.thumb.on('change', function() {
            var formData = new FormData();
            var files = $('#upload-thumb')[0].files;
            var TotalFiles = $('#upload-thumb')[0].files.length; //Total files
            var $url = $(this).attr('url-handle');
            for (var i = 0; i < TotalFiles; i++) {
                formData.append('files[]', files[i]);
            }
            formData.append('TotalFiles', TotalFiles);
            $.ajax({
                processData: false,
                contentType: false,
                type: 'POST',
                datatype: 'JSON',
                data: formData,
                url: $url,
                success: function(results) {
                    if (results.error == false) {
                        results.url.forEach(url => {
                            $('#show_images').append('<div class="image_show" data-path="' + url + '"><input type="checkbox" name="delete_image" value="' + url + '" >Xóa</input><a href="' + url +
                                '" target="_blank">' +
                                '<img src="' + url + '" width="100px"></a></div>' +
                                '<input type="hidden" name="thumb[]" value="' + url + '" id="thumb">');
                        });
                        $('#deleteImage').show();
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

    var deletethumb = function() {
        ele.deleThumb.on('click', function() {
            var $urlImage = [];
            var $url = $(this).attr('url-delete');
            $('input[name="delete_image"]:checked').each(function() {
                $urlImage.push($(this).closest('.image_show').data('path'))
            });
            $.ajax({
                url: $url,
                type: 'delete',
                data: { 'urlImage': $urlImage },
                success: function(response) {
                    if (response.success == true) {
                        $('input[name="delete_image"]:checked').closest('.image_show').remove();
                    }

                }
            })
        })
    }
    var updateThumb = function() {
        ele.updateThumb.change(function() {
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
                            '<img src="' + results.url + '" width="100px"></a>');
                        $("#thumb").val(results.url);
                        $("#name_image").val(results.name);
                        deleteOldThumb();
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
}