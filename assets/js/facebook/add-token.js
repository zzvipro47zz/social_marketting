var i = tokenPage = tokenAccountPage = tokenAccount = 0;
var tokenList = [];

$(document).on('click', '#token-get-info', getTokenInput);
$(document).on('click', '.add-all', function () {
    addAll(this);
});
$(document).on('click', '.delete', function () {
    var selectorElement = '#' + $(this).closest('tbody').attr('id');
    if (selectorElement === '#token-account') {
        tokenAccount--;
    } else if (selectorElement === '#token-account-page') {
        tokenAccountPage--;
    } else if (selectorElement === '#token-page') {
        tokenPage--;
    }
    updateCount();
    $(this).closest('tr').remove();
});


function getTokenInput() {
    var tokens = $('#token-input').val();
    tokenList = tokens.split('\n');
    i = tokenPage = tokenAccountPage = tokenAccount = 0;
    loadToken();
}

function loadToken() {
    if (i >= tokenList.length) {
        alert('Xử lý xong!');
        return false;
    }
    var token = tokenList[i];
    $.ajax({
        url: 'https://graph.facebook.com/v2.8/me?access_token=' + token,
        success: function (response) {
            filterToken(token, response);
        },
        error: function () {
            i++;
            loadToken();
        }
    });
}

function filterToken(token, infoAccount) {
    $.ajax({
        url: 'https://graph.facebook.com/v2.2/me/accounts?access_token=' + token,
        success: function (response) {
            var template;
            var totalPage = response.data.length;
            if (totalPage) {
                tokenAccountPage++;
                template = templateToken(infoAccount, token, tokenAccountPage, totalPage);
                $('#token-account-page').append(template);
            } else {
                tokenAccount++;
                template = templateToken(infoAccount, token, tokenAccount, false);
                $('#token-account').append(template);
            }
            i++;
            loadToken();
        },
        error: function () {
            tokenPage++;
            var template = templateToken(infoAccount, token, tokenPage, false);
            $('#token-page').append(template);
            i++;
            loadToken();
        }
    });
}

function templateToken(data, token, no, totalPage) {
    updateCount();
    var text = '';
    if (totalPage) {
        text = '(có ' + totalPage + ' page)';
    }
    return '<tr>\
                <td class="text-vertical text-center">' + no + '</td>\
                <td class="text-vertical">' + data.name + ' ' + text + '</td>\
                <td class="text-vertical text-center">\
                <input type="hidden" class="token-select" value="' + token + '">\
                <button class="btn btn-sm btn-danger delete">Xóa</button>\
                </td>\
            </tr>';
}

function updateCount() {
    $('#token-account-count').text(tokenAccount);
    $('#token-account-page-count').text(tokenAccountPage);
    $('#token-page-count').text(tokenPage);
}

function addAll(selector) {
    var selectorElement = $(selector).data('selector');
    $('.token-select', $(selectorElement)).each(function () {
        var self = $(this);
        var token = self.val();
        $.ajax({
            url: 'ajax.php',
            type: 'post',
            data: {
                core: 'token',
                act: 'add',
                access_token: token
            },
            success: function (response) {
                console.log(response);
                if (response.result) {
                    self.closest('tr').remove();
                    if (selectorElement === '#token-account') {
                        tokenAccount--;
                    } else if (selectorElement === '#token-account-page') {
                        tokenAccountPage--;
                    } else if (selectorElement === '#token-page') {
                        tokenPage--;
                    }
                    updateCount();
                }
            }
        });
    });
}
