<?php include BASE_PATH . '/app/views/partials/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-cloud-upload me-2"></i>Upload Prescription
    </h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle me-2"></i>
                <?= htmlspecialchars($_SESSION['flash']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-file-medical me-2"></i>Prescription Upload Form
                </h5>
            </div>
            <div class="card-body">
                <form method="post" action="?action=upload-post" enctype="multipart/form-data">
                    <?php csrf_field(); ?>
                    
                    <div class="mb-4">
                        <label for="note" class="form-label">
                            <i class="bi bi-chat-text me-1"></i>Additional Notes
                        </label>
                        <textarea class="form-control" id="note" name="note" rows="3" 
                                placeholder="Any special instructions or notes for the pharmacy..."></textarea>
                        <div class="form-text">Optional: Any specific requirements or medical conditions</div>
                    </div>

                    <div class="mb-4">
                        <label for="delivery_address" class="form-label">
                            <i class="bi bi-geo-alt me-1"></i>Delivery Address *
                        </label>
                        <input type="text" class="form-control" id="delivery_address" name="delivery_address" required 
                               placeholder="Enter your complete delivery address">
                        <div class="form-text">Please provide your complete address including city and postal code</div>
                    </div>

                    <div class="mb-4">
                        <label for="delivery_slot" class="form-label">
                            <i class="bi bi-clock me-1"></i>Preferred Delivery Time *
                        </label>
                        <select class="form-select" id="delivery_slot" name="delivery_slot" required>
                            <option value="">Choose your preferred delivery time...</option>
                            <?php
                            // 2-hour slots from 8:00 to 20:00
                            for ($h=8; $h<=18; $h+=2) {
                                $start = sprintf('%02d:00', $h);
                                $end   = sprintf('%02d:00', $h+2);
                                echo "<option value='{$start}-{$end}'>{$start} - {$end}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="images" class="form-label">
                            <i class="bi bi-images me-1"></i>Prescription Images *
                        </label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple 
                               accept=".jpg,.jpeg,.png,.gif" required>
                        <div class="form-text">
                            <strong>Important:</strong> Upload clear images of your prescription (max 5 files). 
                            Supported formats: JPG, PNG, GIF
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Before uploading:</strong> Ensure all prescription images are clear and readable. 
                        Double-check your delivery address and preferred time slot.
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="?" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                        </a>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-cloud-upload me-2"></i>Submit Prescription
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include BASE_PATH . '/app/views/partials/footer.php'; ?>
