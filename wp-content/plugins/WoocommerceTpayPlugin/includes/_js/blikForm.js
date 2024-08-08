(function ($) {
    $(document).ready(function () {
        setupBlikForm();
        $(document.body).on('updated_checkout', function () {
            setupBlikForm();
        });
    });
    setupBlikForm = function () {
        $('#blik_code').on('input change blur', function () {
            var that = $(this);
            if (that.val().length > 0) {
                $('#tpay-transfers-form').css('display', 'none');
            } else {
                $('#tpay-transfers-form').css('display', 'block');
            }
        });
    }
})(jQuery);
