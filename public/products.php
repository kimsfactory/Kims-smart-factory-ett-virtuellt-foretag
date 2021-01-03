<?php
// database connection
require('../src/dbconnect.php');
require('../src/config.php');
$pageTitle = 'All product list';
//show all product list
$products = $ProductHandler -> bringAll();
?>
<?php include('../public/admin/layout/header.php');?>
<body>
    <div class="container">
      
        <div class="row">
           <div class="col-12">
                <a href="login.php" class="float-right">| Log in</a>
                <a href="register.php" class="float-right">|| Sign up |</a>
                <a href="productlist.php" class="float-right mr-2"><i class="fa fa-home"> </i></a>
            </div>
         </div>
          <div class="row">
           <div class="col-12">
          <img src="img/mobilebackground.jpeg" alt="" width="100%" height="120px" class="mt-2 mb-2">
            </div>
         </div>
    
             <?php include('cart.php'); ?>
       
        <!--add cart-->
        <br>
        <div class="row">
        <?php foreach ($products as $key => $product) { ?>
        <div class="col-4 border p-4 d-flex flex-column">
        <img src="<?=htmlentities($product['img_url'])?>" width="100%" height="100px">
        <div style="margin-top:auto">
            <h3><?=htmlentities($product['title'])?></h3>
            <p><?=htmlentities($product['description'])?></p>
            <p>Price: <?=htmlentities($product['price'])?> SEK/Item</p>
        <form action="add-cart-item.php" method="post">
        <input type="hidden" name="productId" value="<?=htmlentities($product['id'])?>">
        <input type="number" name="quantity" value="1" min="0">
        <input type="Submit" name="addToCart" value="Add to Cart">
        </form>
        </div>
    </div>
         <?php } ?>
         </div>
         
    </div>
<?php include('../public/admin/layout/footer.php'); ?>
