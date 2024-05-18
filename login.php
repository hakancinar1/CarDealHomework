<?php include ("ViewHtml/_ViewHeader.php") ?>
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
                    <h2 class="text-center">Login</h2>
                </div>
                <div class="card-body">
                    <form id="loginForm">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <a href="register.php" class="btn btn-outline-primary btn-block">Register</a>

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
        $('#loginForm').submit(function (e) {
            e.preventDefault(); 
            debugger;
            var username = $('#username').val();
            var password = $('#password').val();

            $.ajax({
                type: 'POST',
                url: 'http://dealer.rf.gd/Api/LoginApi.php',
                data: { username: username, password: password },
                success: function (response) {
                    debugger;
                    if (response.success) {
                        window.location.href = "index.php";

                    } else {
                        $('#response').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                }
            });
        });
    });
</script>

<?php include ("ViewHtml/_ViewFooter.php") ?>