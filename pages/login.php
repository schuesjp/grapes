<?php

/* Import DB Configuration */
include "../db/dbconfig.php";

/* Allow for Session Use */
session_start();

/* Possible Error Message */
$error = "";

// Get Post Varibles
$mail = $_POST["mail"];
$pass = $_POST["pass"];

// Connect to Database
$db = connectDB();

/* Handle Login Request if applicable */
if (isset($_POST["login"]) && !empty($_POST["mail"]) && !empty($_POST["pass"])) {

    $rawQuery = "
        SELECT username FROM users
        WHERE email=:mail AND password=MD5(:pass)
    ";

    // Run SQL
    $prepQuery = $db->prepare("$rawQuery");
    $prepQuery->bindParam(":mail", $mail, PDO::PARAM_STR);
    $prepQuery->bindParam(":pass", $pass, PDO::PARAM_STR);
    $prepQuery->execute();

    // Get Results
    $result = $prepQuery->fetch();

    // Update Accordingly
    if ($result != FALSE && isset($result["username"])) {
        $_SESSION["user"] = $result["username"];
        /* Redirect */
    } else {
        $error = "Incorrect Username or Password";
    }

} else if (isset($_POST["register"]) && !empty($_POST["nmail"]) && !empty($_POST["npass"])) {

    /* Registeration involves more POST vars */
    $user = $_POST["user"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $bday = $_POST["bday"];
    $zip = $_POST["zip"];

    /* Check Database for Ohio voters */
    $screenQuery = "
        SELECT voterID, stateSenateDistrict, stateRepresentativeDistrict from voters
        WHERE firstName=:fname AND lastName=:lname
        AND residentZip=:zip AND birthday=:bday
        LIMIT 1
    ";

    $prepQuery = $db->prepare("$rawQuery");
    $prepQuery->bindParam(":fname", $fname, PDO::PARAM_STR);
    $prepQuery->bindParam(":lname", $lname, PDO::PARAM_STR);
    $prepQuery->bindParam(":zip", $zip, PDO::PARAM_STR);
    $prepQuery->bindParam(":bday", $bday, PDO::PARAM_STR);
    $prepQuery->execute();

    $res = $prepQuery->fetch(PDO::FETCH_ASSOC);

    if ($res) {

        /* Perform Registration */
        $rawQuery = "
            INSERT INTO users
            VALUES (:user, :mail, MD5(:pass), :id, :senate, :rep)
        ";

        // Run SQL
        $prepQuery = $db->prepare("$rawQuery");
        $prepQuery->bindParam(":user", $user, PDO::PARAM_STR);
        $prepQuery->bindParam(":mail", $mail, PDO::PARAM_STR);
        $prepQuery->bindParam(":pass", $pass, PDO::PARAM_STR);
        $prepQuery->bindParam(":id", $res["voterID"], PDO::PARAM_STR);
        $prepQuery->bindParam(":senate", $res["stateSenateDistrict"], PDO::PARAM_STR);
        $prepQuery->bindParam(":rep", $res["stateRepresentativeDistrict"], PDO::PARAM_STR);
        $prepQuery->execute();

        /* Redirect */

    } else {
        $error = "You are not an Ohio voter, or you are not in our database.";
    }

}

/* Close the Database Connection */
closeDB($db);

?>

<html lang="en">

    <head>

        <!-- META Data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Anthony Zheng">
        <meta name="keywords" content="">

        <!-- Site Title (What shows up in the tab) -->
        <title>Grapevine | Log In</title>

        <!-- Bootstrap & CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="../css/scrolling-nav.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">

    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="../index.html#page-top"><img src="../img/logo.png"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="hidden">
                            <a class="page-scroll" href="../index.html#page-top"></a>
                        </li>
                        <li>
                            <a class="page-scroll" href="../index.html#about">About</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="../index.html#contact">Contact</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="login-btn" href="../index.html">
                                <span class="glyphicon glyphicon-home"></span> Home
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Sign In / Sign Up Form -->
        <section class="intro-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-6">

                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#login">Log In</a></li>
                            <li><a data-toggle="pill" href="#register">Sign Up</a></li>
                        </ul>

                        <div class="tab-content">
                            <!-- Log In Section -->
                            <div id="login" class="tab-pane fade in active">
                                <p style="color: red"> <?php echo $error; ?> </p>
                                <form action="" method="POST">
                                    <input class="form-control" type="email" name="mail" placeholder="Email" required autofocus>
                                    <input class="form-control" type="password" name="pass" placeholder="Password" required>
                                    <button class="btn btn-default" type="submit" name="login">Login</button>
                                </form>
                            </div>

                            <!-- Sign Up Section -->
                            <div id="register" class="tab-pane fade">
                                <p style="color: red"> <?php echo $error; ?> </p>
                                <form action="" method="POST">
                                    <input class="form-control" type="email" name="mail" placeholder="Email" required autofocus>
                                    <input class="form-control" type="text" name="fname" placeholder="First Name" required>
                                    <input class="form-control" type="text" name="lname" placeholder="Last Name" required>
                                    <input class="form-control" type="text" name="zip" placeholder="Your Zip Code" required>
                                    <input class="form-control" type="date" name="bday" placeholder="Date of Birth (yyyy-mm-dd)" required>
                                    <input class="form-control" type="text" name="user" placeholder="Username" required>
                                    <input class="form-control" type="password" name="pass" placeholder="Password" required>
                                    <button class="btn btn-default" type="submit" name="register">Sign Up</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Scrolling Nav JavaScript -->
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/scrolling-nav.js"></script>

    </body>

</html>
