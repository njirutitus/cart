<?php
session_start();
require_once 'connect.php';
if(!(isset($_SESSION['user']) && $_SESSION['user']['role']==='admin')){
    header('Location: index.php');
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    try {
        $sql = "INSERT INTO products(name,price,description,image) VALUE(?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name,$price,$description,$image]);
        $_SESSION['success'] = "Product Added successfully";

    } catch (PDOException $e) {
        $_SESSION['success'] = $e->getMessage();
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
        <h1>All Products</h1>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
        $sql = "SELECT * FROM products";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        foreach ($products as $product) {
            echo "<tr>";
            echo "<td><img src='" . $product['image'] ?? 'https://images.unsplash.com/photo-1558818498-28c1e002b655?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dG9tYXRvZXN8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60'. "'></td>";
            echo "<td>" . $product['name'] . "</td>";
            echo "<td>$" . $product['price'] . "</td>";
            echo "<td>" . $product['description'] . "</td>";
            echo '<td><a href="edit.php?id=' . $product['id'] . ' role="button">Update</a><a href="delete.php?id=' . $product['id'] . ' role="button">Delete</a></td>';
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>
        <h1>Add new Product</h1>
        <form action="" method="post">
            <div>
                <label>Name</label>
                <input type="text" name="name">
            </div>
            <div>
                <label>Price</label>
                <input type="number" name="price">
            </div>
            <div>
                <label>Description</label>
                <textarea name="description"></textarea>
            </div>
            <div>
                <label>Image</label>
                <input type="text" name="image">
            </div>
            <div>
                <button type="submit">Add</button>
            </div>
        </form>
    </div>
</body>

</html>