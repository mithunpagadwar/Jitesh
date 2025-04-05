<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginId = $_POST['loginId'] ?? '';
    if(!empty($loginId)) {
        if(is_numeric($loginId) && (strlen($loginId) == 10 || strlen($loginId) <= 4)) {
            $_SESSION['resident_logged_in'] = true;
            $_SESSION['login_id'] = $loginId;
            header("Location: housetax.php");
            exit;
        } else {
            $error = 'कृपया सही क्रमांक या मोबाइल नंबर डालें';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>घर टैक्स/पानी टैक्स भुगतान - ग्राम पंचायत चिखली</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .header {
            background: #f8bb14;
            padding: 1rem 0;
            border-bottom: 3px solid #FF9933;
        }
        .tax-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
        }
        .resident-card {
            border: 1px solid #ddd;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .resident-info {
            display: flex;
            gap: 1rem;
            align-items: start;
        }
        .resident-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .resident-details {
            flex: 1;
        }
        .payment-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        .search-box {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .home-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #138808;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            z-index: 1000;
        }
        .home-button:hover {
            background: #0d6efd;
            color: white;
            text-decoration: none;
        }
        .logout-button {
            position: fixed;
            top: 20px;
            right: 140px;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            z-index: 1000;
        }
        .logout-button:hover {
            background: #bb2d3b;
            color: white;
        }
        .login-container {
            max-width: 400px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .alert {
            margin: 1rem 0;
        }
        .payment-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 1000;
            max-width: 90%;
            width: 400px;
        }
        .modal-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .resident-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }
        .resident-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .payment-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <?php 
    if(isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        echo "<script>window.location.href = 'housetax.php';</script>";
        exit;
    } 
    ?>

    <a href="index.php" class="home-button">
        <i class="fas fa-home"></i> होम
    </a>

    <?php if(isset($_SESSION['resident_logged_in'])): ?>
        <a href="?logout=1" class="logout-button">
            <i class="fas fa-sign-out-alt"></i> लॉगआउट
        </a>
    <?php endif; ?>

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

    <div class="tax-container">
        <?php if(!isset($_SESSION['resident_logged_in'])): ?>
            <div class="login-container">
                <h2 class="text-center mb-4">लॉगिन करें</h2>
                <form method="POST" action="" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="loginId" class="form-label">आपका क्रमांक या मोबाइल नंबर</label>
                        <input type="text" class="form-control" id="loginId" name="loginId" 
                               placeholder="उदाहरण: 9876543210 या 1234" required>
                        <div class="invalid-feedback">
                            कृपया सही क्रमांक या मोबाइल नंबर डालें
                        </div>
                    </div>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary w-100">लॉगिन करें</button>
                </form>
            </div>
        <?php else: ?>
            <div id="searchForm" class="search-box">
                <h2>घर टैक्स/पानी टैक्स भुगतान</h2>
                <div class="mb-3">
                    <label for="searchInput" class="form-label">नाम या क्रमांक से खोजें</label>
                    <input type="text" class="form-control" id="searchInput" 
                           placeholder="नाम या क्रमांक दर्ज करें...">
                </div>
            </div>

            <div id="searchResults"></div>
            <div id="paymentModal" class="payment-modal">
                <h3>भुगतान विवरण</h3>
                <div id="paymentDetails"></div>
                <button onclick="closePaymentModal()" class="btn btn-secondary mt-3">बंद करें</button>
            </div>
            <div id="modalBackdrop" class="modal-backdrop"></div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        if(document.getElementById('searchInput')) {
            document.getElementById('searchInput').addEventListener('input', searchResidents);
            searchResidents();
        }

        function searchResidents() {
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');
            const searchTerm = searchInput.value.toLowerCase().trim();

            // Example data - replace with your actual data
            const residents = [];
            // Generate 1200 residents
            for(let i = 1; i <= 1200; i++) {
                const ward = Math.floor(Math.random() * 10) + 1;
                const house = Math.floor(Math.random() * 999) + 1;
                const mobile = '98765' + String(i).padStart(5, '0');
                residents.push({
                    id: i,
                    name: `निवासी ${i}`,
                    address: `वार्ड ${ward}, मकान ${house}`,
                    mobile: mobile,
                    houseTax: 500,
                    waterTax: 300
                });
            }

            let results = residents;
            if(searchTerm) {
                results = residents.filter(resident => 
                    resident.name.toLowerCase().includes(searchTerm) || 
                    resident.id.toString().includes(searchTerm) ||
                    resident.mobile.includes(searchTerm)
                );
            }

            searchResults.innerHTML = results.map(resident => `
                <div class="resident-card">
                    <div class="resident-info">
                        <img src="https://i.pravatar.cc/100?img=${resident.id}" alt="${resident.name}" class="resident-photo">
                        <div class="resident-details">
                            <h4>${resident.name}</h4>
                            <p><strong>क्रमांक:</strong> ${resident.id}</p>
                            <p><strong>पता:</strong> ${resident.address}</p>
                            <p><strong>मोबाइल:</strong> ${resident.mobile}</p>
                        </div>
                    </div>
                    <div class="payment-buttons">
                        <button onclick="showPayment(${resident.id}, 'house')" class="btn btn-primary">
                            घर टैक्स भरें (₹500)
                        </button>
                        <button onclick="showPayment(${resident.id}, 'water')" class="btn btn-info text-white">
                            पानी टैक्स भरें (₹300)
                        </button>
                    </div>
                </div>
            `).join('');
        }
        let residents = [];
        // Generate 1200 residents
        for(let i = 1; i <= 1200; i++) {
            const ward = Math.floor(Math.random() * 10) + 1;
            const house = Math.floor(Math.random() * 999) + 1;
            const mobile = '98765' + String(i).padStart(5, '0');
            residents.push({
                id: i,
                name: `निवासी ${i}`,
                address: `वार्ड ${ward}, मकान ${house}`,
                mobile: mobile,
                houseTax: 500,
                waterTax: 300
            });
        }

        function showPayment(residentId, type) {
            const resident = residents.find(r => r.id === residentId);
            if (!resident) return;

            const modal = document.getElementById('paymentModal');
            const backdrop = document.getElementById('modalBackdrop');
            const details = document.getElementById('paymentDetails');

            const amount = type === 'house' ? resident.houseTax : resident.waterTax;
            const typeText = type === 'house' ? 'घर टैक्स' : 'पानी टैक्स';

            details.innerHTML = `
                <p><strong>निवासी:</strong> ${resident.name}</p>
                <p><strong>क्रमांक:</strong> ${resident.id}</p>
                <p><strong>मोबाइल:</strong> ${resident.mobile}</p>
                <p><strong>भुगतान प्रकार:</strong> ${typeText}</p>
                <p><strong>राशि:</strong> ₹${amount}</p>
                <button onclick="processPayment(${residentId}, '${type}')" class="btn btn-success w-100 mt-3">
                    भुगतान करें
                </button>
            `;

            modal.style.display = 'block';
            backdrop.style.display = 'block';
        }

        function closePaymentModal() {
            const modal = document.getElementById('paymentModal');
            const backdrop = document.getElementById('modalBackdrop');
            modal.style.display = 'none';
            backdrop.style.display = 'none';
        }

        function processPayment(residentId, type) {
            const resident = residents.find(r => r.id === residentId);
            if (!resident) return;

            const amount = type === 'house' ? resident.houseTax : resident.waterTax;
            const upiId = "grampanchayat.chikhali@upi";
            const paymentUrl = `upi://pay?pa=${upiId}&pn=Gram%20Panchayat%20Chikhali&am=${amount}&cu=INR&tn=${type === 'house' ? 'घर टैक्स' : 'पानी टैक्स'} - ${resident.name}`;
            
            // Open payment URL in new window
            window.open(paymentUrl, '_blank');
            closePaymentModal();
            
            // Fallback for desktop
            setTimeout(() => {
                if (confirm('UPI ऐप नहीं खुला? क्या आप UPI आईडी कॉपी करना चाहते हैं?')) {
                    const tempInput = document.createElement('input');
                    tempInput.value = upiId;
                    document.body.appendChild(tempInput);
                    tempInput.select();
                    document.execCommand('copy');
                    document.body.removeChild(tempInput);
                    alert('UPI आईडी कॉपी कर दी गई है: ' + upiId);
                }
            }, 1000);
        }
    </script>
</body>
</html>