/* FORMS */
// validation
let _iti = false;
function trigger_parsley(form, iti){
    var valid = true;
    _iti = iti;

    // check inputs
    var inputs = form.find('.parsley-check');
    inputs.each(function(){
        $(this).parents('.parsley-parent').removeClass('error');
        if($(this).attr('type') === 'tel' && $(this).val()){
            if(iti.isValidNumber() === false || $(this).parsley().isValid() === false){
                $(this).parents('.parsley-parent').addClass('error');
                valid = false;
            }
        }else{
            if($(this).parsley().isValid() === false){
                $(this).parents('.parsley-parent').addClass('error');
                valid = false;
            }
        }
    });

    // return
    return valid;
}
$(document).on('keyup keypress change', '.parsley-check', function() {
    if($(this).parents('.parsley-parent').hasClass('error')){
        var form = $(this).parents('.parsley-form');
        if(form.length){
            trigger_parsley(form, _iti);
        }
    }
});

// contact us
$(document).ready(function() {
    if($('#letter-phone').length){
        var letter_input = document.querySelector("#letter-phone");
        var letter_iti = intlTelInput(letter_input, {
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "pl";
                    success(countryCode);
                });
            },
            utilsScript: "/wp-content/themes/onrial/assets/js/min/utils.js",
            preferredCountries: ['pl']
        });
    }

    var no_block_letter = true;
    $(document).on('click', '.contact-form [type="submit"], .contacts__form [type="submit"]', function() {
        var submit = $(this);
        var form = submit.parents('.parsley-form');

        if(trigger_parsley(form, letter_iti) && no_block_letter) {
            // phone
            form.find('[name="phone"]').val(letter_iti.getNumber());
            // country
            form.find('[name="country"]').val(letter_iti.getSelectedCountryData().name);

            // ajax
            var formData = new FormData(form[0]);
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: formData,
                type: 'POST',
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // block
                    no_block_letter = false;
                    // button
                    if(form.hasClass('contacts__form')){ // contacts page
                        submit.html(submit.data('wait'));
                    }else{
                        submit.find('span').html(submit.data('wait'));
                    }
                },
                success: function (data) {
                    if (data.success) {
                        // reset
                        form.find('input, textarea').each(function (){
                            $(this).val('');
                        });

                        // success
                        if(form.hasClass('contacts__form')){ // contacts page
                            form.remove();
                            $(".contacts__thanks").css('display', 'flex');
                        }else{
                            $('body').addClass('is-hidden');
                            $('[data-modal="letter-thanks-popup"]').fadeIn(1).addClass('is-open');
                        }
                    }
                },
                complete() {
                    // block
                    no_block_letter = true;
                    // button
                    if(form.hasClass('contacts__form')){ // contacts page
                        submit.html(submit.data('default'));
                    }else{
                        submit.find('span').html(submit.data('default'));
                    }
                }
            });
        }
        return false;
    });
});

// questionnaire
$(document).ready(function() {
    if($('#questionnaire-phone').length){
        var questionnaire_input = document.querySelector("#questionnaire-phone");
        var questionnaire_iti = intlTelInput(questionnaire_input, {
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "pl";
                    success(countryCode);
                });
            },
            utilsScript: "/wp-content/themes/onrial/assets/js/min/utils.js",
            preferredCountries: ['pl']
        });
    }

    var no_block_questionnaire = true;
    $(document).on('click', '.questionnaire-form [type="submit"]', function() {
        var submit = $(this);
        var form = submit.parents('.parsley-form');

        if(trigger_parsley(form, questionnaire_iti) && no_block_questionnaire) {
            // phone
            form.find('[name="phone"]').val(questionnaire_iti.getNumber());
            // country
            form.find('[name="country"]').val(questionnaire_iti.getSelectedCountryData().name);

            // ajax
            var formData = new FormData(form[0]);
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: formData,
                type: 'POST',
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // block
                    no_block_questionnaire = false;
                    // button
                    submit.html(submit.data('wait'));
                },
                success: function (data) {
                    if (data.success) {
                        // reset
                        form.find('input, textarea').each(function (){
                            $(this).val('');
                        });

                        // success
                        $('body').addClass('is-hidden');
                        $('[data-modal="questionnaire-thanks-popup"]').fadeIn(1).addClass('is-open');
                    }
                },
                complete() {
                    // block
                    no_block_questionnaire = true;
                    // button
                    submit.html(submit.data('default'));
                }
            });
        }
        return false;
    });
});

