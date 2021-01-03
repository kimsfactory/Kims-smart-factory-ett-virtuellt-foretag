<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');

$pageTitle = "Order confirmation";
$pageId = "order_confirmation";

if (empty($_SESSION['cartItems'])) {
	header('Location: checkout.php');
	exit;
}
$cartItems = $_SESSION['cartItems'];
unset($_SESSION['cartItems']);
?>
<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title><?=$pageTitle?></title>
	</head>
	<body>
		<div class="container">
			<?php include('cart.php') ?>

			<br>

			<h1>Thank you for order!</h1>
			<p>
				We have received your order and will manage it as soon as possible. You will receive an confirmation letter or sms to you e-mail address or to your phone. This might take few minutes. If you have any questions, please look at FAQ page or ask via chat, email or phone. Thank you for your patience.
			</p>
			<br>

			<table class="table table-borderless">
			  <thead>
			    <tr>
			      <th style="width: 15%">Product</th>
			      <th style="width: 50%">Info</th>
			      <th style="width: 10%">Quantity</th>
			      <th style="width: 15%">Price per product</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($cartItems as $cartId => $cartItem) { ?>
			    <tr>
			      <td><img src="img/<?=$cartItem['img_url']?>" width="100"></td>
			      <td><?=$cartItem['description']?></td>
			      <td><?=$cartItem['quantity']?></td>
			      <td><?=$cartItem['price']?> kr</td>
			    </tr>
				<?php } ?>

				<tr class="border-top">
					<td></td>
					<td></td>
					<td></td>
					<td><b>Total: <?=$cartTotalSum?> kr</b></td>
				</tr>

			  </tbody>
			</table>	
		</div>

	

		<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	    <!-- Custom JavaScript -->
	    <script type="text/javascript">
	    	$('.update-cart-form input[name="quantity"]').on('change', function(){
	    		$(this).parent().submit();
	    	});
	    </script>
  	</body>
</html>