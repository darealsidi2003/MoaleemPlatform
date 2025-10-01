<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';
$stmt = $conn->query("SELECT * FROM ads ORDER BY id DESC");
$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<meta charset="UTF-8">
<title>منصة معلم | MOALEM - عرض الشروحات</title>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #2c216e;
        color: #333;
        direction: rtl;
        font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif;
    }

    .top-bar {
        position: sticky;
        top: 0;
   background-color: #191641;
        padding: 15px 30px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        z-index: 100;
    }

    .top-bar img.logo {
        height: 50px;
        margin-left: auto; 
    }

    
    .main-container {
        max-width: 1000px;
        margin: 30px auto;
        background-color: #3f327f;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }

    .back-btn {
        display: inline-block;
        background-color: #5950d7;
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: bold;
        transition: opacity 0.3s;
        margin-bottom: 20px;
       
        
    }
  

    .back-btn:hover {
        opacity: 0.85;
    }

   .card {
    background-color: #594c92;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    display: flex;
    flex-direction: column; 
    justify-content: space-between;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s;
    word-wrap: break-word; 
    overflow-wrap: break-word; 
    max-height: 500px; 
   }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

  .card-info {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    overflow: auto; 
}


   .card-info h3 {
    margin: 0;
    font-size: 20px;
    color: #fff;
    word-wrap: break-word;
}

    .card-info p {
    margin: 10px 0 0 0;
    font-size: 14px;
    color: #bababaff;
    flex-grow: 1; 
    overflow-wrap: break-word;
    word-wrap: break-word;
    white-space: pre-line; 
}

    .card-info img {
        margin-top: 10px;
        max-width: 150px;
        border-radius: 8px;
    }

    
    .card-actions {
        display: flex;
        gap: 10px;
    }

    .card-actions a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background-color: #3b2f7d;
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        transition: background-color 0.3s, transform 0.2s;
    }

    .card-actions a:hover {
        transform: scale(1.1);
    }

    .card-actions .delete-btn { background-color: #ff4d4d; }
    .card-actions .edit-btn { background-color: #6c5ce7; }
    .card-actions .view-btn { background-color: #00a8ff; }

    .ad-img {
    width: 200px;       
    height: 200px;     
    object-fit: cover;  
    border-radius: 8px;
    display: block;
    margin: auto;
}
</style>
</head>
<body>

<div class="top-bar">
    <img src="materials/شعار التعليم.PNG" alt="Logo" class="logo">
</div>

<div class="main-container">
    <a href="ControlPage.php" class="back-btn">العودة لصفحة الإضافة</a>

    <?php foreach ($ads as $ad): ?>
    <div class="card" id="ad<?= $ad['id'] ?>">
        <div class="card-info">
            <h3><?= htmlspecialchars($ad['title']) ?></h3>
            <p><?= htmlspecialchars($ad['content']) ?></p>
      
        </div>
        <div class="card-actions">
            <a href="Delete_ad.php?id=<?= $ad['id'] ?>" class="delete-btn" title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟')">🗑️</a>
            <a href="Edit_ad.php?id=<?= $ad['id'] ?>" class="edit-btn" title="تعديل">✏️</a>
            <a href="index.php#ad<?= $ad['id'] ?>" class="view-btn" title="عرض">👁️</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

</body>
</html>