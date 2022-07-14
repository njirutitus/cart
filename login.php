<?php
    require_once 'connect.php';
    session_start();
    if(isset($_SESSION['user'])){
        header('Location: index.php');
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password']; 
        try {
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if($user){
                if(password_verify($password, $user['password'])){
                    session_start();
                    $_SESSION['user'] = $user;
                    if($user['role']==='admin'){
                        header('Location: admin.php');
                    }else{
                        header('Location: index.php');
                    }
                }else{
                    $_SESSION['error'] = "Password incorrect.";
                }
            }else{
                $_SESSION['error'] = "User not found.";
            }
        } catch (PDOException $e) {
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
        <h1>Login to continue</h1>
        <?php require_once 'feedback.php';?>
        <form action="" method="post">
            <div>
                <label>Email</label>
                <input type="email" name="email">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </main>

</body>

</html>