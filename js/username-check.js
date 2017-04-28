$(document).ready(function() {
    var usernameField = $('#username');

    usernameField.blur(function() {
        if(!$(this).val()) {
            $("#user-result").css("display", "none");
        }
    });

    usernameField.keyup(function (e){
        var user_name = $(this).val();
        check_username_ajax(user_name);
    });

    function check_username_ajax(username){
        $.post('username-checker.php', {'username':username}, function(data) {
            $("#user-result").html(data);
        });
    }
});