// become partner
$(document).ready(function() {
    if($('#partner-phone').length) {
        var partner_input = document.querySelector("#partner-phone");
        var partner_iti = intlTelInput(partner_input, {
            initialCountry: "auto",
            geoIpLookup: function (success, failure) {
                $.get("https://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "pl";
                    success(countryCode);
                });
            },
            utilsScript: "/wp-content/themes/onrial/assets/js/min/utils.js",
            preferredCountries: ['pl']
        });
    }

    var no_block_partner = true;
    $(document).on('click', '.partner-form [type="submit"], .partnership-contact__form [type="submit"]', function() {
        var submit = $(this);
        var form = submit.parents('.parsley-form');

        if(trigger_parsley(form, partner_iti) && no_block_partner) {
            // phone
            form.find('[name="phone"]').val(partner_iti.getNumber());
            // country
            form.find('[name="country"]').val(partner_iti.getSelectedCountryData().name);

            // ajax
            var formData = new FormData(form[0]);
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: formData,
                type: 'POST',
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // block
                    no_block_partner = false;
                    // button
                    submit.html(submit.data('wait'));
                },
                success: function (data) {
                    if (data.success) {
                        // reset
                        form.find('input, textarea').each(function (){
                            $(this).val('');
                        });

                        // success
                        if(form.hasClass('partnership-contact__form')){ // partnership page
                            form.remove();
                            $(".partnership-connect__thanks").css('display', 'flex');
                        }else{
                            $('[data-modal="become-partner-popup"]').fadeOut(1).removeClass('is-open');
                            $('[data-modal="become-partner-thanks-popup"]').fadeIn(1).addClass('is-open');
                        }
                    }
                },
                complete() {
                    // block
                    no_block_partner = true;
                    // button
                    submit.html(submit.data('default'));
                }
            });
        }
        return false;
    });
});

// ambassador
$(document).ready(function() {
    if($('#ambassador-phone').length) {
        var ambassador_input = document.querySelector("#ambassador-phone");
        var ambassador_iti = intlTelInput(ambassador_input, {
            initialCountry: "auto",
            geoIpLookup: function (success, failure) {
                $.get("https://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "pl";
                    success(countryCode);
                });
            },
            utilsScript: "/wp-content/themes/onrial/assets/js/min/utils.js",
            preferredCountries: ['pl']
        });
    }

    var no_block_ambassador = true;
    $(document).on('click', '.ambassador-form [type="submit"]', function() {
        var submit = $(this);
        var form = submit.parents('.parsley-form');

        if(trigger_parsley(form, ambassador_iti) && no_block_ambassador) {
            // phone
            form.find('[name="phone"]').val(ambassador_iti.getNumber());
            // country
            form.find('[name="country"]').val(ambassador_iti.getSelectedCountryData().name);

            // ajax
            var formData = new FormData(form[0]);
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: formData,
                type: 'POST',
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // block
                    no_block_ambassador = false;
                    // button
                    submit.html(submit.data('wait'));
                },
                success: function (data) {
                    if (data.success) {
                        // reset
                        form.find('input, textarea').each(function (){
                            $(this).val('');
                        });

                        // success
                        $('[data-modal="ambassador-popup"]').fadeOut(1).removeClass('is-open');
                        $('[data-modal="ambassador-thanks-popup"]').fadeIn(1).addClass('is-open');
                    }
                },
                complete() {
                    // block
                    no_block_ambassador = true;
                    // button
                    submit.html(submit.data('default'));
                }
            });
        }
        return false;
    });
});

