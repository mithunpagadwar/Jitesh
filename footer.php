<?php
/**
 * फुटर टेम्पलेट
 */
?>

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="footer-widget">
                    <h4>ग्राम पंचायत चिखली</h4>
                    <p><?php echo get_theme_mod('contact_address', 'ग्राम पंचायत चिखली, तहसील - , जिला - '); ?></p>
                    <p><i class="fas fa-phone"></i> <?php echo get_theme_mod('contact_phone', '0123456789'); ?></p>
                    <p><i class="fas fa-envelope"></i> <?php echo get_theme_mod('contact_email', 'gpchikhali66@gmail.com'); ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-widget">
                    <h4>महत्वपूर्ण लिंक्स</h4>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'depth'          => 1,
                        'fallback_cb'    => function() {
                            echo '<ul>';
                            echo '<li><a href="' . esc_url(home_url('/')) . '">होम</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/schemes')) . '">सरकारी योजनाएं</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/housetax')) . '">टैक्स भुगतान</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/complaint')) . '">शिकायत दर्ज करें</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/gallery')) . '">गैलरी</a></li>';
                            echo '</ul>';
                        }
                    ));
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4>सूचना</h4>
                        <ul>
                            <li><i class="fas fa-arrow-right"></i> मासिक ग्रामसभा हर महीने की 15 तारीख को आयोजित की जाती है।</li>
                            <li><i class="fas fa-arrow-right"></i> टैक्स भुगतान के लिए ऑनलाइन सुविधा उपलब्ध है।</li>
                            <li><i class="fas fa-arrow-right"></i> अपनी शिकायतें ऑनलाइन दर्ज करें और उनकी स्थिति ट्रैक करें।</li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="copyright">
            <p>© <?php echo date('Y'); ?> ग्राम पंचायत चिखली। सर्वाधिकार सुरक्षित।</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
