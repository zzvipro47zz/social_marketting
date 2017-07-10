var no = 0;

$(document).on('click', '.delete-token', function () {
    var access_key = $(this).data('key');
    deleteToken(access_key);
});

function getListToken() {
    $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: {
            core: 'token',
            act: 'list'
        },
        success: function (response) {
            $.each(response.data, function (k, v) {
                getInfoAccount(v);
            });
        }
    });
}

function getInfoAccount(key) {
    $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: {
            core: 'token',
            act: 'get-info',
            access_key: key
        },
        success: function (response) {
            if (response.result) {
                no++;
                var t = $('.table').DataTable();
                t.row.add([
                    no,
                    response.data.key,
                    response.data.name,
                    response.data.type,
                    response.data.id,
                    '<div class="btn-group"><button class="btn btn-sm btn-primary edit">Sửa</button><button class="btn btn-sm btn-danger delete-token" data-key="' + response.data.key + '">Xóa</button></div>'
                ]).draw(false);
                $('#all-token-count').text(no);
            }
        }
    });
}

function deleteToken(key) {
    $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: {
            core: 'token',
            act: 'delete',
            access_key: key
        },
        success: function (response) {
            if (response.result) {
                $('#' + key).remove();
            }
        }
    });
}