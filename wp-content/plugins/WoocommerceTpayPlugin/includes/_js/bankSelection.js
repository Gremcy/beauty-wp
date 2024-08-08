(function ($) {
    $.loadScript = function (url, callback) {
        $.ajax({
            url: url,
            dataType: 'script',
            success: callback,
            async: false
        });
    }

    function setupBanksForm() {
        var str = '',
            i,
            str2 = '',
            tile,
            others = [157, 106, 109, 148, 104],
            group,
            id,
            groupName,
            logoSrc;
        if (isSmallList === 0) {
            for (i in tr_groups) {
                group = tr_groups[i];
                id = group[0];
                groupName = group[1];
                logoSrc = group[3];
                if (show_installments == 0 && id == 109) {
                    continue;
                }
                tile = getBankTile(id, groupName, logoSrc);
                if (inArray(id, others) === false) {
                    str += tile;
                } else {
                    str2 += tile;
                }
            }
            var $wrapper = $('#bank-selection-form');
            $wrapper.html(str + str2);
            $wrapper.find('.tpay-group-holder.tpay-with-logo').click(function () {
                var bankId = $(this).attr('data-groupId'),
                    input = document.getElementById('tpay-channel-input'),
                    bank_block = document.getElementById('bank-' + bankId),
                    active_bank_blocks = document.getElementsByClassName('tpay-active');

                input.value = bankId;
                if (active_bank_blocks.length > 0) {
                    active_bank_blocks[0].className = active_bank_blocks[0].className.replace('tpay-active', '');
                }
                if (bank_block !== null) {
                    bank_block.className = bank_block.className + ' tpay-active';
                }
            })
        } else {
            for (i in tr_groups) {
                group = tr_groups[i];
                id = group[0];
                groupName = group[1];
                if (show_installments == 0 && id == 109) {
                    continue;
                }
                str += getBankOption(id, groupName);
            }
            document.getElementById('tpay-bank-list').innerHTML = str;
            var $wrapper = $('#tpay-bank-list');
            $wrapper.change(function () {
                document.getElementById('tpay-channel-input').value = document.getElementById('tpay-bank-list').value;
            });
        }
        var regulation_checkbox = document.getElementById('tpay-accept-regulations-checkbox'),
            regulations_input = document.getElementById('tpay-regulations-input');

        regulation_checkbox.onchange = function () {
            regulations_input.value = (this.checked) ? 1 : 0;
        };
    }

    function getBankTile(groupId, groupName, logoSrc) {
        return '<div class="tpay-group-holder tpay-with-logo" id="bank-' + groupId + '" data-groupId="' + groupId + '">' +
            '<div class="tpay-group-name">' + groupName + '</div>' +
            '<div class="tpay-group-logo-holder">' +
            '<img src="' + logoSrc + '" class="tpay-group-logo" alt="' + groupName + '"/>' +
            '</div></div>';
    }

    function getBankOption(groupId, groupName) {
        return '<option value="' + groupId + '" >' + groupName + '</option>';
    }

    function inArray(needle, haystack) {
        var length = haystack.length;
        for (var i = 0; i < length; i++) {
            if (haystack[i] == needle) return true;
        }
        return false;
    }

    $(document).ready(function () {
        var tpayBanksLink = link;
        $.loadScript(tpayBanksLink, setupBanksForm);
        $(document.body).on('updated_checkout', function () {
            $.loadScript(tpayBanksLink, setupBanksForm);
        });
    });
})(jQuery);