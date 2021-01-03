<?php
// database connection
require('../src/dbconnect.php');
require('../src/config.php');
$pageTitle = 'Product view page';
//show specific data
$post = $ProductHandler -> productById();
?>
<?php include('../public/admin/layout/header.php'); ?>
<body>
    <div class="container">
            <div class="row">
           <div class="col-12">
                <a href="login.php" class="float-right">| Log in</a>
                <a href="register.php" class="float-right">|| Sign up |</a>
                <a href="productlist.php" class="float-right mr-1"><i class="fa fa-home"> </i></a>
            </div>
         </div>
          <div class="row">
           <div class="col-12">
        <img src="img/mobilebackground.jpeg" alt="" width="100%" height="320px" class="mt-2 mb-2">
            </div>
         </div>
           <div class="row">
            <div class="col-sm-6 col-lg-2">
                <a href=""><img src="<?php $post['img_url'] ?>" width="100%" height="97%" class="mt-2"></a>
            </div>
            <div class="col-7">
                <h5 class="text-danger">
                    <?php echo $post['title'] ?>
                </h5>
                <p class="text-justify">
                    <?php echo $post['description'];?>
                </p>
            </div>
            <div class="col-3">
                <h4 class="text-center mt-3"><?php echo $post['price']?> SEK</h4>
                <p class="text-center"><em>10 are available</em></p><hr>
                <input type="submit" name="" value="Silver" class="btn btn-outline-dark border-dark mr-2">
                <input type="submit" name="" value="Guld" class="btn btn-outline-dark border-dark mr-2">
                <input type="submit" name="" value="Black" class="btn btn-outline-dark border-dark mr-2"><hr>
                <input type="submit" name="" value="Preview" class="btn btn-outline-dark border-success mb-3 mr-2">
                <a href="#"><i class="fa fa-cart-plus fa-2x"></i></a>
            </div>
        </div>
        </div>
    <?php include('../public/admin/layout/footer.php'); ?>
