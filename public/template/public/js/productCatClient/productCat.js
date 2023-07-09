var productCatClass = function() {
    var ele = {};
    this.run = function() {
        this.init();
        this.bindEvents();
    }

    this.init = function() {
        ele.productSort = $('#sort_by');
        ele.search = $('#search');
    }

    this.bindEvents = function() {
        productSort();
    }
    var productSort = function() {
        ele.productSort.on('change', function() {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        })
    }
}