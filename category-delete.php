<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['delete_category'])) {
  $cat_id = $_POST['delete_category']; // Corrected to get the product ID from the button value

  $query = "DELETE FROM category WHERE id=:cat_id";
  $query_run = $pdo->prepare($query);
  $query_run->bindParam(':cat_id', $cat_id);

  if ($query_run->execute()) {
    $_SESSION['message'] = "Category Deleted Successfully";
    header("Location: manage-category.php");
    exit(0);
  } else {
    $_SESSION['message'] = "Category Not Deleted";
    header("Location: manage-category.php");
    exit(0);
  }
}
?>