var MediaClass = function() {
    var ele = {};
    this.run = function() {
        this.init();
        this.bindEvents();
    }

    this.init = function() {
        ele.updateThumb = $('#updateThumb');
        ele.postTable = $('#Media_table');
        ele.search = $('#search');
        ele.row = $('.removeRow');
    }

    this.bindEvents = function() {
        updateThumb();
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
                            '<img src="' + results.url + '" width="100px"></a>');
                        $("#thumb").val(results.url);
                        $("#name_image").val(results.name);
                        $("#oldThumb").val(results.public_id);
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
            pageLength: 7,
            lengthChange: false,
            info: true,
            dom: "lrtip",
            paging: true
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