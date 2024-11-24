<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // Öýjük üçin maglumat çykar
    echo "<h1>Sargyt kabul edildi!</h1>";
    echo "<p>Önüm: $product_name</p>";
    echo "<p>Bahasy: $price TMT</p>";

    // Here maglumat bazasyna goşup bolýar
    // Mysal: MySQL ulanmak
}
// MySQL bilen baglanyşyk
$conn = new mysqli('localhost', 'root', '', 'zat_satysh_db');
if ($conn->connect_error) {
    die("Baglanyşykda näsazlyk: " . $conn->connect_error);
}

// Maglumatlary goşmak
$sql = "INSERT INTO orders (product_name, price) VALUES ('$product_name', '$price')";
if ($conn->query($sql) === TRUE) {
    echo "<p>Sargyt maglumat bazasyna üstünlikli goşuldy!</p>";
} else {
    echo "Sargytda näsazlyk: " . $conn->error;
}

$conn->close();

?>
