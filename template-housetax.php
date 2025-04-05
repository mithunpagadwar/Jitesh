<?php
/**
 * Template Name: टैक्स भुगतान
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container section-padding">
        <h1 class="page-title text-center mb-5">घर और पानी टैक्स भुगतान</h1>
        
        <!-- अलर्ट कंटेनर -->
        <div id="alert-container" class="mb-4" style="display: none;"></div>
        
        <!-- टैक्स लुकअप फॉर्म -->
        <div class="tax-login-form">
            <h4 class="mb-4">अपना विवरण खोजें</h4>
            <form id="tax-lookup-form">
                <div class="mb-3">
                    <label for="mobile-number" class="form-label">मोबाइल नंबर</label>
                    <input type="tel" class="form-control" id="mobile-number" placeholder="मोबाइल नंबर दर्ज करें" required>
                </div>
                <button type="submit" class="btn btn-primary">खोजें</button>
                <div id="tax-form-loader" class="text-center mt-3" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- निवासी विवरण और भुगतान सेक्शन -->
        <div id="resident-details" class="mt-5" style="display: none;"></div>
        
        <!-- भुगतान रसीद मोडल -->
        <div class="modal fade" id="receipt-modal" tabindex="-1" aria-labelledby="receipt-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="receipt-modal-label">भुगतान रसीद</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="receipt-container"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">बंद करें</button>
                        <button type="button" class="btn btn-primary" id="print-receipt">प्रिंट करें</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
