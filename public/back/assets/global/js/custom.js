function do_login(url) {
    $('button').prop("disabled", true);
    $('input').prop("disabled", true);
    $('#notify').show();
    var data = {
        email: $('#email').val(),
        phone: $('#phone').val(),
        password: $('#password').val(),
        _token: $('input[name="_token"]').val()
    };

    $.post( url , data).done(function( data )
    {

        if(data.scode == 401)
        {
            $('#login-status').removeClass('info');
            $('#login-status-icon-container').find('i').removeClass('fa-spinner fa-pulse');
            $('#login-status-icon-container').find('i').addClass('fa-times-circle');
            $('#login-status-message').html('');
            $.each(data.errors, function(k, v) {
                $('#login-status-message').append('<li>'+v+'</li>')
            });
            $('button').prop("disabled", false);
            $('input').prop("disabled", false);
        }else if(data.scode == 202){
            $('#login-status').removeClass('info');
            $('#login-status').addClass('success');
            $('#login-status-icon-container').find('i').removeClass('fa-spinner fa-pulse');
            $('#login-status-icon-container').find('i').addClass('fa-check-circle');
            $('#login-status-message').html('');
            $.each(data.msg, function(k, v) {
                $('#login-status-message').append('<li>'+v+'</li>')
            });
            setTimeout(function(){ location.reload(); }, 1000);

        }else{
            $('#login-status').removeClass('info');
            $('#login-status-icon-container').find('i').removeClass('fa-spinner fa-pulse');
            $('#login-status-icon-container').find('i').addClass('fa-check-circle');
            $('#login-status-message').html('');
            $('#login-status-message').append('<li>Some Error Happened</li>');
            $('button').prop("disabled", false);
            $('input').prop("disabled", false);
        }
    });
}