// get 5% discount
$(document).ready(function() {
    if($('#coupons-phone').length) {
        var coupons_input = document.querySelector("#coupons-phone");
        var coupons_iti = intlTelInput(coupons_input, {
            initialCountry: "auto",
            geoIpLookup: function (success, failure) {
                $.get("https://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "pl";
                    success(countryCode);
                });
            },
            utilsScript: "/wp-content/themes/onrial/assets/js/min/utils.js",
            preferredCountries: ['pl']
        });
    }

    var no_block_coupons = true;
    $(document).on('click', '.fill-out-form [type="submit"]', function() {
        var submit = $(this);
        var form = submit.parents('.parsley-form');

        if(trigger_parsley(form, coupons_iti) && no_block_coupons) {
            // phone
            form.find('[name="phone"]').val(coupons_iti.getNumber());
            // country
            form.find('[name="country"]').val(coupons_iti.getSelectedCountryData().name);

            // ajax
            var formData = new FormData(form[0]);
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: formData,
                type: 'POST',
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // block
                    no_block_coupons = false;
                    // button
                    submit.html(submit.data('wait'));
                },
                success: function (data) {
                    // reset
                    form.find('input, textarea').each(function (){
                        $(this).val('');
                    });
                    $('[data-modal="fill-out-form-popup"]').fadeOut(1).removeClass('is-open');

                    if (data.success) {
                        $('[data-modal="promocode-popup"] .ajax-show-coupon').html(data.coupon_code);
                        $('[data-modal="promocode-popup"]').fadeIn(1).addClass('is-open');
                    }else{
                        $('[data-modal="hello-popup"]').fadeIn(1).addClass('is-open');
                    }
                },
                complete() {
                    // block
                    no_block_coupons = true;
                    // button
                    submit.html(submit.data('default'));
                }
            });
        }
        return false;
    });
});

// questions
$(document).ready(function() {
    var no_block_questions = true;
    $(document).on('click', '.registration-sales-news-right [type="submit"]', function() {
        var submit = $(this);
        var form = submit.parents('.parsley-form');

        if(trigger_parsley(form) && no_block_questions) {
            // ajax
            var formData = new FormData(form[0]);
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: formData,
                type: 'POST',
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // block
                    no_block_questions = false;
                },
                success: function (data) {
                    if (data.success) {
                        // reset
                        form.find('input, textarea').each(function (){
                            $(this).val('');
                        });

                        // success
                        $('body').addClass('is-hidden');
                        $('[data-modal="letter-thanks-popup"]').fadeIn(1).addClass('is-open');
                    }
                },
                complete() {
                    // block
                    no_block_questions = true;
                }
            });
        }
        return false;
    });
});
/* END FORMS */

/* SHOP MAINPAGE */
$(document).on('click', '.catalog-page .catalog__item.clickable', function() {
    var term_id = $(this).data('term_id');
    $('.catalog-page .subcatalog').hide();
    $('.catalog-page .subcatalog[data-term_id="' + term_id + '"]').show();

    $('html, body').animate({
        scrollTop: $("#subcatalog").offset().top - $('header').outerHeight()
    }, 1000);

    return false;
});
/* END SHOP MAINPAGE */

/* WOOCOMMERCE */
// variations validation
$(document).on( 'check_variations', 'body', function(){
    if($('.ajax-products-item').length){
        var stock_class = 'variation';

        $('.ajax-products-item').each(function (){
            $selectionMsg = $(this).find('.product-right-info-settings');

            $notSelectedItems = 0;
            $(this).find('.variations_form .variations select').each(function (index, el) {
                if ($(el).find("option:selected").index() === 0) {
                    $notSelectedItems++;
                }else{
                    stock_class = stock_class + '_' + $(el).find("option:selected").val();
                }
            });
            if ($notSelectedItems > 0) {
                if ($selectionMsg.is(':hidden')) {
                    $selectionMsg.css('display', 'flex');
                }

                $(this).find('.product-right-options.default-price').css('display', 'flex');
            } else {
                $selectionMsg.css('display', 'none');

                if ($(this).find('.woocommerce-variation.single_variation').html() && $(this).find('.woocommerce-variation.single_variation').html().trim() != '') {
                    $(this).find('.product-right-options.default-price').css('display', 'none');
                }
            }
        });

        $('.ajax-stock').css('display', 'none');
        if($('.' + stock_class).length){
            $('.' + stock_class).css('display', 'inline-block');
        }
    }
});

