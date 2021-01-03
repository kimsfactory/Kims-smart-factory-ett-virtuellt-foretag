<?php
    require('../src/config.php');
    checkLogginSession();
    require('../src/dbconnect.php');

    $pageTitle = "My page";
    $pageId = "my_page";

    //debug($_GET);
    //debug($_POST);
    //debug($_SESSION);

    if (isset($_POST['delete'])) {   
        $UserDbHandler->delete($_POST['id']);
    }



    $first_name   = "";
    $last_name    = "";
    $email        = "";
    $password     = "";
    $phone        = "";
    $street       = "";
    $postal_code  = "";
    $city         = "";
    $country      = "";
    $error        = "";
    $msg          = "";
    
    if (isset($_POST['update'])) {
        $first_name    = trim($_POST['first_name']);
        $last_name     = trim($_POST['last_name']);
        $email         = trim($_POST['email']);
        $password      = trim($_POST['password']);
        $phone         = trim($_POST['phone']);
        $street        = trim($_POST['street']);
        $postal_code   = trim($_POST['postal_code']);
        $city          = trim($_POST['city']);
        $country       = trim($_POST['country']);



        //error messages
        if (empty($first_name) || empty($last_name)) {
            $error .= "<li>Your names are missing.</li>";
        }
        if (empty($email)) {
            $error .= "<li>Your e-mail adress is missing.</li>";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<li>Your e-mail adress is not correct</li>";
        }
        if (empty($password)) {
            $error .= "<li>Your password is missing</li>";
        }
        if (!empty($password) && strlen($password) < 8) {
            $error .= "<li>Your password should be at least 8 characters long.</li>";
        }
        if (empty($phone)) {
            $error .= "<li>Your phone number is missing.</li>";
        }
        if (empty($street)) {
            $error .= "<li>Your street adress is missing.</li>";
        }
        if (empty($postal_code)) {
            $error .= "<li>Your postal code is missing.</li>";
        }
        if (empty($city)) {
            $error .= "<li>Your city is missing.</li>";
        }
        if (empty($country)) {
            $error .= "<li>Your country is missing.</li>";
        }

        

        if ($error) {
            $msg = "<ul class='error_msg'>{$error}</ul>";
        }



        if (empty($error)) {
            
            $userData = [
                'first_name'   => $first_name,
                'last_name'    => $last_name,
                'email'        => $email,
                'password'     => $password,
                'phone'        => $phone,
                'street'       => $street,
                'postal_code'  => $postal_code,
                'city'         => $city,
                'country'      => $country,
            ];
            
            $result = $UserDbHandler->update($userData);

            if ($result) {
                $msg = '<div class="success_msg">You have successfully updated your account.</div>';
            } else {
                $msg = '<div class="error_msg">Update failed. Please try again.</div>';
            }
        }
    }



    $users = $UserDbHandler->fetch();
    // debug($users);

?>



<?php include('../public/admin/layout/header.php');?>

<form action="#" method="POST">
    <fieldset>
        <legend>Manage user</legend>
        <h3>This account was created at: <?=htmlentities($users['register_date'])?></h3>

        <!--Show error message-->
        <?=$msg?>
            
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="input_first_name">First name:</label>
                <input type="email" class="form-control" id="input_first_name" name="first_name" placeholder="<?=htmlentities($users['first_name'])?>">
            </div>
            <div class="form-group col-md-6">
                <label for="input_last_name">Last name:</label>
                <input type="password" class="form-control" id="input_last_name" name="last_name" placeholder="<?=htmlentities($users['last_name'])?>">
            </div>
        </div>
            
        <div class="form-group">
            <label for="input_email">E-mail:</label>
            <input type="text" class="form-control" id="input_email" name="email" placeholder="<?=htmlentities($users['email'])?>">
        </div>
            
        <div class="form-group">
            <label for="input_password">New password:</label>
            <input type="password" class="form-control" id="input_password" name="password">
        </div>
            
        <div class="form-group">
            <label for="input_phone">Phone:</label>
            <input type="text" class="form-control" id="input_phone" name="phone" placeholder="<?=htmlentities($users['phone'])?>">
        </div>
            
        <div class="form-group">
            <label for="input_street">Street:</label>
            <input type="text" class="form-control" id="input_street" name="street" placeholder="<?=htmlentities($users['street'])?>">
        </div>
            
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="input_postal_code">Postal code:</label>
                <input type="text" class="form-control" id="input_postal_code" name="postal_code" placeholder="<?=htmlentities($users['postal_code'])?>">
            </div>
            <div class="form-group col-md-4">
                <label for="input_city">City:</label>
                <input type="text" class="form-control" id="input_city" name="city" placeholder="<?=htmlentities($users['city'])?>">
            </div>
            <div class="form-group col-md-2">
                <label for="input_country">Country</label>
                <input type="text" class="form-control" id="input_country" name="country" placeholder="<?=htmlentities($users['country'])?>">
            </div>
        </div>

        <?php
            if ($_SESSION['email']) {
                include('admin/orders.php');           
            }
        ?>

        <input type="hidden" name="id" value="<?=$users['id']?>">
        <button type="submit" class="btn btn-primary" name="update">Update</button>
        <button type="submit" class="btn btn-primary" name="delete">Delete</button>

    </fieldset>
</form>

<?php include('../public/admin/layout/footer.php');?>