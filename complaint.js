document.addEventListener('DOMContentLoaded', function() {
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photo-preview');
    const photoPreviewContainer = document.getElementById('photo-preview-container');
    
    if (photoInput && photoPreview && photoPreviewContainer) {
        photoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreviewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                photoPreviewContainer.style.display = 'none';
            }
        });
    }
});
