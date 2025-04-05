<?php session_start(); ?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>फोटो गैलरी - ग्राम पंचायत चिखली</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="container py-4">
        <h1 class="text-center mb-5">फोटो गैलरी</h1>
        
        <div class="gallery-categories" id="gram-sabha">
            <h2 class="mb-4">ग्रामसभा फोटो</h2>
            <div class="gallery-grid">
                <?php
                // Generate 20 gallery items for ग्रामसभा
                for ($i = 1; $i <= 20; $i++):
                    $date = date('d/m/Y', strtotime("-$i days"));
                ?>
                <div class="gallery-item">
                    <a href="data:image/svg+xml;base64,<?php echo base64_encode(generateGallerySvg('ग्रामसभा', $i, $date)); ?>" 
                       data-lightbox="gram-sabha" 
                       data-title="ग्रामसभा दिनांक <?php echo $date; ?>">
                        <img src="data:image/svg+xml;base64,<?php echo base64_encode(generateGallerySvg('ग्रामसभा', $i, $date)); ?>" 
                             alt="ग्रामसभा फोटो <?php echo $i; ?>">
                    </a>
                    <p>ग्रामसभा दिनांक <?php echo $date; ?></p>
                </div>
                <?php endfor; ?>
            </div>
            
            <h2 class="mb-4 mt-5" id="monthly-meeting">मासिक सभा फोटो</h2>
            <div class="gallery-grid">
                <?php
                // Generate 20 gallery items for मासिक सभा
                for ($i = 1; $i <= 20; $i++):
                    $date = date('d/m/Y', strtotime("-$i months"));
                ?>
                <div class="gallery-item">
                    <a href="data:image/svg+xml;base64,<?php echo base64_encode(generateGallerySvg('मासिक सभा', $i, $date)); ?>" 
                       data-lightbox="monthly-meeting" 
                       data-title="मासिक सभा दिनांक <?php echo $date; ?>">
                        <img src="data:image/svg+xml;base64,<?php echo base64_encode(generateGallerySvg('मासिक सभा', $i, $date)); ?>" 
                             alt="मासिक सभा फोटो <?php echo $i; ?>">
                    </a>
                    <p>मासिक सभा दिनांक <?php echo $date; ?></p>
                </div>
                <?php endfor; ?>
            </div>
            
            <h2 class="mb-4 mt-5" id="cultural">सांस्कृतिक कार्यक्रम फोटो</h2>
            <div class="gallery-grid">
                <?php
                // Generate 20 gallery items for सांस्कृतिक कार्यक्रम
                for ($i = 1; $i <= 20; $i++):
                    $date = date('d/m/Y', strtotime("-$i weeks"));
                ?>
                <div class="gallery-item">
                    <a href="data:image/svg+xml;base64,<?php echo base64_encode(generateGallerySvg('सांस्कृतिक कार्यक्रम', $i, $date)); ?>" 
                       data-lightbox="cultural" 
                       data-title="सांस्कृतिक कार्यक्रम दिनांक <?php echo $date; ?>">
                        <img src="data:image/svg+xml;base64,<?php echo base64_encode(generateGallerySvg('सांस्कृतिक कार्यक्रम', $i, $date)); ?>" 
                             alt="सांस्कृतिक कार्यक्रम फोटो <?php echo $i; ?>">
                    </a>
                    <p>कार्यक्रम दिनांक <?php echo $date; ?></p>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php
// Helper function to generate SVG placeholders for gallery
function generateGallerySvg($category, $index, $date) {
    $colors = [
        'ग्रामसभा' => '#4CAF50',
        'मासिक सभा' => '#2196F3',
        'सांस्कृतिक कार्यक्रम' => '#FF9800'
    ];
    
    $color = $colors[$category] ?? '#333333';
    
    return '<svg xmlns="http://www.w3.org/2000/svg" width="300" height="200" viewBox="0 0 300 200">
        <rect width="300" height="200" fill="' . $color . '"/>
        <text x="150" y="80" font-family="Arial" font-size="20" text-anchor="middle" fill="white">' . $category . '</text>
        <text x="150" y="110" font-family="Arial" font-size="16" text-anchor="middle" fill="white">फोटो ' . $index . '</text>
        <text x="150" y="140" font-family="Arial" font-size="14" text-anchor="middle" fill="white">दिनांक: ' . $date . '</text>
    </svg>';
}
?>
