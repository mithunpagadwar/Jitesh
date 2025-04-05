<?php
/**
 * हेडर टेम्पलेट
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-5">
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php else : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <nav class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => function() {
                            echo '<ul id="primary-menu">';
                            echo '<li><a href="' . esc_url(home_url('/')) . '">होम</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/schemes')) . '">योजनाएं</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/housetax')) . '">टैक्स भुगतान</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/complaint')) . '">शिकायत दर्ज करें</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/gallery')) . '">गैलरी</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/admin')) . '">एडमिन लॉगिन</a></li>';
                            echo '</ul>';
                        }
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </div>
</header>
