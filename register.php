<?php
require_once 'connect.php';
session_start();
if(isset($_SESSION['user'])){
    header('Location: index.php');
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    if($password !== $confirm_password){
        $_SESSION['error'] = "Passwords do not match";
        exit();
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    try{
        $sql = "INSERT INTO users(email,name,password) VALUES(?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email,$name,$password]);
        $_SESSION['success'] = "User created.\n";
    }catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
        exit();
    }
}
?>


<html>

<head>
    <link rel="stylesheet" href="./css/pico.min.css">
    <title>Shopping cart</title>
</head>

<body>
    <div class="container">
        <?php include_once 'navbar.php';?>
    </div>
    <main class="container">
        <h1>Register to continue</h1>
        <?php require_once 'feedback.php';?>
        <form action="" method="post">
            <div>
                <label>Your Name</label>
                <input type="text" name="name">
            </div>
            <div>
                <label>Your Email</label>
                <input type="email" name="email">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" name="confirmPassword">
            </div>
            <div>
                <button type="submit">Register</button>
            </div>
        </form>
    </main>

</body>

</html>