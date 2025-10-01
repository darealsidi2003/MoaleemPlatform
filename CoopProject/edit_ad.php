<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';

if (!isset($_GET['id'])) die("لم يتم تحديد الإعلان.");
$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM ads WHERE id = ?");
$stmt->execute([$id]);
$ad = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$ad) die("الإعلان غير موجود.");

$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $link = $_POST['link'];

    $image = $ad['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);
    }

    $stmt = $conn->prepare("UPDATE ads SET title=?, content=?, image=?, link=? WHERE id=?");
    $stmt->execute([$title, $content, $image, $link, $id]);

    header("Location: dashbord.php");
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<meta charset="UTF-8">
<title>منصة معلم | MOALEM - تعديل </title>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #2c216e;
        color: #fff;
        direction: rtl;
        font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif;
    }

    .top-bar {
        background-color: #191641;
        padding: 20px 30px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.4);
        justify-content: space-between;
    }

    .top-bar h2 {
        margin: 0;
        font-size: 22px;
    }

    .top-bar img {
        height: 40px;
        border-radius: 5px;
    }

    .form-container {
        background-color: #3a3177;
        padding: 50px 40px;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.5);
        width: 450px;
        margin: 40px auto;
    }

    .form-container h1 {
        margin-bottom: 30px;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
    }

    .form-container input,
    .form-container textarea {
        width: 95%;
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #5851d0;
        background-color: #58508c;
        color: #fff;
        font-size: 16px;
        text-align: right;
    }

    .form-container textarea {
        height: 120px;
        resize: none;
    }

    .form-container button {
        width: 100%;
        padding: 12px;
        font-size: 18px;
        border: none;
        border-radius: 5px;
        background: #5950d7;
        color: #fff;
        cursor: pointer;
        font-weight: bold;
        transition: opacity 0.3s;
    }

    .form-container button:hover {
        opacity: 0.85;
    }

    .success-message {
        color: #4CAF50;
        margin-bottom: 20px;
        font-weight: bold;
        text-align: center;
    }

    .current-image {
        text-align: center;
        margin-bottom: 20px;
    }

    .current-image img {
        max-width: 100%;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.5);
    }
    .table-container img {
    width: 120px;     
    height: 120px;     
    object-fit: cover; 
    border-radius: 8px;
    display: block;
    margin: auto;
}

  

</style>
</head>
<body>

<div class="top-bar">
    <img src="materials/شعار التعليم.PNG" alt="Logo">
     <a href="dashbord.php" class="back-btn">⬅ عودة</a>
</div>

<div class="form-container">
    <h1>تعديل الشرح</h1>

    <?php if($success) echo "<p class='success-message'>$success</p>"; ?>

    <form method="post" enctype="multipart/form-data">
        <label>عنوان:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($ad['title']) ?>" required>

        <label>محتوى:</label>
        <textarea name="content" required><?= htmlspecialchars($ad['content']) ?></textarea>

        <label>رابط:</label>
        <input type="text" name="link" value="<?= htmlspecialchars($ad['link']) ?>">

        <label>صورة جديده:</label>
        <input type="file" name="image">

        <?php if($ad['image']): ?>
        <div class="current-image">
            <p>الصورة الحالية:</p>
            <img src="images/<?= htmlspecialchars($ad['image']) ?>" alt="Current Image">
        </div>
        <?php endif; ?>

        <button type="submit">تعديل الإعلان</button>
    </form>
    
   
  
</div>

</body>
</html>