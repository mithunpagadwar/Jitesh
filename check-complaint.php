<?php
session_start();
require_once 'functions.php';

$complaint = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complaint_id'])) {
    $complaint_id = sanitize_input($_POST['complaint_id']);
    $complaint = get_complaint_by_id($complaint_id);
    
    if (!$complaint) {
        $error = 'इस क्रमांक की कोई शिकायत नहीं मिली। कृपया सही क्रमांक डालें।';
    }
}
?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>शिकायत स्टेटस जांचें - ग्राम पंचायत चिखली</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card complaint-form">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">शिकायत स्टेटस जांचें</h2>
                        
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <?php if ($complaint): ?>
                            <div class="complaint-details mb-4">
                                <div class="alert alert-info">
                                    <h4>शिकायत विवरण</h4>
                                    <p><strong>शिकायत क्रमांक:</strong> <?php echo htmlspecialchars($complaint['id']); ?></p>
                                    <p><strong>नाम:</strong> <?php echo htmlspecialchars($complaint['name']); ?></p>
                                    <p><strong>दिनांक:</strong> <?php echo date('d-m-Y', strtotime($complaint['date'])); ?></p>
                                    <p><strong>स्थिति:</strong> 
                                        <?php if ($complaint['status'] === 'pending'): ?>
                                            <span class="badge bg-warning text-dark">लंबित</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">निपटा दिया गया</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                
                                <h5>शिकायत:</h5>
                                <p class="border p-3 rounded bg-light"><?php echo nl2br(htmlspecialchars($complaint['complaint'])); ?></p>
                                
                                <?php if (!empty($complaint['file'])): ?>
                                    <p><strong>अपलोड किया गया दस्तावेज:</strong> <a href="<?php echo htmlspecialchars($complaint['file']); ?>" target="_blank">दस्तावेज देखें</a></p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="text-center">
                                <a href="complaint.php" class="btn btn-primary">नई शिकायत दर्ज करें</a>
                                <a href="index.php" class="btn btn-outline-secondary ms-2">होम पेज पर जाएं</a>
                            </div>
                        <?php else: ?>
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="complaint_id" class="form-label">शिकायत क्रमांक</label>
                                    <input type="text" class="form-control" id="complaint_id" name="complaint_id" required>
                                    <small class="form-text text-muted">शिकायत दर्ज करते समय प्राप्त हुआ क्रमांक दर्ज करें</small>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">स्टेटस जांचें</button>
                            </form>
                            
                            <hr class="my-4">
                            
                            <p class="text-center">नई शिकायत दर्ज करनी है?</p>
                            <div class="text-center">
                                <a href="complaint.php" class="btn btn-outline-primary">नई शिकायत दर्ज करें</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
