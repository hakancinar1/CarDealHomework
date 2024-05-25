<?php
session_start();


function parseUrl_header() {
    if (isset($_GET['url'])) {
        $url = $_GET['url'];
        $url = trim($url, '/');
        $urlSegments = explode('/', $url);
        return $urlSegments;
    }
    return [];


}
$parsUrl=parseUrl_header();
$currentPage ="home";
if(count($parsUrl)>0){
    $currentPage = $parsUrl[0];
}



$_UserIsLogin = false;
if (isset($_SESSION['token'])) {
    $_UserIsLogin = true;
    //header("Location: Login.php");
    //exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEAL</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php?url=home">DEAL

            <?php if ($_UserIsLogin): ?>
                for Users
            <?php endif; ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php if ($currentPage == 'home')
                    echo 'active'; ?>">
                    <a class="nav-link" href="index.php?url=home">MAIN PAGE<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'product')
                    echo 'active'; ?> ">
                    <a class="nav-link" href="index.php?url=product">PRODUCTS</a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'contact')
                    echo 'active'; ?> ">
                    <a class="nav-link" href="index.php?url=contact">CONTACT</a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'login')
                    echo 'active'; ?> ">

                    <?php if ($_UserIsLogin): ?>

                        <a class="nav-link" id ="logout_user" >
                            <b> DEAR <?php echo $_SESSION['username'] ?> </b>
                            LOGOUT
                        </a>

                    <?php else: ?>
                        <a class="nav-link" href="index.php?url=login">
                            LOGIN
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        

        $("#logout_user").click(function (event) {
            event.preventDefault();
            
            debugger;
            $.ajax({
                type: 'POST',
                url: 'http://dealer.rf.gd/index.php?url=api',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    "method": "logout"
                    
                }),
                success: function (response) {
                    debugger;
                    if (response.success) {
                        window.location.href = "index.php?url=home";

                    } else {
                        window.alert("Check the system!");
                    }
                },
                error: function (response) {
                    debugger;
                    console.log(response);
                }
            });
        
        });
      
        
    
    
    
    });
</script>