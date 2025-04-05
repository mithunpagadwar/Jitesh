<?php
/**
 * Template Name: शिकायत दर्ज करें
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container section-padding">
        <h1 class="page-title text-center mb-5">शिकायत दर्ज करें</h1>
        
        <!-- अलर्ट कंटेनर -->
        <div id="alert-container" class="mb-4" style="display: none;"></div>
        
        <!-- सफलता संदेश -->
        <div id="complaint-success" class="mb-4" style="display: none;"></div>
        
        <!-- शिकायत फॉर्म -->
        <div id="complaint-form-container" class="complaint-section">
            <form id="complaint-form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="complaint-name" class="form-label">नाम</label>
                            <input type="text" class="form-control" id="complaint-name" name="name" placeholder="अपना नाम दर्ज करें" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="complaint-mobile" class="form-label">मोबाइल नंबर</label>
                            <input type="tel" class="form-control" id="complaint-mobile" name="mobile" placeholder="मोबाइल नंबर दर्ज करें" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="complaint-text" class="form-label">शिकायत विवरण</label>
                    <textarea class="form-control" id="complaint-text" name="complaint_text" rows="5" placeholder="अपनी शिकायत का विस्तृत विवरण दें" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="complaint-photo" class="form-label">फोटो अपलोड करें (वैकल्पिक)</label>
                            <input type="file" class="form-control" id="complaint-photo" name="photo" accept="image/*">
                            <div id="photo-preview"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="complaint-document" class="form-label">दस्तावेज़ अपलोड करें (वैकल्पिक)</label>
                            <input type="file" class="form-control" id="complaint-document" name="document" accept=".pdf,.doc,.docx">
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" id="submit-complaint" class="btn btn-primary">शिकायत दर्ज करें</button>
                    <div id="complaint-loader" class="text-center mt-3" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- शिकायत स्थिति देखने का लिंक -->
        <div class="text-center mt-5">
            <p>पहले से दर्ज शिकायत की स्थिति जानने के लिए, <a href="<?php echo esc_url(home_url('/check-complaint')); ?>">यहां क्लिक करें</a></p>
        </div>
    </div>
</main>

<?php
get_footer();