// remove alert
$('.single_add_to_cart_button').on('click', function(e){
    if ( $( this ).is('.disabled') ) {
        e.preventDefault();
        return false;
    }else{
        let cts = [];
        let cats = JSON.parse(jQuery('[name="hidden_cats"]').val());
        let item_obj = {
            item_name: jQuery('[product-right-name]').text(),
            item_id: jQuery('[name="product_id"]').val(),
            price: jQuery('[name="hidden_price"]').val(),
            item_brand: 'Onrial',
            index: 1,
            quantity:jQuery('[name="quantity"]').val()
        };
        let content_category = [];
        cats.forEach(function(item, i, arr) {
            content_category.push(arr[i].name);
            if(i == 0){
                item_obj.item_category = arr[i].name;
                //cts['item_category'] = arr;
            }else{
                item_obj['item_category'+(i+1)] = arr[i].name;
                //cts['item_category'+(i+1)] = arr;
            }
        });
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push
        ({event: 'add_to_cart',
            ecommerce:
                {items:
                        [
                            item_obj
                        ]
                }
        });
        fbq('track', 'AddToCart', {
            content_ids: [jQuery('[name="product_id"]').val()],
            content_name: jQuery('[product-right-name]').text(),
            content_type: 'product',
            content_category: content_category.join(' > '),
            value: jQuery('[name="hidden_price"]').val()*jQuery('[name="quantity"]').val(),
            currency: jQuery('[name="hidden_price_code"]').val()
        });


        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push
        ({event: 'view_cart',
            ecommerce:
                {items: items_send}
        });

    }
});
$(document).on('click', '[data-target="cart-popup"]', function(){
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push
    ({event: 'view_cart',
        ecommerce:
            {items: items_send}
    });
});

// toggle favourite on product
$(document).on('click', '.categories-card-item-top-like', function(e) {
    e.preventDefault();
    const like = $(this)

    const likedCount = parseInt($('.js-like-counter').html())
    if($(this).parents('.categories-card').hasClass('favorit')) {
        $('.js-like-counter').html(likedCount-1)
    } else {
        $('.js-like-counter').html(likedCount+1)
    }

    $(this).parents('.categories-card').toggleClass('favorit')

    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'action' : 'toggle_favourite',
            'product_id' : $(this).data('product-id')
        },
        complete: function(data, status){
            if(status !== 'success' || data.responseJSON.success !== true)
                $(this).parents('.categories-card').toggleClass('favorit')
        }
    });
});

// toggle favourite on product single page
$(document).on('click', '.product-right-favourite', function(e) {
    e.preventDefault();
    const like = $(this)
    
    const likedCount = parseInt($('.js-like-counter').html())
    if($(this).hasClass('selected')) {
        $('.js-like-counter').html(likedCount-1)
    } else {
        $('.js-like-counter').html(likedCount+1)
    }

    $(this).toggleClass('selected')

    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'action' : 'toggle_favourite',
            'product_id' : $(this).data('product-id')
        },
        complete: function(data, status){
            if(status !== 'success' || data.responseJSON.success !== true)
                $(this).toggleClass('selected')
        }
    });
});

// add to cart
$('body').on( 'added_to_cart', function(){
    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'action' : 'update_cart',
            'type' : $('.checkout-page').length ? 'woocommerce_cart' : 'minicart'
        },
        success: function(data){
            // quantity
            $('.ajax-quantity').html(data.quantity);

            // total
            $('.ajax-total').html(data.sum);

            // minicart
            $('.ajax-minicart').html(data.minicart);
            $('.js-modal-link[data-target="cart-popup"]').trigger('click');
        }
    });
});


