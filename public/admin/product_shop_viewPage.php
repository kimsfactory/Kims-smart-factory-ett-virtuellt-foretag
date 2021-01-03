<?php
// database connection
require('../../src/dbconnect.php');

$pageTitle = 'Product view page';

//show specific data
try {
	$stmt = $dbconnect->prepare("SELECT title,description,price FROM products
    WHERE id = :id");
    $stmt->bindValue(':id',$_GET['hidID']);
    $stmt->execute();
	$post = $stmt->fetch(); 
    
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

?>
<?php include('layout/header.php'); ?>


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
                <img src="img/bookbackground1.jpg">
            </div>
-->
            <div class="offset-1 col-10">

                <h1>Product deatils</h1>

                <h3 style="background-color:lightblue;">
                    <?php echo $post['title'] ?>
                </h3>
                <p class="text-justify">
                    <?php
                    echo $post['description'];
                    ?>
                </p>
                <h4 class="text-right"><?php echo $post['price'] ?></h4>
<!--                <p class="text-right"><?php echo $post['published_date'] ?></p>-->

            </div>
        </div>
    </div>
    
<?php include('layout/bootstrap.php'); ?>
   
    <?php include('layout/footer.php'); ?>
