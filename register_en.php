<?php
$name = '';
$email = '';
$pass = '';
$emailError = '';
$nameError = '';
$passError = '';

include_once 'dbconnect.php';

ob_start();
if( isset($_SESSION['user'])!="" ){
    header("Location: index.php");
    exit;
}

$error = false;


if ( isset($_POST['btn-signup']) ) {


    $name = trim($_POST['name']);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);


    if (empty($name)) {
        $error = true;
        $nameError = " Enter Username.";
    } else if (strlen($name) < 3) {
        $error = true;
        $nameError = "The name should not be less than 3 characters.";
    }

    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Enter Email.";
    } else {
        $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if($count!=0){
            $error = true;
            $emailError = "The email is used.";
        }
    }

    if (empty($pass)){
        $error = true;
        $passError = "Enter Password.";
    } else if(strlen($pass) < 6) {
        $error = true;
        $passError = "The password should not be less than 6 characters.";
    }

    ;
    $password = hash('sha256', $pass);


    if( !$error ) {

        $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
        $res = mysqli_query($conn, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successful sign up. You can now sign in to your account";
            $name = '';
            $email = '';
            $pass = '';
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong. Try again..";
        }

    }


}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Visit me!</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="./layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
</head>
<body id="top">
<?php
include('includes/header_en.php');
?>

<div class="container">
    <div id="login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <div class="col-md-12">
                <div class="form-group">
                    <h2 class="">Sign up</h2>
                </div>

                <div class="form-group">
                    <hr />
                </div>

                <?php if(isset($errMSG)): ?>
                    <div class="form-group">
                        <div class="alert alert-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="name" class="form-control" placeholder="Username" maxlength="50" value="<?php echo $name ?>" />
                    </div>
                    <span class="text-danger"><?php echo $nameError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Email" maxlength="40" value="<?php echo $email ?>" />
                    </div>
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Password" maxlength="15" />
                    </div>
                    <span class="text-danger"><?php echo $passError; ?></span>
                </div>

                <hr />

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign up</button>
                </div>

                <hr />

                <div class="form-group">
                    <a href="login_en.php">Login here...</a>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
</body>
</html>

<?php ob_end_flush(); ?>