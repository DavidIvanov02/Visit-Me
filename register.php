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
        $nameError = " Въведи име.";
    } else if (strlen($name) < 3) {
        $error = true;
        $nameError = "Името не трябва да е по-малко от 3 знака.";
    }

    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Въведи имейл.";
    } else {
        $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if($count!=0){
            $error = true;
            $emailError = "Имейлът се използва.";
        }
    }

    if (empty($pass)){
        $error = true;
        $passError = "Въведи парола.";
    } else if(strlen($pass) < 6) {
        $error = true;
        $passError = "Паролата не трябва да е под 6 знака.";
    }

    ;
    $password = hash('sha256', $pass);


    if( !$error ) {

        $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
        $res = mysqli_query($conn, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Успешна регистрация. Сега можете да влезете в профила си";
            $name = '';
            $email = '';
            $pass = '';
        } else {
            $errTyp = "danger";
            $errMSG = "Нещо се обърка. Опитайте отново...";
        }

    }


}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Посети ме!</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="./layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
</head>
<body id="top">
<?php
include('includes/header.php');
?>

<div class="container">
    <div id="login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <div class="col-md-12">
                <div class="form-group">
                    <h2 class="">Регистирай се</h2>
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
                        <input type="text" name="name" class="form-control" placeholder="Потребителско име" maxlength="50" value="<?php echo $name ?>" />
                    </div>
                    <span class="text-danger"><?php echo $nameError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Имейл" maxlength="40" value="<?php echo $email ?>" />
                    </div>
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Парола" maxlength="15" />
                    </div>
                    <span class="text-danger"><?php echo $passError; ?></span>
                </div>

                <hr />

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Регистрация</button>
                </div>

                <hr />

                <div class="form-group">
                    <a href="login.php">Влез в профила си от тук...</a>
                </div>
            </div>
        </form>
    </div>
</div>
<br>

</body>
</html>

<?php ob_end_flush(); ?>