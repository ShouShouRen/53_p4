<?php
require_once("pdo.php");
extract($_POST);
$images = $_FILES["images"]["name"];

if ($images) {
  $target_dir = "./images/";
  $target_file = $target_dir . basename($_FILES["images"]["name"]);
  move_uploaded_file($_FILES["images"]["tmp_name"], $target_file);
  
  $sql = "UPDATE products SET product_name = ?, product_des = ?, price = ?, links = ?, time =?, images = ? WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$product_name, $product_des, $price, $links,$now, $images, $id]);
} else {
  $sql = "UPDATE products SET product_name = ?, product_des = ?, price = ?, links = ? ,time =? WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$product_name, $product_des, $price, $links, $now, $id]);
}