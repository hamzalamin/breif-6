<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<style>
   
    .category-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .category-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 2);
    }

    .category-card img {
        max-width: 100%;
        height: auto;
        margin-top: 10px;
    }

    .category-card p {
        margin-bottom: 0;
    }

    .category-card strong {
        display: block;
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .category-card small {
        color: #777;
    }
   
    .nav-link {
        transition: color 0.3s ease-in-out;
    }

    .nav-link:hover {
        color: #fff; /* Change to your desired hover color */
    }

    .nav-link.active {
        font-weight: bold; /* Change to your desired active link style */
    }
    .nav-link {
        transition: color 0.3s ease-in-out;
    }

    .nav-link:hover {
        color: #fff; /* Change to your desired hover color */
    }

    .nav-link.active {
        font-weight: bold; /* Change to your desired active link style */
    }
   
    .nav-link {
        transition: color 0.3s ease-in-out;
    }

    .nav-link:hover {
        color: #fff; /* Set your link color on hover */
        background-color: #007bff; /* Set your background color on hover */
    }

    .nav-link.active {
        font-weight: bold; /* Set your active link style */
        color: #fff; /* Set your active link color */
        background-color: #0069d9; /* Set your active link background color */
    }

    .text-primary {
        color: #007bff; /* Set your primary text color */
    }

</style>
<body>
    <header>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ELECTRO EL-NACCER</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
      </ul>
    </div>
  </div>
</nav>
</header>
<?php
$hostname = "localhost";
$username = "root";
$password = "123";
$database = "breif6";

// Use the correct variable name here
$connection = new PDO('mysql:host=localhost;dbname=breif6', $username, $password);

$query = 'SELECT * FROM categories WHERE cache = 1';
$statement = $connection->prepare($query); // Use $connection instead of $pdo
$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

$query = 'SELECT * FROM products WHERE cache_prod = 1';
$statement = $connection->prepare($query);
$statement->execute();
$prod = $statement->fetchAll(PDO::FETCH_ASSOC);



?>
<section style="display: flex;">
<nav class="col-md-2 d-none d-md-block bg-primary-subtle">
<div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="admin.php">
                            Dashboard
                        </a>
                    </li>
                    <p class="text-primary px-3">Produits</p>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="addprod.php">
                    ADD PRODUCT        
                </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="modifyprod.php">
                            MODIFY PRODUCT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="superprod.php">
                            MASK PRODUCT
                    </a>
                    </li>
                    <p class="text-primary px-3">Categories</p>

                    <li class="nav-item">
                        <a class="nav-link text-dark" href="admin.php">
                            ADD CATEGORY
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="modifycate.php">
                            MODIFY CATEGORY
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="supprcat.php">
                            MASK CATEGORY
                    </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="pagedcategory.php">
                            ALL CATEGORYS
                    </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark" href="validuser.php">
                            VALIDATION
                    </a>
                    </li>
                    
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="iwant.php">
                            STATES OF USERS
                    </a>
                    </li>
                </ul>
            </div>
        </nav>

<div class="container mt-3">
    <div class="row">
        <?php
        foreach ($result as $row) {
            echo '<div class="col-4 mb-3">';
            echo '<div class="bg-white p-3 border rounded category-card">';
            echo '<p>';
            echo '<strong>' . $row['categorie_name'] . '</strong><br>';
            echo '<img src="' . $row['categorie_pic'] . '" alt="Category Image" class="img-fluid">';
            echo '<small>' . $row['categorie_description'] . '</small><br>';
            echo '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>
</section>

<footer class="mt-auto bg-primary">
              <div class="card bg-primary">
            <h5 class="bg-primary card-header">YOU FINDE US AT  &nbsp; &nbsp; &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
  <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
</svg>&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
</svg>&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401m-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4"/>
</svg>&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
  <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
</svg></h5>

            <div class="d-flex justify-content-between text-light bg-primary card-body">
            <div>
             <h5>PRODUCT</h5>  
             <p>all about electronic</p>
             <p>and robotique</p>
             <p>home menage</p>
             <p>and a lote of products</p> 
             </div>
             <div>
             <h5>PAYMENT</h5>  
             <p>Master cartd</p>
             <p>Visa</p>
             <p>Paypale</p>
             <p>lorem</p> 
             </div>
             <div>
             <h5>OUR CITE</h5>  
             <p>Jiach break</p>
             <p>Celtic squad</p>
             <p>404 class</p>
             <p>Youcode</p> 
             </div>
             <div>
             <h5>ABOUT</h5>  
             <p>We work in all citys of <br> morroco</p>
             <p>France</p>
             <p>USA</p>
             <p>spain</p> 
             </div>
          </div>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>