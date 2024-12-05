
# Project Title: "PHP Products Display with CRUD Operation"

## Table of Contents

1. Introduction
2. [Project Structure](#project-structure)
3. [Setup Instructions](#setup-instructions)
   1. Prerequisites
   2. Installation
4. [Database Setup](#database-setup)
5. Usage
   1. [Managing Categories](#managing-categories)
   2. [Managing Products](#managing-products)
6. [File Descriptions](#file-descriptions)


## Introduction

This project, "PHP Products Display with CRUD Operation," is a web application that allows users to manage products and categories. It includes functionalities to create, read, update, and delete (CRUD) products and categories.

## Project Structure

```
.gitignore
.vscode/
    settings.json
category-create.php
category-delete.php
category-edit.php
code.php
CodeCollection.md
config/
    dbcon.php
database/
    phpproducts.sql
    products.sql
img/
index.php
manage-category.php
message.php
product-create.php
product-edit.php
product-view.php
Readme.md
```

## Setup Instructions

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer (optional, for dependency management)
- A web server like Apache or Nginx

### Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/sisovin/php-products.git
   cd php-products
   ```

2. Configure the database connection:
   - Open 

dbcon.php

 and update the database credentials:
     ```php
     $MYSQL_HOST = 'localhost';
     $DB_NAME = 'phpproducts';
     $DB_USER = 'root';
     $DB_PASS = 'your_password';
     ```

3. Import the database:
   - Import the SQL files located in the 

database

 directory into your MySQL server:
     ```sh
     mysql -u root -p phpproducts < database/phpproducts.sql
     mysql -u root -p phpproducts < database/products.sql
     ```

4. Start your web server and navigate to the project directory.

## Database Setup

1. Create a database named `phpproducts`.
2. Import the SQL files located in the 

database

 directory into your MySQL server:
   ```sh
   mysql -u root -p phpproducts < database/phpproducts.sql
   mysql -u root -p phpproducts < database/products.sql
   ```

## Usage

### Managing Categories

1. **Add Category**:
   - Navigate to 

category-create.php

.
   - Fill in the category title and submit the form.

2. **Edit Category**:
   - Navigate to 

manage-category.php

.
   - Click on the "Edit" button next to the category you want to edit.
   - Update the category title and submit the form.

3. **Delete Category**:
   - Navigate to 

manage-category.php

.
   - Click on the "Delete" button next to the category you want to delete.

### Managing Products

1. **Add Product**:
   - Navigate to 

product-create.php

.
   - Fill in the product details and submit the form.

2. **Edit Product**:
   - Navigate to 

index.php

.
   - Click on the "Edit" button next to the product you want to edit.
   - Update the product details and submit the form.

3. **Delete Product**:
   - Navigate to 

index.php

.
   - Click on the "Delete" button next to the product you want to delete.

4. **View Product**:
   - Navigate to 

index.php

.
   - Click on the "View" button next to the product you want to view.

## File Descriptions

- **config/dbcon.php**: Database connection configuration.
- **category-create.php**: Page to create a new category.
- **category-delete.php**: Script to delete a category.
- **category-edit.php**: Page to edit an existing category.
- **code.php**: Contains the logic for CRUD operations on products.
- **index.php**: Main page displaying the list of products.
- **manage-category.php**: Page to manage categories.
- **message.php**: Displays session messages.
- **product-create.php**: Page to create a new product.
- **product-edit.php**: Page to edit an existing product.
- **product-view.php**: Page to view product details.

