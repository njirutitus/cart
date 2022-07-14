<html>

<head>
    <link rel="stylesheet" href="./css/pico.min.css">
    <title>Shopping cart</title>
</head>

<body>
    <div class="container">
        <?php include_once 'navbar.php';?>

        <main>
            <h1>Featured Products</h1>
            <div class="grid">
                <?php
    require_once 'connect.php';
    $sql = "SELECT * FROM products";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll();
    foreach ($products as $product) {
        echo "<div class='product'>";
        echo "<img src='" . $product['image'] . "'>";
        echo "<h3>" . $product['name'] . "</h3>";
        echo "<p>$" . $product['price'] . "</p>";
        echo "<p>" . $product['description'] . "</p>";
        echo '<a href="add_to_cart.php?id=' . $product['id'] . ' role="button">Add to cart</a>';
        echo "</div>";
    }
    ?>
            </div>
        </main>
    </div>
</body>

</html>