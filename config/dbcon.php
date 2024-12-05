<?php
// Assign Parameter
$MYSQL_HOST = 'localhost';
$DB_NAME = 'phpproducts';
$DB_USER = 'root';
$DB_PASS = '************************';
$DB_CHAR = 'utf8';

  // Connect to database using PDO method
  $dsn = "mysql:host=$MYSQL_HOST;dbname=$DB_NAME;charset=$DB_CHAR";
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];
  try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
    // echo "Connected successfully";
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
?>