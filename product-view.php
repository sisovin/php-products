<?php
session_start();
include('config/dbcon.php');
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

  <title>Product View</title>
</head>

<body>

  <div class="container mt-5">

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Product View Details
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
              $query = "SELECT products.*, category.title AS category_title FROM products 
                        JOIN category ON products.cat_id = category.id 
                        WHERE products.id = :product_id";
              $query_run = $pdo->prepare($query);
              $query_run->bindParam(':product_id', $product_id);
              $query_run->execute();

              if ($query_run->rowCount() > 0) {
                $product = $query_run->fetch(PDO::FETCH_ASSOC);
            ?>

                <div class="mb-3">
                  <label>Product Image</label>
                  <p class="form-control">
                    <img src="<?= $product['image']; ?>" alt="Product Image" style="width: 100px; height: auto;">
                  </p>
                </div>
                <div class="mb-3">
                  <label>Title</label>
                  <p class="form-control">
                    <?= $product['title']; ?>
                  </p>
                </div>
                <div class="mb-3">
                  <label>Category</label>
                  <p class="form-control">
                    <?= $product['category_title']; ?>
                  </p>
                </div>
                <div class="mb-3">
                  <label>Price</label>
                  <p class="form-control">
                    <?= $product['price']; ?>
                  </p>
                </div>
                <div class="mb-3">
                  <label>Description</label>
                  <p class="form-control">
                    <?= $product['description']; ?>
                  </p>
                </div>
                <div class="mb-3">
                  <label>Short Description</label>
                  <p class="form-control">
                    <?= $product['meta_description']; ?>
                  </p>
                </div>
                <div class="mb-3">
                  <label>Keywords</label>
                  <p class="form-control">
                    <?= $product['meta_keywords']; ?>
                  </p>
                </div>

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