<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    $pageTitle = "Log in";
    $pageId = "log_in";

    //debug($_GET);
    //debug($_POST);
    //debug($_SESSION);



    $error  = "";
    $msg    = "";

    //Message for login and logout
    if (isset($_GET['mustLogin'])) {
        $msg = '<div class="error_msg">The page you want to view is needs to be logged in. Please enter your e-mail adress and password.</div>';
    }
    if (isset($_GET['logout'])) {
        $msg = '<div class="success_msg">You have logged out.</div>';
    }



    if (isset($_POST['doLogin'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];


        //error messages
        if (empty($email)) {
            $error .= "<li>You must enther your e-mail adress.</li>";
        }
        if (empty($password)) {
            $error .= "<li>You must enter your password.</li>";
        }

        if ($error) {
            $msg = "<ul class='error_msg'>{$error}</ul>";
        }



        //fetch data by email
        if (empty($error)) {
            $user = $UserDbHandler->fetchByEmail($email);        
        }

   

        //validation of user
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            header('Location: productlist.php');
            exit;
        } else {
            $msg = '<div class="error_msg">Login failed. Please try again.</div>';
        }
    }
?>



<?php include('../public/admin/layout/header.php');?>

<form action="#" method="POST">
    <fieldset>
        <legend>Log in</legend>

        <!--Show error message-->
        <?=$msg?>

        <div class="form-group">
            <label for="input_email">E-mail address: </label>
            <input type="email" class="form-control" id="input_email" aria-describedby="emailHelp" name="email">
        </div>

        <div class="form-group">
            <label for="input_password">Password: </label>
            <input type="password" class="form-control" id="input_password" name="password">
        </div>

        <button type="submit" class="btn btn-primary" name="doLogin">Log in</button>

    </fieldset>
</form>

<?php include('../public/admin/layout/footer.php');?>