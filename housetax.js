document.addEventListener('DOMContentLoaded', function() {
    // Handle resident selection
    const residentItems = document.querySelectorAll('.resident-list-item');
    const taxTypeRadios = document.querySelectorAll('input[name="taxType"]');
    const searchInput = document.getElementById('residentSearch');
    
    // Get UPI IDs from hidden spans in the page
    const upiIdText = document.querySelector('#houseTaxPayment .fw-bold') ? 
                      document.querySelector('#houseTaxPayment .fw-bold').textContent : 'gpchikhali66@ybl';
    const upiId2Text = document.querySelector('#waterTaxPayment .fw-bold') ? 
                       document.querySelector('#waterTaxPayment .fw-bold').textContent : 'gpchikhali66@paytm';
    
    function updatePaymentDetails() {
        const selectedResident = document.querySelector('.resident-list-item.active');
        const selectedTaxType = document.querySelector('input[name="taxType"]:checked').value;
        
        if (selectedResident) {
            const residentId = selectedResident.dataset.id;
            const residentName = selectedResident.dataset.name;
            const houseTax = selectedResident.dataset.houseTax;
            const waterTax = selectedResident.dataset.waterTax;
            const avatar = selectedResident.dataset.avatar;
            const address = selectedResident.dataset.address;
            const mobile = selectedResident.dataset.mobile;
            
            document.getElementById('residentId').textContent = residentId;
            document.getElementById('residentName').textContent = residentName;
            document.getElementById('residentAvatar').src = 'data:image/svg+xml;base64,' + avatar;
            
            // Hide both payment sections initially
            document.getElementById('houseTaxPayment').style.display = 'none';
            document.getElementById('waterTaxPayment').style.display = 'none';
            
            if (selectedTaxType === 'house') {
                document.getElementById('taxAmount').textContent = houseTax;
                document.getElementById('taxTypeDisplay').textContent = 'घर टैक्स';
                
                // Show house tax payment section
                document.getElementById('houseTaxPayment').style.display = 'block';
                
                // Update QR code for house tax - use server-generated QR
                const houseQrUrl = '/generate-qr?upi_id=' + encodeURIComponent(upiIdText) + 
                                  '&amount=' + houseTax + 
                                  '&resident_id=' + residentId + 
                                  '&tax_type=house';
                document.getElementById('houseQrCodeImage').src = houseQrUrl;
            } else {
                document.getElementById('taxAmount').textContent = waterTax;
                document.getElementById('taxTypeDisplay').textContent = 'पाणी टैक्स';
                
                // Show water tax payment section
                document.getElementById('waterTaxPayment').style.display = 'block';
                
                // Update QR code for water tax - use server-generated QR
                const waterQrUrl = '/generate-qr?upi_id=' + encodeURIComponent(upiId2Text) + 
                                  '&amount=' + waterTax + 
                                  '&resident_id=' + residentId + 
                                  '&tax_type=water';
                document.getElementById('waterQrCodeImage').src = waterQrUrl;
            }
            
            document.getElementById('paymentCard').style.display = 'block';
        }
    }
    
    // Generate tax receipt
    function generateReceipt(residentId, residentName, address, taxType, amount, upiIdUsed) {
        // Get modal elements
        const receiptModal = new bootstrap.Modal(document.getElementById('paymentReceiptModal'));
        const receiptContent = document.getElementById('receiptContent');
        const printReceiptBtn = document.getElementById('printReceiptBtn');
        
        // Generate receipt content
        const date = new Date().toLocaleDateString();
        const receiptNumber = Date.now().toString().substring(6) + residentId;
        
        // Create receipt HTML
        const receiptHTML = `
            <div class="receipt">
                <div class="text-center mb-4">
                    <h3>ग्राम पंचायत चिखली</h3>
                    <h4>टैक्स पावती</h4>
                </div>
                <div class="row mb-3">
                    <div class="col-6"><strong>पावती क्रमांक:</strong></div>
                    <div class="col-6">${receiptNumber}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-6"><strong>दिनांक:</strong></div>
                    <div class="col-6">${date}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-6"><strong>निवासी क्रमांक:</strong></div>
                    <div class="col-6">${residentId}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-6"><strong>निवासी नाम:</strong></div>
                    <div class="col-6">${residentName}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-6"><strong>पता:</strong></div>
                    <div class="col-6">${address}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-6"><strong>टैक्स प्रकार:</strong></div>
                    <div class="col-6">${taxType}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-6"><strong>राशि:</strong></div>
                    <div class="col-6">₹${amount}/-</div>
                </div>
                <div class="row mb-3">
                    <div class="col-6"><strong>भुगतान विधि:</strong></div>
                    <div class="col-6">UPI (${upiIdUsed})</div>
                </div>
                <div class="row mb-3">
                    <div class="col-6"><strong>स्थिति:</strong></div>
                    <div class="col-6 text-success">सफल</div>
                </div>
                <hr>
                <div class="text-center mt-4">
                    <p>धन्यवाद! आपका भुगतान सफलतापूर्वक प्राप्त हुआ है।</p>
                    <p class="mb-0">ग्राम पंचायत चिखली, जिला गडचिरोली, महाराष्ट्र</p>
                </div>
            </div>
        `;
        
        // Set content and show modal
        receiptContent.innerHTML = receiptHTML;
        receiptModal.show();
        
        // Add print functionality
        printReceiptBtn.addEventListener('click', function() {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>टैक्स पावती</title>
                    <meta charset="UTF-8">
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        .receipt { border: 2px solid #333; padding: 20px; max-width: 800px; margin: 0 auto; }
                        .header { text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; }
                        .content { margin: 20px 0; }
                        .row { display: flex; margin-bottom: 10px; }
                        .label { font-weight: bold; width: 200px; }
                        .value { flex: 1; }
                        .footer { text-align: center; margin-top: 30px; border-top: 1px solid #ddd; padding-top: 10px; }
                    </style>
                </head>
                <body onload="window.print(); window.close();">
                    ${receiptHTML}
                </body>
                </html>
            `);
            printWindow.document.close();
        });
    }
    
    // Add click event to resident items
    residentItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all items
            residentItems.forEach(i => i.classList.remove('active'));
            // Add active class to clicked item
            this.classList.add('active');
            // Update payment details
            updatePaymentDetails();
        });
    });
    
    // Add change event to tax type radios
    taxTypeRadios.forEach(radio => {
        radio.addEventListener('change', updatePaymentDetails);
    });
    
    // Search functionality
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            residentItems.forEach(item => {
                const name = item.dataset.name.toLowerCase();
                const id = item.dataset.id;
                const address = item.dataset.address.toLowerCase();
                const mobile = item.dataset.mobile;
                
                if (name.includes(searchTerm) || id.includes(searchTerm) || 
                    address.includes(searchTerm) || mobile.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // Handle payment buttons
    const payHouseTaxBtn = document.getElementById('payHouseTaxBtn');
    const payWaterTaxBtn = document.getElementById('payWaterTaxBtn');
    
    if (payHouseTaxBtn) {
        payHouseTaxBtn.addEventListener('click', function(e) {
            const selectedResident = document.querySelector('.resident-list-item.active');
            if (selectedResident) {
                e.preventDefault();
                const residentId = selectedResident.dataset.id;
                const residentName = selectedResident.dataset.name;
                const houseTax = selectedResident.dataset.houseTax;
                const address = selectedResident.dataset.address;
                
                // Create UPI deep link
                const upiDeepLink = `upi://pay?pa=${upiIdText}&pn=GramPanchayat&am=${houseTax}&cu=INR&tn=HouseTax-${residentId}`;
                
                // Open UPI app if on mobile or generate receipt
                if (/Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                    window.location.href = upiDeepLink;
                    setTimeout(function() {
                        generateReceipt(residentId, residentName, address, 'घर टैक्स', houseTax, upiIdText);
                    }, 3000);
                } else {
                    // On desktop, just generate a receipt
                    generateReceipt(residentId, residentName, address, 'घर टैक्स', houseTax, upiIdText);
                }
            }
        });
    }
    
    if (payWaterTaxBtn) {
        payWaterTaxBtn.addEventListener('click', function(e) {
            const selectedResident = document.querySelector('.resident-list-item.active');
            if (selectedResident) {
                e.preventDefault();
                const residentId = selectedResident.dataset.id;
                const residentName = selectedResident.dataset.name;
                const waterTax = selectedResident.dataset.waterTax;
                const address = selectedResident.dataset.address;
                
                // Create UPI deep link
                const upiDeepLink = `upi://pay?pa=${upiId2Text}&pn=GramPanchayat&am=${waterTax}&cu=INR&tn=WaterTax-${residentId}`;
                
                // Open UPI app if on mobile or generate receipt
                if (/Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                    window.location.href = upiDeepLink;
                    setTimeout(function() {
                        generateReceipt(residentId, residentName, address, 'पाणी टैक्स', waterTax, upiId2Text);
                    }, 3000);
                } else {
                    // On desktop, just generate a receipt
                    generateReceipt(residentId, residentName, address, 'पाणी टैक्स', waterTax, upiId2Text);
                }
            }
        });
    }
});
