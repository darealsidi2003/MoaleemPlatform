<?php
require 'config.php';
$stmt = $conn->query("SELECT * FROM ads ORDER BY id DESC");
$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>منصة معلم | MOALEM PLATFORM</title>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #2c216e;
        color: white;
        direction: rtl;
        scroll-behavior: smooth;
        font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif;
    }

    header {
        background-color: #191641;
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.4);
        position: relative;
    }

    .logo {
        width: 80px;
        height: 80px;
       
    }

.contact-btn {
    background-color: #6fadf9; 
    border: none;
    padding: clamp(8px, 1.5vw, 16px) clamp(12px, 3vw, 32px); 
    font-size: clamp(14px, 2vw, 18px); 
    border-radius: 25px;
    cursor: pointer;
    color: #fff;
    transition: all 0.3s ease-in-out;
    position: absolute;
    left: 2%; 
    top: 50%;
    transform: translateY(-50%);
}

.contact-btn:hover {
    background-color: #0d6efd;
    transform: translateY(-50%) scale(1.05)
}

    .header-center {
        text-align: center;
        flex: 1;
    }

    .header-center h1 {
        margin: 0;
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .header-center p {
        margin: 0;
        font-size: 12px;
        color: #faf9f9ff;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        padding: 70px 20px 50px 20px;
        flex-direction: row; 
    }

    .text {
        max-width: 500px;
        margin: 20px;
        order: 1; 
    }

    .text h2 {
        font-size: 36px;
        margin-bottom: 20px;
    }

    .text p {
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .text button {
        background: linear-gradient(to right, #e9808c, #Df9aa9,#cbdaee);
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 25px;
        cursor: pointer;
        color: #fff;
    }

    .image-container {
        width: 700px;
        max-width: 90%;
        margin: 20px;
        overflow: hidden;
        order: 2; 
    }

    .image-container img {
    width: 100%;
    position: relative;
    right: -100%;   
    transition: right 1.5s ease-out;
}

.image-container img.animate {
    right: 0;
}

   .ads-wrapper {
    margin-top: 80px;   
    text-align: center; 
}

    .ads-wrapper h2 {
        font-size: 28px;
        margin-bottom: 30px;
    }

   .ads-section {
    max-width: 1200px;          
    margin: 0 auto 50px auto;   
    padding: 20px;
    display: flex;               
    flex-wrap: wrap;            
    gap: 20px;                  
    justify-content: center;     
}
.ad {
    background-color: #49408b;
    border-radius: 10px;
    padding: 15px;
    width: 300px;             
    box-sizing: border-box;
    text-align: center;
    transition: transform 0.3s;
    display: flex;
    flex-direction: column;
    justify-content: flex-start; 
    min-height: 500px;     
    max-height: 700px;       
    overflow-y: auto;         
}
.ad:hover {
    transform: translateY(-5px); 
}

   .ad h2 { font-size: 18px; margin: 10px 0; }
.ad p {
    font-size: 14px;        
    line-height: 1.4;
    overflow-y: auto;        
    white-space: pre-wrap;   
    word-wrap: break-word;  
    flex-grow: 1;           
    margin-bottom: 10px;
}
.ad img {
    width: 220px;     
    height: 150px;    
    object-fit: cover; 
    border-radius: 8px;
    display: block;
    margin: auto;
}
.ad a {
    display: inline-block;
    padding: 6px 12px;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
}

    @media (max-width: 900px) {
        .container {
            flex-direction: column-reverse;
            text-align: center;
        }
        .text {
            max-width: 90%;
            order: 2;
        }
        .image-container {
            order: 1;
        }
        .ad {
            width: 90%;
        }

    }

.start-btn {
    background: linear-gradient(to right, #e9808c, #Df9aa9,#cbdaee);
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 25px;
        cursor: pointer;
      
}

.start-btn:hover,
.text button:hover {
    opacity: 0.9; 
}

.banner-img {
    display: block;
    width: calc(100% - 40px);    
    height: 120px;               
    margin: 300px auto;            
    border-radius: 15px;          
    object-fit: cover;            
    box-shadow: 0 4px 12px rgba(0,0,0,0.3); 
}
</style>
</head>
<body>

<header>
    
    <img src="materials/شعار التعليم.PNG" alt="Logo" class="logo">
    <div class="header-center">
        <h1>منصة معلم</h1>
        <p>Moalem platform</p>
            <button class="contact-btn" onclick="location.href='mailto:darealsidi2003@gmail.com';">تواصل معنا</button>
    </div>
</header>

<div class="container">
    
    <div class="text">
        <h2>منصة معلم</h2>
        <p>منصة معلم توفر لك أحدث التقنيات والأدوات التي تعتمدها الإدارة، مع شرح عملي لكيفية استخدامها وتطبيقها بشكل مباشر، لتكون دائمًا على اطلاع وتمكن من تنفيذ مهامك بكفاءة واحترافية</p>
        <button id="scrollToAds">الشروحات </button>
        
    </div>
    
    <div class="image-container">
        <img src="materials/28C5F315-7567-42E1-B127-0274F7F656FA.GIF" alt="صورة" id="mainImage">
    </div>
</div>

<div class="banner">
    <img class="banner-img" src="materials/29D1C306-E42D-4A3D-8034-4413E7F4AE20 2.GIF" alt="صورة توضيحية">
</div>

<div class="ads-wrapper" id="adsSection">
    <h2>الشروحات المتاحة</h2>
    <div class="ads-section">
        <?php foreach ($ads as $ad): ?>
        <div class="ad" id="ad<?= $ad['id'] ?>">
            <?php if($ad['image']) echo "<img src='images/".$ad['image']."' class='ad-img' alt=''>"; ?>
            <h2><?= htmlspecialchars($ad['title']) ?></h2>
            <p><?= htmlspecialchars($ad['content']) ?></p>
           
           
           <?php if($ad['link']) echo "<a href='".$ad['link']."'class='start-btn'>ابدأ</a>"; ?>
           <h2><?= htmlspecialchars($ad['date']) ?></h2>
        </div>
        
        <?php endforeach; ?>
    </div>
</div>

<script>
    window.addEventListener('load', () => {
        document.getElementById('mainImage').classList.add('animate');
    });

    document.getElementById('scrollToAds').addEventListener('click', () => {
        document.getElementById('adsSection').scrollIntoView({ behavior: 'smooth' });
    });
</script>

</body>
</html>