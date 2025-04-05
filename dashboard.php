<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Data directory
if (!file_exists('../data')) {
    mkdir('../data', 0777, true);
}

// UPI ID update logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upi_id'])) {
    $upi_id = $_POST['upi_id'];
    file_put_contents('../data/upi_id.txt', $upi_id);
    $success_message = 'UPI ID सफलतापूर्वक अपडेट की गई';
}

// Read current UPI ID
$current_upi_id = file_exists('../data/upi_id.txt') ? file_get_contents('../data/upi_id.txt') : '';

// Complaint statistics
$complaints = [];
$complaints_pending = 0;
$complaints_resolved = 0;
if (file_exists('../data/complaints.json')) {
    $complaints = json_decode(file_get_contents('../data/complaints.json'), true) ?: [];
    foreach ($complaints as $complaint) {
        if ($complaint['status'] === 'pending') {
            $complaints_pending++;
        } else {
            $complaints_resolved++;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>एडमिन डैशबोर्ड - ग्राम पंचायत चिखली</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
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
            <!-- Complaints Section -->
            <div class="col-md-8 mb-4">
                <div class="dashboard-card">
                    <h3><i class="fas fa-exclamation-circle"></i> शिकायत प्रबंधन</h3>
                    <?php if (empty($complaints)): ?>
                        <div class="alert alert-info">अभी तक कोई शिकायत दर्ज नहीं की गई है।</div>
                    <?php else: ?>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card text-center bg-primary text-white">
                                    <div class="card-body">
                                        <h3><?php echo count($complaints); ?></h3>
                                        <p class="mb-0">कुल शिकायतें</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center bg-warning text-dark">
                                    <div class="card-body">
                                        <h3><?php echo $complaints_pending; ?></h3>
                                        <p class="mb-0">लंबित शिकायतें</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center bg-success text-white">
                                    <div class="card-body">
                                        <h3><?php echo $complaints_resolved; ?></h3>
                                        <p class="mb-0">निपटाई गई शिकायतें</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <h4>नवीनतम शिकायतें</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>क्रमांक</th>
                                        <th>नाम</th>
                                        <th>दिनांक</th>
                                        <th>स्थिति</th>
                                        <th>कार्रवाई</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $recent_complaints = array_slice(array_reverse($complaints), 0, 5);
                                    foreach ($recent_complaints as $complaint): 
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($complaint['id']); ?></td>
                                        <td><?php echo htmlspecialchars($complaint['name']); ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($complaint['date'])); ?></td>
                                        <td>
                                            <?php if ($complaint['status'] === 'pending'): ?>
                                                <span class="badge bg-warning text-dark">लंबित</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">निपटा दिया गया</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">देखें</button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Website Links -->
                <div class="dashboard-card mt-4">
                    <h3><i class="fas fa-link"></i> महत्वपूर्ण वेबसाइट लिंक्स</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="link-list">
                                <li><a href="https://www.maharashtra.gov.in" target="_blank"><i class="fas fa-external-link-alt"></i> महाराष्ट्र सरकार</a></li>
                                <li><a href="https://www.india.gov.in" target="_blank"><i class="fas fa-external-link-alt"></i> भारत सरकार</a></li>
                                <li><a href="https://www.mygov.in" target="_blank"><i class="fas fa-external-link-alt"></i> माय गव</a></li>
                                <li><a href="https://www.digital-india.gov.in" target="_blank"><i class="fas fa-external-link-alt"></i> डिजिटल इंडिया</a></li>
                                <li><a href="https://www.pmkisan.gov.in" target="_blank"><i class="fas fa-external-link-alt"></i> PM किसान</a></li>
                                <li><a href="https://mahabhulekh.maharashtra.gov.in" target="_blank"><i class="fas fa-external-link-alt"></i> महाभूलेख</a></li>
                                <li><a href="https://www.maharashtra.gov.in/1125/Home" target="_blank"><i class="fas fa-external-link-alt"></i> महाऑनलाइन</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="link-list">
                                <li><a href="https://aaple.maharashtra.gov.in" target="_blank"><i class="fas fa-external-link-alt"></i> आपले सरकार</a></li>
                                <li><a href="https://www.mahapwd.com" target="_blank"><i class="fas fa-external-link-alt"></i> सार्वजनिक बांधकाम विभाग</a></li>
                                <li><a href="https://www.mahaonline.gov.in" target="_blank"><i class="fas fa-external-link-alt"></i> महाऑनलाइन सेवा</a></li>
                                <li><a href="https://www.nvsp.in" target="_blank"><i class="fas fa-external-link-alt"></i> मतदाता पोर्टल</a></li>
                                <li><a href="https://www.uidai.gov.in" target="_blank"><i class="fas fa-external-link-alt"></i> आधार</a></li>
                                <li><a href="https://www.swachhbharat.mygov.in" target="_blank"><i class="fas fa-external-link-alt"></i> स्वच्छ भारत</a></li>
                                <li><a href="https://www.panchayat.gov.in" target="_blank"><i class="fas fa-external-link-alt"></i> पंचायती राज</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- UPI Settings -->
                <div class="dashboard-card">
                    <h3><i class="fas fa-money-bill"></i> UPI सेटिंग्स</h3>
                    <?php if (isset($success_message)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="upi_id" class="form-label">ग्राम पंचायत UPI ID</label>
                            <input type="text" class="form-control" id="upi_id" name="upi_id" value="<?php echo htmlspecialchars($current_upi_id); ?>" required>
                            <small class="form-text text-muted">यह UPI ID वेबसाइट पर सभी भुगतान अनुरोधों के लिए उपयोग की जाएगी।</small>
                        </div>
                        <button type="submit" class="btn btn-primary">अपडेट करें</button>
                    </form>
                </div>

                <!-- Website Statistics -->
                <div class="dashboard-card mt-4">
                    <h3><i class="fas fa-chart-line"></i> वेबसाइट आंकड़े</h3>
                    <div class="d-flex justify-content-between mb-2">
                        <span>कुल आगंतुक:</span>
                        <span>1,245</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>आज के आगंतुक:</span>
                        <span>42</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>टैक्स भुगतान:</span>
                        <span>28</span>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="dashboard-card mt-4">
                    <h3><i class="fas fa-bolt"></i> त्वरित कार्य</h3>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-upload text-primary me-2"></i> नई सूचना अपलोड करें
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-image text-success me-2"></i> फोटो गैलरी अपडेट करें
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-file-alt text-warning me-2"></i> योजनाएं अपडेट करें
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-user-cog text-danger me-2"></i> प्रशासकीय सेटिंग्स
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
