var MediaClass = function() {
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
            var formData = new FormData();
            var files = $('#upload-thumb')[0].files;
            var $url = $(this).attr('url-update');
            for (var i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }
            $.ajax({
                processData: false,
                contentType: false,
                type: 'POST',
                datatype: 'JSON',
                data: formData,
                url: $url,
                success: function(results) {
                    if (results.error == false) {
                        $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                            '<img src="' + results.url + '" width="150px"></a>');
                        $('#thumb').val(results.url);
                        $('#name_image').val(results.name);
                    } else {
                        alert('Upload File Lỗi rồi kìa !');
                    }
                },
            });
        });
    }

}