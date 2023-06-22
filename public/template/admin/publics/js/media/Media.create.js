var MediaCreateClass = function() {
    var vars = {
        datatable: {},

    };
    var ele = {};
    this.run = function() {
        this.init();
        this.bindEvents();
    }

    this.init = function() {
        ele.btnCreate = $('#btn-submit');
        ele.category = $('#product_category')
    }

    this.bindEvents = function() {
        createProduct()
    }
    var createProduct = () => {
        ele.formSubmit.on('submit', function() { //bắt sự kiện form được submit. 
            var type = $(ele.btnCreate, $(this)).data('type') // lấy thuộc tính data-type của  nút nhấn 
            var params = {
                'category_id': ele.category.val(),
                'thumb': [],
            }
            let target = ele.btnCreate
            $('input[name="thumb[]"]').each((i, el) => {
                params.thumb.push($(el).val())
            })
            let _cb = (rs) => {
                if (rs.status) {
                    $.app.pushNotyCallback({
                        'type': 'success',
                        'callback': function() {
                            window.location.href = $.app.vars.url + '/products/'
                        }
                    })
                } else {
                    $.app.pushNoty('error')
                }
            }
            if (type === 'create') {
                $.app.ajax($.app.vars.url + 'upload/services', 'POST', params, target, null, _cb);
            }
        })
    }
}