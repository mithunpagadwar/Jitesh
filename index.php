<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ग्राम पंचायत चिखली</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <style>
        :root {
            --primary-color: #FF9933;
            --secondary-color: #138808;
            --accent-color: #000080;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }

        .header {
            background: #f8bb14;
            padding: 1rem 0;
            border-bottom: 3px solid var(--primary-color);
        }

        .nav {
            background: var(--accent-color);
            padding: 10px 0;
        }

        .nav-menu {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .nav-menu li a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .nav-menu li a:hover {
            background: var(--primary-color);
        }

        .swiper {
            width: 100%;
            height: 400px;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .footer {
            background: var(--accent-color);
            color: white;
            padding: 2rem 0;
            margin-top: 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container d-flex align-items-center justify-content-between">
            <img src="attached_assets/image_1743684718040.png" alt="सरकारी लोगो" height="80">
            <div class="text-center">
                <h1 class="mb-0">ग्राम पंचायत चिखली</h1>
                <p class="mb-0">जिला गडचिरोली, महाराष्ट्र</p>
            </div>
            <img src="attached_assets/image_1743698068343.png" alt="G20 लोगो" height="80">
        </div>
    </header>

    <nav class="nav">
        <div class="container">
            <ul class="nav-menu">
                <li><a href="index.php">होम</a></li>
                <li><a href="schemes.php">योजनाएं</a></li>
                <li><a href="gallery.php">फोटो गैलरी</a></li>
                <li><a href="housetax.php">घरटैक्स/पाणी टैक्स</a></li>
                <li><a href="complaint.php">शिकायत</a></li>
                <li><a href="admin/login.php">प्रशासकीय लॉगिन</a></li>
            </ul>
        </div>
    </nav>

    <div class="swiper my-4">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="attached_assets/image_1743684718040.png" alt="स्लाइड 1">
            </div>
            <div class="swiper-slide">
                <img src="attached_assets/image_1743698068343.png" alt="स्लाइड 2">
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <main class="container my-4">
        <section class="welcome-section text-center mb-5">
            <h2>ग्राम पंचायत चिखली में आपका स्वागत है</h2>
            <p>हम अपने ग्रामवासियों को बेहतर सेवाएं प्रदान करने के लिए प्रतिबद्ध हैं।</p>
        </section>

        <section class="services-grid">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-home fa-3x mb-3 text-primary"></i>
                            <h3>घर टैक्स</h3>
                            <p>ऑनलाइन घर टैक्स जमा करें</p>
                            <a href="housetax.php" class="btn btn-primary">अधिक जानें</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-tint fa-3x mb-3 text-primary"></i>
                            <h3>पानी बिल</h3>
                            <p>पानी का बिल ऑनलाइन जमा करें</p>
                            <a href="housetax.php" class="btn btn-primary">अधिक जानें</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-comments fa-3x mb-3 text-primary"></i>
                            <h3>शिकायत</h3>
                            <p>अपनी शिकायत दर्ज करें</p>
                            <a href="complaint.php" class="btn btn-primary">शिकायत दर्ज करें</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-section">
                <h3>संपर्क करें</h3>
                <p><i class="fas fa-map-marker-alt"></i> ग्राम पंचायत कार्यालय, चिखली</p>
                <p><i class="fas fa-phone"></i> 07133-245678</p>
                <p><i class="fas fa-envelope"></i> gpchikhali66@gmail.com</p>
            </div>
            <div class="footer-section">
                <h3>महत्वपूर्ण लिंक्स</h3>
                <p><a href="schemes.php" class="text-white">सरकारी योजनाएं</a></p>
                <p><a href="gallery.php" class="text-white">फोटो गैलरी</a></p>
                <p><a href="complaint.php" class="text-white">शिकायत</a></p>
            </div>
            <div class="footer-section">
                <h3>नक्शे पर स्थान</h3>
                <div class="google-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.4858773124993!2d79.85646007424365!3d20.33175447958868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd278d4a555555%3A0x3b11c6f5c60ea4a2!2sGram%20Panchayat%20Office%20Chikhali!5e0!3m2!1sen!2sin!4v1689871234567!5m2!1sen!2sin" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 3000,
            },
        });
    </script>
</body>
</html>