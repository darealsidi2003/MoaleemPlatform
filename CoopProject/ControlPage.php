<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $link = $_POST['link'];

    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageDir = __DIR__ . '/images/';
        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0777, true);
        }

        $image = time() . '_' . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imageDir . $image)) {
            die("فشل رفع الصورة");
        }
    }

   try {
    $stmt = $conn->prepare("INSERT INTO ads (title, content, image, link, date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$title, $content, $image, $link]);
    header("Location: dashbord.php");
} catch (PDOException $e) {
    echo "<script>alert('فشل الإضافة'); window.history.back();</script>";
    exit;
}
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>منصة معلم | MOALEM - إضافة شرح</title>
    <style>
        body { margin: 0; font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif; background-color: #2c216e; color: #fff; direction: rtl; }
        .top-bar { background-color: #191641; padding: 20px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 8px rgba(0,0,0,0.4); }
        .top-bar img { height: 40px; border-radius: 5px; }
        .form-container { background-color: #3a3177; padding: 50px 40px; border-radius: 15px; box-shadow: 0 6px 20px rgba(0,0,0,0.5); width: 450px; text-align: right; margin: 40px auto; }
        .form-container h1 { margin-bottom: 30px; font-size: 20px; font-weight: bold; text-align: center; }
        .form-container input, .form-container textarea { width: 95%; padding: 12px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #5851d0; background-color: #58508c; color: #fdfbfbff; font-size: 16px; text-align: right; }
        .form-container textarea { height: 120px; resize: none; }
        .form-container button { width: 100%; padding: 12px; font-size: 18px; border: none; border-radius: 5px; background: #5950d7; color: #fff; cursor: pointer; font-weight: bold; transition: opacity 0.3s; }
        .form-container button:hover { opacity: 0.85; }
        .success-message { color: #4CAF50; margin-bottom: 20px; font-weight: bold; }
        .form-buttons { margin-top: 20px; display: flex; flex-direction: column; gap: 10px; }
        .form-buttons a { text-decoration: none; padding: 10px; border-radius: 5px; text-align: center; font-weight: bold; color: #fff; }
        .form-buttons a.dashboard-btn, .form-buttons a.logout-btn { background: #5950d7; }
        .form-buttons a:hover { opacity: 0.85; }
        .table-container img { width: 120px; height: 120px; object-fit: cover; border-radius: 8px; display: block; margin: auto; }
    </style>
</head>
<body>

<div class="top-bar">
    <img src="materials/شعار التعليم.PNG" alt="Logo">
</div>

<div class="form-container">
    <h1>إضافة شرح جديد</h1>

    <?php if(isset($success)) echo "<p class='success-message'>$success</p>"; ?>

    <form method="post" enctype="multipart/form-data">
        <label>عنوان:</label>
        <input type="text" name="title" placeholder="ادخل عنوان الشرح" required>

        <label>محتوى:</label>
        <textarea name="content" placeholder="ادخل محتوى الشرح" required></textarea>

        <label>رابط:</label>
        <input type="text" name="link" placeholder="ادخل رابط الشرح">

        <label>صورة:</label>
        <input type="file" name="image">

        <button type="submit">اضافة</button>
    </form>

    <div class="form-buttons">
        <a href="dashbord.php" class="dashboard-btn">عرض الشروحات المضافة</a>
        <a href="logout.php" class="logout-btn">تسجيل خروج</a>
    </div>
</div>

</body>
</html>