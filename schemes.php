<?php session_start(); ?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>सरकारी योजनाएं - ग्राम पंचायत चिखली</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .scheme-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .scheme-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .scheme-image {
            height: 200px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }
        .scheme-content {
            padding: 15px;
        }
        .scheme-title {
            color: #000080;
            margin-bottom: 10px;
        }
        .scheme-description {
            color: #666;
            margin-bottom: 15px;
        }
        .scheme-link {
            color: #FF9933;
            text-decoration: none;
            font-weight: 500;
        }
        .scheme-link:hover {
            color: #138808;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Navigation -->
    <nav class="nav bg-dark py-2">
        <div class="container">
            <ul class="nav justify-content-center">
                <li class="nav-item"><a class="nav-link text-white" href="index.php">होम</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="schemes.php">योजनाएं</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="housetax.php">घर टैक्स</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="complaint.php">शिकायत</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="admin/login.php">प्रशासकीय लॉगिन</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-4">
        <h1 class="text-center mb-4">सरकारी योजनाएं</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="scheme-card">
                    <img src="attached_assets/pm-kisan.jpg" alt="PM किसान योजना" class="scheme-image w-100">
                    <div class="scheme-content">
                        <h3 class="scheme-title">प्रधानमंत्री किसान सम्मान निधि</h3>
                        <p class="scheme-description">किसानों को प्रति वर्ष ₹6,000 की वित्तीय सहायता</p>
                        <a href="https://pmkisan.gov.in/" target="_blank" class="scheme-link">
                            <i class="fas fa-external-link-alt"></i> अधिक जानकारी
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="scheme-card">
                    <img src="attached_assets/pmay.jpg" alt="PM आवास योजना" class="scheme-image w-100">
                    <div class="scheme-content">
                        <h3 class="scheme-title">प्रधानमंत्री आवास योजना</h3>
                        <p class="scheme-description">सभी के लिए आवास सुनिश्चित करने की योजना</p>
                        <a href="https://pmaymis.gov.in/" target="_blank" class="scheme-link">
                            <i class="fas fa-external-link-alt"></i> अधिक जानकारी
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="scheme-card">
                    <img src="attached_assets/mnrega.jpg" alt="मनरेगा" class="scheme-image w-100">
                    <div class="scheme-content">
                        <h3 class="scheme-title">मनरेगा</h3>
                        <p class="scheme-description">ग्रामीण रोजगार गारंटी योजना</p>
                        <a href="https://nrega.nic.in/" target="_blank" class="scheme-link">
                            <i class="fas fa-external-link-alt"></i> अधिक जानकारी
                        </a>
                    </div>
                </div>
            </div>

            <!-- अन्य योजनाएं यहाँ जोड़ें -->
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
