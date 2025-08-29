<?php include BASE_PATH . '/app/views/partials/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-building me-2"></i>Pharmacy Dashboard
    </h1>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="alert alert-success border-0">
            <i class="bi bi-check-circle me-2"></i>
            <strong>Welcome to the Pharmacy Portal!</strong> Manage prescriptions and create quotations for patients.
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-file-medical display-1 text-primary mb-3"></i>
                <h5 class="card-title">Prescription Management</h5>
                <p class="card-text text-muted">
                    View all uploaded prescriptions from patients and create quotations with medicine details and pricing.
                </p>
                <a href="?action=pharmacy-prescriptions" class="btn btn-primary btn-lg">
                    <i class="bi bi-list-ul me-2"></i>View All Prescriptions
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-info-circle me-2"></i>Quick Stats
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Pending Prescriptions</span>
                        <span class="badge bg-warning">New</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Quotations Sent</span>
                        <span class="badge bg-info">Processing</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Accepted Orders</span>
                        <span class="badge bg-success">Completed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light">
                <h6 class="card-title mb-0">
                    <i class="bi bi-gear me-2"></i>Workflow Guide
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3 h-100">
                            <i class="bi bi-eye-fill text-primary fs-2 mb-2"></i>
                            <h6>Review Prescriptions</h6>
                            <small class="text-muted">Check uploaded prescription images and patient details</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3 h-100">
                            <i class="bi bi-calculator text-warning fs-2 mb-2"></i>
                            <h6>Create Quotation</h6>
                            <small class="text-muted">Add medicines with quantities and pricing</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3 h-100">
                            <i class="bi bi-send text-info fs-2 mb-2"></i>
                            <h6>Send to Patient</h6>
                            <small class="text-muted">Submit quotation for patient review</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3 h-100">
                            <i class="bi bi-check-circle text-success fs-2 mb-2"></i>
                            <h6>Process Order</h6>
                            <small class="text-muted">Prepare and deliver accepted orders</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include BASE_PATH . '/app/views/partials/footer.php'; ?>
