<?php
session_start();
include('config/dbcon.php');
// Define SITEURL constant
define('SITEURL', 'http://localhost/learnphp/php-products/');

// Check whether id is set or not 
if (isset($_GET['id'])) {
  // Get all the details
  $product_id = $_GET['id'];

  // SQL Query to Get the Selected Product
  $query = "SELECT * FROM products WHERE id='$product_id' ";
  // Prepare the Query
  $query_run = $pdo->prepare($query);
  // Execute the Query
  $query_run->execute();
  // Bind the parameter
  $query_run->bindParam(':image', $image);
  $query_run->bindParam(':title', $title);
  $query_run->bindParam(':category', $category);
  $query_run->bindParam(':price', $price);
  $query_run->bindParam(':description', $description);
  $query_run->bindParam(':meta_description', $meta_description);
  $query_run->bindParam(':meta_keywords', $meta_keywords);
  $query_run->bindParam(':product_id', $product_id);

  // Check if any row is returned
  if ($query_run->rowCount() > 0) {
    // Get the value based on query executed
    $product = $query_run->fetch(PDO::FETCH_ASSOC);

    // Get the Individual Values of Selected Product
    $title = $product['title'];
    $description = $product['description'];
    $meta_description = $product['meta_description'];
    $meta_keywords = $product['meta_keywords'];
    $price = $product['price'];
    $current_image = $product['image'];
    $current_category = $product['cat_id'];
  } else {
    // Redirect to Manage Food with error message
    $_SESSION['no-product-found'] = "<div class='error'>Product not found.</div>";
    header('location:' . SITEURL . 'product-edit.php.php');
  }
} else {
  // Redirect to Manage Food
  header('location:' . SITEURL . 'product-edit.php');
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--  Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

  <title>Product Edit</title>
</head>

<body>

  <div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Product Edit
              <a href="index.php" class="btn btn-danger float-end flex d-flex gap-1">
                <i class="bi bi-house-add-fill"></i>
                BACK
              </a>
            </h4>
          </div>
          <div class="card-body">

            <?php
            if (isset($_GET['id'])) {
              $product_id = $_GET['id'];
              $query = "SELECT * FROM products WHERE id='$product_id' ";
              $query_run = $pdo->prepare($query);
              $query_run->execute();
              $query_run->bindParam(':image', $image);
              $query_run->bindParam(':title', $title);
              $query_run->bindParam(':category', $category);
              $query_run->bindParam(':price', $price);
              $query_run->bindParam(':description', $description);
              $query_run->bindParam(':meta_description', $meta_description);
              $query_run->bindParam(':meta_keywords', $meta_keywords);
              $query_run->bindParam(':product_id', $product_id);

              if ($query_run->rowCount() > 0) {
                $product = $query_run->fetch(PDO::FETCH_ASSOC);
            ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="product_id" value="<?= $product['id']; ?>">

                  <div class="mb-3">
                    <label>Title:</label>
                    <input type="text" name="title" value="<?= $product['title']; ?>" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label>Description:</label>
                    <input type="text" name="description" value="<?= $product['description']; ?>" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label>Short Description:</label>
                    <input type="text" name="meta_description" value="<?= $product['meta_description']; ?>" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label>Keywords:</label>
                    <input type="text" name="meta_keywords" value="<?= $product['meta_keywords']; ?>" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label>Price:</label>
                    <input type="number" name="price" value="<?= $product['price']; ?>" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label>Current Image:</label>
                    <div class="form-control">
                      <?php
                      if ($current_image == "") {
                        // Image not Available 
                        echo "<div class='error'>Image not Available.</div>";
                      } else {
                        // Image Available
                      ?>
                        <img src="<?php echo SITEURL; ?><?= $product['image']; ?>" alt="<?= $product['title']; ?>" width="130px" class="img-responsive img-curve">
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label>Select New Image:</label>
                    <input type="file" name="image" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label>Category</label>
                    <select name="category" class="form-control">
                      <?php
                      // Fetch categories from the database
                      $sql = "SELECT * FROM category";
                      $res = $pdo->query($sql);
                      if ($res->rowCount() > 0) {
                        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                          echo "<option value='{$row['id']}'>{$row['title']}</option>";
                        }
                      } else {
                        echo "<option value='0'>No Category Found</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <!-- Other form fields for title, category, price, etc. -->
                    <button type="submit" name="update_product" class="btn btn-primary"> <i class="bi bi-pencil-fill"> </i>Update Product</button>
                  </div>
                </form>
            <?php
              } else {
                echo "<h4>No Such Id Found</h4>";
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>