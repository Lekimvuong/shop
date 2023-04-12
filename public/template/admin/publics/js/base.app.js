(function() {
    "use strict";

    $.app = new function() {

        var appRunCls = {};
        var instance = this;

        this.lang = {};
        this.vars = {};
        this.t = {};
        this.io = null;

        this.f = function(str, data) {
            return str.replace(/{([^{}]*)}/g,
                function(a, b) {
                    var r = data[b];
                    if (r === undefined) r = '{' + b + '}';
                    return typeof r === 'string' ? r : "" + r;
                }
            );
        };

        this.validURL = function(string) {
            let url;

            try {
                url = new URL(string);
            } catch (_) {
                return false;
            }
            return url.protocol === "http:" || url.protocol === "https:";
        }

        this.initFlatPickr = function(elFlatpickr, otps) {
            let defaults = {
                dateFormat: 'd-m-Y',
                wrap: true,
                locale: 'vn',
                animate: true,

            };
            let options = extend({}, defaults, JSON.parse(elFlatpickr.getAttribute('data-options')), otps);
            flatpickr(elFlatpickr, options);
        };

        this.addCls = function(name, cls) {
            name = name.toLowerCase().trim();
            if (!appRunCls[name]) appRunCls[name] = cls;
        };
        this.setCls = function(name, cls) {
            name = name.toLowerCase().trim();
            appRunCls[name] = cls;
        };
        this.getCls = function(name) {
            name = name.toLowerCase().trim();
            return appRunCls[name];
        };

        this.init = function(args) {

            //Set vars
            for (var i in args) {
                if (args.hasOwnProperty(i)) {
                    instance.vars[i] = args[i];
                }
            }

            addPrototype();
            this.autohideAlert();
            //Run app
            this.run();

            //reload to login if require
            $(document).ajaxComplete(function(event, request, settings) {
                if (request.status == 401 && request.getResponseHeader('REQUIRES_AUTH') === '1')
                    window.location.reload();
            });






        };


        this.secondsToHms = function(d) {
            d = Number(d);
            var h = Math.floor(d / 3600);
            var m = Math.floor(d % 3600 / 60);
            var s = Math.floor(d % 3600 % 60);

            var hDisplay = h > 0 ? h + (h == 1 ? " h, " : " h, ") : "";
            var mDisplay = m > 0 ? m + (m == 1 ? " m, " : " m, ") : "";
            var sDisplay = s > 0 ? s + (s == 1 ? " s" : " s") : "";
            return hDisplay + mDisplay + sDisplay;
        }



        this.pushNoty = function(type, msg) {

            if (!type) type = 'success';
            // if (type == 'success' && !msg) msg = Lang.get('common.Successfully');
            // if (type == 'error' && !msg) msg = Lang.get('common.error_try_again');
            if (type == 'success' && !msg) msg = 'Thành công!';
            if (type == 'error' && !msg) msg = 'Thất bại!';

            var classBtn = ' btn-primary';
            if (type == 'error') {
                classBtn = 'btn-warning';
            }
            Swal.fire({
                text: msg,
                icon: type,
                // buttonsStyling: false,
                // confirmButtonText: Lang.get('common.Ok'),
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: "btn " + classBtn
                },
                showCloseButton: true,

            });


        };


        this.pushConfirmNoti = function(options) {

            Swal.fire({
                title: options.title ? options.title : 'Bạn có chắc không?',
                text: options.text ? options.text : '',
                icon: options.icon ? options.icon : '',
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy bỏ',
                reverseButtons: true,
                confirmButtonColor: '#377dff',
                cancelButtonColor: '#a4adbd',
                color: '#303030',
                customClass: {
                    'title': 'modal-title mb-1',
                    'content': 'fs-md text-gray-4 fw-bold mb-4'
                }
                // buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    if (options.callback) options.callback();
                } else {
                    options.unConfirm();

                }
            });
        };

        this.run = function() {
            $.each(appRunCls, function(index, data) {
                if (data.hasOwnProperty('run'))
                    data.run();
            });
        };



        //function to scroll(focus) to an element
        this.scrollTo = function(ele, offset) {
            var pos = (ele && ele.size() > 0) ? ele.offset().top : 0;

            if (ele) {
                if ($('body').hasClass('page-header-fixed')) {
                    pos = pos - $('.page-header').height();
                }
                pos = pos + (offset ? offset : -1 * ele.height());
            }

            $('html,body').animate({
                scrollTop: pos
            }, 'slow');
        };


        //Common ajax
        this.ajax = function(url, method, formData, target, option, callback) {
            $('.loading').show();
            var $button = $(target);
            var alertClass = option ? option.alertClass : null;
            var draw = option ? option.draw : null;
            var $alert = alertClass ? $(alertClass) : $button.parent().closest('alert');
            method = method || "POST";
            $.app.tmpHtml = target ? $button.html() : null;
            if (target) {
                if (typeof target === 'string') {
                    target = $(target);
                }
                target.LoadingOverlay("show", {
                    fade: false,
                    maxSize: 50
                });
            }

            var hideLoading = function() {
                if (target) {
                    target.LoadingOverlay("hide");
                }
                $('.loading').hide();

            };

            $alert.addClass('alert').addClass('text-left').removeClass('alert-danger').removeClass('alert-success');

            $.ajax({
                type: method,
                url: url,
                data: formData,
                success: function(data) {
                    hideLoading()
                    if (data.message) {
                        if (data.code) {
                            $alert.addClass('alert-success');
                        } else {
                            $alert.addClass('alert-danger');
                        }
                        $alert.removeClass('d-none').html(data.message);
                        setTimeout(function() {
                            $alert.addClass('d-none');
                        }, 3000);
                    }

                    if (target) {
                        target.LoadingOverlay("hide");
                        if (draw) {
                            target.html(data);
                        }

                    }

                    if (typeof callback === 'function') {
                        $('.loading').hide();
                        callback(data);
                    }
                },
                statusCode: {
                    400: function(response) {
                        hideLoading();
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,
                        });
                    },
                    500: function(response) {
                        hideLoading();
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Unknown Error',
                        });
                    },
                    403: function(response) {
                        hideLoading();
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,
                        });
                    },
                    404: function(response) {
                        hideLoading();
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,
                        });
                    },
                    422: function(response) {
                        hideLoading();
                        $.app.posting = false;
                        // $button.html($.app.tmpHtml);
                        $alert.removeClass('d-none').addClass('alert-danger').html();

                        var $html = [];
                        //$html.push(response.responseJSON.message);
                        $html.push('Lỗi khi xử lý dữ liệu:');
                        $.each(response.responseJSON.errors, function(field, errors) {
                            $.each(errors, function(idx, error) {
                                $html.push(error);
                            });
                        });

                        $alert.removeClass('d-none').addClass('alert-danger').html($html.join('<br/>'));
                    }
                },
                error: function() {
                    hideLoading();
                    $.app.posting = false;
                },
                done: function() {
                    hideLoading();
                    $.app.posting = false;
                }
            });
        };


        this.formatNumber = function(number) {


            if (!number) number = 0;
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            String(number).replace(/(.)(?=(\d{3})+$)/g, '$1,')
            return number;

        }

        this.urlAddParram = function(url, params) {
            var url = new URL(url);
            $.each(params, function(k, value) {
                url.searchParams.set(k, value);

            });

            return url.toString();
        };

        this.getUrlParam = function(url, name) {
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }




        this.parseJSON = function(str) {
            if (!str) return {};
            try {
                return $.parseJSON(str);
            } catch (err) {
                return {};
            }
        };



        this.setCookie = function(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        this.getCookie = function(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        this.eraseCookie = function(name) {
            document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        this.formatDate = function(d) {

            var dformat = [

                    d.getFullYear(),
                    (d.getMonth() + 1).padLeft(),
                    d.getDate().padLeft()
                ].join('-') +
                ' ' + [d.getHours().padLeft(),
                    d.getMinutes().padLeft(),
                    d.getSeconds().padLeft()
                ].join(':');
            return dformat;
        }

        var addPrototype = function() {

            String.prototype.ucwords = function() {
                var str = this.toLowerCase();
                return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
                    function(s) {
                        return s.toUpperCase();
                    });
            };

            $.fn.buttonLoading = function(text) {
                var $this = $(this);
                text = _.isEmpty(text) ? 'loading' : 'text';
                var loadingText = '<i class="fa fa-spinner fa-spin"></i> ' + text;

                $this.data('original-text', $(this).html());
                $this.html(loadingText);
            };

            $.fn.resetLoading = function() {
                var $this = $(this);
                $this.html($this.data('original-text'));
            };

            $.fn.outerHTML = function() {
                return $('<div />').append(this.eq(0).clone()).html();
            };

            $.fn.refresh = function() {
                return $(this.selector);
            };

            $.fn.alterClass = function(removals, additions) {

                var self = this;
                if (removals.indexOf('*') === -1) {
                    // Use native jQuery methods if there is no wildcard matching
                    self.removeClass(removals);
                    return !additions ? self : self.addClass(additions);
                }

                var patt = new RegExp('\\s' +
                    removals.replace(/\*/g, '[A-Za-z0-9-_]+').split(' ').join('\\s|\\s') +
                    '\\s', 'g');
                self.each(function(i, it) {
                    var cn = ' ' + it.className + ' ';
                    while (patt.test(cn)) {
                        cn = cn.replace(patt, ' ');
                    }
                    it.className = $.trim(cn);
                });

                return !additions ? self : self.addClass(additions);
            };



        };



        this.message = function(message, type) {
            if (_.isEmpty(type))
                type = 'error';

            var subtitle = 'Please try again.'

            if (type == 'success') {
                subtitle = 'Congrats!'
            } else if (type == 'info') {
                subtitle = 'Happy to help!'
            }

            var html = `<div class="message-container">
			<div class="message <%= type %> shadow">
                <%= message %>
				<br>
				<%= subtitle %>
				<a href="javascript:;"><i class="far fa-times"></i></a>
            </div></div>`;
            var compiled = _.template(html);
            var rs = compiled({
                'type': type,
                'message': message,
                'subtitle': subtitle,
            });

            $('body').append(rs);

        };


        this.showError = function(errMess) {
            errMess = errMess || '';
            if (errMess == '')
                errMess = 'An error occurred while processing please try again later!';
            sweetAlert('Oops...', errMess, 'error');
        };

        this.confirmAlert = function(msg, okCb, canCb) {
            Swal.fire({
                text: msg,
                title: 'Bạn có chắc chắn?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy bỏ'
            }).then((result) => {
                if (result.value) okCb();
                else if (typeof canCb != "undefined") canCb();
            })
        }

        this.showMessage = function(msg) {
            Swal.fire(msg)
        }

        this.removeItemByValue = function(arr, value) {
            return arr.filter(function(elem) {
                return elem != value;
            });
        };

        this.genRandomNumber = function(min, max) {
            return Math.floor((Math.random() * max) + min);
        };

        this.loadCss = function(lstFile) {
            if (!$.isArray(lstFile)) lstFile = [lstFile];

            $.each(lstFile, function(i, url) {

                if (!$('link[href="' + url + '"]').length)
                    $('head').append('<link rel="stylesheet" type="text/css" href="' + url + '">');
            });
        };


        this.genRand = function(length, current) {
            current = current || '';
            return length ? instance.genRand(--length, "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz".charAt(Math.floor(Math.random() * 60)) + current) : current;
        };

        this.redirect = function(path) {
            window.location.href = instance.vars.url + '/' + path;
        }



        this.showLoading = function() {
            if ($('.modal-loading').length == 0) $("body").append('<div class="modal-loading"></div>');
            $("body").addClass("loading");
        }

        this.hideLoading = function() {
            $("body").removeClass("loading")
        }

        this.autohideAlert = function() {
            setTimeout(function() {
                $("div.alert").remove();
            }, 3000); // 5 secs
        };

        this.checkboxAll = function($checkall, $checkItems) {
            $checkall.click(function() {
                $checkItems.not(this).prop('checked', this.checked).trigger('change');
                $checkall.not(this).prop('checked', this.checked)
            });
            $checkItems.click(function() {
                let allCheck = true;

                $checkItems.each(function() {
                    allCheck = $(this).is(':checked');
                    if (!allCheck) {
                        return false;
                    }
                });
                $checkall.prop('checked', allCheck)
            });
        }

        addPrototype();
    };


})();