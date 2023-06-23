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
    }

    this.bindEvents = function() {
        drawPostData();
        removeRow();
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
}