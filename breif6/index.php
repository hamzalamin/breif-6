<?php


$hostname = "localhost";
$username = "root";
$password = "123";
$database = "breif6";

$connection = new PDO('mysql:host=localhost;dbname=breif6', $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


session_start();

if (isset($_POST['email'], $_POST['pass'])) {
    $emailuser = $_POST['email'];
    $password = $_POST['pass'];

    $stmt = $connection->prepare("SELECT * FROM users WHERE email = '$emailuser' AND Pass = '$password'");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Perform authentication (replace this with your actual authentication logic)
    if (count($result) === 1) {
        if ($result[0]["states"] === 0 && $result[0]["isadmin"] === 0) {
            $_SESSION['is_admin'] = false; // Non-admin user
            header("location: validation.php");
        } else if ($result[0]["states"] === 1 && $result[0]["isadmin"] === 0) {
            $_SESSION['is_admin'] = false; // Non-admin user
            header("location: home.php");
        } else if ($result[0]["isadmin"] === 1 && $result[0]["states"] === 1) {
            $_SESSION['is_admin'] = true; // Admin user
            header("location: admin.php");
        } else {
            // Invalid credentials, show an error or do something else
            echo 'Invalid credentials';
        }
    } else {
        echo 'Invalid credentials';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<h1 class="d-flex justify-content-center text-primary">WELCOME TO ELECTRO EL-NACCER</h1>

    <section class="d-flex">

        <form class="back justify-content-center mt-5 border border-2 w-50 rounded " method="post">
            <h1 class="d-flex mb-5 justify-content-center">LOG IN</h1>
            <div class="input-group mb-3 mx-5">
                <span class="input-group-text " id="addon-wrapping">YOUR EMAIL</span>
                <input type="email" class="w-50 rounded " name="email" placeholder="Example@gmail.com" required>
            </div>
            <div class="input-group mb-3 mx-5">
                <span class="input-group-text " id="addon-wrapping">PASSWORD.</span>
                <input type="password" class="w-50 rounded" name="pass" placeholder="password" required>
            </div>


            <button type="submit" class="btn btn-primary mx-5">Submit</button>
            <p class="d-flex justify-content-center">Yon't have an account &nbsp; <a href="signup.php">Sign up</a></p>
        </form>
        <video class="ved" width="640" height="360" controls>
        <source src="pics/video.mp4" type="video/mp4">
        Your browser does not support the video tag.
        </video>
    </section>
    <?php
    $hostname = "localhost";
    $username = "root";
    $password = "123";
    $database = "breif6";
    
    $connection = new PDO('mysql:host=localhost;dbname=breif6', $username, $password);
    
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['email'], $_POST['pass'])) {
            $emailuser = $_POST['email'];
            $password = $_POST['pass'];
    
            $stmt = $connection->prepare("SELECT * FROM users WHERE email = '$emailuser' AND Pass = '$password'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if (count($result) === 1) {
                if ($result[0]["states"] === 0 && $result[0]["isadmin"] === 0) {
                    header("location:validation.php");
                } else if ($result[0]["states"] === 1 && $result[0]["isadmin"] === 0) {
                    header("location:home.php");
                    exit;
                } else if ($result[0]["isadmin"] === 1 && $result[0]["states"] === 1 ) {
                    header("location:admin.php");
                    exit;
                }
                //  else {
                //     header("location:admin.php");
                //     exit;
                // }
            } else {
                echo '<script>alert("Login failed. Please check your userId and password.");</script>';
            }
        }
    }
    
    
    
    
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
