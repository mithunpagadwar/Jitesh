<?php
/**
 * Template Name: शिकायत की स्थिति जांचें
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container section-padding">
        <h1 class="page-title text-center mb-5">शिकायत स्थिति जांचें</h1>
        
        <!-- अलर्ट कंटेनर -->
        <div id="alert-container" class="mb-4" style="display: none;"></div>
        
        <!-- शिकायत आईडी फॉर्म -->
        <div class="complaint-section">
            <form id="check-complaint-form">
                <div class="mb-3">
                    <label for="complaint-id" class="form-label">शिकायत क्रमांक</label>
                    <input type="text" class="form-control" id="complaint-id" placeholder="शिकायत क्रमांक दर्ज करें (उदा. COMP-20250404-1234)" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">जांचें</button>
                    <div id="complaint-check-loader" class="text-center mt-3" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- शिकायत परिणाम -->
        <div id="complaint-result" class="mt-5" style="display: none;"></div>
        
        <!-- नई शिकायत का लिंक -->
        <div class="text-center mt-5">
            <p>नई शिकायत दर्ज करने के लिए, <a href="<?php echo esc_url(home_url('/complaint')); ?>">यहां क्लिक करें</a></p>
        </div>
    </div>
</main>

<?php
get_footer();
