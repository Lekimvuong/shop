var ProductClass = function() {
    var ele = {};
    this.run = function() {
        this.init();
        this.bindEvents();
    }

    this.init = function() {
        ele.postTable = $('#product-table');
        ele.search = $('#search');
        ele.row = $('.remove-row');
        ele.thumb = $('#upload-thumb');
        ele.deleThumb = $('#deleteImage');
        ele.productName = $('#product-name');
        ele.productCode = $('#product-code');
        ele.productPrice = $('#price');
        ele.productSale = $('#price_sale');
        ele.productDesc = $('#desc');
        ele.productCat = $('#product-cat');
        ele.productActive = $('#active_product');
        //ele.modal = $('.show_modal');
    }
    this.bindEvents = function() {
        createProduct();
        uploadThumb();
        deletethumb();
        drawPostData();
        removeRow();
        //showModal();
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
                        $.each(results.url, function(i, url) {
                            $('#show_images').append('<div class="image_show" data-path="' + url + '"><div class="checkbox-container"><input type="checkbox" name="delete_image"value="' + url + '" ></div><a href="' + url +
                                '" target="_blank">' + '<input type="hidden" name="image_name[]" value="' + results.name[i] + '" class="image_name"></input>' +
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
                $urlImage.push($(this).val())
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
    var createProduct = function() {
        $('#form_submit').on('submit', function() {
            var editor = CKEDITOR.instances.product_content;
            var params = {
                'name': ele.productName.val(),
                'code': ele.productCode.val(),
                'price': ele.productPrice.val(),
                'price_sale': ele.productSale.val(),
                'description': ele.productDesc.val(),
                'content': editor.getData(),
                'cat_id': ele.productCat.val(),
                'active': ele.productActive.val(),
                'thumb': [],
                'name_thumb': []
            }
            $("input[name='thumb[]']").each(function() {
                params.thumb.push($(this).val());
            });
            $("input[name='image_name[]']").each(function() {
                params.name_thumb.push($(this).val()); //CHỗ m đẩy giá trị input image_name ở mô
            });
            $.ajax({
                url: '/admin/Products/add',
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
                pageLength: 7,
                lengthChange: false,
                info: true,
                dom: "lrtip",
                paging: true
            });
            ele.search.on('keyup', function(e) {
                postTable.column(4).search(e.target.value).draw();
            })
        }
        // var showModal = function() {
        //     ele.modal.on('click', function() {
        //         var dataPath = $(this).data('path');
        //         var dataId = $(this).data('id');
        //         $("#image_show").html('<img src="' + dataPath + '" width="100px"></a>')


    //     })
    // }
}