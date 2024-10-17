<?php
session_start(); // เริ่มต้นเซสชัน

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
$isLoggedIn = isset($_SESSION['login']);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Anchisa Novel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #246fa5;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        nav {
            text-align: center;
            margin: 15px 0;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #c9e3ed;
        }

        nav a:hover {
            color: #007BFF;
        }

        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin: auto;
            overflow: hidden;
        }

        .mySlides {
            display: none;
        }

        .featured-image {
            width: 100%;
            height: auto;
        }

        .centered-heading {
            text-align: center;
            color: #246fa5;
            position: relative;
            animation: slide 25s linear infinite;
        }

        @keyframes slide {
            0% {
                transform: translateX(50%);
            }

            100% {
                transform: translateX(-50%);
            }
        }
    </style>
</head>

<body>

<header>
    <h1>Anchisa Novel</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="product.php">Product</a>
        <a href="#">About Us</a>
        <a href="admin_login.php">Admin</a>
        <?php if ($isLoggedIn): ?>
            <!-- Show Profile and Logout buttons when logged in -->
            <a href="my-profile.php" class="btn btn-primary" style="padding: 8px 16px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">Profile</a>
            <form action="logout2.php" method="post" style="display: inline;">
                <button type="submit" name="logout2" style="padding: 8px 16px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 5px; border: none; cursor: pointer;">Logout</button>
            </form>
        <?php else: ?>
            <!-- Show Login button when not logged in -->
            <a href="login.php" class="btn btn-primary" style="padding: 8px 16px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Login</a>
        <?php endif; ?>
    </nav>
</header>

<br>
<section>
    <h2 class="centered-heading">Welcome to Anchisa Novel !!!</h2>
    <div class="slideshow-container">
        <div class="mySlides">
            <img src="images/hero-banner-4.jpg" alt="Featured Image 1" class="featured-image">
        </div>

        <div class="mySlides">
            <img src="images/hero-banner-3.jpg" alt="Featured Image 2" class="featured-image">
        </div>

        <div class="mySlides">
            <img src="images/hero-banner-5.jpg" alt="Featured Image 3" class="featured-image">
        </div>
    </div>
</section>

<style>
    .slideshow-container {
        align-items: center;
        justify-content: center;
        text-align: center;
        margin: 0 auto;
    }

    .featured-image {
        width: 90%;
        height: 400px;
        object-fit: cover;
    }
</style>

<br><br>
<section class="clearance-deal">
    <div class="container">
        <h2 class="section-title">COLLECTION</h2>
        <div class="deal-items">
            <div class="deal-item">
                <img src="images/collection-1.jpg" alt="Top 100" class="deal-image" width="250" height="350">
                <h3 class="deal-title">MAY MORE DEAL</h3>
                <p class="deal-subtitle">TOP CHINESE NOVEL</p>
                <p class="deal-description">ประจำเว็บต้องมี</p>
            </div>
            <div class="deal-item">
                <img src="images/collection-2.jpg" alt="Top 100" class="deal-image" width="250" height="350">
                <h3 class="deal-title">MAY MORE DEAL</h3>
                <p class="deal-subtitle">ซื้อ 5 ชุด ลดเพิ่ม 20%</p>
                <p class="deal-description">ซื้อ 7 ชุด ลดเพิ่ม 30%</p>
            </div>
            <div class="deal-item">
                <img src="images/collection-3.jpg" alt="Top 100" class="deal-image" width="250" height="350">
                <h3 class="deal-title">MAY MORE DEAL</h3>
                <p class="deal-subtitle">TOP 100</p>
                <p class="deal-description">ราคาพิเศษ</p>
            </div>
            <div class="deal-item">
                <img src="images/collection-4.jpg" alt="Top 100" class="deal-image" width="250" height="350">
                <h3 class="deal-title">MAY MORE DEAL</h3>
                <p class="deal-subtitle">TOP 100</p>
                <p class="deal-description">ราคาพิเศษ</p>
            </div>
        </div>
    </div>
</section>

<style>
    .clearance-deal {
        background-color: #f4f4f4;
        padding: 40px 0;
    }

    .section-title {
        text-align: center;
        font-size: 2em;
        margin-bottom: 20px;
        color: #b22222;
    }

    .deal-items {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .deal-item {
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        width: 250px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .deal-image {
        width: 250px;
        height: 350px;
        object-fit: cover;
        border-radius: 8px;
    }

    .deal-title {
        font-size: 1.5em;
        margin: 10px 0;
    }

    .deal-subtitle {
        font-size: 1.2em;
        color: #ff5733;
    }

    .deal-description {
        color: #555;
    }
</style>

<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let slides = document.getElementsByClassName("mySlides");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none"; 
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].style.display = "block"; 
        setTimeout(showSlides, 3000); 
    }
</script>

<br><br><br><br><br>
</body>
</html>
<footer style="display: flex; justify-content: center; align-items: center; height: 60px;">
    &copy;2024 Anchisa Novel.
</footer>