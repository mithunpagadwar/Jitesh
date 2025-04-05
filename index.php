<?php
/**
 * मुख्य टेम्पलेट फाइल
 */

get_header();

?>
<main id="primary" class="site-main">
    <?php if (is_front_page()) : ?>
        <?php if (get_theme_mod('enable_slider', true)) : ?>
        <!-- होम पेज स्लाइडर -->
        <div class="home-slider">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                    $slider_count = 0;
                    for ($i = 1; $i <= 10; $i++) {
                        $slide_image = get_theme_mod('slider_image_' . $i, '');
                        $slide_title = get_theme_mod('slider_title_' . $i, '');
                        
                        if (!empty($slide_image)) {
                            $slider_count++;
                            ?>
                            <div class="swiper-slide" style="background-image: url('<?php echo esc_url($slide_image); ?>');">
                                <?php if (!empty($slide_title)) : ?>
                                <div class="slide-content">
                                    <h2 class="slide-title"><?php echo esc_html($slide_title); ?></h2>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                    }
                    
                    // अगर कोई स्लाइड नहीं मिलता है तो डिफॉल्ट एक स्लाइड दिखाएं
                    if ($slider_count == 0) {
                        ?>
                        <div class="swiper-slide" style="background-color: #007bff;">
                            <div class="slide-content">
                                <h2 class="slide-title">ग्राम पंचायत चिखली में आपका स्वागत है</h2>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if (get_theme_mod('enable_notices', true)) : ?>
        <!-- नोटिस टिकर -->
        <div class="notice-ticker">
            <div class="ticker-container">
                <div class="ticker-content">
                    <?php
                    $notice_count = 0;
                    for ($i = 1; $i <= 5; $i++) {
                        $notice_text = get_theme_mod('notice_text_' . $i, '');
                        if (!empty($notice_text)) {
                            $notice_count++;
                            echo '<div class="ticker-item"><i class="fas fa-bullhorn"></i> ' . esc_html($notice_text) . '</div>';
                        }
                    }
                    
                    // अगर कोई नोटिस नहीं मिलता है तो डिफॉल्ट नोटिस दिखाएं
                    if ($notice_count == 0) {
                        echo '<div class="ticker-item"><i class="fas fa-bullhorn"></i> मासिक ग्रामसभा हर महीने की 15 तारीख को आयोजित की जाती है।</div>';
                        echo '<div class="ticker-item"><i class="fas fa-bullhorn"></i> टैक्स भुगतान के लिए ऑनलाइन सुविधा उपलब्ध है।</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- सेवाएं सेक्शन -->
        <section class="services-section section-padding">
            <div class="container">
                <h2 class="section-title">हमारी सेवाएं</h2>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <h3>टैक्स भुगतान</h3>
                            <p>ऑनलाइन घर टैक्स और पानी टैक्स का भुगतान करें।</p>
                            <a href="<?php echo esc_url(home_url('/housetax')); ?>" class="btn btn-primary mt-3">भुगतान करें</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <h3>शिकायत दर्ज करें</h3>
                            <p>अपनी शिकायत ऑनलाइन दर्ज करें और उसकी स्थिति ट्रैक करें।</p>
                            <a href="<?php echo esc_url(home_url('/complaint')); ?>" class="btn btn-primary mt-3">शिकायत दर्ज करें</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <h3>सरकारी योजनाएं</h3>
                            <p>विभिन्न सरकारी योजनाओं के बारे में जानकारी प्राप्त करें।</p>
                            <a href="<?php echo esc_url(home_url('/schemes')); ?>" class="btn btn-primary mt-3">और जानें</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- पंचायत समिति सेक्शन -->
        <section class="committee-section section-padding bg-light">
            <div class="container">
                <h2 class="section-title">पंचायत समिति</h2>
                <div class="row">
                    <?php
                    $member_count = 0;
                    for ($i = 1; $i <= 8; $i++) {
                        $member_name = get_theme_mod('committee_member_name_' . $i, '');
                        $member_position = get_theme_mod('committee_member_position_' . $i, '');
                        $member_photo = get_theme_mod('committee_member_photo_' . $i, '');
                        $member_mobile = get_theme_mod('committee_member_mobile_' . $i, '');
                        
                        if (!empty($member_name)) {
                            $member_count++;
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="member-card text-center">
                                    <div class="member-avatar">
                                        <?php if (!empty($member_photo)) : ?>
                                            <img src="<?php echo esc_url($member_photo); ?>" alt="<?php echo esc_attr($member_name); ?>">
                                        <?php else : ?>
                                            <svg width="150" height="150" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="75" cy="75" r="75" fill="#e9ecef"/>
                                                <circle cx="75" cy="60" r="30" fill="#adb5bd"/>
                                                <path d="M75,100 C45,100 35,120 35,135 L115,135 C115,120 105,100 75,100 Z" fill="#adb5bd"/>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <h4><?php echo esc_html($member_name); ?></h4>
                                    <?php if (!empty($member_position)) : ?>
                                        <p class="text-primary"><?php echo esc_html($member_position); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($member_mobile)) : ?>
                                        <p><i class="fas fa-phone"></i> <?php echo esc_html($member_mobile); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    
                    // अगर कोई सदस्य नहीं है तो संदेश दिखाएं
                    if ($member_count == 0) {
                        echo '<div class="col-12 text-center"><p>समिति सदस्यों की जानकारी जल्द ही अपडेट की जाएगी।</p></div>';
                    }
                    ?>
                </div>
            </div>
        </section>
        
        <!-- ग्राम पंचायत कमेटी सेक्शन -->
        <section class="gp-committee-section section-padding">
            <div class="container">
                <h2 class="section-title">ग्राम पंचायत कमेटी</h2>
                <div class="row">
                    <?php
                    $gp_member_count = 0;
                    for ($i = 1; $i <= 10; $i++) {
                        $member_name = get_theme_mod('gp_committee_member_name_' . $i, '');
                        $member_position = get_theme_mod('gp_committee_member_position_' . $i, '');
                        $member_photo = get_theme_mod('gp_committee_member_photo_' . $i, '');
                        $member_mobile = get_theme_mod('gp_committee_member_mobile_' . $i, '');
                        
                        if (!empty($member_name)) {
                            $gp_member_count++;
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="member-card text-center">
                                    <div class="member-avatar">
                                        <?php if (!empty($member_photo)) : ?>
                                            <img src="<?php echo esc_url($member_photo); ?>" alt="<?php echo esc_attr($member_name); ?>">
                                        <?php else : ?>
                                            <svg width="150" height="150" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="75" cy="75" r="75" fill="#e9ecef"/>
                                                <circle cx="75" cy="60" r="30" fill="#adb5bd"/>
                                                <path d="M75,100 C45,100 35,120 35,135 L115,135 C115,120 105,100 75,100 Z" fill="#adb5bd"/>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <h4><?php echo esc_html($member_name); ?></h4>
                                    <?php if (!empty($member_position)) : ?>
                                        <p class="text-primary"><?php echo esc_html($member_position); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($member_mobile)) : ?>
                                        <p><i class="fas fa-phone"></i> <?php echo esc_html($member_mobile); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    
                    // अगर कोई सदस्य नहीं है तो संदेश दिखाएं
                    if ($gp_member_count == 0) {
                        echo '<div class="col-12 text-center"><p>कमेटी सदस्यों की जानकारी जल्द ही अपडेट की जाएगी।</p></div>';
                    }
                    ?>
                </div>
            </div>
        </section>
        
        <!-- ग्राम पंचायत कर्मचारी सेक्शन -->
        <section class="employees-section section-padding bg-light">
            <div class="container">
                <h2 class="section-title">ग्राम पंचायत कर्मचारी</h2>
                <div class="row">
                    <?php
                    $employee_count = 0;
                    for ($i = 1; $i <= 9; $i++) {
                        $employee_name = get_theme_mod('employee_name_' . $i, '');
                        $employee_position = get_theme_mod('employee_position_' . $i, '');
                        $employee_photo = get_theme_mod('employee_photo_' . $i, '');
                        $employee_mobile = get_theme_mod('employee_mobile_' . $i, '');
                        
                        if (!empty($employee_name)) {
                            $employee_count++;
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="member-card text-center">
                                    <div class="member-avatar">
                                        <?php if (!empty($employee_photo)) : ?>
                                            <img src="<?php echo esc_url($employee_photo); ?>" alt="<?php echo esc_attr($employee_name); ?>">
                                        <?php else : ?>
                                            <svg width="150" height="150" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="75" cy="75" r="75" fill="#e9ecef"/>
                                                <circle cx="75" cy="60" r="30" fill="#adb5bd"/>
                                                <path d="M75,100 C45,100 35,120 35,135 L115,135 C115,120 105,100 75,100 Z" fill="#adb5bd"/>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <h4><?php echo esc_html($employee_name); ?></h4>
                                    <?php if (!empty($employee_position)) : ?>
                                        <p class="text-primary"><?php echo esc_html($employee_position); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($employee_mobile)) : ?>
                                        <p><i class="fas fa-phone"></i> <?php echo esc_html($employee_mobile); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    
                    // अगर कोई कर्मचारी नहीं है तो संदेश दिखाएं
                    if ($employee_count == 0) {
                        echo '<div class="col-12 text-center"><p>कर्मचारियों की जानकारी जल्द ही अपडेट की जाएगी।</p></div>';
                    }
                    ?>
                </div>
            </div>
        </section>
        
    <?php else : ?>
        <!-- पोस्ट या पेज कंटेंट दिखाएं -->
        <div class="container section-padding">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        </header>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                    <?php
                endwhile;
                
                the_posts_navigation();
            else :
                ?>
                <p><?php esc_html_e('कोई पोस्ट नहीं मिली।', 'grampanchayat'); ?></p>
                <?php
            endif;
            ?>
        </div>
    <?php endif; ?>
</main>

<?php
get_footer();
