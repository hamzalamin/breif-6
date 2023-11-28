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
    <section class="ima d-flex" >
        <form class="back justify-content-center mt-5 border border-2 w-50 rounded " method="post">
            <h1 class="d-flex mb-5 justify-content-center">SIGN UP</h1>
            <div class="input-group mb-3 mx-5">
                <span class="input-group-text " id="addon-wrapping">YOUR NAME</span>
                <input type="name" class="w-50 rounded" name="name" placeholder="name" required>
            </div>
            <div class="input-group mb-3 mx-5">
                <span class="input-group-text " id="addon-wrapping">YOUR EMAIL</span>
                <input type="email" class="w-50 rounded " name="emailuser" placeholder="Example@gmail.com" required>
            </div>
            <div class="input-group mb-3 mx-5">
                <span class="input-group-text " id="addon-wrapping">PASSWORD.</span>
                <input type="password" class="w-50 rounded" name="pass" placeholder="password" required>
            </div>
            <button type="submit" class="btn btn-primary mx-5">valid</button>
            <p class="d-flex justify-content-center">Yon have already an account &nbsp; <a href="index.php">Log in</a></p>
        </form>
        <img src="pics/backg.png">
    </section>
    <?php
$hostname = "localhost";
$username = "root";
$password = "123";
$database = "breif6";

try {
    $connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $name = $_POST['name'];
        $email = $_POST['emailuser'];
        $password = $_POST['pass'];

        $sql = "INSERT INTO users (user_name, email, pass) VALUES (:name, :email, :password)";
        $stmt = $connection->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        echo "User registered successfully!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$connection = null;
?>
    
