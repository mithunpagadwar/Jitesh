
<?php
/**
 * Template Name: Photo Gallery
 */

get_header();
?>

<main class="photo-gallery-page">
    <div class="container">
        <h1 class="page-title">फोटो गैलरी</h1>
        
        <div class="gallery-categories">
            <h2>ग्रामसभा फोटो</h2>
            <div class="gallery-grid">
                <?php
                for ($i = 1; $i <= 20; $i++):
                    $image_url = get_template_directory_uri() . '/assets/gram-sabha/image' . $i . '.jpg';
                ?>
                <div class="gallery-item">
                    <img src="<?php echo esc_url($image_url); ?>" alt="ग्रामसभा फोटो <?php echo $i; ?>">
                    <p>ग्रामसभा दिनांक <?php echo date('d/m/Y', strtotime("-$i days")); ?></p>
                </div>
                <?php endfor; ?>
            </div>
            
            <h2>मासिक सभा फोटो</h2>
            <div class="gallery-grid">
                <?php
                for ($i = 1; $i <= 20; $i++):
                    $image_url = get_template_directory_uri() . '/assets/monthly-meeting/image' . $i . '.jpg';
                ?>
                <div class="gallery-item">
                    <img src="<?php echo esc_url($image_url); ?>" alt="मासिक सभा फोटो <?php echo $i; ?>">
                    <p>मासिक सभा दिनांक <?php echo date('d/m/Y', strtotime("-$i months")); ?></p>
                </div>
                <?php endfor; ?>
            </div>
            
            <h2>सांस्कृतिक कार्यक्रम फोटो</h2>
            <div class="gallery-grid">
                <?php
                for ($i = 1; $i <= 20; $i++):
                    $image_url = get_template_directory_uri() . '/assets/cultural/image' . $i . '.jpg';
                ?>
                <div class="gallery-item">
                    <img src="<?php echo esc_url($image_url); ?>" alt="सांस्कृतिक कार्यक्रम फोटो <?php echo $i; ?>">
                    <p>कार्यक्रम दिनांक <?php echo date('d/m/Y', strtotime("-$i weeks")); ?></p>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>

