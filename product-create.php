<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['save_product'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $meta_description = $_POST['meta_description'];
  $meta_keywords = $_POST['meta_keywords'];
  $price = $_POST['price'];
  $category = $_POST['category'];

  // 2. Upload the Image if selected
  // Check whether the select image is clicked or not and upload the image only if the image is selected
  if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = "img/"; // Ensure this is the correct path relative to your project

    // Destination Path for the image to be uploaded
    $dst = $image_folder . $image_name;

    // Move the uploaded image to the destination folder
    if (move_uploaded_file($image_tmp_name, $dst)) {
      // Image uploaded successfully
    } else {
      // Failed to upload image
      $_SESSION['upload'] = "Failed to upload image.";
      header('Location: product-create.php');
      exit();
    }
  } else {
    $dst = ""; // No image uploaded
  }

  // Insert into database
  $query = "INSERT INTO products (title, description, meta_description, meta_keywords, price, image, cat_id) 
              VALUES (:title, :description, :meta_description, :meta_keywords, :price, :image, :category)";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':description', $description);
  $stmt->bindParam(':meta_description', $meta_description);
  $stmt->bindParam(':meta_keywords', $meta_keywords);
  $stmt->bindParam(':price', $price);
  $stmt->bindParam(':image', $dst); // Store the full path
  $stmt->bindParam(':category', $category);

  if ($stmt->execute()) {
    $_SESSION['message'] = "Product added successfully";
    header('Location: index.php');
    exit();
  } else {
    $_SESSION['message'] = "Failed to add product";
    header('Location: product-create.php');
    exit();
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Product Create</title>
</head>

<body>
  <div class="container mt-5">
    <?php include('message.php'); ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Product Add
              <a href="index.php" class="btn btn-danger float-end">BACK</a>
            </h4>
          </div>
          <div class="card-body">
            <form action="product-create.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label>Title:</label>
                <input type="text" name="title" placeholder="Title of the Product" class="form-control">
              </div>
              <div class="mb-3">
                <label>Description:</label>
                <textarea name="description" cols="30" rows="5" placeholder="Description of the Food." class="form-control"></textarea>
              </div>
              <div class="mb-3">
                <label>Short Description:</label>
                <input type="text" name="meta_description" placeholder="Short Description" class="form-control">
              </div>
              <div class="mb-3">
                <label>Keywords:</label>
                <input type="text" name="meta_keywords" placeholder="Keywords" class="form-control">
              </div>
              <div class="mb-3">
                <label>Price:</label>
                <input type="number" name="price" step="0.01" placeholder="Price" class="form-control">
              </div>
              <div class="mb-3">
                <label>Select Product Image:</label>
                <input type="file" name="image" placeholder="Image Upload" class="form-control">
              </div>
              <div class="mb-3">
                <label>Category:</label>
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
                <button type="submit" name="save_product" class="btn btn-primary">Save Product</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>