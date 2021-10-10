<?php 
    ob_start();
    include_once 'includes/session.php';
    require_once "db/conn.php";
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

    <!-- Local CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/response.css">

    <title>Library | Home</title>

</head>

<body>

    <div class="custom-header">

        <nav class="navbar navbar-expand-lg navbar-light">

            <div class="container-fluid">

                <a class="navbar-brand mb-0 h1 fade-white" href="index.php">Community Library</a>

                <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link fade-white" aria-current="page" href="index.php">Home</a>
                        <?php if (!isset($_SESSION['username']) || !($_SESSION['username'] == 'admin')) {?>
                        <?php } else { ?>
                        <a class="nav-link fade-white" aria-current="page" href="viewmembers.php">View Members</a>
                        <?php } ?>
                        <a class="nav-link fade-white" aria-current="page" href="register.php">Register</a>
                        <?php if (!isset($_SESSION['userId'])) {?>
                        <a class="nav-link" aria-current="page" href="login.php"><i class="fas fa-sign-in-alt"></i>
                            Login</a>
                        <?php } else { ?>
                        <a class="nav-link" aria-current="page" href="logout.php"><i class="fas fa-sign-out-alt"></i>
                            Logout</a>
                        <?php } ?>
                    </div>
                </div>

            </div>

        </nav>

        <div class="middle-caption">
            <div class="container">

                <div class="row">
                    <div class="col">
                        <h1 class="text-center">My library, my lifeline.</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p class="text-center">Opening the door to knowledge. Register and become a member today!
                        </p>
                    </div>
                </div>

                <div class="row text-center button-down">
                    <div class="col">
                        <a class="btn btn-outline-primary my-2" href="login.php" role="button">Login</a>
                    </div>
                    <div class="col">
                        <a class="btn btn-outline-primary my-2" href="register.php" role="button">Register</a>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/7e5cbe9b0d.js" crossorigin="anonymous"></script>

</body>

</html>