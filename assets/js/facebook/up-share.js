$(document).on('click', '#setup-share', function () {
    console.log(12345);
    var idShare = $('#id-post').val();
    var shareLimit = $('#share-limit option:selected').val();
    $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: {
            core: 'share',
            act: 'setup',
            limit: shareLimit,
            id: idShare
        },
        success: function (response) {
            $('#id-post').val('');
            listSetup();
            alert(response.msg);
        }
    });
});

function listSetup() {
    $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: {
            core: 'share',
            act: 'get'
        },
        success: function (response) {
            if (response.result) {
                var data = response.data;
                if (data.length) {
                    $('#share-post-installed').html('');
                }
                $.each(data, function () {
                    $('#share-post-installed').append('<li class="list-group-item">ID: ' + this.id + ' <i class="badge">' + this.share_count + ' share</i></li>');
                });
            }

        }
    });
}