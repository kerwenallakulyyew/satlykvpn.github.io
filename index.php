<?php
// MySQL bilen baglanyşyk
$conn = new mysqli('localhost', 'root', '', 'zat_satysh_db');
if ($conn->connect_error) {
    die("Baglanyşykda näsazlyk: " . $conn->connect_error);
}

// Harytlary al
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark tunnel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .product {
            border: 1px solid #ddd;
            padding: 15px;
            width: 250px;
            background: white;
            text-align: center;
            border-radius: 8px;
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product:hover {
            transform: translateY(-5px);
            box-shadow: 2px 6px 15px rgba(0, 0, 0, 0.2);
        }
        .product img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .product img.active {
            transform: scale(1.5);
        }
        .product h3 {
            margin: 15px 0 10px;
            font-size: 18px;
            font-weight: 600;
        }
        .product p {
            margin: 0;
            font-size: 16px;
            color: #555;
        }
        .product button {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .product button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>Dark Tunnel - Ynamly satuw</header>
    <div class="container">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="product">
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" onclick="toggleImageSize(this)">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p>Bahasy: <b><?= htmlspecialchars($row['price']) ?> TMT</b></p>
            <form action="order.php" method="get">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($row['id']) ?>">
                <button type="submit">Satyn Almak</button>
            </form>
        </div>
        <?php endwhile; ?>
    </div>

    <script>
        function toggleImageSize(image) {
            // Eger ulaldylan bolsa, kiçeldýär
            if (image.classList.contains('active')) {
                image.classList.remove('active');
            } else {
                // Başga ulaldylan surat bar bolsa, ony kiçeldýär
                document.querySelectorAll('.product img').forEach(img => img.classList.remove('active'));
                image.classList.add('active');
            }
        }
    </script>
</body>
</html>

