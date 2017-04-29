<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();

?>

<div class="container">
    <div class="login-form">
        <form action="user-store.php" method="post">
            <div class="form-group">
                <label for="username" class="form-control" id="username">Username:</label>
                <input type="text" name="username" class="form-control" autocomplete="off" id="username-admin">
                <div id="user-result-admin"></div>
            </div>

            <div class="form-group">
                <label for="pw" class="form-control">Password:</label>
                <input type="password" name="pw" class="form-control">
            </div>

            <div class="form-group">
                <label for="is_admin" class="form-control">Admin?</label>
                <select name="is_admin" id="is_admin" class="form-control">
                    <option value="1">Administrator</option>
                    <option value="0">Visitor</option>
                </select>
            </div>

            <button type="submit">Create</button>
        </form>
    </div>
</div>
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var usernameField = $('#username-admin');

        usernameField.blur(function() {
            if(!$(this).val()) {
                $("#user-result-admin").css("display", "none");
            } else {
                $("#user-result-admin").css("display", "block");
            }
        });

        usernameField.keyup(function (e){
            var user_name = $(this).val();
            check_username_ajax(user_name);
        });

        function check_username_ajax(username){
            $.post('../username-checker.php', {'username':username}, function(data) {
                $("#user-result-admin").html(data);
            });
        }
    });
</script>
<?php include "../includes/footer.php" ?>

