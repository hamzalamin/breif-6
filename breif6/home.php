<?php
$hostname = "localhost";
$username = "root";
$password = "123";
$database = "breif6";

$connection = new PDO('mysql:host=localhost;dbname=breif6', $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sqlCount = "SELECT COUNT(*) AS total FROM products WHERE cache_prod = 1";
$resultCount = $connection->query($sqlCount);
$rowCount = $resultCount->fetch(PDO::FETCH_ASSOC);
$totalProducts = $rowCount['total'];

$productsPerPage = 10;
$totalPages = ceil($totalProducts / $productsPerPage);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

if (isset($_GET['filter'])) {
    if ($_GET['filter'] == 'category') {
        $filterCategoryId = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : null;

        $query = 'SELECT * FROM products WHERE cache_prod = 1';
        if ($filterCategoryId) {
            $query .= ' AND categorie_id = :categoryId';
        }
        $query .= ' LIMIT :offset, :productsPerPage';

        $statement = $connection->prepare($query);
        if ($filterCategoryId) {
            $statement->bindParam(':categoryId', $filterCategoryId, PDO::PARAM_INT);
        }
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->bindParam(':productsPerPage', $productsPerPage, PDO::PARAM_INT);
        $statement->execute();
        $prod = $statement->fetchAll(PDO::FETCH_ASSOC);
    } elseif ($_GET['filter'] == 'price') {
        $maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : PHP_INT_MAX;

        $query = 'SELECT * FROM products WHERE cache_prod = 1 AND prix_final <= :maxPrice LIMIT :offset, :productsPerPage';
        $statement = $connection->prepare($query);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->bindParam(':productsPerPage', $productsPerPage, PDO::PARAM_INT);
        $statement->bindParam(':maxPrice', $maxPrice, PDO::PARAM_INT);
        $statement->execute();
        $prod = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    // Default query without any filters
    $query = 'SELECT * FROM products WHERE cache_prod = 1 LIMIT :offset, :productsPerPage';
    $statement = $connection->prepare($query);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->bindParam(':productsPerPage', $productsPerPage, PDO::PARAM_INT);
    $statement->execute();
    $prod = $statement->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php
session_start();

$is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .product-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 2);
        }

        .offer {
            text-decoration: line-through;
            color: #999;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ELECTRO EL-NACCER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">LOG OUT</a>
                    </li>
                    <?php
                    if ($is_admin) {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link active" aria-current="page" href="admin.php">ADMINISTRATION</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="container mx-5 mt-3">
    <form method="GET" action="home.php" class="mb-3">
        <label for="categoryFilter" class="form-label">Filter by Category:</label>
        <select name="categoryFilter" id="categoryFilter" class="form-select">
            <option value="" selected disabled>Select Category</option>
            <?php
            $query = "SELECT * FROM categories WHERE cache = 1";
            $statement = $connection->prepare($query);
            $statement->execute();
            $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($categories as $category) {
                echo '<option value="' . $category['categorie_id'] . '">' . $category['categorie_name'] . '</option>';
            }
            ?>
        </select>

        <button type="submit" class="btn btn-primary" name="filter" value="category">Filter by Category</button>
    </form>

    <form method="GET" action="home.php" class="mb-3">
        <label for="maxPrice" class="form-label">Maximum Price:</label>
        <input type="number" name="maxPrice" id="maxPrice" class="form-control" placeholder="Enter maximum price">

        <button type="submit" class="btn btn-primary" name="filter" value="price">Filter by Price</button>
    </form>

    <div class="row">
        <?php
        foreach ($prod as $ray) {
            $x = $ray['categorie_id'];
            $query = "SELECT * FROM categories WHERE cache = 1 AND categorie_id = :categoryId";
            $statement = $connection->prepare($query);
            $statement->bindParam(':categoryId', $x, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            echo '<div class="col-4 mb-1">';
            echo '<div class="bg-white p-3 border rounded product-card w-100">';
            echo '<p>';
            echo '<img style="width: 150px; height: 100px;" src="' . $ray['image'] . '" alt="Product Image" class="img-fluid">';
            echo '<strong>' . $ray['etiquette'] . '</strong><br>';
            echo '<span class="text-muted offer">' . $ray['prix_final'] . " DH" . '</span><br>';
            echo '<span>' . $ray['Offre_de_prix'] . " DH" . '</span><br>';
            echo "<small>" . $ray['description'] . "</small><br>";

            // Check if there are any results before accessing the array
            if (!empty($result)) {
                echo '<small>' . $result[0]['categorie_name'] . '</small><br>';
            }

            echo '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center mt-4">
        <?php
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '">';
            echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
            echo '</li>';
        }
        ?>
    </ul>
</nav>
</body>
</html>
