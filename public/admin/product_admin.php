
<?php
//database connection
require('../../src/dbconnect.php');

$pageTitle = 'Product Admin page';

session_start();
//check username and password have value or not
//if(isset($_SESSION['firstname'])){
//    $loginUsername = $_SESSION['firstname'];
//}else{
//    header('Location: user_login.php');
//}
//remove username and password
//if(isset($_POST['logout'])){
//    session_unset();
//    session_destroy();
//    header('Location: product_shop_viewlist.php');
//    exit;
//}

// Delete post
$message = '';
if (isset($_POST['deleteBtn'])) {
  try {
    $query = "
      DELETE FROM products
      WHERE id = :id;
    ";
    $stmt = $dbconnect->prepare($query);
    $stmt->bindValue(':id', $_POST['hidId']);
    $stmt->execute();
      
    $message = 
      '<div class="alert alert-success" role="alert">
        Product deleted successfully.
      </div>';
  } catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }
}

// Add new post
$error = '';
if (isset($_POST['addBtn'])) {
//  $id      = trim($_POST['id']);
  $title   = trim($_POST['title']);
  $description = trim($_POST['description']);
  $price  = trim($_POST['price']);

    //validation of product name
  if (empty($title)) {
      $error .=  '<li> Product name must not be empty</li>';
  }else if(is_numeric($title)){
      $error .=  '<li> Product name: Only number is not allowed</li>';
  }else if(!preg_match("/^[a-zA-Z0-9 ]*$/",$title)){
       $error .=  '<li> Product name: Only letter, number and whitespace are allowed</li>'; 
  }else if(strlen($title) > 90){
       $error .=  '<li> Product name must have less than 90 characters</li>'; 
  }else if(strlen($title) < 5){
       $error .=  '<li> Product name must have 4 characters long</li>'; 
  }
    
    //validation of price
  if(empty($price)){
      $error .=  '<li> Price must not be empty</li>';
  }else if(!preg_match('/^(0|[1-9]\d*)(\.\d{2})?$/',$price)){
       $error .=  '<li> Price: Seems wrong price, 00/00.00 are right format</li>';
  }else if(strlen($price) > 9){
       $error .=  '<li>Price seems too high</li>';
  }else if(strlen($price) < 2){
       $error .=  '<li> Price seems too low</li>';
  }
    
    
    
    //validation of product description
    $firstWord=explode(' ',trim($_POST['description']));
    
//    //remove span
//    $strPos1 = strpos($content, '>');
////    $strPos2 = strpos($post['content'], '>');
//    
//    $removeSpan = substr($content, $strPos1+1, -7);
//
//    $firstWord=explode(' ',$removeSpan);
    
//    echo "<pre>";
//    print_r($strPos1);
//    echo "</pre>";
//    
//    echo "<pre>";
//    print_r($removeSpan);
//    echo "</pre>";
    
    
  if(empty($description)){
      $error .=  '<li> Product description must not be empty</li>';
  }else if(is_numeric($description)){
      $error .=  '<li> Product description: number is not allowed</li>';
  }else if(!preg_match("/^[a-zA-Z]$/",$description[0])){
       $error .=  '<li>  Product description: start with letter</li>';
  }else if(!preg_match("/^[a-zA-Z ]*$/", substr($description, 0, 15))){
       $error .=  '<li>  Product description: First 15 character should have letter</li>';
  }else if(strlen($description) < 40){
       $error .=  '<li>  Product description should have at least 40 character</li>';
  }else if(strlen($firstWord[0]) > 10){
       $error .=  '<li> First word is too long. *Use space to make it short</li>';
  }


  if($error){
       $message =  "<ul style='background-color:#f8d7da;'>{$error}</ul>";
    }
    else {
    try {
      $query = "
        INSERT INTO products (title, description, price)
        VALUES (:title, :description, :price);
      ";

      $stmt = $dbconnect->prepare($query);
      $stmt->bindValue(':title', $title);
      $stmt->bindValue(':description', $description);//
      $stmt->bindValue(':price', $price);
      $stmt->execute();
        
    $message =  "<ul style='background-color:#d4edda;'>Your product uploaded successfully</ul>";
        
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
  }
}

// Update blog
if (isset($_POST['updateBtn'])) { 
  $title   = trim($_POST['title']);
  $description = trim($_POST['description']);
  $price  = trim($_POST['price']);

    //validation of product name
  if (empty($title)) {
      $error .=  '<li> Update: Product name must not be empty</li>';
  }else if(is_numeric($title)){
      $error .=  '<li> Update:  In Product name, number is not allowed</li>';
  }else if(!preg_match("/^[a-zA-Z0-9 ]*$/",$title)){
       $error .=  '<li> Update: In Product name, only letter and whitespace are allowed</li>'; 
  }else if(strlen($title) > 90){
       $error .=  '<li> Update: Product name must have less than 30 characters</li>'; 
  }else if(strlen($title) < 5){
       $error .=  '<li> Update: Product name must have 4 characters more</li>'; 
  }
    //validation of price
  if(empty($price)){
      $error .=  '<li> Update: Price must not be empty</li>';
  }else if(!preg_match('/^(0|[1-9]\d*)(\.\d{2})?$/',$price)){
       $error .=  '<li> Update: Price Seems wrong, 00/00.00 are right format</li>';
  }else if(strlen($price) > 9){
       $error .=  '<li>Update: Price seems too high</li>';
  }else if(strlen($price) < 2){
       $error .=  '<li> Update: Price seems too low</li>';
  }
    
    //validation of product description
  if(empty($description)){
      $error .=  '<li> Update: Product description must not be empty</li>';
  }else if(is_numeric($description)){
      $error .=  '<li> Update: In Product description, number is not allowed</li>';
  }else if(!preg_match("/^[a-zA-Z]$/",$description[0])){
       $error .=  '<li>  Update: In Product description, start with letter</li>';
  }else if(!preg_match("/^[a-zA-Z ]*$/",substr($description, 0, 15))){
       $error .=  '<li>  Update: In Product description, First 15 character should have letter</li>';
  }else if(strlen($description) < 40){
       $error .=  '<li> Update: Product description should have at least 40 character</li>';
  }else if(strlen($description[0]) > 10){
       $error .=  '<li> First word is too long. *Use space to make it short</li>';
  }
  if($error){
       $message =  "<ul style='background-color:#f8d7da;'>{$error}</ul>";
    }
    else {
    try {
      $query = "
        UPDATE products
        SET description = :description,title = :title,price = :price
        WHERE id = :id;
      ";

      $stmt = $dbconnect->prepare($query);
      $stmt->bindValue(':title', $title);
      $stmt->bindValue(':description', $description);
      $stmt->bindValue(':price', $price);
      $stmt->bindValue(':id', $_POST['id']);
      $stmt->execute();
       
     $message =  "<ul style='background-color:#d4edda;'>Post updated successfully</ul>";
        
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
  }
}

// Fetch all posts to display on page
try {
  $query = "SELECT * FROM products;";
  $stmt = $dbconnect->query($query);
  $products = $stmt->fetchAll();
} catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

?>

<?php include('layout/header.php'); ?>

<body>

    <div class="container">
        <div class="row">
            <div class="offset-1 col-10">
                <form action="" method="POST">
                    <div class="input-group-append mt-3 d-flex justify-content-end">

                        <!--display user name-->
                        <label class="mt-2 mr-2"><?php echo 'Welcome '.ucfirst($loginUsername); ?></label>
                       
                        <input type="submit" name="logout" value="Log out" class="btn btn-outline-dark border-info">
                    </div>
                </form>


                <h1>Product Admin</h1>
            
                <?=$message?>

                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="title" class="form-control border-success" placeholder="Product name">
                        <input type="text" name="price" class="form-control border-success" placeholder="Price"><br>
                    </div>
                    <textarea name="description" class="form-control border-success" placeholder="Product Description" rows="5" cols="30"></textarea>

                    <div class="input-group-append mt-3 mr-2 float-right">
                        <input type="submit" name="addBtn" value="Add" class="btn btn-success" id="button-addon2">
                    </div>
                </form><br><br>

                <h3>All product list</h3>
                <hr>
                <ul class="list-group">
                    <?php foreach ($products as $key => $product) { ?>
                    <li class="list-group-item border-info mb-1">
                        <p class="float-left">
                            <h3><?=htmlentities($product['title'])?></h3>
                            <?=htmlentities($product['description'])?>
                            <h4><br>Price: <?=htmlentities($product['price'])?> SEK</h4>
                            <p>
                                    
                                <!--Delete post-->
                                <form action="" method="POST" class="float-right">
                                    <input type="hidden" name="hidId" value="<?=$product['id']?>">
                                    <input type="submit" name="deleteBtn" value="Delete" class="btn btn-danger">
                                </form>

                                
                                <!--Update post-->
                                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal" data-title="<?=htmlentities($product['title'])?>" data-price="<?=htmlentities($product['price'])?>" data-description="<?=htmlentities($product['description'])?>" data-id="<?=htmlentities($product['id'])?>">Update</button>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <!--update modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Update Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="form-group">

                            <label for="recipient-name" class="col-form-label">Update Title: </label>
                            <input type="text" class="form-control" name="title" for="recipient-name">

                            <label for="recipient-name" class="col-form-label">Update Description: </label>
                            <textarea class="form-control" name="description" for="recipient-name" rows="6"></textarea>

                            <label for="recipient-name" class="col-form-label">Update Price: </label>
                            <input type="text" class="form-control" name="price" for="recipient-name">

                            <input type="hidden" class="form-control" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="updateBtn" value="Update" class="btn btn-success">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <?php include('layout/bootstrap.php'); ?>

   
        <!--update modal-->
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var title = button.data('title'); // Extract info from data-* attributes
            var description = button.data('description'); // Extract info from data-* attributes
            var price = button.data('price'); // Extract info from data-* attributes
            var id = button.data('id'); // Extract info from data-* attributes

            var modal = $(this);
            modal.find(".modal-body input[name='title']").val(title);
            modal.find(".modal-body textarea[name='description']").val(description);
            modal.find(".modal-body input[name='price']").val(price);
            modal.find(".modal-body input[name='id']").val(id);
        });
    </script>
    
    <!--spell checker in content field-->
<!--
    <script src="https://cdn.tiny.cloud/1/b1y2db7exjdaipku016s8wrj1xgiruek4eovrkb1cx0oeuyg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({
	selector: 'textarea',
	plugins: 'tinymcespellchecker',
    forced_root_block: false, //remove p tag
	spellchecker_language: 'en'
});
</script>
-->

    <?php include('layout/footer.php'); ?>