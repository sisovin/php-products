<?php
session_start();
include('config/dbcon.php');

// Retrieve all categories from the database
$query = "SELECT * FROM category";
$query_run = $pdo->query($query);
$query_run->execute();

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
          <h1 class="p-2 card-title">Category List</h1>
          <div class="card-header d-flex flex-wrap justify-content-end gap-2">
            <a href="category-create.php" class="btn btn-primary"><i class="bi bi-plus-lg"> </i>Add Category</a>
            <a href="index.php" class="btn btn-danger">BACK</a>
          </div>
          <div class="card-body">
            <!-- Card body content goes here -->
            <table class="table table-dark table-striped table-hover">
              <thead class="flex flex-grow">
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($query_run->rowCount() > 0) {
                  while ($category = $query_run->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                      <td><?= $category['id']; ?></td>
                      <td><?= $category['title']; ?></td>
                      <td class="d-flex col-md-12 gap-1 text-center">
                        <a href="category-edit.php?id=<?= $category['id']; ?>" class="btn btn-success btn-md">
                          <i class="bi bi-pencil-square"></i>
                          Edit
                        </a>
                        <form action="category-delete.php" method="POST" class="d-inline">
                          <button type="submit" name="delete_category" value="<?= $category['id']; ?>" class="btn btn-danger btn-md d-flex gap-1">
                            <i class="bi bi-trash-fill"> </i>
                            Delete
                          </button>
                        </form>
                      </td>
                    </tr>
                <?php
                  }
                } else {
                  echo "<tr><td colspan='9' class='error'>No Category Found.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>