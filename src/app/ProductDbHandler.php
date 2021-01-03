<?php
class ProductDbHandler
{
//fetch
public function bringAll(){
    global $dbconnect;
    try {
  $query = "SELECT * FROM products;";
  $stmt = $dbconnect->query($query);
  $products = $stmt->fetchAll();
} catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
return $products;
}
//update
public function update(){
          global $dbconnect;
          global $id;
          global $title;
          global $description;
          global $price;
          global $message;
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
      $stmt->bindValue(':id', $id);
      $stmt->execute();
     $message =  "<ul style='background-color:#d4edda;'>Post updated successfully</ul>";
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
}
//add
public function add(){
            global $dbconnect;
            global $title;
            global $description;
            global $price;
            global $message;
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
//delete
public function delete(){
       global $dbconnect;
       global $id;
       global $message;
try {
    $query = "
      DELETE FROM products
      WHERE id = :id;
    ";
    $stmt = $dbconnect->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $message = 
      '<div class="alert alert-success" role="alert">
        Product deleted successfully.
      </div>';
  } catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }
   }
//specific data
public function productById(){
    global $dbconnect;
try {
	$stmt = $dbconnect->prepare("SELECT title,description,price FROM products
    WHERE id = :id");
    $stmt->bindValue(':id',$_GET['hidID']);
    $stmt->execute();
	$post = $stmt->fetch(); 
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
 return $post;   
}
}