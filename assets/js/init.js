$(function () {
    /**
     * Function: TemplateLoader
     * author: Lê Phi
     * Please do not remove credit
     */
    var templateLoader = function () {
    };

    templateLoader.prototype = {
        require: function (template, callback) {
            $('.preloader').show();
            this.callback = callback;
            this.callTemplate(template);
        },
        loaded: function (evt) {
            if (typeof this.callback === 'function') this.callback.call();
        },
        callTemplate: function (template) {
            var self = this;
            $.ajax({
                url: './pages/' + template + '.html',
                success: function (res) {
                    $('.preloader').hide();
                    self.writeTemplate(res);
                },
                error: function () {
                    $('.preloader').hide();
                    alert('Load template lỗi');
                }
            });
        },
        writeTemplate: function (htmlTemplate) {
            $('#page-wrapper').html(htmlTemplate);
            this.loaded();
        }
    };



    loadTemplate('facebook.list-token');
    $(document).on('click', '.load-template', function () {
        loadTemplate($(this).data('template'));
    });

    function loadTemplate(template) {
        template = template.split('.').join('/');
        var templateLoaders = new templateLoader();
        templateLoaders.require(template,
            function () {
                // Callback
                console.log('Load successfully');
            });
    }

});