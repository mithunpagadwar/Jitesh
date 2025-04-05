<?php
/**
 * Template Name: एडमिन लॉगिन
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container section-padding">
        <h1 class="page-title text-center mb-5">एडमिन लॉगिन</h1>
        
        <!-- अलर्ट कंटेनर -->
        <div id="alert-container" class="mb-4" style="display: none;"></div>
        
        <!-- लॉगइन फॉर्म -->
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="card-title text-center mb-4">ग्राम पंचायत एडमिन</h4>
                        <form id="admin-login-form">
                            <div class="mb-3">
                                <label for="username" class="form-label">यूजरनेम</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">पासवर्ड</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">लॉगिन</button>
                            </div>
                            <div id="login-loader" class="text-center mt-3" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p>यदि आप पासवर्ड भूल गए हैं, तो कृपया ग्राम सचिव से संपर्क करें।</p>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // एडमिन लॉगिन स्क्रिप्ट
    document.addEventListener('DOMContentLoaded', function() {
        const adminLoginForm = document.getElementById('admin-login-form');
        
        if (adminLoginForm) {
            adminLoginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                const loginLoader = document.getElementById('login-loader');
                
                if (!username || !password) {
                    showAlert('error', 'कृपया यूजरनेम और पासवर्ड दर्ज करें');
                    return;
                }
                
                loginLoader.style.display = 'block';
                
                // अजैक्स लॉगिन रिक्वेस्ट
                fetch(gp_ajax.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'admin_login',
                        nonce: gp_ajax.nonce,
                        username: username,
                        password: password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    loginLoader.style.display = 'none';
                    
                    if (data.success) {
                        // डैशबोर्ड पर रीडायरेक्ट करें
                        window.location.href = data.data.redirect_url;
                    } else {
                        showAlert('error', data.data.message || 'लॉगिन विफल, कृपया सही क्रेडेंशियल्स दर्ज करें');
                    }
                })
                .catch(error => {
                    loginLoader.style.display = 'none';
                    showAlert('error', 'लॉगिन प्रक्रिया में त्रुटि हुई। कृपया बाद में पुन: प्रयास करें।');
                    console.error('Login error:', error);
                });
            });
        }
        
        // अलर्ट फंक्शन
        function showAlert(type, message) {
            const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
            const alertContainer = document.getElementById('alert-container');
            
            alertContainer.innerHTML = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            alertContainer.style.display = 'block';
            
            // 5 सेकंड के बाद अलर्ट हटाएं
            setTimeout(() => {
                const alertElement = alertContainer.querySelector('.alert');
                if (alertElement) {
                    alertElement.classList.remove('show');
                    setTimeout(() => {
                        alertContainer.style.display = 'none';
                    }, 150);
                }
            }, 5000);
        }
    });
</script>

<?php
get_footer();
