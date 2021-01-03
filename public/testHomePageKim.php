<?php
// database connection
require('../src/dbconnect.php');
require('../src/config.php');
$pageTitle = 'All product list';
//show all product list
$products = $ProductHandler -> bringAll();
?>
<?php include('../public/admin/layout/headerkim.php');?>

<body>
    <div class="container">
        <div class="row">   
            <div class="col-12 bg-light">   <!--Kim added background color here-->
                <a href="login.php" class="float-right">| Log in</a>
                <a href="register.php" class="float-right">|| Sign up |</a>
                <a href="productlist.php" class="float-right mr-2"><i class="fa fa-home"> </i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="background-color: yellow;">  <!--Kim added background color here-->
                <img src="img/logo3.png" alt="Company logo" width="100%" height="320px" class="mt-2 mb-2">
            </div>
        </div>


        <!--Kim's nav menu-->
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                        <a class="navbar-brand" href="#">Mobile Alltech</a>
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" href="productlist.php">Home<span class="sr-only">(current)</span></a>
                            </li>
                            <li>
                                <div class="dropdown bg-primary">
                                    <button class="btn btn-secondary bg-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mobile</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Samsung</a>
                                        <a class="dropdown-item" href="#">Apple</a>
                                        <a class="dropdown-item" href="#">Huawei</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Contact<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="productlist.php">About us<span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>



        <div> <?php include('cart1.php');?> </div>
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
            </div>
            <hr>
            <hr>
            <div class="col-3 p-3 border border-right-0 border-bottom-0 border-top-0 text-center ml-5">
                <p><strong><?php echo $product['price'] ?> SEK</strong></p>
                <p><em>10 are available</em></p>
                <input type="submit" name="preview" value="Preview" class="btn btn-outline-dark border-success mb-3 mr-2">
                <form action="addtocart.php" method="POST">
                    <input type="hidden" name="productId" value="<?=$product['id']?>">
                    <input type="number" min="0" value="1" name="quantity">
                    <input type="submit" value="addtocart" name="addToCart">
                </form>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php include('../public/admin/layout/footerkim.php'); ?>