<?php
session_start();

$currentPage = strtolower(basename($_SERVER['PHP_SELF']));

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
        <a class="navbar-brand" href="index.php">DEAL

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
                <li class="nav-item <?php if ($currentPage == 'index.php')
                    echo 'active'; ?>">
                    <a class="nav-link" href="index.php">MAIN PAGE<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'product.php')
                    echo 'active'; ?> ">
                    <a class="nav-link" href="product.php">PRODUCTS</a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'contact.php')
                    echo 'active'; ?> ">
                    <a class="nav-link" href="contact.php">CONTACT</a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'login.php')
                    echo 'active'; ?> ">

                    <?php if ($_UserIsLogin): ?>

                        <a class="nav-link" href="AdminPanel/Logout.php?logout=True">
                            <b> DEAR <?php echo $_SESSION['username'] ?> </b>
                            LOGOUT
                        </a>

                    <?php else: ?>
                        <a class="nav-link" href="Login.php">
                            LOGIN
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>