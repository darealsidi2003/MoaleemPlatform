<?php
session_start();
require 'config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: ControlPage.php");
        exit;
    } else {
        $message = "اسم المستخدم أو كلمة المرور خاطئ!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> منصة معلم | MOALEM - تسجيل دخول</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif;
            background-color: #2c216e;
            color: #fff;
            direction: rtl;
        }

        .top-bar {
            background-color: #191641;
            padding: 20px 30px;
            display: flex;
            justify-content: right;
            
            box-shadow: 0 4px 8px rgba(0,0,0,0.4);
            position: relative;
        }
        .top-bar img {
            height: 50px;
            border-radius: 5px;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 90px); 
            padding: 50px;
        }

        .login-box {
            background-color: #3a3177;
            padding: 150px 40px;
            border-radius: 150px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.5);
            width: 500px;
            max-width: 100%;
            text-align: center;
        }

        .login-box img {
            width: 100px;
            height: 100px;
            margin-bottom: 25px;
        }

        .login-box h1 {
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 700;
        }

        .login-box input {
            width: 95%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #5851d0;
            font-size: 16px;
            background-color: #58508c;
            color: #fff;
            text-align: right;
        }

        .login-box input::placeholder {
            color: #ccc;
            text-align: right;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(to right, #5950d7, #7b66ff);
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            transition: opacity 0.3s;
        }
        .login-box button:hover {
            opacity: 0.85;
        }

        .error-message {
            color: #ff6b6b;
            margin-bottom: 15px;
            font-weight: bold;
        }

        @media (max-width: 500px) {
            .login-box {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>

<div class="top-bar">
    <img src="materials/شعار التعليم.PNG" alt="Logo">
</div>

<div class="login-container">
    <div class="login-box">
        <img src="materials/شعار التعليم.PNG" alt="شعار الموقع">
        <h1>تسجيل الدخول</h1>

        <?php if($message) echo "<p class='error-message'>$message</p>"; ?>

        <form method="post">
            <input type="text" name="username" placeholder="اسم المستخدم" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button type="submit">تسجيل الدخول</button>
        </form>
    </div>
</div>

</body>
</html>