<?php
//session_start();
// database connection
require('../src/dbconnect.php');
require('../src/config.php');
$pageTitle = 'Checkout';
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
        <div> <?php include('cart1.php'); ?></div>
        <br>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Info</th>
                    <th scope="col"></th>
                    <th scope="col">Total</th>
                    <th scope="col">Price/Item</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($_SESSION['cartItems'] as $cartId => $cartItem) { ?>
                <tr class="border">
                    <td><img src="<?=htmlentities($cartItem['img_url'])?>" width="100" height="50px">
                    </td>
                    <td><?=htmlentities($cartItem['description'])?></td>
                    <td>
                        <!--delete item-->
                        <form action="delete-cart-item.php" method="post">
                            <input type="hidden" name="cartId" value="<?=htmlentities($cartId)?>">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                    <td>
                        <!--update quantity item-->
                        <form class="update-cart-form" action="update-cart-item.php" method="post">
                            <input type="hidden" name="cartId" value="<?=htmlentities($cartId)?>">
                            <input type="number" name="quantity" value="<?=htmlentities($cartItem['quantity'])?>" min="0">
                        </form>
                    </td>
                    <td><?=htmlentities($cartItem['price'])?> SEK</td>
                </tr>
                <?php } ?>
                <tr class="border">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>Total: <?=htmlentities($cartTotalsum)?> SEK</strong></td>
                </tr>
            </tbody>
        </table>
        <?php include('../public/checkout-userform.php'); ?>
    </div>
    <?php include('../public/admin/layout/footer.php'); ?>
