<?php
/**
 * Template Name: एडमिन डैशबोर्ड
 */

// यूजर लॉगिन है या नहीं चेक करें
if (!is_user_logged_in()) {
    wp_redirect(home_url('/admin-login'));
    exit;
}

get_header();
?>

<main id="primary" class="site-main">
    <div class="container-fluid section-padding">
        <div class="row">
            <!-- साइडबार -->
            <div class="col-lg-3 col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">एडमिन मेनू</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#dashboard" class="list-group-item list-group-item-action active" data-bs-toggle="list">डैशबोर्ड</a>
                        <a href="#complaints" class="list-group-item list-group-item-action" data-bs-toggle="list">शिकायतें</a>
                        <a href="#residents" class="list-group-item list-group-item-action" data-bs-toggle="list">निवासी</a>
                        <a href="#payments" class="list-group-item list-group-item-action" data-bs-toggle="list">भुगतान</a>
                        <a href="#upi-settings" class="list-group-item list-group-item-action" data-bs-toggle="list">UPI सेटिंग्स</a>
                        <a href="<?php echo wp_logout_url(home_url('/')); ?>" class="list-group-item list-group-item-action text-danger">लॉगआउट</a>
                    </div>
                </div>
            </div>
            
            <!-- मुख्य कंटेंट -->
            <div class="col-lg-9 col-md-8">
                <div class="tab-content">
                    <!-- डैशबोर्ड टैब -->
                    <div class="tab-pane fade show active" id="dashboard">
                        <h2 class="mb-4">डैशबोर्ड</h2>
                        
                        <!-- स्टैटिस्टिक्स कार्ड्स -->
                        <div class="row">
                            <div class="col-sm-6 col-xl-3 mb-4">
                                <div class="card bg-primary text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75">कुल निवासी</div>
                                                <div class="display-6 fw-bold">253</div>
                                            </div>
                                            <i class="fas fa-users fa-2x text-white-50"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#residents" data-bs-toggle="list">विस्तार देखें</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3 mb-4">
                                <div class="card bg-warning text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75">लंबित शिकायतें</div>
                                                <div class="display-6 fw-bold">12</div>
                                            </div>
                                            <i class="fas fa-clipboard-list fa-2x text-white-50"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#complaints" data-bs-toggle="list">विस्तार देखें</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3 mb-4">
                                <div class="card bg-success text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75">आज के भुगतान</div>
                                                <div class="display-6 fw-bold">₹4,500</div>
                                            </div>
                                            <i class="fas fa-money-bill-wave fa-2x text-white-50"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#payments" data-bs-toggle="list">विस्तार देखें</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3 mb-4">
                                <div class="card bg-danger text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75">बकाया टैक्स</div>
                                                <div class="display-6 fw-bold">₹25,400</div>
                                            </div>
                                            <i class="fas fa-hand-holding-usd fa-2x text-white-50"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#residents" data-bs-toggle="list">विस्तार देखें</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- हाल की गतिविधियां -->
                        <div class="card mb-4">
                            <div class="card-header">
                                हाल की गतिविधियां
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill-wave text-success"></i>
                                            </div>
                                            <div class="col">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">रमेश पाटील ने घर टैक्स का भुगतान किया</h5>
                                                    <small>2 घंटे पहले</small>
                                                </div>
                                                <p class="mb-1">भुगतान राशि: ₹500</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list text-warning"></i>
                                            </div>
                                            <div class="col">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">नई शिकायत दर्ज की गई</h5>
                                                    <small>5 घंटे पहले</small>
                                                </div>
                                                <p class="mb-1">संजय शर्मा द्वारा 'गली में पानी भरने' की शिकायत दर्ज की गई।</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-check text-success"></i>
                                            </div>
                                            <div class="col">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">शिकायत का समाधान किया गया</h5>
                                                    <small>आज सुबह</small>
                                                </div>
                                                <p class="mb-1">ग्राम सचिव द्वारा 'स्ट्रीट लाइट की समस्या' शिकायत का समाधान किया गया।</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-user-plus text-primary"></i>
                                            </div>
                                            <div class="col">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">नए निवासी जोड़े गए</h5>
                                                    <small>कल</small>
                                                </div>
                                                <p class="mb-1">प्रमोद राव को निवासी सूची में जोड़ा गया।</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- शिकायतें टैब -->
                    <div class="tab-pane fade" id="complaints">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>शिकायतें</h2>
                            <div>
                                <select class="form-select form-select-sm" id="complaint-filter">
                                    <option value="all">सभी शिकायतें</option>
                                    <option value="pending">लंबित शिकायतें</option>
                                    <option value="resolved">सुलझी हुई शिकायतें</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- शिकायतें टेबल -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>क्रमांक</th>
                                                <th>नाम</th>
                                                <th>मोबाइल</th>
                                                <th>शिकायत</th>
                                                <th>दिनांक</th>
                                                <th>स्थिति</th>
                                                <th>एक्शन</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>COMP-20250404-1234</td>
                                                <td>संजय शर्मा</td>
                                                <td>9876543210</td>
                                                <td>गली में पानी भरने की समस्या है</td>
                                                <td>04/04/2025</td>
                                                <td><span class="badge bg-warning">लंबित</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">देखें</button>
                                                    <button class="btn btn-sm btn-success">समाधान</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>COMP-20250403-5678</td>
                                                <td>प्रीति पाटील</td>
                                                <td>9876543211</td>
                                                <td>स्ट्रीट लाइट काम नहीं कर रही है</td>
                                                <td>03/04/2025</td>
                                                <td><span class="badge bg-success">समाधान</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">देखें</button>
                                                </td>
                                            </tr>
                                            <!-- अधिक शिकायतें यहां जोड़ें -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- निवासी टैब -->
                    <div class="tab-pane fade" id="residents">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>निवासी</h2>
                            <button class="btn btn-primary">नया निवासी जोड़ें</button>
                        </div>
                        
                        <!-- निवासी सर्च -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="नाम या मोबाइल द्वारा खोजें">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select">
                                            <option>सभी</option>
                                            <option>बकाया टैक्स</option>
                                            <option>टैक्स भुगतान किया</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary w-100">खोजें</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- निवासी टेबल -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>नाम</th>
                                                <th>मोबाइल</th>
                                                <th>पता</th>
                                                <th>घर टैक्स</th>
                                                <th>पानी टैक्स</th>
                                                <th>एक्शन</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>रमेश पाटील</td>
                                                <td>9876543210</td>
                                                <td>मुख्य रोड, वार्ड नं. 3, चिखली</td>
                                                <td>₹500</td>
                                                <td>₹300</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">संपादित करें</button>
                                                    <button class="btn btn-sm btn-info">भुगतान</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>सुनीता राणे</td>
                                                <td>9876543211</td>
                                                <td>बाजार गली, वार्ड नं. 2, चिखली</td>
                                                <td>₹500</td>
                                                <td>₹300</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">संपादित करें</button>
                                                    <button class="btn btn-sm btn-info">भुगतान</button>
                                                </td>
                                            </tr>
                                            <!-- अधिक निवासी यहां जोड़ें -->
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- पेजिनेशन -->
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">पिछला</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">अगला</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    
                    <!-- भुगतान टैब -->
                    <div class="tab-pane fade" id="payments">
                        <h2 class="mb-4">भुगतान रिकॉर्ड</h2>
                        
                        <!-- भुगतान फिल्टर -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" placeholder="आरंभ तिथि">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" placeholder="अंतिम तिथि">
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select">
                                            <option>सभी टैक्स</option>
                                            <option>घर टैक्स</option>
                                            <option>पानी टैक्स</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary w-100">फिल्टर करें</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- भुगतान टेबल -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>रसीद नंबर</th>
                                                <th>निवासी</th>
                                                <th>टैक्स प्रकार</th>
                                                <th>राशि</th>
                                                <th>भुगतान तिथि</th>
                                                <th>एक्शन</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>GP-20250404-1234</td>
                                                <td>रमेश पाटील</td>
                                                <td>घर टैक्स</td>
                                                <td>₹500</td>
                                                <td>04/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info">रसीद देखें</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>GP-20250403-5678</td>
                                                <td>सुनीता राणे</td>
                                                <td>पानी टैक्स</td>
                                                <td>₹300</td>
                                                <td>03/04/2025</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info">रसीद देखें</button>
                                                </td>
                                            </tr>
                                            <!-- अधिक भुगतान रिकॉर्ड यहां जोड़ें -->
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- पेजिनेशन -->
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">पिछला</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">अगला</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    
                    <!-- UPI सेटिंग्स टैब -->
                    <div class="tab-pane fade" id="upi-settings">
                        <h2 class="mb-4">UPI सेटिंग्स</h2>
                        
                        <!-- UPI फॉर्म -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <form id="upi-settings-form">
                                    <div class="mb-3">
                                        <label for="house-tax-upi" class="form-label">घर टैक्स UPI ID</label>
                                        <input type="text" class="form-control" id="house-tax-upi" value="gpchikhali66@ybl" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="water-tax-upi" class="form-label">पानी टैक्स UPI ID</label>
                                        <input type="text" class="form-control" id="water-tax-upi" value="gpchikhali66@paytm" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">अपडेट करें</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
