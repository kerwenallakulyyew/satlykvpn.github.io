<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $phone = $_POST['phone'];

    // MySQL bilen baglanyşyk
    $conn = new mysqli('localhost', 'root', '', 'zat_satysh_db');
    if ($conn->connect_error) {
        die("Baglanyşykda näsazlyk: " . $conn->connect_error);
    }

    // Sargyt goşmak
    $sql = "INSERT INTO orders (product_id, phone) VALUES ('$product_id', '$phone')";
    if ($conn->query($sql) === TRUE) {
        $message = "Sargydyňyz kabul edildi. Az wagtyň içinde size SMS barar.";
    } else {
        $message = "Sargydy goşmakda näsazlyk ýüze çykdy. Täzeden synanyşyň.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="tk">
<head>
    <meta charset="UTF-8">
    <title>Sargyt Kabul Edildi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .message {
            font-size: 18px;
            color: #333;
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="message">
        <?= isset($message) ? $message : "Hiç hili maglumat ýok!" ?>
    </div>
    <br><br>
    <a href="index.php">Baş sahypa dolan</a>
</body>
</html>
