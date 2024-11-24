<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'] ?: 'default.png';

    // MySQL bilen baglanyşyk
    $conn = new mysqli('localhost', 'root', '', 'zat_satysh_db');
    if ($conn->connect_error) {
        die("Baglanyşykda näsazlyk: " . $conn->connect_error);
    }

    // Täze haryt goşmak
    $sql = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "Täze haryt goşuldy!";
    } else {
        echo "Näsazlyk: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="tk">
<head>
    <meta charset="UTF-8">
    <title>Haryt Goşmak</title>
</head>
<body>
    <h1>Täze Haryt Goşmak</h1>
    <form method="post" action="">
        <label for="name">Haryt Ady:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="price">Bahasy:</label>
        <input type="number" id="price" name="price" step="0.01" required><br><br>

        <label for="image">Surat URL:</label>
        <input type="text" id="image" name="image"><br><br>

        <button type="submit">Goş</button>
    </form>
</body>
</html>