// change quantity
$(document).on('click', '.basket-item-product-quantity-less, .basket-item-product-quantity-more', function(e) {
    e.preventDefault();
    var is_popup = false;
    if($(this).closest('.product-right-quantity').parent().hasClass('cart-area-item-content-bottom')){
        is_popup = true;
    }
    var button = $(this);
    var input = button.parent().find('.qty');
    var number = parseInt(input.val());
    var max = input.attr('max') ? parseInt(input.attr('max')) : 99;
    let ev = '';
    if(button.hasClass('basket-item-product-quantity-less')){
        if(number > 1){
            input.val(number - 1);
        }
        ev = 'remove_from_cart';
    }else{
        if(number < max){
            input.val(number + 1);
        }
        ev = 'add_to_cart';
    }
    if(is_popup){
        let item_obj = {item_name: jQuery(this).closest('.cart_item').find('.cart-area-item-content-name a').text(),
            item_id: jQuery(this).closest('.cart_item').find('[name="product_id"]').val(),
            price: jQuery(this).closest('.cart_item').find('[name="product_price"]').val(),
            item_brand: 'Onrial',
            item_variant:jQuery(this).closest('.cart_item').find('.cart-area-item-content-name div').text(),
            index: 1,
            quantity:jQuery(this).closest('.cart_item').find('.qty[type="number"]').val()
        };
        let cts = [];
        let cats = JSON.parse(jQuery(this).closest('.cart_item').find('[name="cats_one"]').val());
        content_category = [];
        cats.forEach(function(item, i, arr) {
            content_category.push(arr[i].name);
            if(i == 0){
                item_obj.item_category = arr[i].name;
                //cts['item_category'] = arr;
            }else{
                item_obj['item_category'+(i+1)] = arr[i].name;
                //cts['item_category'+(i+1)] = arr;
            }
        });
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push
        ({event: ev,
            ecommerce:
                {items:
                        [
                            item_obj
                        ]
                }
        });
        if(ev == 'add_to_cart'){
            fbq('track', 'AddToCart', {
                content_ids: [jQuery(this).closest('.cart_item').find('[name="product_id"]').val()],
                content_name: jQuery(this).closest('.cart_item').find('.cart-area-item-content-name a').text(),
                content_type: 'product',
                content_category: content_category.join(' > '),
                value: jQuery(this).closest('.cart_item').find('[name="product_price"]').val()*jQuery(this).closest('.cart_item').find('.qty[type="number"]').val(),
                currency: jQuery(this).closest('.cart_item').find('[name="price_code"]').val()
            });
        }
    }
    if(button.parents('.ajax-minicart').length){
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                'action': 'change_quantity_in_cart',
                'cart_item_key': input.parents('[data-cart_item_key]').data('cart_item_key'),
                'quantity': parseInt(input.val()),
                'type' : $('.checkout-page').length ? 'cart' : 'minicart'
            },
            success: function(data){
                // quantity
                $('.ajax-quantity').html(data.quantity);

                // total
                $('.ajax-total').html(data.sum);
            }
        });
    }

    return false;
});

// remove from cart
$(document).on('click', '.cart-area-item-content-delete', function(e) {
    e.preventDefault();
    let cts = [];
    let cats = JSON.parse(jQuery(this).closest('.cart_item').find('[name="cats_one"]').val());
    let item_obj = {
        item_name: jQuery(this).closest('.cart_item').find('.cart-area-item-content-name a').text(),
        item_id: jQuery(this).closest('.cart_item').find('[name="product_id"]').val(),
        price: jQuery(this).closest('.cart_item').find('[name="product_price"]').val(),
        item_brand: 'Onrial',
        item_variant:jQuery(this).closest('.cart_item').find('.cart-area-item-content-name div').text(),
        index: 1,
        quantity:jQuery(this).closest('.cart_item').find('.qty[type="number"]').val()
    };
    cats.forEach(function(item, i, arr) {
        if(i == 0){
            item_obj.item_category = arr[i].name;
            //cts['item_category'] = arr;
        }else{
            item_obj['item_category'+(i+1)] = arr[i].name;
            //cts['item_category'+(i+1)] = arr;
        }
    });
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push
    ({event: 'remove_from_cart',
        ecommerce:
            {items:
                    [
                        item_obj
                    ]
            }
    });
    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'action': 'change_quantity_in_cart',
            'cart_item_key': $(this).data('cart_item_key'),
            'quantity': 0,
            'type' : $('.checkout-page').length ? 'cart' : 'minicart'
        },
        success: function(data){
            // quantity
            $('.ajax-quantity').html(data.quantity);

            // total
            $('.ajax-total').html(data.sum);

            // minicart
            $('.ajax-minicart').html(data.minicart);
            $('.js-modal-link[data-target="cart-popup"]').trigger('click');
        }
    });

    return false;
});

