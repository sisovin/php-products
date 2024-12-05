<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['delete_product'])) {
  $product_id = $_POST['delete_product']; // Corrected to get the product ID from the button value

  $query = "DELETE FROM products WHERE id=:product_id";
  $query_run = $pdo->prepare($query);
  $query_run->bindParam(':product_id', $product_id);

  if ($query_run->execute()) {
    $_SESSION['message'] = "Product Deleted Successfully";
    header("Location: index.php");
    exit(0);
  } else {
    $_SESSION['message'] = "Product Not Deleted";
    header("Location: index.php");
    exit(0);
  }
}

if (isset($_POST['update_product'])) {
  $product_id = $_POST['product_id'];
  $title = $_POST['title'];
  $cat_id = $_POST['category'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $meta_description = $_POST['meta_description'];
  $meta_keywords = $_POST['meta_keywords'];
  $old_image = $_POST['current_image'];
  $current_image = $old_image; // Ensure current_image is defined

  // Check whether a new image is uploaded
  if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = "img/"; // Ensure this is the correct path relative to your project

    // Destination Path for the image to be uploaded
    $dst = $image_folder . $image_name;

    // Move the uploaded image to the destination folder
    if (move_uploaded_file($image_tmp_name, $dst)) {
      // Image uploaded successfully, delete the old image
      if (file_exists($old_image)) {
        unlink($old_image);
      }
      $current_image = $dst; // Update current_image to the new image path
    } else {
      // Failed to upload image
      $_SESSION['upload'] = "Failed to upload image.";
      header('Location: product-edit.php?id=' . $product_id);
      exit();
    }
  }

  // Update the product details in the database
  $query = "UPDATE products SET image=:image, title=:title, cat_id=:cat_id, price=:price, description=:description, meta_description=:meta_description, meta_keywords=:meta_keywords WHERE id=:product_id";
  $query_run = $pdo->prepare($query);
  $query_run->bindParam(':image', $current_image);
  $query_run->bindParam(':title', $title);
  $query_run->bindParam(':cat_id', $cat_id);
  $query_run->bindParam(':price', $price);
  $query_run->bindParam(':description', $description);
  $query_run->bindParam(':meta_description', $meta_description);
  $query_run->bindParam(':meta_keywords', $meta_keywords);
  $query_run->bindParam(':product_id', $product_id);

  if ($query_run->execute()) {
    $_SESSION['message'] = "Product Updated Successfully";
    header("Location: index.php");
    exit(0);
  } else {
    $_SESSION['message'] = "Product Not Updated";
    header("Location: index.php");
    exit(0);
  }
}

if (isset($_POST['save_product'])) {
  $image = $_POST['image']; // Removed extra space
  $title = $_POST['title'];
  $cat_id = $_POST['category']; // Corrected to use cat_id
  $price = $_POST['price'];
  $description = $_POST['description'];
  $meta_description = $_POST['meta_description'];
  $meta_keywords = $_POST['meta_keywords'];

  $query = "INSERT INTO products (image, title, cat_id, price, description, meta_description, meta_keywords) VALUES (:image, :title, :cat_id, :price, :description, :meta_description, :meta_keywords)";
  $query_run = $pdo->prepare($query);
  $query_run->bindParam(':image', $image);
  $query_run->bindParam(':title', $title);
  $query_run->bindParam(':cat_id', $cat_id); // Corrected to use cat_id
  $query_run->bindParam(':price', $price);
  $query_run->bindParam(':description', $description);
  $query_run->bindParam(':meta_description', $meta_description);
  $query_run->bindParam(':meta_keywords', $meta_keywords);

  if ($query_run->execute()) {
    $_SESSION['message'] = "Product Created Successfully";
    header("Location: product-create.php");
    exit(0);
  } else {
    $_SESSION['message'] = "Product Not Created";
    header("Location: product-create.php");
    exit(0);
  }
}
