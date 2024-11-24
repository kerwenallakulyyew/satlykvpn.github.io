<?php
// MySQL bilen baglanyşyk
$conn = new mysqli('localhost', 'root', '', 'zat_satysh_db'); // 'webdb' yerine 'zat_satysh_db'
if ($conn->connect_error) {
    die("Baglanyşykda näsazlyk: " . $conn->connect_error);
}



// Haryt ID-si al
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

// Telefon nomerini bazada saklamak
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone_number = $_POST['phone_number'];

    // Telefon nomeriniň validasiýasy (10-15 san)
    if (preg_match("/^\+?\d{10,15}$/", $phone_number)) {
        // SQL tälimatyny taýýarlaň
        $stmt = $conn->prepare("INSERT INTO orders (product_id, phone_number) VALUES (?, ?)");

        // Eger SQL tälimaty başarısyz bolsa, hata ýaz
        if ($stmt === false) {
            die('MySQL error: ' . $conn->error);
        }

        // Telefon nomerini we haryt ID-ni bazada saklamak
        $stmt->bind_param("is", $product_id, $phone_number); // "i" = INT, "s" = STRING
        if ($stmt->execute()) {
            $message = "Az wagtyn icinde size sms barar!";
            $is_success = true;
        } else {
            $message = "Satyşda näsazlyk bolup geçdi!";
            $is_success = false;
        }
        $stmt->close();
    } else {
        $message = "Telefon nomerini dogry giriziň.";
        $is_success = false;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satyn Almak</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .order-container {
            background: white;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 320px;
            text-align: center;
            box-sizing: border-box;
        }
        .order-container h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .order-container input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
            box-sizing: border-box;
        }
        .order-container button {
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .order-container button:hover {
            background-color: #45a049;
        }
        .message {
            font-size: 16px;
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .success-message {
            color: green;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="order-container">
        <h1>Satyn Almak</h1>

        <!-- SMS Maglumat -->
        <?php if (isset($message)): ?>
            <div class="message <?php echo $is_success ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="phone_number" placeholder="Telefon nomeri giriziň" required>
            <button type="submit">Satyn Al</button>
        </form>

        <!-- Az wagtyň içinde SMS habar -->
        <div id="smsMessage" class="success-message" style="display:none;">
        </div>
    </div>

    <script>
        // Telefon nomeri girizildikden soň SMS maglumatyny görkezmek üçin
        <?php if (isset($is_success) && $is_success): ?>
            document.getElementById('smsMessage').style.display = 'block';
        <?php endif; ?>
    </script>

</body>
</html>




