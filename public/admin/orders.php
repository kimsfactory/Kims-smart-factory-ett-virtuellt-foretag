<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    $pageTitle = "Orders";
    $pageId = "orders";


	$orders = $OrderDbHandler->fetchOrders();
	// debug($orders);

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
		<title>Mange Order</title>
	</head>
	<body>
		<div class="container">
			<br>
			
			<h1>Manage orders</h1>
			<div class="form-group">
            	<input type="text" class="form-control" name="searchQuery" id="search-input" placeholder="Search">
          	</div>
			
			<br>
			<table class="table table-borderless table-hover">
			  <thead>
			    <tr>
			      <th style="width: 10%">Order id</th>
			      <th style="width: 50%">Customer name</th>
			      <th style="width: 15%">Price</th>
			      <th style="width: 15%">Manage status</th>
			      <th style="width: 10%">Delete</th>
			    </tr>
			  </thead>
			  <tbody id="order-list">
			  	<?php foreach ($orders as $key => $order) { ?>	<!--empty array '[]' will this foreach() will not loop.-->
			    <tr>
			      <td><a href="order.php?id=<?=$order['id']?>"># <?=$order['id']?></a></td>
			      <td><?=$order['billing_full_name']?></td>
			      <td><?=$order['total_price']?></td>
			      <td>
					<select name="status" id="status" class="form-control">
					    <option>Oppen</option>
					    <option>Managing</option>
					    <option>Delivered</option>
					    <option>Cancelled</option>
					</select>	
			      </td>
			      <td>
			      	<button type="submit" class="btn delete-order-btn">
			      		<svg class="bi bi-trash" width="2" height="2" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  							<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
 	 						<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
						</svg>
					</button>
			      </td>
			    </tr>
				<?php } ?>
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