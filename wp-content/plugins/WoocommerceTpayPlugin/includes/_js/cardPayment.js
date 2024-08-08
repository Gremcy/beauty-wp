(function ($) {
    function CardPayment(url, pubkey) {
        this.url = url;
        this.pubkey = pubkey;
        $("#card_payment_form").attr("action", url);
        var numberInput = $('#card_number'),
            expiryInput = $('#expiry_date'),
            cvcInput = $('#cvc');
        const TRIGGER_EVENTS = 'input change blur';

        function SubmitPayment() {
            var cardNumber = numberInput.val().replace(/\s/g, ''),
                cd = cardNumber + '|' + expiryInput.val().replace(/\s/g, '') + '|' + cvcInput.val().replace(/\s/g, '') + '|' + document.location.origin,
                encrypt = new JSEncrypt(),
                decoded = Base64.decode(pubkey),
                encrypted;
            encrypt.setPublicKey(decoded);
            encrypted = encrypt.encrypt(cd);
            $("#card_data").val(encrypted);
            $("#card_vendor").val($.payment.cardType(cardNumber));
        }

        function setWrong($elem) {
            $elem.addClass('wrong').removeClass('valid');
        }

        function setValid($elem) {
            $elem.addClass('valid').removeClass('wrong');
        }

        function validateCcNumber($elem) {
            var isValid = false,
                ccNumber = $.payment.formatCardNumber($elem.val()),
                supported = ['mastercard', 'maestro', 'visa'],
                type = $.payment.cardType(ccNumber),
                notValidNote = $('#info_msg_not_valid'),
                cardTypeHolder = $('.tpay-card-icon'),
                notSupportedNote = $('#info_msg_not_supported');
            $elem.val($.payment.formatCardNumber($elem.val()));
            cardTypeHolder.attr('class', 'tpay-card-icon');
            if (supported.indexOf(type) < 0 && type !== null && ccNumber.length > 1) {
                showElem(notSupportedNote);
                hideElem(notValidNote);
                setWrong($elem);
            } else if (supported.indexOf(type) > -1 && $.payment.validateCardNumber(ccNumber)) {
                setValid($elem);
                hideElem(notSupportedNote);
                hideElem(notValidNote);
                isValid = true;
                SubmitPayment();
            } else if (ccNumber.length < 4) {
                hideElem(notSupportedNote);
                hideElem(notValidNote);
                setWrong($elem);
            } else {
                setWrong($elem);
                showElem(notValidNote);
                hideElem(notSupportedNote);
            }
            if (type !== '') {
                cardTypeHolder.addClass('tpay-' + type + '-icon');
            }

            return isValid;
        }

        function hideElem($elem) {
            $elem.css('display', 'none');
        }

        function showElem($elem) {
            $elem.css('display', 'block');
        }

        function validateExpiryDate($elem) {
            var isValid = false, expiration;
            $elem.val($.payment.formatExpiry($elem.val()));
            expiration = $elem.payment('cardExpiryVal');
            if (!$.payment.validateCardExpiry(expiration.month, expiration.year)) {
                setWrong($elem);
            } else {
                setValid($elem);
                isValid = true;
                SubmitPayment();
            }

            return isValid;
        }

        function validateCvc($elem) {
            var isValid = false;
            if (!$.payment.validateCardCVC($elem.val(), $.payment.cardType(numberInput.val().replace(/\s/g, '')))) {
                setWrong($elem);
            } else {
                setValid($elem);
                isValid = true;
                SubmitPayment();
            }

            return isValid;
        }
        numberInput.on(TRIGGER_EVENTS, function () {
            validateCcNumber($(this));
        });
        expiryInput.on(TRIGGER_EVENTS, function () {
            validateExpiryDate($(this));
        });
        cvcInput.on(TRIGGER_EVENTS, function () {
            validateCvc($(this));
        });
        $(".payment_box.payment_method_tpaycards").visibilityChanged({
            callback: function (element, visible) {
                SubmitPayment();
            },
            runOnLoad: false,
            frequency: 1000
        });
    }

    function handleTpayForm() {
        $('input[name=savedId]').each(function () {
            $(this).click(function () {
                if ($(this).is(":checked")) {
                    if ($(this).val() !== 'new') {
                        $('#card_form').css({opacity: 1.0}).animate({opacity: 0.0}, 500);
                        setTimeout(
                            function () {
                                $('#card_form').css({display: "none"})
                            }, 500
                        );
                    }
                }
            });
        });
        $('#newCard').click(function () {
            if ($(this).is(":checked")) {
                $('#card_form').css({opacity: 0.0, display: "block"}).animate({opacity: 1.0}, 500);
            }
        });
    }

    $(document).ready(function ($) {
        setupCardForm();
        $(document.body).on('updated_checkout', function () {
            setupCardForm();
        });

        function setupCardForm() {
            var RSA = document.getElementById("tpayRSA").textContent;
            $('input[name=savedId]').first().prop('checked', "checked");
            handleTpayForm();
            var cards_regulation_checkbox = document.getElementById('tpay-cards-accept-regulations-checkbox'),
                cards_regulations_input = document.getElementById('tpay-cards-regulations-input');

            cards_regulation_checkbox.onchange = function () {
                cards_regulations_input.value = (this.checked) ? 1 : 0;
            };
            new CardPayment("", RSA);
        }
    });

})(jQuery);
