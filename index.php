<?php
include('config/dbcon.php');

define('SITEURL', 'http://localhost/learnphp/php-products/'); // Define the SITEURL constant

// Get the current page number from the URL, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // Number of products per page
$offset = ($page - 1) * $limit; // Calculate the offset for the SQL query

// Fetch total number of products
$total_query = "SELECT COUNT(*) as total FROM products";
$total_result = $pdo->query($total_query);
$total_row = $total_result->fetch(PDO::FETCH_ASSOC);
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit); // Calculate total pages

// Fetch products for the current page
$query = "SELECT products.*, category.title AS category_title FROM products 
          JOIN category ON products.cat_id = category.id 
          ORDER BY products.id ASC LIMIT :limit OFFSET :offset";
$query_run = $pdo->prepare($query);
$query_run->bindParam(':limit', $limit, PDO::PARAM_INT);
$query_run->bindParam(':offset', $offset, PDO::PARAM_INT);
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
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <h1 class="p-2 card-title">Product Details</h1>
          <div class="card-header d-flex flex-wrap justify-content-end gap-2">
            <a href="manage-category.php" class="btn btn-warning"><i class="bi bi-plus-lg"> </i>Manage Category</a>
            <a href="product-create.php" class="btn btn-primary"><i class="bi bi-plus-lg"> </i>Add Products</a>
          </div>
          <div class="card-body">
            <!-- Card body content goes here -->
            <table class="table table-responsive table-striped table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Short Description</th>
                  <th>Keywords</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($query_run->rowCount() > 0) {
                  while ($row = $query_run->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                      <td><?= $row['id']; ?></td>
                      <td><?= $row['title']; ?></td>
                      <td><?= $row['category_title']; ?></td> <!-- Use category_title instead of category -->
                      <td>$<?= $row['price']; ?></td>
                      <td>
                        <?php
                        // Check whether image available or not
                        if ($row['image'] == "") {
                          // Image not Available
                          echo "<div class='error'>Image not available.</div>";
                        } else {
                          // Image Available
                        ?>
                          <img src="<?php echo SITEURL; ?><?= $row['image']; ?>" alt="<?= $row['title']; ?>" width="130px" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                      </td>
                      <td><?= $row['description']; ?></td>
                      <td><?= $row['meta_description']; ?></td>
                      <td><?= $row['meta_keywords']; ?></td>
                      <td class="d-flex col-md-6 gap-1">
                        <a href="product-view.php?id=<?= $row['id']; ?>" class="btn btn-info btn-md flex d-flex gap-1">
                          <i class="bi bi-binoculars-fill"> </i>
                          View
                        </a>
                        <a href="product-edit.php?id=<?= $row['id']; ?>" class="btn btn-success btn-md flex d-flex gap-1">
                          <i class="bi bi-pencil-fill"> </i>
                          Edit
                        </a>
                        <form action="code.php" method="POST" class="d-inline">
                          <button type="submit" name="delete_product" value="<?= $row['id']; ?>" class="btn btn-danger btn-md flex d-flex gap-1">
                            <i class="bi bi-trash-fill"> </i>
                            Delete
                          </button>
                        </form>
                      </td>
                    </tr>
                  <?php
                  }
                } else {
                  ?>
                  <tr>
                    <td colspan="9">No Record Found</td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer text-muted">
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                      Previous
                      <span aria-hidden="true"><!-- &laquo; --><i class="bi bi-chevron-double-left"></i></span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                  </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                      <span aria-hidden="true"><!-- &raquo; --><i class="bi bi-chevron-double-right"></i></span>
                      Next
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>
            <hr />
            <p class="text-center">
              2024 -
              <?php
              echo date("Y");
              ?>
              &copy; All Rights Reserved. Developed by: <a href="#">Niewwin Cheung</a></p>
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