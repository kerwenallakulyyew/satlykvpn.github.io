<?php
$conn = new mysqli('localhost', 'root', '', 'zat_satysh_db');
if ($conn->connect_error) {
    die("Baglanyşykda näsazlyk: " . $conn->connect_error);
}

// Üýtgetmek üçin harydy al
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Maglumatlary täzeden ýazmak
    $sql = "UPDATE products SET name='$name', price='$price' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Bahasy üýtgedildi!";
    } else {
        echo "Näsazlyk: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="tk">
<head>
    <meta charset="UTF-8">
    <title>Harydy Üýtgetmek</title>
</head>
<body>
    <h1>Harydy Üýtgetmek</h1>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <label for="name">Haryt Ady:</label>
        <input type="text" id="name" name="name" value="<?= $product['name'] ?>" required><br><br>

        <label for="price">Bahasy:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?= $product['price'] ?>" required><br><br>

        <button type="submit">Üýtget</button>
    </form>
</body>
</html>
