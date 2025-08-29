<?php include BASE_PATH . '/app/views/partials/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-house-door me-2"></i>User Dashboard
    </h1>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="alert alert-info border-0">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Welcome back!</strong> Upload a new prescription or view your quotations below.
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-cloud-upload display-1 text-primary mb-3"></i>
                <h5 class="card-title">Upload Prescription</h5>
                <p class="card-text text-muted">
                    Upload your prescription images and delivery details to get quotations from pharmacies.
                </p>
                <a href="?action=upload" class="btn btn-primary">
                    <i class="bi bi-cloud-upload me-2"></i>Upload New Prescription
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-file-text display-1 text-success mb-3"></i>
                <h5 class="card-title">My Prescriptions</h5>
                <p class="card-text text-muted">
                    View all your uploaded prescriptions and check quotations from pharmacies.
                </p>
                <a href="?action=my-prescriptions" class="btn btn-success">
                    <i class="bi bi-list-ul me-2"></i>View My Prescriptions
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light">
                <h6 class="card-title mb-0">
                    <i class="bi bi-lightbulb me-2"></i>How it works
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-3 h-100">
                            <i class="bi bi-1-circle-fill text-primary fs-2 mb-2"></i>
                            <h6>Upload Prescription</h6>
                            <small class="text-muted">Upload images of your prescription with delivery details</small>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-3 h-100">
                            <i class="bi bi-2-circle-fill text-warning fs-2 mb-2"></i>
                            <h6>Get Quotations</h6>
                            <small class="text-muted">Pharmacies will review and send you quotations</small>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-3 h-100">
                            <i class="bi bi-3-circle-fill text-success fs-2 mb-2"></i>
                            <h6>Accept & Receive</h6>
                            <small class="text-muted">Accept the best quotation and receive your medicines</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include BASE_PATH . '/app/views/partials/footer.php'; ?>
