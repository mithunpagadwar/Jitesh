<?php
/**
 * Template Name: फोटो गैलरी
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container section-padding">
        <h1 class="page-title text-center mb-5">फोटो गैलरी</h1>
        
        <!-- गैलरी कैटेगरी टैब्स -->
        <ul class="nav nav-pills mb-5 justify-content-center" id="gallery-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="events-tab" data-bs-toggle="pill" data-bs-target="#events" type="button" role="tab" aria-controls="events" aria-selected="true">कार्यक्रम</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="development-tab" data-bs-toggle="pill" data-bs-target="#development" type="button" role="tab" aria-controls="development" aria-selected="false">विकास कार्य</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="meetings-tab" data-bs-toggle="pill" data-bs-target="#meetings" type="button" role="tab" aria-controls="meetings" aria-selected="false">ग्रामसभा</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="celebrations-tab" data-bs-toggle="pill" data-bs-target="#celebrations" type="button" role="tab" aria-controls="celebrations" aria-selected="false">उत्सव</button>
            </li>
        </ul>
        
        <!-- गैलरी कंटेंट -->
        <div class="tab-content" id="gallery-content">
            <!-- कार्यक्रम गैलरी -->
            <div class="tab-pane fade show active" id="events" role="tabpanel" aria-labelledby="events-tab">
                <div class="row">
                    <?php
                    // वर्डप्रेस के माध्यम से अपलोड की गई तस्वीरों के लिए एक गैलरी पोस्ट बनाए जाएंगी
                    // फिलहाल डमी डेटा
                    for ($i = 1; $i <= 8; $i++) {
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image-id="events-<?php echo $i; ?>">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>" class="card-img-top" alt="कार्यक्रम फोटो <?php echo $i; ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">कार्यक्रम फोटो <?php echo $i; ?></h5>
                                    <p class="card-text"><small class="text-muted">10 अप्रैल, 2025</small></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <!-- विकास कार्य गैलरी -->
            <div class="tab-pane fade" id="development" role="tabpanel" aria-labelledby="development-tab">
                <div class="row">
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image-id="development-<?php echo $i; ?>">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>" class="card-img-top" alt="विकास कार्य फोटो <?php echo $i; ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">विकास कार्य फोटो <?php echo $i; ?></h5>
                                    <p class="card-text"><small class="text-muted">15 मार्च, 2025</small></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <!-- ग्रामसभा गैलरी -->
            <div class="tab-pane fade" id="meetings" role="tabpanel" aria-labelledby="meetings-tab">
                <div class="row">
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image-id="meetings-<?php echo $i; ?>">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>" class="card-img-top" alt="ग्रामसभा फोटो <?php echo $i; ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">ग्रामसभा फोटो <?php echo $i; ?></h5>
                                    <p class="card-text"><small class="text-muted">20 फरवरी, 2025</small></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <!-- उत्सव गैलरी -->
            <div class="tab-pane fade" id="celebrations" role="tabpanel" aria-labelledby="celebrations-tab">
                <div class="row">
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image-id="celebrations-<?php echo $i; ?>">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>" class="card-img-top" alt="उत्सव फोटो <?php echo $i; ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">उत्सव फोटो <?php echo $i; ?></h5>
                                    <p class="card-text"><small class="text-muted">25 जनवरी, 2025</small></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- गैलरी मोडल -->
        <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalLabel">फोटो विवरण</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="" class="img-fluid" id="galleryModalImage" alt="फोटो विवरण">
                        <div class="mt-3">
                            <h5 id="galleryModalTitle"></h5>
                            <p id="galleryModalDate" class="text-muted"></p>
                            <p id="galleryModalDescription"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // गैलरी मोडल स्क्रिप्ट
    document.addEventListener('DOMContentLoaded', function() {
        const galleryModal = document.getElementById('galleryModal');
        if (galleryModal) {
            galleryModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const imageId = button.getAttribute('data-bs-image-id');
                
                // इमेज डेटा (एक बड़े प्रोजेक्ट में यह सर्वर से आएगा)
                const modalImage = document.getElementById('galleryModalImage');
                const modalTitle = document.getElementById('galleryModalTitle');
                const modalDate = document.getElementById('galleryModalDate');
                const modalDescription = document.getElementById('galleryModalDescription');
                
                // प्लेसहोल्डर इमेज और टेक्स्ट
                modalImage.src = button.querySelector('img').src;
                modalTitle.textContent = button.closest('.card').querySelector('.card-title').textContent;
                modalDate.textContent = button.closest('.card').querySelector('.text-muted').textContent;
                modalDescription.textContent = 'ग्राम पंचायत द्वारा आयोजित गतिविधि का विवरण यहां दिखाया जाएगा। यह विवरण वर्डप्रेस एडमिन द्वारा मैनेज किया जाएगा।';
            });
        }
    });
</script>

<?php
get_footer();
