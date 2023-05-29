var ProductClass = function() {
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
        ele.postTable = $('#product-table');
        ele.search = $('#search');
        ele.row = $('.remove-row');
        ele.deleThumb = $('#deleteImage');
    }

    this.bindEvents = function() {
            uploadThumb();
            // updateThumb();
            drawPostData();
            removeRow();
            deletethumb();
        }
        // var updateThumb = function() {
        //     ele.thumb.change(function() {
        //         deleteOldThumb();
        //         const form = new FormData();
        //         form.append('file', $(this)[0].files[0]);
        //         var $url = $(this).attr('url-update');
        //         $.ajax({
        //             type: 'POST',
        //             datatype: 'JSON',
        //             data: form,
        //             processData: false,
        //             contentType: false,
        //             url: $url,
        //             success: function(results) {
        //                 if (results.error == false) {
        //                     $("#image_show").html('<a href="' + results.url + '" target="_blank">' +
        //                         '<img src="' + results.url + '" width="100px"></a>');
        //                     $("#thumb").val(results.url);
        //                     $("#oldThumb").val(results.url);
        //                     $("#name_image").val(results.name);
        //                 } else {
        //                     var errorMessages = '<ul>';
        //                     $.each(results.error, function(key, value) {
        //                         errorMessages += '<li>' + value + '</li>';
        //                     });
        //                     errorMessages += '</ul>';
        //                     $('#errorMessages').html(errorMessages).show();
        //                 }
        //             },
        //         });
        //     });
        // }
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
                                '<img src="' + url + '" width="100px"></a><input type="hidden" name="thumb[]" value="' + url + '" class="thumb"></div>'
                            );
                        });
                        $('#deleteImage').show();
                        countImage();
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
                        countImage();
                    }

                }
            })
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
            postTable.column(4).search(e.target.value).draw();
        })
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
                        countImage();
                    }
                }
            })
        })
    }
    var countImage = function() {
        var imageContainer = document.getElementById('show_images');
        var images = imageContainer.getElementsByTagName('img');
        var imageCount = images.length;
        document.querySelector('#countThumbs').innerHTML = `<p>Đã tải lên ${imageCount} ảnh.</p>`
        if (imageCount == 0) {
            $('#deleteImage').hide();
        }
    }
}