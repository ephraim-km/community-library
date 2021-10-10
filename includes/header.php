<?php 
    ob_start();
    include_once 'includes/session.php'; 
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Local CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/response.css">

    <title>Library | <?php echo $title ?>
    </title>

</head>

<body>

    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

            <div class="container-fluid">

                <a class="navbar-brand" href="index.php">Community Library</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <!-- <div class="navbar-nav me-auto">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        <a class="nav-link" href="viewmembers.php">View Members</a>
                    </div> -->
                    <div class="navbar-nav ms-auto">

                        <a class="nav-link" aria-current="page" href="index.php">Home</a>

                        <?php if (!isset($_SESSION['userId']) || $_SESSION['username'] == 'admin') {?>
                        <a class="nav-link fade-white" aria-current="page" href="register.php">Register</a>
                        <?php } ?>

                        <?php if (!isset($_SESSION['username']) || !($_SESSION['username'] == 'admin')) {?>
                        <?php } else { ?>
                        <a class="nav-link fade-white" aria-current="page" href="viewmembers.php">View Members</a>
                        <?php } ?>

                        <?php if (!isset($_SESSION['userId'])) {?>
                        <a class="nav-link" aria-current="page" href="login.php"><i class="fas fa-sign-in-alt"></i>
                            Login</a>
                        <?php } else { ?>

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Hello
                                <?php echo $_SESSION['username'] ?></span></a>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                                <?php if (($_SESSION['username']) != 'admin') {?>
                                <li><a class="dropdown-item" href="userhome.php"><i class="fas fa-user-circle"></i>
                                        Profile</a></li>
                                <?php } ?>

                                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>
                                        Logout</a></li>

                            </ul>

                        </li>
                        <?php } ?>

                    </div>

                </div>

            </div>

        </nav>
        <br>