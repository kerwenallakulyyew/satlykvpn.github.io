<!DOCTYPE html>
<html lang="tk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sayta Gir</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }
        .login-container h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .modal-content h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .modal-content input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .modal-content button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
        }
        .modal-content .close-btn {
            background-color: #FF4B4B;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Telefon nomerini almak üçin modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <h2>Telefon Nomerini Giriziň</h2>
            <input type="text" id="phoneNumber" placeholder="Telefon nomeri giriziň">
            <button onclick="submitPhoneNumber()">Gir</button>
            <button class="close-btn" onclick="closeModal()">Ýapmak</button>
        </div>
    </div>

    <!-- Giris sahypasy -->
    <div class="login-container">
        <h1>Sayta Gir</h1>
        <button onclick="openModal()">Telefon nomeri bilen girmek</button>
    </div>

    <script>
        // Modal ulanyş funksiýalary
        const modal = document.getElementById('loginModal');
        
        // Modaly açmak
        function openModal() {
            modal.classList.add('active');
        }

        // Modaldan çykmak
        function closeModal() {
            modal.classList.remove('active');
        }

        // Telefon nomerini almak we ulanyjy üçin bildiriş bermek
        function submitPhoneNumber() {
            const phoneNumber = document.getElementById('phoneNumber').value;
            
            // Telefon nomerini validasiýa etmek
            const phoneRegex = /^\+?\d{10,15}$/; // Telefon nomeri üçin regex (10-15 san aralygy)
            
            if (phoneRegex.test(phoneNumber)) {
                alert('Telefon nomeri kabul edildi: ' + phoneNumber);
                closeModal();  // Modaly ýapmak
                window.location.href = "index.php";  // Sayt başyna gaýtarmak
            } else {
                alert('Jübi nomerini dogry giriziň.');
            }
        }
    </script>
</body>
</html>
