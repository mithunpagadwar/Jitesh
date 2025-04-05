<?php 
//This file likely needs more code to handle complaint submission and email sending.  
if (isset($_GET['complaint_submitted'])): ?>
            <div class="complaint-success">
                <p>आपकी शिकायत सफलतापूर्वक दर्ज कर ली गई है। आपका शिकायत क्रमांक है: <strong><?php echo esc_html($_GET['complaint_submitted']); ?></strong></p>
                <p>कृपया इस क्रमांक को भविष्य के संदर्भ के लिए सहेज कर रखें। आप इस क्रमांक से अपनी शिकायत का स्टेटस जान सकते हैं।</p>
            </div>
<?php endif; ?>

<?php
// ... rest of the complaint form code ...

//This is a partial example of how the customizer setting might be used.  It needs to be integrated into the theme's customizer.php file appropriately.

$wp_customize->add_setting('upi_admin_password', array(
        'default'           => 'Chikhali@2024#Secure',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

// ...rest of the customizer settings and code...

?>