// hide some fields for pickup / inpost
$(document).on( 'change', '#shipping_method input[type="radio"]', function() {
    $('.billing-dynamic_pickup').toggleClass('hide_pickup', this.value === 'local_pickup:2');
    $('.inpost_fields').toggleClass('show_if_inpost', this.value !== 'flat_rate:3');
});

// hide/show coupon form
$(document).on( 'click', '.woocommerce-cart-form .show_discount_form', function() {
    $('.woocommerce-cart-form .have_discount_hide').remove();
    $('.woocommerce-cart-form .have_discount_show').show();
    return false;
});

// input coupon
$(document).on( 'keyup keypress change', '.woocommerce-cart-form input.discount_code', function() {
    $(this).removeClass('error');
    $(this).parents('.use-discount-form').find('.use-discount-form-input-error-text').hide();
});

// apply coupon
$(document).on( 'click', '.woocommerce-cart-form .apply_discount_code', function() {
    var coupon = $(this).parents('.use-discount-form').find('.discount_code').val();
    if(coupon){
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                'action': 'apply_coupon',
                'coupon': coupon
            },
            success: function(data){
                if(data.success){
                    // hide error
                    $('.woocommerce-cart-form .discount_code').removeClass('error');
                    $('.woocommerce-cart-form .use-discount-form-input-error-text').hide();

                    // minicart
                    $('.ajax-minicart').html(data.minicart);
                }else{
                    // show error
                    $('.woocommerce-cart-form .discount_code').addClass('error');
                    $('.woocommerce-cart-form .use-discount-form-input-error-text').show();
                }
            }
        });
    }else{
        $(this).parents('.use-discount-form').find('.discount_code').addClass('error');
    }

    return false;
});

// remove coupon
$(document).on( 'click', '.woocommerce-cart-form .remove_discount_code', function() {
    $(this).parents('.use-discount-form').find('.discount_code').val('');
    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'action': 'remove_coupon'
        },
        success: function(data){
            if(data.success){
                // coupon
                $('.ajax-coupon-block, .woocommerce-cart-form .remove_discount_code').hide();

                // total
                $('.ajax-total').html(data.sum);
            }
        }
    });

    return false;
});

// copy coupon
$(document).on('click', '[data-modal="promocode-popup"] .promocode-use', function (){
    navigator.clipboard.writeText($('[data-modal="promocode-popup"] .ajax-show-coupon').text());
    return false;
});

/* END WOOCOMMERCE */

/* SEARCH */
var block_search = false;
$(document).on('keyup keypress change', '.search-ajax', function() {
    var _this = $(this);
    setTimeout(function (){
        if(!block_search){
            var search = _this.val();
            var form = _this.parents('.search_form');

            // preloader
            form.find('.search-ajax-results').html('<div class="header-search-result-container"><div class="header-search-result-preloader show"><svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve"><path fill="#424242" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50"><animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite"/></path></svg></div></div>').css('display', 'flex');

            if(search.length >= 3){
                // ajax
                $.ajax({
                    url: '/wp-admin/admin-ajax.php',
                    data: {
                        'action': 'search_of_items',
                        'search': search
                    },
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function() {
                        block_search = true;
                    },
                    success: function (data) {
                        if (data.success) {
                            form.find('.search-ajax-results').html(data.html);
                        }
                    },
                    complete: function () {
                        block_search = false;
                    }
                });
            }else{
                form.find('.search-ajax-results').css('display', 'none');
            }
        }
    }, 100);
});
$(document).on('submit', '.search_form', function() {
    if(!$(this).find('.search-ajax').val()){
        return false;
    }
});
$(document).on('click', '.trigger_search_form', function() {
    $(this).parents('.search_form').trigger('submit');
});
/* END SEARCH */

/* OTHER */
function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
}

$(document).on('click', '.change-catalog-grid', function() {
    setCookie('catalog-grid', $(this).data('type'), '31');
    window.location.reload();
});
/* END OTHER */