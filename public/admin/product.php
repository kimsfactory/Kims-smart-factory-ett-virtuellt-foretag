<?php
//database connection
require('../../src/dbconnect.php');
require('../../src/config.php');
$pageTitle = 'Product Admin page';
//check username and password have value or not
/*Ä if(isset($_SESSION['firstname'])){
    $loginUsername = $_SESSION['firstname'];
}else{
    redirect('../../public/login.php');
}
//remove username and password
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    redirect('../../public/productlist.php');
}
*/
// Bringing all products to display on page
$products = $ProductHandler -> bringAll();
?>
<?php include('layout/header.php'); ?>
<body>
<div class="container">
<div class="row">
    <div class="offset-1 col-10">
        <form action="" method="POST">
            <div class="input-group-append mt-3 d-flex justify-content-end">
                <!--display user name-->
                <label class="mt-2 mr-2"><?php echo 'Welcome '.ucfirst($loginUsername); ?></label>
                <input type="submit" name="logout" value="Log out" class="btn btn-outline-dark border-info">
            </div>
        </form>
        <h1>Product Admin</h1>
        <!--display message-->
         <div id="form-message"><?=$message?></div>
        <!--Add buttom input html-->
        <?php include('layout/addBtn.php'); ?>
        <h3>All product list</h3>
        <hr>
        <ul id="product-list" class="list-group">
            <?php foreach ($products as $key => $product) { ?>
            <li class="list-group-item border-info mb-1">
                <p class="float-left">
                    <h3><?=htmlentities($product['title'])?></h3>
                        <?=htmlentities($product['description'])?>
         <h4><br>Price: <?=htmlentities($product['price'])?> SEK</h4>
                    <p>
                        <!--Delete post-->
                        <form action="" method="POST" class="float-right">
                            <input type="hidden" name="hidId" value="<?=$product['id']?>">
                            <input type="submit" name="deleteBtn" value="Delete" class="btn btn-danger delete-product-btn">
                        </form>
                        <!--Update post-->
                        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal" data-title="<?=htmlentities($product['title'])?>" data-price="<?=htmlentities($product['price'])?>" data-description="<?=htmlentities($product['description'])?>" data-id="<?=htmlentities($product['id'])?>">Update</button>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
</div>
<?php include('layout/updateModal.php'); ?>
<?php include('layout/footer.php'); ?>
