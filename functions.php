<?php
/**
 * ग्राम पंचायत चिखली थीम फंक्शंस
 */

if (!defined('ABSPATH')) {
    exit; // एक्सेस डायरेक्ट है?
}

/**
 * थीम सेटअप
 */
function grampanchayat_setup() {
    // थीम सपोर्ट जोड़ें
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    
    // मेनू रजिस्टर करें
    register_nav_menus(array(
        'primary' => esc_html__('प्राइमरी मेनू', 'grampanchayat'),
        'footer'  => esc_html__('फुटर मेनू', 'grampanchayat'),
    ));
    
    // थीम टेक्स्ट डोमेन लोड करें
    load_theme_textdomain('grampanchayat', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'grampanchayat_setup');

/**
 * स्क्रिप्ट और स्टाइल एनक्यू करें
 */
function grampanchayat_scripts() {
    // स्टाइल
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', array(), '5.2.3');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css', array(), '6.2.1');
    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css', array(), '8.0.0');
    wp_enqueue_style('grampanchayat-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // स्क्रिप्ट्स
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.2.3', true);
    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array(), '8.0.0', true);
    wp_enqueue_script('grampanchayat-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
    
    // Ajax सेटअप के लिए लोकलाइज़ेशन
    wp_localize_script('grampanchayat-main', 'gp_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('gp_ajax_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'grampanchayat_scripts');

/**
 * विजेट्स रजिस्टर करें
 */
function grampanchayat_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('साइडबार', 'grampanchayat'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('साइडबार विजेट क्षेत्र', 'grampanchayat'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('फुटर 1', 'grampanchayat'),
        'id'            => 'footer-1',
        'description'   => esc_html__('फुटर विजेट क्षेत्र 1', 'grampanchayat'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('फुटर 2', 'grampanchayat'),
        'id'            => 'footer-2',
        'description'   => esc_html__('फुटर विजेट क्षेत्र 2', 'grampanchayat'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('फुटर 3', 'grampanchayat'),
        'id'            => 'footer-3',
        'description'   => esc_html__('फुटर विजेट क्षेत्र 3', 'grampanchayat'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'grampanchayat_widgets_init');

/**
 * WordPress कस्टमाइज़र के माध्यम से थीम विकल्प सेट करें
 */
function grampanchayat_customize_register($wp_customize) {
    // होम पेज सेक्शन
    $wp_customize->add_section('grampanchayat_home_section', array(
        'title'    => __('होम पेज सेटिंग्स', 'grampanchayat'),
        'priority' => 130,
    ));
    
    // स्लाइडर सेटिंग्स
    $wp_customize->add_setting('enable_slider', array(
        'default'           => true,
        'sanitize_callback' => 'grampanchayat_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('enable_slider', array(
        'label'    => __('स्लाइडर दिखाएं', 'grampanchayat'),
        'section'  => 'grampanchayat_home_section',
        'type'     => 'checkbox',
    ));
    
    // स्लाइडर के लिए 10 स्लाइड जोड़ें
    for ($i = 1; $i <= 10; $i++) {
        // स्लाइड इमेज
        $wp_customize->add_setting('slider_image_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'slider_image_' . $i, array(
            'label'    => __('स्लाइड #' . $i . ' इमेज', 'grampanchayat'),
            'section'  => 'grampanchayat_home_section',
            'settings' => 'slider_image_' . $i,
        )));
        
        // स्लाइड टाइटल
        $wp_customize->add_setting('slider_title_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('slider_title_' . $i, array(
            'label'    => __('स्लाइड #' . $i . ' शीर्षक', 'grampanchayat'),
            'section'  => 'grampanchayat_home_section',
            'type'     => 'text',
        ));
    }
    
    // नोटिस टिकर सेटिंग्स
    $wp_customize->add_setting('enable_notices', array(
        'default'           => true,
        'sanitize_callback' => 'grampanchayat_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('enable_notices', array(
        'label'    => __('नोटिस टिकर दिखाएँ', 'grampanchayat'),
        'section'  => 'grampanchayat_home_section',
        'type'     => 'checkbox',
    ));
    
    // 5 नोटिस्स जोड़ें
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting('notice_text_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('notice_text_' . $i, array(
            'label'    => __('नोटिस #' . $i . ' टेक्स्ट', 'grampanchayat'),
            'section'  => 'grampanchayat_home_section',
            'type'     => 'text',
        ));
    }
    
    // समिति सदस्य सेक्शन के लिए सेटिंग्स
    $wp_customize->add_section('grampanchayat_committee_section', array(
        'title'    => __('समिति सदस्य', 'grampanchayat'),
        'priority' => 131,
    ));
    
    // पंचायत समिति (8 सदस्य)
    for ($i = 1; $i <= 8; $i++) {
        // सदस्य का नाम
        $wp_customize->add_setting('committee_member_name_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('committee_member_name_' . $i, array(
            'label'    => __('पंचायत समिति सदस्य #' . $i . ' नाम', 'grampanchayat'),
            'section'  => 'grampanchayat_committee_section',
            'type'     => 'text',
        ));
        
        // सदस्य का पद
        $wp_customize->add_setting('committee_member_position_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('committee_member_position_' . $i, array(
            'label'    => __('पंचायत समिति सदस्य #' . $i . ' पद', 'grampanchayat'),
            'section'  => 'grampanchayat_committee_section',
            'type'     => 'text',
        ));
        
        // सदस्य का फोटो
        $wp_customize->add_setting('committee_member_photo_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'committee_member_photo_' . $i, array(
            'label'    => __('पंचायत समिति सदस्य #' . $i . ' फोटो', 'grampanchayat'),
            'section'  => 'grampanchayat_committee_section',
            'settings' => 'committee_member_photo_' . $i,
        )));
        
        // सदस्य का मोबाइल नंबर
        $wp_customize->add_setting('committee_member_mobile_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('committee_member_mobile_' . $i, array(
            'label'    => __('पंचायत समिति सदस्य #' . $i . ' मोबाइल', 'grampanchayat'),
            'section'  => 'grampanchayat_committee_section',
            'type'     => 'text',
        ));
    }
    
    // ग्राम पंचायत कमेटी (10 सदस्य)
    $wp_customize->add_section('grampanchayat_gp_committee_section', array(
        'title'    => __('ग्राम पंचायत कमेटी', 'grampanchayat'),
        'priority' => 132,
    ));
    
    for ($i = 1; $i <= 10; $i++) {
        // सदस्य का नाम
        $wp_customize->add_setting('gp_committee_member_name_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('gp_committee_member_name_' . $i, array(
            'label'    => __('ग्राम पंचायत कमेटी सदस्य #' . $i . ' नाम', 'grampanchayat'),
            'section'  => 'grampanchayat_gp_committee_section',
            'type'     => 'text',
        ));
        
        // सदस्य का पद
        $wp_customize->add_setting('gp_committee_member_position_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('gp_committee_member_position_' . $i, array(
            'label'    => __('ग्राम पंचायत कमेटी सदस्य #' . $i . ' पद', 'grampanchayat'),
            'section'  => 'grampanchayat_gp_committee_section',
            'type'     => 'text',
        ));
        
        // सदस्य का फोटो
        $wp_customize->add_setting('gp_committee_member_photo_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gp_committee_member_photo_' . $i, array(
            'label'    => __('ग्राम पंचायत कमेटी सदस्य #' . $i . ' फोटो', 'grampanchayat'),
            'section'  => 'grampanchayat_gp_committee_section',
            'settings' => 'gp_committee_member_photo_' . $i,
        )));
        
        // सदस्य का मोबाइल नंबर
        $wp_customize->add_setting('gp_committee_member_mobile_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('gp_committee_member_mobile_' . $i, array(
            'label'    => __('ग्राम पंचायत कमेटी सदस्य #' . $i . ' मोबाइल', 'grampanchayat'),
            'section'  => 'grampanchayat_gp_committee_section',
            'type'     => 'text',
        ));
    }
    
    // ग्राम पंचायत कर्मचारी (9 कर्मचारी)
    $wp_customize->add_section('grampanchayat_employees_section', array(
        'title'    => __('ग्राम पंचायत कर्मचारी', 'grampanchayat'),
        'priority' => 133,
    ));
    
    for ($i = 1; $i <= 9; $i++) {
        // कर्मचारी का नाम
        $wp_customize->add_setting('employee_name_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('employee_name_' . $i, array(
            'label'    => __('कर्मचारी #' . $i . ' नाम', 'grampanchayat'),
            'section'  => 'grampanchayat_employees_section',
            'type'     => 'text',
        ));
        
        // कर्मचारी का पद
        $wp_customize->add_setting('employee_position_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('employee_position_' . $i, array(
            'label'    => __('कर्मचारी #' . $i . ' पद', 'grampanchayat'),
            'section'  => 'grampanchayat_employees_section',
            'type'     => 'text',
        ));
        
        // कर्मचारी का फोटो
        $wp_customize->add_setting('employee_photo_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'employee_photo_' . $i, array(
            'label'    => __('कर्मचारी #' . $i . ' फोटो', 'grampanchayat'),
            'section'  => 'grampanchayat_employees_section',
            'settings' => 'employee_photo_' . $i,
        )));
        
        // कर्मचारी का मोबाइल नंबर
        $wp_customize->add_setting('employee_mobile_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('employee_mobile_' . $i, array(
            'label'    => __('कर्मचारी #' . $i . ' मोबाइल', 'grampanchayat'),
            'section'  => 'grampanchayat_employees_section',
            'type'     => 'text',
        ));
    }
    
    // UPI सेटिंग्स
    $wp_customize->add_section('grampanchayat_payment_section', array(
        'title'    => __('भुगतान सेटिंग्स', 'grampanchayat'),
        'priority' => 134,
    ));
    
    $wp_customize->add_setting('house_tax_upi_id', array(
        'default'           => 'gpchikhali66@ybl',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('house_tax_upi_id', array(
        'label'    => __('घर टैक्स UPI ID', 'grampanchayat'),
        'section'  => 'grampanchayat_payment_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('water_tax_upi_id', array(
        'default'           => 'gpchikhali66@paytm',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('water_tax_upi_id', array(
        'label'    => __('पानी टैक्स UPI ID', 'grampanchayat'),
        'section'  => 'grampanchayat_payment_section',
        'type'     => 'text',
    ));
    
    // शिकायत सेटिंग्स
    $wp_customize->add_section('grampanchayat_complaint_section', array(
        'title'    => __('शिकायत सेटिंग्स', 'grampanchayat'),
        'priority' => 135,
    ));
    
    $wp_customize->add_setting('complaint_email', array(
        'default'           => 'gpchikhali66@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('complaint_email', array(
        'label'    => __('शिकायत ईमेल', 'grampanchayat'),
        'section'  => 'grampanchayat_complaint_section',
        'type'     => 'email',
    ));
    
    // संपर्क सेटिंग्स
    $wp_customize->add_section('grampanchayat_contact_section', array(
        'title'    => __('संपर्क सेटिंग्स', 'grampanchayat'),
        'priority' => 136,
    ));
    
    $wp_customize->add_setting('contact_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label'    => __('पंचायत का पता', 'grampanchayat'),
        'section'  => 'grampanchayat_contact_section',
        'type'     => 'textarea',
    ));
    
    $wp_customize->add_setting('contact_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label'    => __('फोन नंबर', 'grampanchayat'),
        'section'  => 'grampanchayat_contact_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('contact_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label'    => __('ईमेल', 'grampanchayat'),
        'section'  => 'grampanchayat_contact_section',
        'type'     => 'email',
    ));
}
add_action('customize_register', 'grampanchayat_customize_register');

/**
 * सैनिटाइज़ कॉलबैक्स
 */
function grampanchayat_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * कस्टम पोस्ट टाइप्स रजिस्टर करें
 */
function grampanchayat_register_post_types() {
    // शिकायत पोस्ट टाइप
    register_post_type('complaint', array(
        'labels' => array(
            'name'               => __('शिकायतें', 'grampanchayat'),
            'singular_name'      => __('शिकायत', 'grampanchayat'),
            'add_new'            => __('नई शिकायत जोड़ें', 'grampanchayat'),
            'add_new_item'       => __('नई शिकायत जोड़ें', 'grampanchayat'),
            'edit_item'          => __('शिकायत संपादित करें', 'grampanchayat'),
            'new_item'           => __('नई शिकायत', 'grampanchayat'),
            'view_item'          => __('शिकायत देखें', 'grampanchayat'),
            'search_items'       => __('शिकायतें खोजें', 'grampanchayat'),
            'not_found'          => __('कोई शिकायत नहीं मिली', 'grampanchayat'),
            'not_found_in_trash' => __('ट्रैश में कोई शिकायत नहीं मिली', 'grampanchayat'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'complaints'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-megaphone',
        'supports'            => array('title', 'editor', 'author', 'thumbnail', 'custom-fields'),
    ));
    
    // निवासी पोस्ट टाइप
    register_post_type('resident', array(
        'labels' => array(
            'name'               => __('निवासी', 'grampanchayat'),
            'singular_name'      => __('निवासी', 'grampanchayat'),
            'add_new'            => __('नया निवासी जोड़ें', 'grampanchayat'),
            'add_new_item'       => __('नया निवासी जोड़ें', 'grampanchayat'),
            'edit_item'          => __('निवासी संपादित करें', 'grampanchayat'),
            'new_item'           => __('नया निवासी', 'grampanchayat'),
            'view_item'          => __('निवासी देखें', 'grampanchayat'),
            'search_items'       => __('निवासी खोजें', 'grampanchayat'),
            'not_found'          => __('कोई निवासी नहीं मिला', 'grampanchayat'),
            'not_found_in_trash' => __('ट्रैश में कोई निवासी नहीं मिला', 'grampanchayat'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'residents'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-groups',
        'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields'),
    ));
    
    // भुगतान पोस्ट टाइप
    register_post_type('payment', array(
        'labels' => array(
            'name'               => __('भुगतान', 'grampanchayat'),
            'singular_name'      => __('भुगतान', 'grampanchayat'),
            'add_new'            => __('नया भुगतान जोड़ें', 'grampanchayat'),
            'add_new_item'       => __('नया भुगतान जोड़ें', 'grampanchayat'),
            'edit_item'          => __('भुगतान संपादित करें', 'grampanchayat'),
            'new_item'           => __('नया भुगतान', 'grampanchayat'),
            'view_item'          => __('भुगतान देखें', 'grampanchayat'),
            'search_items'       => __('भुगतान खोजें', 'grampanchayat'),
            'not_found'          => __('कोई भुगतान नहीं मिला', 'grampanchayat'),
            'not_found_in_trash' => __('ट्रैश में कोई भुगतान नहीं मिला', 'grampanchayat'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'payments'),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 7,
        'menu_icon'           => 'dashicons-money-alt',
        'supports'            => array('title', 'editor', 'custom-fields'),
    ));
}
add_action('init', 'grampanchayat_register_post_types');

/**
 * कस्टम मेटा बॉक्स जोड़ें
 */
function grampanchayat_add_meta_boxes() {
    // निवासी मेटा बॉक्स
    add_meta_box(
        'resident_details',
        __('निवासी विवरण', 'grampanchayat'),
        'grampanchayat_resident_details_callback',
        'resident',
        'normal',
        'high'
    );
    
    // भुगतान मेटा बॉक्स
    add_meta_box(
        'payment_details',
        __('भुगतान विवरण', 'grampanchayat'),
        'grampanchayat_payment_details_callback',
        'payment',
        'normal',
        'high'
    );
    
    // शिकायत मेटा बॉक्स
    add_meta_box(
        'complaint_details',
        __('शिकायत विवरण', 'grampanchayat'),
        'grampanchayat_complaint_details_callback',
        'complaint',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'grampanchayat_add_meta_boxes');

/**
 * निवासी मेटा बॉक्स कॉलबैक
 */
function grampanchayat_resident_details_callback($post) {
    wp_nonce_field('resident_details_save', 'resident_details_nonce');
    
    // निवासी मेटा फील्ड्स प्राप्त करें
    $address = get_post_meta($post->ID, '_resident_address', true);
    $mobile = get_post_meta($post->ID, '_resident_mobile', true);
    $house_tax = get_post_meta($post->ID, '_resident_house_tax', true);
    $water_tax = get_post_meta($post->ID, '_resident_water_tax', true);
    ?>
    <p>
        <label for="resident_address"><?php _e('पता:', 'grampanchayat'); ?></label><br>
        <textarea id="resident_address" name="resident_address" class="widefat" rows="3"><?php echo esc_textarea($address); ?></textarea>
    </p>
    <p>
        <label for="resident_mobile"><?php _e('मोबाइल नंबर:', 'grampanchayat'); ?></label><br>
        <input type="text" id="resident_mobile" name="resident_mobile" value="<?php echo esc_attr($mobile); ?>" class="widefat">
    </p>
    <p>
        <label for="resident_house_tax"><?php _e('घर टैक्स (₹):', 'grampanchayat'); ?></label><br>
        <input type="number" id="resident_house_tax" name="resident_house_tax" value="<?php echo esc_attr($house_tax); ?>" class="widefat" step="0.01" min="0">
    </p>
    <p>
        <label for="resident_water_tax"><?php _e('पानी टैक्स (₹):', 'grampanchayat'); ?></label><br>
        <input type="number" id="resident_water_tax" name="resident_water_tax" value="<?php echo esc_attr($water_tax); ?>" class="widefat" step="0.01" min="0">
    </p>
    <?php
}

/**
 * भुगतान मेटा बॉक्स कॉलबैक
 */
function grampanchayat_payment_details_callback($post) {
    wp_nonce_field('payment_details_save', 'payment_details_nonce');
    
    // भुगतान मेटा फील्ड्स प्राप्त करें
    $resident_id = get_post_meta($post->ID, '_payment_resident_id', true);
    $amount = get_post_meta($post->ID, '_payment_amount', true);
    $tax_type = get_post_meta($post->ID, '_payment_tax_type', true);
    $receipt_number = get_post_meta($post->ID, '_payment_receipt_number', true);
    $payment_date = get_post_meta($post->ID, '_payment_date', true);
    
    // सभी निवासियों को प्राप्त करें
    $residents = get_posts(array(
        'post_type' => 'resident',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));
    ?>
    <p>
        <label for="payment_resident_id"><?php _e('निवासी:', 'grampanchayat'); ?></label><br>
        <select id="payment_resident_id" name="payment_resident_id" class="widefat">
            <option value=""><?php _e('-- निवासी चुनें --', 'grampanchayat'); ?></option>
            <?php foreach ($residents as $resident) : ?>
                <option value="<?php echo esc_attr($resident->ID); ?>" <?php selected($resident_id, $resident->ID); ?>>
                    <?php echo esc_html($resident->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label for="payment_amount"><?php _e('राशि (₹):', 'grampanchayat'); ?></label><br>
        <input type="number" id="payment_amount" name="payment_amount" value="<?php echo esc_attr($amount); ?>" class="widefat" step="0.01" min="0">
    </p>
    <p>
        <label><?php _e('टैक्स प्रकार:', 'grampanchayat'); ?></label><br>
        <label>
            <input type="radio" name="payment_tax_type" value="house" <?php checked($tax_type, 'house'); ?>>
            <?php _e('घर टैक्स', 'grampanchayat'); ?>
        </label>
        <label style="margin-left: 20px;">
            <input type="radio" name="payment_tax_type" value="water" <?php checked($tax_type, 'water'); ?>>
            <?php _e('पानी टैक्स', 'grampanchayat'); ?>
        </label>
    </p>
    <p>
        <label for="payment_receipt_number"><?php _e('रसीद नंबर:', 'grampanchayat'); ?></label><br>
        <input type="text" id="payment_receipt_number" name="payment_receipt_number" value="<?php echo esc_attr($receipt_number); ?>" class="widefat">
    </p>
    <p>
        <label for="payment_date"><?php _e('भुगतान तिथि:', 'grampanchayat'); ?></label><br>
        <input type="date" id="payment_date" name="payment_date" value="<?php echo esc_attr($payment_date); ?>" class="widefat">
    </p>
    <?php
}

/**
 * शिकायत मेटा बॉक्स कॉलबैक
 */
function grampanchayat_complaint_details_callback($post) {
    wp_nonce_field('complaint_details_save', 'complaint_details_nonce');
    
    // शिकायत मेटा फील्ड्स प्राप्त करें
    $name = get_post_meta($post->ID, '_complaint_name', true);
    $mobile = get_post_meta($post->ID, '_complaint_mobile', true);
    $status = get_post_meta($post->ID, '_complaint_status', true);
    $document = get_post_meta($post->ID, '_complaint_document', true);
    $photo = get_post_meta($post->ID, '_complaint_photo', true);
    ?>
    <p>
        <label for="complaint_name"><?php _e('नाम:', 'grampanchayat'); ?></label><br>
        <input type="text" id="complaint_name" name="complaint_name" value="<?php echo esc_attr($name); ?>" class="widefat">
    </p>
    <p>
        <label for="complaint_mobile"><?php _e('मोबाइल नंबर:', 'grampanchayat'); ?></label><br>
        <input type="text" id="complaint_mobile" name="complaint_mobile" value="<?php echo esc_attr($mobile); ?>" class="widefat">
    </p>
    <p>
        <label><?php _e('स्थिति:', 'grampanchayat'); ?></label><br>
        <label>
            <input type="radio" name="complaint_status" value="pending" <?php checked($status, 'pending'); ?>>
            <?php _e('लंबित', 'grampanchayat'); ?>
        </label>
        <label style="margin-left: 20px;">
            <input type="radio" name="complaint_status" value="resolved" <?php checked($status, 'resolved'); ?>>
            <?php _e('समाधान', 'grampanchayat'); ?>
        </label>
    </p>
    <?php if ($document) : ?>
    <p>
        <label><?php _e('दस्तावेज़:', 'grampanchayat'); ?></label><br>
        <a href="<?php echo esc_url($document); ?>" target="_blank">
            <?php _e('दस्तावेज़ देखें', 'grampanchayat'); ?>
        </a>
    </p>
    <?php endif; ?>
    <?php if ($photo) : ?>
    <p>
        <label><?php _e('फोटो:', 'grampanchayat'); ?></label><br>
        <img src="<?php echo esc_url($photo); ?>" style="max-width: 200px; max-height: 200px;">
    </p>
    <?php endif; ?>
    <?php
}

/**
 * मेटा बॉक्स सेव करें
 */
function grampanchayat_save_meta_boxes($post_id) {
    // ऑटोसेव चेक
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // निवासी मेटा बॉक्स
    if (isset($_POST['resident_details_nonce']) && wp_verify_nonce($_POST['resident_details_nonce'], 'resident_details_save')) {
        if (isset($_POST['resident_address'])) {
            update_post_meta($post_id, '_resident_address', sanitize_textarea_field($_POST['resident_address']));
        }
        if (isset($_POST['resident_mobile'])) {
            update_post_meta($post_id, '_resident_mobile', sanitize_text_field($_POST['resident_mobile']));
        }
        if (isset($_POST['resident_house_tax'])) {
            update_post_meta($post_id, '_resident_house_tax', (float) $_POST['resident_house_tax']);
        }
        if (isset($_POST['resident_water_tax'])) {
            update_post_meta($post_id, '_resident_water_tax', (float) $_POST['resident_water_tax']);
        }
    }
    
    // भुगतान मेटा बॉक्स
    if (isset($_POST['payment_details_nonce']) && wp_verify_nonce($_POST['payment_details_nonce'], 'payment_details_save')) {
        if (isset($_POST['payment_resident_id'])) {
            update_post_meta($post_id, '_payment_resident_id', sanitize_text_field($_POST['payment_resident_id']));
        }
        if (isset($_POST['payment_amount'])) {
            update_post_meta($post_id, '_payment_amount', (float) $_POST['payment_amount']);
        }
        if (isset($_POST['payment_tax_type'])) {
            update_post_meta($post_id, '_payment_tax_type', sanitize_text_field($_POST['payment_tax_type']));
        }
        if (isset($_POST['payment_receipt_number'])) {
            update_post_meta($post_id, '_payment_receipt_number', sanitize_text_field($_POST['payment_receipt_number']));
        }
        if (isset($_POST['payment_date'])) {
            update_post_meta($post_id, '_payment_date', sanitize_text_field($_POST['payment_date']));
        }
    }
    
    // शिकायत मेटा बॉक्स
    if (isset($_POST['complaint_details_nonce']) && wp_verify_nonce($_POST['complaint_details_nonce'], 'complaint_details_save')) {
        if (isset($_POST['complaint_name'])) {
            update_post_meta($post_id, '_complaint_name', sanitize_text_field($_POST['complaint_name']));
        }
        if (isset($_POST['complaint_mobile'])) {
            update_post_meta($post_id, '_complaint_mobile', sanitize_text_field($_POST['complaint_mobile']));
        }
        if (isset($_POST['complaint_status'])) {
            update_post_meta($post_id, '_complaint_status', sanitize_text_field($_POST['complaint_status']));
        }
    }
}
add_action('save_post', 'grampanchayat_save_meta_boxes');

/**
 * QR कोड जनरेशन फंक्शन
 */
function grampanchayat_generate_qr_code_svg($upi_id, $amount, $resident_id, $tax_type) {
    // टैक्स टाइप के आधार पर अलग-अलग बैकग्राउंड कलर
    $bg_color = ($tax_type == 'house') ? "#4CAF50" : "#2196F3";
    $tax_display = ($tax_type == 'house') ? 'घर टैक्स' : 'पाणी टैक्स';
    
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200">
        <rect width="200" height="200" fill="white" stroke="' . $bg_color . '" stroke-width="4"/>
        <rect x="10" y="10" width="180" height="30" fill="' . $bg_color . '"/>
        <text x="100" y="30" font-family="Arial" font-size="14" font-weight="bold" text-anchor="middle" fill="white">' . $tax_display . ' QR Code</text>
        <text x="100" y="70" font-family="Arial" font-size="12" text-anchor="middle" font-weight="bold">UPI ID:</text>
        <text x="100" y="90" font-family="Arial" font-size="12" text-anchor="middle">' . $upi_id . '</text>
        <text x="100" y="110" font-family="Arial" font-size="14" text-anchor="middle" font-weight="bold">₹' . $amount . '</text>
        <text x="100" y="140" font-family="Arial" font-size="10" text-anchor="middle">निवासी क्रमांक: ' . $resident_id . '</text>
        <text x="100" y="160" font-family="Arial" font-size="10" text-anchor="middle" font-weight="bold">' . $tax_display . '</text>
        <text x="100" y="180" font-family="Arial" font-size="8" text-anchor="middle">ग्राम पंचायत चिखली</text>
    </svg>';
    
    return 'data:image/svg+xml;base64,' . base64_encode($svg);
}

/**
 * Ajax QR कोड जनरेट करें
 */
function grampanchayat_generate_qr_ajax() {
    check_ajax_referer('gp_ajax_nonce', 'nonce');
    
    $upi_id = isset($_POST['upi_id']) ? sanitize_text_field($_POST['upi_id']) : '';
    $amount = isset($_POST['amount']) ? (float) $_POST['amount'] : 0;
    $resident_id = isset($_POST['resident_id']) ? sanitize_text_field($_POST['resident_id']) : '';
    $tax_type = isset($_POST['tax_type']) ? sanitize_text_field($_POST['tax_type']) : 'house';
    
    $svg_data = grampanchayat_generate_qr_code_svg($upi_id, $amount, $resident_id, $tax_type);
    
    wp_send_json_success(array('svg' => $svg_data));
}
add_action('wp_ajax_generate_qr', 'grampanchayat_generate_qr_ajax');
add_action('wp_ajax_nopriv_generate_qr', 'grampanchayat_generate_qr_ajax');

/**
 * पेमेंट रसीद जनरेट करें
 */
function grampanchayat_generate_receipt_ajax() {
    check_ajax_referer('gp_ajax_nonce', 'nonce');
    
    $resident_id = isset($_POST['resident_id']) ? sanitize_text_field($_POST['resident_id']) : '';
    $resident_name = isset($_POST['resident_name']) ? sanitize_text_field($_POST['resident_name']) : '';
    $address = isset($_POST['address']) ? sanitize_text_field($_POST['address']) : '';
    $tax_type = isset($_POST['tax_type']) ? sanitize_text_field($_POST['tax_type']) : '';
    $amount = isset($_POST['amount']) ? (float) $_POST['amount'] : 0;
    $upi_id = isset($_POST['upi_id']) ? sanitize_text_field($_POST['upi_id']) : '';
    
    // रसीद नंबर जनरेट करें
    $receipt_number = 'GP-' . date('Ymd') . '-' . rand(1000, 9999);
    
    // पेमेंट पोस्ट बनाएं
    $payment_id = wp_insert_post(array(
        'post_title'   => 'भुगतान - ' . $resident_name . ' - ' . date('d/m/Y'),
        'post_content' => 'राशि: ₹' . $amount . ' | टैक्स: ' . ($tax_type == 'house' ? 'घर टैक्स' : 'पानी टैक्स'),
        'post_status'  => 'publish',
        'post_type'    => 'payment',
    ));
    
    if ($payment_id) {
        update_post_meta($payment_id, '_payment_resident_id', $resident_id);
        update_post_meta($payment_id, '_payment_amount', $amount);
        update_post_meta($payment_id, '_payment_tax_type', $tax_type);
        update_post_meta($payment_id, '_payment_receipt_number', $receipt_number);
        update_post_meta($payment_id, '_payment_date', date('Y-m-d'));
    }
    
    // रसीद HTML
    $receipt_html = '
    <div class="receipt-container" style="border: 2px solid #000; padding: 20px; max-width: 600px; margin: 0 auto;">
        <div class="receipt-header" style="text-align: center; margin-bottom: 20px;">
            <h2 style="margin: 0;">ग्राम पंचायत चिखली</h2>
            <p>टैक्स भुगतान रसीद</p>
        </div>
        
        <div class="receipt-details" style="margin-bottom: 20px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">रसीद नंबर:</td>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">' . $receipt_number . '</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">दिनांक:</td>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">' . date('d/m/Y') . '</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">निवासी का नाम:</td>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">' . $resident_name . '</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">निवासी क्रमांक:</td>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">' . $resident_id . '</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">पता:</td>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">' . $address . '</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">टैक्स प्रकार:</td>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">' . ($tax_type == 'house' ? 'घर टैक्स' : 'पानी टैक्स') . '</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">राशि:</td>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">₹' . number_format($amount, 2) . '</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">भुगतान माध्यम:</td>
                    <td style="padding: 5px; border-bottom: 1px solid #ddd;">UPI (' . $upi_id . ')</td>
                </tr>
            </table>
        </div>
        
        <div class="receipt-footer" style="text-align: center;">
            <p>यह एक कंप्यूटर जनित रसीद है</p>
            <p>धन्यवाद!</p>
        </div>
    </div>';
    
    wp_send_json_success(array(
        'receipt_html' => $receipt_html,
        'receipt_number' => $receipt_number
    ));
}
add_action('wp_ajax_generate_receipt', 'grampanchayat_generate_receipt_ajax');
add_action('wp_ajax_nopriv_generate_receipt', 'grampanchayat_generate_receipt_ajax');

/**
 * शिकायत सबमिट करें
 */
function grampanchayat_submit_complaint_ajax() {
    check_ajax_referer('gp_ajax_nonce', 'nonce');
    
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $mobile = isset($_POST['mobile']) ? sanitize_text_field($_POST['mobile']) : '';
    $complaint_text = isset($_POST['complaint_text']) ? sanitize_textarea_field($_POST['complaint_text']) : '';
    
    // शिकायत ID जनरेट करें
    $complaint_id = 'COMP-' . date('Ymd') . '-' . rand(1000, 9999);
    
    // फोटो अपलोड करें
    $photo_url = '';
    if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        
        $photo_id = media_handle_upload('photo', 0);
        if (!is_wp_error($photo_id)) {
            $photo_url = wp_get_attachment_url($photo_id);
        }
    }
    
    // डॉक्यूमेंट अपलोड करें
    $document_url = '';
    if (isset($_FILES['document']) && !empty($_FILES['document']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        
        $document_id = media_handle_upload('document', 0);
        if (!is_wp_error($document_id)) {
            $document_url = wp_get_attachment_url($document_id);
        }
    }
    
    // शिकायत पोस्ट बनाएं
    $complaint_post_id = wp_insert_post(array(
        'post_title'   => 'शिकायत - ' . $name . ' - ' . date('d/m/Y'),
        'post_content' => $complaint_text,
        'post_status'  => 'publish',
        'post_type'    => 'complaint',
    ));
    
    if ($complaint_post_id) {
        update_post_meta($complaint_post_id, '_complaint_id', $complaint_id);
        update_post_meta($complaint_post_id, '_complaint_name', $name);
        update_post_meta($complaint_post_id, '_complaint_mobile', $mobile);
        update_post_meta($complaint_post_id, '_complaint_status', 'pending');
        update_post_meta($complaint_post_id, '_complaint_photo', $photo_url);
        update_post_meta($complaint_post_id, '_complaint_document', $document_url);
        
        // ईमेल भेजें (वास्तविक परिवेश में)
        $to = get_theme_mod('complaint_email', 'gpchikhali66@gmail.com');
        $subject = 'नई शिकायत दर्ज: ' . $complaint_id;
        $message = "शिकायत विवरण:\n\n";
        $message .= "शिकायत ID: " . $complaint_id . "\n";
        $message .= "नाम: " . $name . "\n";
        $message .= "मोबाइल: " . $mobile . "\n\n";
        $message .= "शिकायत: " . $complaint_text . "\n\n";
        
        if ($photo_url) {
            $message .= "फोटो: " . $photo_url . "\n";
        }
        
        if ($document_url) {
            $message .= "दस्तावेज़: " . $document_url . "\n";
        }
        
        // wp_mail($to, $subject, $message);
    }
    
    wp_send_json_success(array(
        'complaint_id' => $complaint_id,
        'message' => 'आपकी शिकायत सफलतापूर्वक दर्ज कर ली गई है।',
    ));
}
add_action('wp_ajax_submit_complaint', 'grampanchayat_submit_complaint_ajax');
add_action('wp_ajax_nopriv_submit_complaint', 'grampanchayat_submit_complaint_ajax');

/**
 * शिकायत स्थिति चेक करें
 */
function grampanchayat_check_complaint_ajax() {
    check_ajax_referer('gp_ajax_nonce', 'nonce');
    
    $complaint_id = isset($_POST['complaint_id']) ? sanitize_text_field($_POST['complaint_id']) : '';
    
    // शिकायत खोजें
    $complaints = get_posts(array(
        'post_type' => 'complaint',
        'meta_key' => '_complaint_id',
        'meta_value' => $complaint_id,
        'posts_per_page' => 1,
    ));
    
    if (!$complaints) {
        wp_send_json_error(array(
            'message' => 'इस क्रमांक की कोई शिकायत नहीं मिली। कृपया सही क्रमांक डालें।',
        ));
    }
    
    $complaint = $complaints[0];
    $name = get_post_meta($complaint->ID, '_complaint_name', true);
    $mobile = get_post_meta($complaint->ID, '_complaint_mobile', true);
    $status = get_post_meta($complaint->ID, '_complaint_status', true);
    $photo = get_post_meta($complaint->ID, '_complaint_photo', true);
    $document = get_post_meta($complaint->ID, '_complaint_document', true);
    
    wp_send_json_success(array(
        'complaint_id' => $complaint_id,
        'name' => $name,
        'mobile' => $mobile,
        'complaint_text' => $complaint->post_content,
        'status' => $status == 'pending' ? 'लंबित' : 'समाधान',
        'created_at' => get_the_date('d/m/Y', $complaint->ID),
        'photo' => $photo,
        'document' => $document,
    ));
}
add_action('wp_ajax_check_complaint', 'grampanchayat_check_complaint_ajax');
add_action('wp_ajax_nopriv_check_complaint', 'grampanchayat_check_complaint_ajax');

// अन्य कस्टम फिल्ड और फंक्शंस यहां जोड़ें
