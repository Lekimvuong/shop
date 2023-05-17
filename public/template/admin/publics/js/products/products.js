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
    }

    this.bindEvents = function() {
        updateThumb();
        drawPostData();
        removeRow();
    }
    var updateThumb = function() {

        ele.thumb.on('change', function() {
            const form = new FormData();
            form.append('file', $(this)[0].files[0]);
            var $url = $(this).attr('url-update');
            $.ajax({
                processData: false,
                contentType: false,
                type: 'POST',
                datatype: 'JSON',
                data: form,
                url: $url,
                success: function(results) {
                    if (results.error == false) {
                        $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                            '<img src="' + results.url + '" width="150px"></a>');
                        $('#thumb').val(results.url);
                        $('#name_image').val(results.name);
                    } else {
                        alert('Upload File Lỗi!');
                    }
                },
            });
        });
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

}