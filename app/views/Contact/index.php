<?php require_once ("app/views/_Layout/__header.php") ?>
<style>
    .message-list {
        max-height: 500px;
        overflow-y: auto;
    }

    .message-card {
        margin-bottom: 20px;
    }

    .guest-name {
        font-weight: bold;
        font-size: 1.2em;
    }

    .guest-message {
        font-size: 1em;
    }
</style>
<?php if ($_UserIsLogin == false): ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2>Contact Us</h2>
                <div class="contact-form">
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="username">Name:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="card-footer">
                    <div id="response" class="text-center"></div>
                </div>
            </div>

        </div>
    </div>
<?php else: ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h2>Contact Us</h2>
                <div class="contact-form">
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="username">Name:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="card-footer">
                    <div id="response" class="text-center"></div>
                </div>
            </div>
            <div class="col-6">
                <h1 class="mb-4">Guest Messages</h1>
                <div class="message-list" id="messageContainer">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function () {
        var username = $('#username').val();
        <?php if ($_UserIsLogin): ?>
            username = '<?php echo $_SESSION['username'] ?>';
            username = "User Name : " + username;
            $('#username').val(username);
            $('#username').prop('readonly', true);
        <?php endif; ?>

        $('#contactForm').submit(function (e) {
            debugger;
            e.preventDefault(); 

            debugger;
            <?php if (!$_UserIsLogin): ?>
                username = "Guest : " + $('#username').val();
            <?php endif; ?>

            var message = $('#message').val();
            var method = "createContact";
           
            $.ajax({
                type: 'POST',
                url: 'http://dealer.rf.gd/index.php?url=api',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({ "username": username, "message": message, "method": method }),
                success: function (response) {
                    if (response.success) {
                        $('#response').html('<div class="alert alert-succes">' + response.message + ' </div>');
                        $('#message').val("");
                        GetlistMessage();
                    } else {
                        $('#response').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });


        // get all list message
        debugger
        function GetlistMessage() {
            <?php if ($_UserIsLogin): ?>
                $.ajax({
                    type: 'POST',
                    url: 'http://dealer.rf.gd/index.php?url=api',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({ "method": "getContactList" }),
                    success: function (response) {
                        debugger;
                        $('#messageContainer').empty();
                        var data = response.message;
                        if (data) {
                            debugger;
                            $.each(data, function (index, message) {
                                debugger;
                                var html = '<div class="card message-card">';
                                html += '<div class="card-body">';
                                html += '<div class="guest-name">' + message.ContactName+ '</div>';
                                html += '<div class="guest-message">' + message.ContactMessage  + '</div>';
                                html += '</div></div>';
                                $('#messageContainer').append(html);
                            });
                        } else {
                            $('#messageContainer').append('<p>Veri bulunamadı.</p>');
                        }
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            <?php endif; ?>
        }
        GetlistMessage();
    });
</script>
<?php require_once ("app/views/_Layout/__footer.php") ?>
