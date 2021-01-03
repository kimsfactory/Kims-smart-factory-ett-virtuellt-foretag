<?php
// database connection
require('../src/dbconnect.php');
require('../src/config.php');

$pageTitle = 'All product list';
//show all product list
$products = $ProductHandler -> bringAll();
?>
<?php include('../public/admin/layout/header.php');?>

        <div class="row">
           <div class="col-12">
                <a href="login.php" class="float-right">| Log in</a>
                <a href="register.php" class="float-right">|| Sign up |</a>
                <a href="productlist.php" class="float-right mr-2"><i class="fa fa-home"> </i></a>
            </div>
         </div>
          <div class="row">
           <div class="col-12">
               
        <img src="img/mobilebackground.jpeg" alt="" width="100%" height="320px" class="mt-2 mb-2">
            </div>
         </div>
           <div>    <?php include('cart1.php');?> </div>
  
        <?php foreach ($products as $key => $product) { ?>
        <div class="row shadow-lg mb-3">
            <div class="col-3 p-2">
                <a href=""><img src="<?=$product['img_url']?>" width="100%" height="97%" class="mt-2"></a>
            </div>

            <div class="col-5 p-2">
                <h5 class="text-center text-danger">
                    <?php echo $product['title'] ?>
                </h5>
                <!--Counting the first sentence-->
                <?php
                    $pos = strpos($product['description'], '.');
                    $firstSentence = substr($product['description'], 0, max($pos+1, 40));
                    echo $firstSentence;
                ?>
                <!--sending id to product.php page for fetching specific data-->
                <br><a href="product.php?hidID=<?=$product['id']?>"><em>more info</em></a>
            </div><hr><hr>
               
            <div class="col-3 p-3 border border-right-0 border-bottom-0 border-top-0 text-center ml-5">
                <p><strong><?php echo $product['price'] ?> SEK</strong></p>
                <p><em>10 are available</em></p>
               
                <input type="submit" name="preview" value="Preview" class="btn btn-outline-dark border-success mb-3 mr-2">
                 <form action="addtocart.php" method="POST">
                    <input type="hidden" name="productId" value="<?=$product['id']?>">
                    <input type="number" min="0" value="1" name="quantity">
                    <input type= "submit" value="addtocart" name="addToCart">
                </form>
               </div>
                
        </div>
         <?php } ?>

                                
<?php include('../public/admin/layout/footer.php'); ?>