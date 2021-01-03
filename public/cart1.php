<?php
if (isset($_POST["resetBtn"])){
unset($_SESSION['cartItems']);
}
if (isset($_POST['deleteItemBtn'])){

}

if (!isset($_SESSION['cartItems'])){
	$_SESSION['cartItems']=[];
}

$cartItemCount 	= count($_SESSION['cartItems']);
//$cartItemPrice 	= ()
$cartTotalsum 	= 0;
foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
	$cartTotalsum += $cartItem['price'] * $cartItem['quantity'];
}


?>

<!--Section: Block Content-->
 <div class="row">
     <div class="col-12 col-sm-12 col-12 main-section text-right">
        <button type="button" class="btn btn-info" data-toggle="dropdown">
         	<i class="fa fa-shopping-cart" aria-hidden="true"></i> Shoppingcart <span class="badge badge-pill badge danger"><?=$cartItemCount?></span>
        </button>
        <div class="dropdown-menu">
           	<div class="row total-header-section">
           	 	<div class="col-lg-6 col-sm-6 col-6"> 
           	 		<i class="fa fa-shopping-cart" aria-hidden="true"></i>
           	 		<?=$cartItemCount?> <span class="badge badge-pill badge danger"></span>
           	 	</div>
           	 	<div class="col-lg-6 col-sm-6 col-6 text-right"> 
           	 		<form action="" method="POST">
           	  			<input type="submit" class="btn btn-info" name="resetBtn" value="Remove all items"></input>
           	 		</form>
          
           	 	</div>
           	 </div>
           	<hr> 
       		<?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem){ ?>
       		<div class="row">
       				
       			<div class="col-lg-4 col-sm-4 col-4 cart-detail-img"> 
       			<img class="cartimage" src=<?=$cartItem['img_url']?> >
       			<style> img.cartimage {width: 100px; margin: 5px; padding: 10px;} </style>
       			</div>
       			<div class="col-lg-8 col-sm-8 col-8 cart-detail-product"> 
       			 <b><?=$cartItem['title']?></b>
       			 <br>
       			
       			
       			<span class="price text-info"> 

       			price:
       			<?=$cartItem['price']?>
       			</span>
       			<br>
       			<span class="count">
       			Quantity:
       			<?=$cartItem['quantity']?>
       			</span>
             
              <form action="deletecartitem.php" method="POST">
                  <input type="hidden" name="cartId" value="<?=$cartId?>">
                  <input type="submit" class="btn btn-info" name="deleteBtn" value="delete">
              </form>
    
       			</div>
       		</div>
       		<hr>
       		<?php } ?>
       		
           	<div class="col-lg-12 col-sm-12 col-12 cart-detail-product text-right"> 
           		<p> Totalt: 
           			<span class="text-info"> <?= $cartTotalsum  ?></span>
           		</p>
           	</div>
           	<div class="col-lg-12 col-sm-12 col-12 cart-detail-product text-right"> 

           	 <button type="button" class="btn btn-info" action="#"> To checkout </button>
           	</div>
          
        

          
       		

       	</div>

	</div>
</div>
  