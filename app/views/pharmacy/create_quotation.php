<?php include BASE_PATH . '/app/views/partials/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-receipt-cutoff me-2"></i>Create Quotation for Prescription #<?= (int)$p['id'] ?>
    </h1>
    <div>
        <a href="?action=pharmacy-prescriptions" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Prescriptions
        </a>
    </div>
</div>

<div class="row">
    <!-- Prescription Images Section -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-images me-2"></i>Prescription Images
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($p['images'])): ?>
                    <div class="row g-3">
                        <?php foreach ($p['images'] as $index => $img): ?>
                            <div class="col-12">
                                <div class="card border-secondary">
                                    <div class="card-header bg-light py-2">
                                        <small class="text-muted">
                                            <i class="bi bi-file-earmark-image me-1"></i>
                                            Image <?= $index + 1 ?>
                                        </small>
                                    </div>
                                    <div class="card-body p-2">
                                        <img src="<?= htmlspecialchars($img['path']) ?>" 
                                             alt="Prescription image <?= $index + 1 ?>" 
                                             class="img-fluid rounded cursor-pointer"
                                             style="max-height: 200px; width: 100%; object-fit: contain;"
                                             onclick="openImageModal(this.src)">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="bi bi-image text-muted display-4"></i>
                        <p class="text-muted mt-2">No prescription images available</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quotation Form Section -->
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-calculator me-2"></i>Quotation Details
                </h5>
            </div>
            <div class="card-body">
                <form method="post" action="?action=pharmacy-create-quotation-post" id="quotationForm">
                    <?php csrf_field(); ?>
                    <input type="hidden" name="prescription_id" value="<?= (int)$p['id'] ?>">

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Instructions:</strong> Add medicines from the prescription images. Click "Add Item" to include more medicines.
                    </div>

                    <!-- Items Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="items">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 40%">
                                        <i class="bi bi-capsule me-1"></i>Drug Name
                                    </th>
                                    <th scope="col" style="width: 15%" class="text-center">
                                        <i class="bi bi-hash me-1"></i>Quantity
                                    </th>
                                    <th scope="col" style="width: 20%" class="text-center">
                                        <i class="bi bi-currency-dollar me-1"></i>Unit Price
                                    </th>
                                    <th scope="col" style="width: 15%" class="text-center">
                                        <i class="bi bi-calculator me-1"></i>Total
                                    </th>
                                    <th scope="col" style="width: 10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input name="drug_name[]" 
                                               class="form-control" 
                                               required 
                                               placeholder="e.g., Amoxicillin 250mg"
                                               onchange="calculateLineTotal(this)">
                                    </td>
                                    <td>
                                        <input name="quantity[]" 
                                               type="number" 
                                               min="1" 
                                               required 
                                               value="1"
                                               class="form-control text-center"
                                               onchange="calculateLineTotal(this)">
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input name="unit_price[]" 
                                                   type="number" 
                                                   step="0.01" 
                                                   min="0" 
                                                   required 
                                                   value="0.00"
                                                   class="form-control text-end"
                                                   onchange="calculateLineTotal(this)">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <span class="badge bg-success fs-6 line-total">$0.00</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" onclick="addRow()">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="table-secondary">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold fs-5">
                                        <i class="bi bi-calculator-fill me-2 text-primary"></i>Grand Total:
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary fs-5 p-3" id="grandTotal">$0.00</span>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Submit Section -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-secondary me-md-2" onclick="window.history.back()">
                            <i class="bi bi-x-circle me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg px-4" id="submitBtn">
                            <i class="bi bi-send me-2"></i>Send Quotation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">
                    <i class="bi bi-zoom-in me-2"></i>Prescription Image
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Prescription image">
            </div>
        </div>
    </div>
</div>

<script>
// Add new row to quotation table
function addRow() {
    const tbody = document.querySelector('#items tbody');
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td>
            <input name="drug_name[]" 
                   class="form-control" 
                   required 
                   placeholder="e.g., Paracetamol 500mg"
                   onchange="calculateLineTotal(this)">
        </td>
        <td>
            <input name="quantity[]" 
                   type="number" 
                   min="1" 
                   required 
                   value="1"
                   class="form-control text-center"
                   onchange="calculateLineTotal(this)">
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input name="unit_price[]" 
                       type="number" 
                       step="0.01" 
                       min="0" 
                       required 
                       value="0.00"
                       class="form-control text-end"
                       onchange="calculateLineTotal(this)">
            </div>
        </td>
        <td>
            <div class="text-center">
                <span class="badge bg-success fs-6 line-total">$0.00</span>
            </div>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                <i class="bi bi-trash"></i>
            </button>
        </td>`;
    tbody.appendChild(tr);
}

// Remove row from quotation table
function removeRow(button) {
    const row = button.closest('tr');
    row.remove();
    calculateGrandTotal();
}

// Calculate line total for a row
function calculateLineTotal(input) {
    const row = input.closest('tr');
    const quantity = parseFloat(row.querySelector('input[name="quantity[]"]').value) || 0;
    const unitPrice = parseFloat(row.querySelector('input[name="unit_price[]"]').value) || 0;
    const lineTotal = quantity * unitPrice;
    
    row.querySelector('.line-total').textContent = '$' + lineTotal.toFixed(2);
    calculateGrandTotal();
}

// Calculate grand total
function calculateGrandTotal() {
    const lineTotals = document.querySelectorAll('.line-total');
    let grandTotal = 0;
    
    lineTotals.forEach(function(element) {
        const amount = parseFloat(element.textContent.replace('$', '')) || 0;
        grandTotal += amount;
    });
    
    document.getElementById('grandTotal').textContent = '$' + grandTotal.toFixed(2);
    
    // Update submit button state
    const submitBtn = document.getElementById('submitBtn');
    if (grandTotal > 0) {
        submitBtn.classList.remove('btn-secondary');
        submitBtn.classList.add('btn-primary');
        submitBtn.disabled = false;
    } else {
        submitBtn.classList.remove('btn-primary');
        submitBtn.classList.add('btn-secondary');
    }
}

// Open image in modal
function openImageModal(imageSrc) {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    document.getElementById('modalImage').src = imageSrc;
    modal.show();
}

// Form validation
document.getElementById('quotationForm').addEventListener('submit', function(e) {
    const rows = document.querySelectorAll('#items tbody tr');
    let hasValidItems = false;
    
    rows.forEach(function(row) {
        const drugName = row.querySelector('input[name="drug_name[]"]').value.trim();
        const quantity = parseFloat(row.querySelector('input[name="quantity[]"]').value);
        const unitPrice = parseFloat(row.querySelector('input[name="unit_price[]"]').value);
        
        if (drugName && quantity > 0 && unitPrice > 0) {
            hasValidItems = true;
        }
    });
    
    if (!hasValidItems) {
        e.preventDefault();
        alert('Please add at least one valid item with drug name, quantity, and unit price.');
        return false;
    }
});

// Initialize calculations on page load
document.addEventListener('DOMContentLoaded', function() {
    // Calculate initial totals
    calculateGrandTotal();
    
    // Add event listeners to existing inputs
    const inputs = document.querySelectorAll('input[name="quantity[]"], input[name="unit_price[]"]');
    inputs.forEach(function(input) {
        input.addEventListener('change', function() {
            calculateLineTotal(this);
        });
    });
});
</script>

<?php include BASE_PATH . '/app/views/partials/footer.php'; ?>
