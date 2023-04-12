var PostClass = function() {
    var vars = {
        datatable: {},

    };
    var ele = {};
    this.run = function() {
        this.init();
        this.bindEvents();
    }

    this.init = function() {
        ele.row = $('.remove-row');
        ele.postTable = $('#posts-table');
    }

    this.bindEvents = function() {
        removeRow();
        drawPostData();
    }

    var removeRow = function() {
        ele.row.on('click', function() {
            var $id = $(this).data('id');
            var $url = $(this).attr('url-delete');
            console.log($id, window.location.origin + 'admin/posts/destroy');
            if (confirm('Bạn có muốn xóa không ?')) {
                $.ajax({
                    type: 'DELETE',
                    datatype: 'JSON',
                    data: { 'id': $id },
                    url: $url,
                    success: function(result) {
                        if (result.error == false) {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert('Lỗi! Vui lòng thử lại');
                        }
                    }
                });
            }
        })
    }

    var drawPostData = function() {
        ele.postTable.DataTable({
            searching: false,
            pagination: true,
            lengthMenu: 20,
            lengthChange: false,
        })
    }
}