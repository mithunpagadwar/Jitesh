
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $complaint = $_POST['complaint'] ?? '';
    $complaint_id = time() . rand(1000, 9999);
    
    // Handle file upload
    $upload_dir = "uploads/complaints/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $file_path = '';
    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        $file_path = $upload_dir . $complaint_id . '_' . basename($_FILES['document']['name']);
        move_uploaded_file($_FILES['document']['tmp_name'], $file_path);
    }
    
    // Save complaint to file
    $complaint_data = [
        'id' => $complaint_id,
        'name' => $name,
        'mobile' => $mobile,
        'complaint' => $complaint,
        'file' => $file_path,
        'status' => 'pending',
        'date' => date('Y-m-d H:i:s')
    ];
    
    $complaints = [];
    if (file_exists('data/complaints.json')) {
        $complaints = json_decode(file_get_contents('data/complaints.json'), true);
    }
    $complaints[] = $complaint_data;
    file_put_contents('data/complaints.json', json_encode($complaints));
    
    // Send email
    $to = "gpchikhali66@gmail.com";
    $subject = "नई शिकायत - " . $complaint_id;
    $message = "नई शिकायत प्राप्त हुई है:\n\n";
    $message .= "शिकायत क्रमांक: " . $complaint_id . "\n";
    $message .= "नाम: " . $name . "\n";
    $message .= "मोबाइल: " . $mobile . "\n";
    $message .= "शिकायत: " . $complaint . "\n";
    
    mail($to, $subject, $message);
    
    header("Location: complaint.php?submitted=" . $complaint_id);
    exit();
}
?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>शिकायत दर्ज करें - ग्राम पंचायत चिखली</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container py-4">
        <?php if (isset($_GET['submitted'])): ?>
            <div class="alert alert-success">
                <h4>आपकी शिकायत सफलतापूर्वक दर्ज कर ली गई है</h4>
                <p>आपका शिकायत क्रमांक है: <strong><?php echo htmlspecialchars($_GET['submitted']); ?></strong></p>
                <p>कृपया इस क्रमांक को संभाल कर रखें। इससे आप अपनी शिकायत का स्टेटस जान सकते हैं।</p>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">शिकायत दर्ज करें</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">नाम</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">मोबाइल नंबर</label>
                            <input type="tel" class="form-control" name="mobile" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">शिकायत</label>
                            <textarea class="form-control" name="complaint" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">दस्तावेज अपलोड करें</label>
                            <input type="file" class="form-control" name="document">
                        </div>
                        <button type="submit" class="btn btn-primary">शिकायत दर्ज करें</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

