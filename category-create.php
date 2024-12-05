<?php
session_start();
include('config/dbcon.php');

// Check if category is existed
if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $query = "INSERT INTO category (title) VALUES (:title)";
  $query_run = $pdo->prepare($query);
  $query_run->bindParam(':title', $title, PDO::PARAM_STR);
  $query_run->execute();
  if ($query_run) {
    $_SESSION['message'] = "Category Added Successfully";
    header('Location: manage-category.php');
    exit(0); // Ensure script stops executing after redirect
  } else {
    $_SESSION['message'] = "Category not added";
    header('Location: manage-category.php');
    exit(0); // Ensure script stops executing after redirect
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
  <!-- Bootstrap Icons CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Other head elements -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <title>Product List</title>
</head>

<body>
  <div class="container mt-5">
    <?php include('message.php'); ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <h1 class="p-2 card-title">Add Category</h1>
          <div class="card-header d-flex flex-wrap justify-content-end gap-2">
            <a href="manage-category.php" class="btn btn-warning"><i class="bi bi-plus-lg"> </i>Manage Category</a>
            <a href="product-create.php" class="btn btn-primary"><i class="bi bi-plus-lg"> </i>Add Products</a>
          </div>
          <div class="card-body">
            <!-- Card body content goes here -->
            <form action="" method="POST">
              <div class="mb-3">
                <label for="title" class="form-label">Category Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Other body elements -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>