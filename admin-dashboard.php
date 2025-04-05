<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// UPI ID अपडेट लॉजिक
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upi_id'])) {
    $upi_id = $_POST['upi_id'];
    file_put_contents('../data/upi_id.txt', $upi_id);
    $success_message = 'UPI ID सफलतापूर्वक अपडेट की गई';
}

// वर्तमान UPI ID पढ़ें
$current_upi_id = file_exists('../data/upi_id.txt') ? file_get_contents('../data/upi_id.txt') : '';
?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>एडमिन डैशबोर्ड - ग्राम पंचायत चिखली</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .dashboard-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .link-list {
            list-style: none;
            padding: 0;
        }
        .link-list li {
            margin-bottom: 10px;
        }
        .link-list a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .link-list a:hover {
            background-color: #f8f9fa;
        }
        .link-list i {
            margin-right: 10px;
            color: #FF9933;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">एडमिन डैशबोर्ड</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php" target="_blank">
                            <i class="fas fa-home"></i> वेबसाइट देखें
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="fas fa-sign-out-alt"></i> लॉगआउट
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row">
            <!-- वेबसाइट लिंक्स -->
            <div class="col-md-8">
                <div class="dashboard-card">
                    <h3>महत्वपूर्ण वेबसाइट लिंक्स</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="link-list">
                                <li><a href="https://www.maharashtra.gov.in" target="_blank">महाराष्ट्र सरकार</a></li>
                                <li><a href="https://www.india.gov.in" target="_blank">भारत सरकार</a></li>
                                <li><a href="https://www.mygov.in" target="_blank">माय गव</a></li>
                                <li><a href="https://www.digital-india.gov.in" target="_blank">डिजिटल इंडिया</a></li>
                                <li><a href="https://www.pmkisan.gov.in" target="_blank">PM किसान</a></li>
                                <li><a href="https://mahabhulekh.maharashtra.gov.in" target="_blank">महाभूलेख</a></li>
                                <li><a href="https://www.maharashtra.gov.in/1125/Home" target="_blank">महाऑनलाइन</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="link-list">
                                <li><a href="https://aaple.maharashtra.gov.in" target="_blank">आपले सरकार</a></li>
                                <li><a href="https://www.mahapwd.com" target="_blank">सार्वजनिक बांधकाम विभाग</a></li>
                                <li><a href="https://www.mahaonline.gov.in" target="_blank">महाऑनलाइन सेवा</a></li>
                                <li><a href="https://www.nvsp.in" target="_blank">मतदाता पोर्टल</a></li>
                                <li><a href="https://www.uidai.gov.in" target="_blank">आधार</a></li>
                                <li><a href="https://www.swachhbharat.mygov.in" target="_blank">स्वच्छ भारत</a></li>
                                <li><a href="https://www.panchayat.gov.in" target="_blank">पंचायती राज</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- UPI सेटिंग्स -->
            <div class="col-md-4">
                <div class="dashboard-card">
                    <h3><i class="fas fa-money-bill"></i> UPI सेटिंग्स</h3>
                    <?php if (isset($success_message)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="upi_id" class="form-label">ग्राम पंचायत UPI ID</label>
                            <input type="text" class="form-control" id="upi_id" name="upi_id" value="<?php echo htmlspecialchars($current_upi_id); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">अपडेट करें</button>
                    </form>
                </div>

                <!-- शिकायत स्टेटिस्टिक्स -->
                <div class="dashboard-card">
                    <h3><i class="fas fa-chart-bar"></i> शिकायत स्टेटिस्टिक्स</h3>
                    <div class="d-flex justify-content-between mb-2">
                        <span>कुल शिकायतें:</span>
                        <span>0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>लंबित शिकायतें:</span>
                        <span>0</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>निपटाई गई शिकायतें:</span>
                        <span>0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
