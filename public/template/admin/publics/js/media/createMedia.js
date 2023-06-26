var CreateMediaClass = function() {
    var ele = {};
    this.run = function() {
        this.init();
        this.bindEvents();
    }

    this.init = function() {
        ele.thumb = $('#upload-thumb');
        ele.deleThumb = $('#deleteImage');
        ele.btnCreate = $('#btn-submit');
        ele.productID = $('#product_category');
    }

    this.bindEvents = function() {
        uploadThumb();
        createMedia();
    }
    var uploadThumb = function() {
        ele.thumb.on('change', function() {
            var formData = new FormData();
            var files = $('#upload-thumb')[0].files;
            var TotalFiles = $('#upload-thumb')[0].files.length;
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
                        $.each(results.url, function(i, url) {
                            $('#show_images').append('<div class="image_show" data-path="' + url + '"><div class="checkbox-container"><input type="checkbox" name="delete_image"value="' + url + '" ></div><a href="' + url +
                                '" target="_blank">' + '<input type="hidden" name="image_name" value="' + results.name[i] + '" class="image_name"></input>' +
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
    var countImage = function() {
        var imageContainer = document.getElementById('show_images');
        var images = imageContainer.getElementsByTagName('img');
        var imageCount = images.length;
        document.querySelector('#countThumbs').innerHTML = `<p>Đã tải lên ${imageCount} ảnh.</p>`
        if (imageCount == 0) {
            $('#deleteImage').hide();
        }
    }
    var createMedia = function() {
        $('#my_form').on('submit', function() {
            var params = {
                'thumb': [],
                'name_thumb': [],
                'product_id': ele.productID.val(),
            }
            $("input[name='thumb[]']").each(function() {
                params.thumb.push($(this).val());
            });
            $("input[name='image_name']").each(function() {
                params.name_thumb.push($(this).val()); //CHỗ m đẩy giá trị input image_name ở mô
            });
            $.ajax({
                url: '/admin/upload/services',
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