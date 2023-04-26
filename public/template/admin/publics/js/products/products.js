var UpdateClass = function() {
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
    }

    this.bindEvents = function() {
        updateThumb();
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
                    } else {
                        alert('Upload File Lỗi!');
                    }
                },
            });
        });
    }


}