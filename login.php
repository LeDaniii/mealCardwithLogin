<?php

ob_start();
session_start();
require_once 'dbconnect.php';
if(isset($_SESSION['user']) != ""){
    header("Location: index.php"); //redirects to home.php
}

$error = false;

if(isset($_POST['btn-signup'])) {

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['password']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
        $emailError = "Please enter valid email address";
    }

    if(empty($pass)) {
        $error = true;
        $emailError = "Please enter your password.";
    }

    // if there is no error, continue to login
    if(!$error) {
        $password = hash('sha256', $pass);
    
    $res = mysqli_query($conn, "select userId, userName, userPass, userType from users where userEmail='$email'");
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $count = mysqli_num_rows($res); // if username/password is correct it has to return one row

    if($count == 1 && $row['userPass'] == $password) {
        if ($row['userType']=="user") {
            $_SESSION['user'] = $row['userId'];
            header( "Location: index.php");
        }elseif ($row['userType']=="admin") {
            $_SESSION['admin'] = $row['userId'];
            header( "Location: index.php");
        } else {
            $errMSG = "userType in database invalid";
        }
        
    } else {
        $errMSG = "Incorrect Credentials, Try again";
    }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
    <link rel="stylesheet" href="./scss/style.css">
    <title>Login and Registration System</title>
</head>

<body>
    <div class="fluid-container d-flex justify-content-center align-items-center ">
        <div class="container col-4 my-5 bg-light py-2">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">

                <h2>Sign In</h2>
                <hr>
                <?php if(isset($errMSG)){
        echo $errMSG;
    } ?>

                <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40"
                    value="<?php echo $email ?>">
                <span class="text-danger"><?php echo $emailError; ?></span>

                <input type="password" name="password" class="form-control" placeholder="Enter Password" maxlength="15"
                    value="<?php echo $passError ?>">
                <span class="text-danger"><?php echo $passError; ?></span>
                <hr>
                <div class="d-flex justify-content-around">
                    <button type="submit" class="btn btn-success" name="btn-signup">Sign In</button>
                    <a href="register.php" class="btn btn-warning text-dark" role="button" aria-disabled="true">Sign
                        Up Here</a>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>