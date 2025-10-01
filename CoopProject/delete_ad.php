<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT image FROM ads WHERE id = ?");
    $stmt->execute([$id]);
    $ad = $stmt->fetch(PDO::FETCH_ASSOC);

    if($ad && $ad['image']){
        $imagePath = "images/".$ad['image'];
        if(file_exists($imagePath)){
            unlink($imagePath);
        }
    }

    $stmt = $conn->prepare("DELETE FROM ads WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: dashbord.php");
exit();
?>