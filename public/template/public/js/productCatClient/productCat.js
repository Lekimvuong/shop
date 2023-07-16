var productCatClass = function() {
    var categoryIds = {}
    var options = {}
    var ele = {};
    this.run = function(opt) {
        options = opt
        categoryId = options.categoryId
        categoryIds = options.categoryIds

        this.init();
        this.bindEvents();
    }

    this.init = function() {
        ele.productSort = $('#sort_by');
        ele.products = $('#products_list')
        ele.priceSort = $('input[name="r-price"]')
        loadData()
    }

    this.bindEvents = function() {
        productSort();
        productSort2();
    }

    var getParam = function() {
        let params = {
            categoryIds: categoryIds,
        }
        return params
    }

    var loadData = function() {
        var params = getParam()
        var target = ele.products
        var _cb = function(rs) {
            var data = rs.data
            loadproduct(data)
        }

        $.app.ajax(window.location.origin + '/danh-muc/getData', 'GET', params, target, null, _cb)
    }

    var productSort = function() {
        ele.productSort.on('change', function() {
            var url = $(this).val();
            var params = getParam()
            $.ajax({
                type: 'GET',
                data: { 'url': url, 'categoryIds': params.categoryIds },
                url: '/danh-muc/getData',
                success: function(results) {
                    var data = results.data
                    loadproduct(data)
                }
            });
        })
    }
    var productSort2 = function() {
        ele.priceSort.on('change', function() {
            var priceSort = $('input[name="r-price"]:checked').val();
            var params = getParam()
            console.log(priceSort);
            $.ajax({
                url: '/danh-muc/getData',
                type: 'GET',
                data: {
                    'priceSort': priceSort,
                    'categoryIds': params.categoryIds
                },
                success: function(results) {
                    var data = results.data
                    loadproduct(data)
                }
            })
        })
    }
    var loadproduct = function(data) {
        ele.products.html(data.htmlProductLists);
    }
}