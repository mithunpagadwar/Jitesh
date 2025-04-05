/**
 * ग्राम पंचायत थीम मुख्य जावास्क्रिप्ट
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        // होम स्लाइडर इनिशियलाइज
        if ($('.home-slider .swiper').length) {
            const homeSlider = new Swiper('.home-slider .swiper', {
                loop: true,
                effect: 'fade',
                speed: 1000,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }
        
        // हाउस टैक्स फंक्शन्स
        if ($('#tax-lookup-form').length) {
            $('#tax-lookup-form').on('submit', function(e) {
                e.preventDefault();
                
                const mobileNumber = $('#mobile-number').val().trim();
                if (!mobileNumber) {
                    showAlert('error', 'कृपया मोबाइल नंबर दर्ज करें');
                    return;
                }
                
                // रेजिडेंट डेटा लोड करें
                $.ajax({
                    url: gp_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'load_resident_data',
                        nonce: gp_ajax.nonce,
                        mobile: mobileNumber
                    },
                    beforeSend: function() {
                        $('#tax-form-loader').show();
                    },
                    success: function(response) {
                        $('#tax-form-loader').hide();
                        
                        if (response.success && response.data.resident) {
                            showResidentDetails(response.data.resident);
                        } else {
                            showAlert('error', response.data.message || 'निवासी डेटा लोड करने में समस्या हुई');
                        }
                    },
                    error: function() {
                        $('#tax-form-loader').hide();
                        showAlert('error', 'सर्वर से जुड़ने में समस्या हुई। कृपया बाद में पुनः प्रयास करें।');
                    }
                });
            });
            
            // टैक्स चुनें
            $('body').on('change', 'input[name="tax_type"]', function() {
                const taxType = $(this).val();
                const amount = taxType === 'house' ? 
                    parseFloat($('#resident-card').data('house-tax')) : 
                    parseFloat($('#resident-card').data('water-tax'));
                    
                const amountDisplay = amount.toFixed(2);
                $('#payment-amount').text('₹' + amountDisplay);
                
                // QR कोड रीजनरेट करें
                generateQRCode(taxType);
            });
            
            // पेमेंट रसीद जनरेट करें
            $('body').on('click', '#generate-receipt', function() {
                const residentId = $('#resident-card').data('resident-id');
                const residentName = $('#resident-card').data('resident-name');
                const address = $('#resident-card').data('address');
                const taxType = $('input[name="tax_type"]:checked').val();
                const amount = taxType === 'house' ? 
                    parseFloat($('#resident-card').data('house-tax')) : 
                    parseFloat($('#resident-card').data('water-tax'));
                const upiId = taxType === 'house' ? $('#house-tax-upi').val() : $('#water-tax-upi').val();
                
                // अजैक्स कॉल
                $.ajax({
                    url: gp_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'generate_receipt',
                        nonce: gp_ajax.nonce,
                        resident_id: residentId,
                        resident_name: residentName,
                        address: address,
                        tax_type: taxType,
                        amount: amount,
                        upi_id: upiId
                    },
                    beforeSend: function() {
                        $('#receipt-loader').show();
                    },
                    success: function(response) {
                        $('#receipt-loader').hide();
                        
                        if (response.success) {
                            $('#receipt-container').html(response.data.receipt_html);
                            $('#receipt-modal').modal('show');
                            
                            // रसीद प्रिंट करें
                            $('#print-receipt').on('click', function() {
                                const printWindow = window.open('', '_blank');
                                printWindow.document.write('<html><head><title>टैक्स भुगतान रसीद</title>');
                                printWindow.document.write('<style>body { font-family: Arial, sans-serif; line-height: 1.6; }</style>');
                                printWindow.document.write('</head><body>');
                                printWindow.document.write($('#receipt-container').html());
                                printWindow.document.write('</body></html>');
                                printWindow.document.close();
                                printWindow.print();
                            });
                        } else {
                            showAlert('error', 'रसीद जनरेट करने में समस्या हुई। कृपया बाद में पुनः प्रयास करें।');
                        }
                    },
                    error: function() {
                        $('#receipt-loader').hide();
                        showAlert('error', 'सर्वर से जुड़ने में समस्या हुई। कृपया बाद में पुनः प्रयास करें।');
                    }
                });
            });
        }
        
        // शिकायत फॉर्म
        if ($('#complaint-form').length) {
            // फोटो प्रीव्यू
            $('#complaint-photo').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#photo-preview').html('<img src="' + e.target.result + '" class="img-fluid mt-2" style="max-height: 200px;">');
                    }
                    reader.readAsDataURL(file);
                }
            });
            
            // फॉर्म सबमिट
            $('#complaint-form').on('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                formData.append('action', 'submit_complaint');
                formData.append('nonce', gp_ajax.nonce);
                
                $.ajax({
                    url: gp_ajax.ajax_url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#complaint-loader').show();
                        $('#submit-complaint').prop('disabled', true);
                    },
                    success: function(response) {
                        $('#complaint-loader').hide();
                        $('#submit-complaint').prop('disabled', false);
                        
                        if (response.success) {
                            $('#complaint-form')[0].reset();
                            $('#photo-preview').html('');
                            
                            // सफलता संदेश दिखाएं
                            $('#complaint-success').html(
                                '<div class="alert alert-success">' +
                                '<p><strong>' + response.data.message + '</strong></p>' +
                                '<p>आपकी शिकायत क्रमांक है: <strong>' + response.data.complaint_id + '</strong></p>' +
                                '<p>कृपया इस क्रमांक को भविष्य के संदर्भ के लिए नोट कर लें।</p>' +
                                '</div>'
                            ).show();
                            
                            // फॉर्म छिपाएं
                            $('#complaint-form-container').hide();
                        } else {
                            showAlert('error', response.data.message || 'शिकायत दर्ज करने में समस्या हुई। कृपया बाद में पुनः प्रयास करें।');
                        }
                    },
                    error: function() {
                        $('#complaint-loader').hide();
                        $('#submit-complaint').prop('disabled', false);
                        showAlert('error', 'सर्वर से जुड़ने में समस्या हुई। कृपया बाद में पुनः प्रयास करें।');
                    }
                });
            });
        }
        
        // शिकायत चेक
        if ($('#check-complaint-form').length) {
            $('#check-complaint-form').on('submit', function(e) {
                e.preventDefault();
                
                const complaintId = $('#complaint-id').val().trim();
                if (!complaintId) {
                    showAlert('error', 'कृपया शिकायत क्रमांक दर्ज करें');
                    return;
                }
                
                $.ajax({
                    url: gp_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'check_complaint',
                        nonce: gp_ajax.nonce,
                        complaint_id: complaintId
                    },
                    beforeSend: function() {
                        $('#complaint-check-loader').show();
                    },
                    success: function(response) {
                        $('#complaint-check-loader').hide();
                        
                        if (response.success) {
                            const complaint = response.data;
                            let statusClass = complaint.status === 'लंबित' ? 'warning' : 'success';
                            
                            let photoHtml = '';
                            if (complaint.photo) {
                                photoHtml = '<div class="mt-3"><h5>फोटो:</h5><img src="' + complaint.photo + '" class="img-fluid" style="max-height: 200px;"></div>';
                            }
                            
                            let documentHtml = '';
                            if (complaint.document) {
                                documentHtml = '<div class="mt-3"><h5>दस्तावेज़:</h5><a href="' + complaint.document + '" class="btn btn-sm btn-primary" target="_blank">दस्तावेज़ देखें</a></div>';
                            }
                            
                            $('#complaint-result').html(
                                '<div class="card">' +
                                '<div class="card-header bg-primary text-white">शिकायत विवरण</div>' +
                                '<div class="card-body">' +
                                '<p><strong>शिकायत क्रमांक:</strong> ' + complaint.complaint_id + '</p>' +
                                '<p><strong>नाम:</strong> ' + complaint.name + '</p>' +
                                '<p><strong>मोबाइल नंबर:</strong> ' + complaint.mobile + '</p>' +
                                '<p><strong>दिनांक:</strong> ' + complaint.created_at + '</p>' +
                                '<p><strong>स्थिति:</strong> <span class="badge bg-' + statusClass + '">' + complaint.status + '</span></p>' +
                                '<div class="mt-3"><h5>शिकायत:</h5><p>' + complaint.complaint_text + '</p></div>' +
                                photoHtml +
                                documentHtml +
                                '</div>' +
                                '</div>'
                            ).show();
                        } else {
                            showAlert('error', response.data.message || 'शिकायत विवरण प्राप्त करने में समस्या हुई');
                        }
                    },
                    error: function() {
                        $('#complaint-check-loader').hide();
                        showAlert('error', 'सर्वर से जुड़ने में समस्या हुई। कृपया बाद में पुनः प्रयास करें।');
                    }
                });
            });
        }
    });
    
    // हेल्पर फंक्शन्स
    function showAlert(type, message) {
        const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
        const alert = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
            message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
            '</div>';
        
        $('#alert-container').html(alert).show();
        
        // 5 सेकंड के बाद अलर्ट हटाएं
        setTimeout(function() {
            $('#alert-container .alert').alert('close');
        }, 5000);
    }
    
    function showResidentDetails(resident) {
        // HTML बनाएं
        let html = '<div id="resident-card" class="resident-card" ' +
            'data-resident-id="' + resident.id + '" ' +
            'data-resident-name="' + resident.name + '" ' +
            'data-address="' + resident.address + '" ' +
            'data-house-tax="' + resident.house_tax + '" ' +
            'data-water-tax="' + resident.water_tax + '">' +
            '<h4>निवासी विवरण</h4>' +
            '<div class="row mb-3">' +
            '<div class="col-sm-4"><strong>नाम:</strong></div>' +
            '<div class="col-sm-8">' + resident.name + '</div>' +
            '</div>' +
            '<div class="row mb-3">' +
            '<div class="col-sm-4"><strong>पता:</strong></div>' +
            '<div class="col-sm-8">' + resident.address + '</div>' +
            '</div>' +
            '<div class="row mb-3">' +
            '<div class="col-sm-4"><strong>मोबाइल:</strong></div>' +
            '<div class="col-sm-8">' + resident.mobile + '</div>' +
            '</div>' +
            '<div class="row mb-3">' +
            '<div class="col-sm-4"><strong>घर टैक्स:</strong></div>' +
            '<div class="col-sm-8">₹' + resident.house_tax + '</div>' +
            '</div>' +
            '<div class="row mb-3">' +
            '<div class="col-sm-4"><strong>पानी टैक्स:</strong></div>' +
            '<div class="col-sm-8">₹' + resident.water_tax + '</div>' +
            '</div>' +
            '</div>';
            
        // भुगतान फॉर्म
        html += '<div class="mt-4">' +
            '<h4>भुगतान विवरण</h4>' +
            '<div class="row">' +
            '<div class="col-md-6">' +
            '<div class="form-check mb-3">' +
            '<input class="form-check-input" type="radio" name="tax_type" id="house-tax" value="house" checked>' +
            '<label class="form-check-label" for="house-tax">घर टैक्स</label>' +
            '</div>' +
            '<div class="form-check mb-3">' +
            '<input class="form-check-input" type="radio" name="tax_type" id="water-tax" value="water">' +
            '<label class="form-check-label" for="water-tax">पानी टैक्स</label>' +
            '</div>' +
            '<div class="mb-3">' +
            '<label><strong>राशि:</strong></label>' +
            '<div id="payment-amount" class="h4 text-primary">₹' + resident.house_tax + '</div>' +
            '</div>' +
            '<button type="button" id="generate-receipt" class="btn btn-success">' +
            '<i class="fas fa-receipt"></i> भुगतान रसीद जनरेट करें' +
            '</button>' +
            '<div id="receipt-loader" class="text-center mt-3" style="display: none;">' +
            '<div class="spinner-border text-primary" role="status">' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-6 text-center">' +
            '<div id="qr-code-container"></div>' +
            '<p class="mt-2">UPI के माध्यम से स्कैन करके भुगतान करें</p>' +
            '</div>' +
            '</div>' +
            '</div>';
            
        // हिडन इनपुट फील्ड्स
        html += '<input type="hidden" id="house-tax-upi" value="' + resident.house_tax_upi + '">' +
                '<input type="hidden" id="water-tax-upi" value="' + resident.water_tax_upi + '">';
            
        // HTML सेट करें
        $('#resident-details').html(html).show();
        
        // QR कोड जनरेट करें
        generateQRCode('house');
    }
    
    function generateQRCode(taxType) {
        const residentId = $('#resident-card').data('resident-id');
        const amount = taxType === 'house' ? 
            parseFloat($('#resident-card').data('house-tax')) : 
            parseFloat($('#resident-card').data('water-tax'));
        const upiId = taxType === 'house' ? $('#house-tax-upi').val() : $('#water-tax-upi').val();
        
        $.ajax({
            url: gp_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'generate_qr',
                nonce: gp_ajax.nonce,
                upi_id: upiId,
                amount: amount,
                resident_id: residentId,
                tax_type: taxType
            },
            beforeSend: function() {
                $('#qr-code-container').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
            },
            success: function(response) {
                if (response.success) {
                    $('#qr-code-container').html('<img src="' + response.data.svg + '" class="img-fluid" alt="Payment QR Code" style="max-width: 200px;">');
                } else {
                    $('#qr-code-container').html('<div class="alert alert-danger">QR कोड जनरेट करने में समस्या हुई</div>');
                }
            },
            error: function() {
                $('#qr-code-container').html('<div class="alert alert-danger">QR कोड जनरेट करने में समस्या हुई</div>');
            }
        });
    }
})(jQuery);
