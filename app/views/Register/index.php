<?php require_once ("app/views/_Layout/__header.php") ?>

<?php

if ($_UserIsLogin) {
    header("Location: index.php");
    exit;
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">REGISTER</h2>
                </div>
                <div class="card-body">
                    <form id="registerForm">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password-again">Password Again:</label>
                            <input type="password" class="form-control" id="password-again" name="password-again">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">REGISTER</button>

                    </form>
                </div>
                <div class="card-footer">
                    <div id="response" class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#registerForm').submit(function (e) {
            debugger;
            e.preventDefault(); 

            var username = $('#username').val();
            var password = $('#password').val();
            var password_again = $('#password-again').val();
            debugger;
            if (password == password_again && password != '' && password != null) {
                debugger;
                $.ajax({
                    type: 'POST',
                    url: 'api/registerapi.php',
                    data: { username: username, password: password },
                    success: function (response) {
                        if (response.success) {
                            $('#response').html('<div class="alert alert-succes">' + response.message + ' . if you want go to <a href="login.php">LOGIN</a> </div>');
                        } else {
                            $('#response').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            }
            else {
                $('#response').html('<div class="alert alert-danger"> Password are not matching </div>');
            }
        });
    });
</script>

<?php require_once ("app/views/_Layout/__footer.php") ?>
