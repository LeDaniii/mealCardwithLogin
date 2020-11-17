<?php

ob_start();
session_start();
if(isset($_SESSION['user']) != ""){
    header("Location: index.php"); //redirects to home.php
}
include_once 'dbconnect.php';
$error = false;
if(isset($_POST['btn-signup'])) {
    $name = trim($_POST['name']);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);
    // trim whitespace, srtip html and php tags from the string, convert html.specialchars characters to html entities
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['password']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // basic name validation
    if(empty($name)){
        $error = true;
        $nameError = "Please enter your full name.";
    } 
    else if (strlen($name) < 3){
        $error = true;
        $nameError = "Name must have at least three Characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $name)){
        $error = true;
        $nameError = "Name must contain alphabets and space.";
    }
    // basic email validation
    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
        $emailError = "Please enter valid email address.";
    }else {
        $query = "select userEmail from users where userEmail='$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if($count!=0){
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    // password validation
    if (empty($pass)){
        $error = true;
        $passError = "Please enter password.";
    } else if(strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have atleast 6 characters.";
    }
    
    echo $name;
 
    echo $email;
    // password hashing for security
    $password = hash('sha256', $pass);

    echo $password;

    // if there is no error, cuntinue with sign up
    if(!$error) {
        $query = "insert into users(userName, userEmail, userPass) values('$name', '$email', '$password')";
        $res = mysqli_query($conn, $query);

        if ($res) {
            $errTyp = "success";
            $errMsg = "Succesfully registered,  you may login now";
            unset($name);
            unset($email);
            unset($pass);
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
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
    <title>LogIn and Registration System0,
    </title>
</head>

<body>
    <div class="fluid-container d-flex justify-content-center align-items-center ">
        <div class="container col-4 my-5 bg-light py-2">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
                <div>
                    <h2>Sign Up</h2>
                    <hr>
                    <?php  if(isset($err)){?>
                    <div class="alert alert-<?php echo $errTyp ?>">

                        <?php echo $errMSG ?>
                    </div>

                    <?php
    } 
    ?>
                </div>
                <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50"
                    value="<?php echo $name ?>">
                <span class="text-danger"><?php echo $nameError; ?></span>


                <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40"
                    value="<?php echo $email ?>">
                <span class="text-danger"><?php echo $emailError; ?></span>


                <input type="password" name="password" class="form-control" placeholder="Enter Password" maxlength="15"
                    value="<?php echo $passError ?>">
                <span class="text-danger"><?php echo $passError; ?></span>
                <hr>

                <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
                <hr>
                <a href="login.php">Sign in Here!</a>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>