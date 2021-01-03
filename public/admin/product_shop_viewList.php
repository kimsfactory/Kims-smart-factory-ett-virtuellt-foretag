<?php
// database connection
require('../../src/dbconnect.php');

$pageTitle = 'All product list';

//show all product list
try {
	$stmt = $dbconnect->query("SELECT * FROM products");
	$posts = $stmt->fetchAll(); 
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

?>

<?php include('layout/header.php');?>

<body>

    <div class="container">
<!--
        <div class="row">
            <div class="col-12">
                <a href="login.php" class="float-right">Create an account</a>
            </div>
        </div>
-->

        <div class="row">
<!--
            <div class="col-12" id="bkgdImg">
                <img src="img/bookbackground.jpg">
            </div>
-->

            <div class="offset-1 col-10">
                <h1>List of all product</h1>

                <?php foreach ($posts as $key => $post) { ?>
                <h3 class="text-center" style="background-color:#e66f59;">
                    <?php echo $post['title'] ?>
                </h3>
<!--                <p style="text-align:center;">Posted on: <?php echo $post['published_date'] ?></p>-->
                <!--Counting the first sentence-->
                <?php
                    $pos = strpos($post['description'], '.');
                    $firstSentence = substr($post['description'], 0, max($pos+1, 40));
                    echo $firstSentence;
                    ?>
                <!--sending id to individual.php page for fetching specific data-->
                <br><a href="product_shop_viewPage.php?hidID=<?=$post['id']?>">details info</a>
                <p style="text-align:">Total price: <strong><?php echo $post['price'] ?></strong></p>
                <?php } ?>
            </div>
        </div>
    </div>
<?php include('layout/bootstrap.php'); ?>
   
    <?php include('layout/footer.php'); ?>
