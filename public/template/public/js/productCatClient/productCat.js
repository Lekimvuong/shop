var productCatClass = function() {
    var categoryIds = {}
    var options = {}
    var ele = {};
    this.run = function(opt) {
        options = opt
        categoryIds = options.categoryIds

        this.init();
        this.bindEvents();
    }

    this.init = function() {
        ele.productSort = $('#sort_by');
        ele.products = $('#products_list');
        ele.priceSort = $('input[name="r-price"]');
        ele.loadMore = $('#load-more');
        loadData()
    }

    this.bindEvents = function() {
        handleSort();
        handlePriceFilter();
        handlePaging()
    }

    var getParam = function() {
        let params = {
            categoryIds: categoryIds,
            priceSort: $('input[name="r-price"]:checked').val(),
            url: ele.productSort.val()
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

    var handleSort = function() {
        ele.productSort.on('change', function() {
            loadData()
        })
    }
    var handlePriceFilter = function() {
        ele.priceSort.on('change', function() {
            loadData()
        })
    }
    var handlePaging = function() {
        $(document).on('click', '.page-link-active', function(e) {
            e.preventDefault()
            let url = $(this).attr('href')
            var target = ele.products
            var _cb = function(rs) {
                var data = rs.data
                loadproduct(data)
            }
            $.app.ajax(url, 'GET', {}, target, null, _cb)
        })
    }

    var loadproduct = function(data) {
        ele.products.html(data.htmlProductLists);
    }
}