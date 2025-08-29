<?php include BASE_PATH . '/app/views/partials/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-receipt me-2"></i>Quotation Details
    </h1>
    <div>
        <a href="?action=my-prescriptions" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to My Prescriptions
        </a>
    </div>
</div>

<?php 
// Debug: Show quotation status
echo "<!-- Debug: Quotation exists = " . ($q ? 'YES' : 'NO') . " -->";
if ($q) {
    echo "<!-- Debug: Quotation status = " . $q['status'] . ", Total = " . $q['total'] . " -->";
}
?>

<div class="row">
    <div class="col-12">
        <?php if (!$q): ?>
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-hourglass-split display-1 text-info mb-3"></i>
                    <h5>Quotation Pending</h5>
                    <div class="alert alert-info mt-3">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>No quotation available yet.</strong> The pharmacy hasn't created a quotation for this prescription.
                    </div>
                    <p class="text-muted">Please wait while the pharmacy reviews your prescription and prepares a quotation.</p>
                    <a href="?action=my-prescriptions" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-2"></i>Back to My Prescriptions
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-check-circle me-2"></i>Your Quotation is Ready
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Quotation Items -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">
                                        <i class="bi bi-capsule me-1"></i>Medicine
                                    </th>
                                    <th scope="col" class="text-center">
                                        <i class="bi bi-hash me-1"></i>Quantity
                                    </th>
                                    <th scope="col" class="text-end">
                                        <i class="bi bi-currency-dollar me-1"></i>Unit Price
                                    </th>
                                    <th scope="col" class="text-end">
                                        <i class="bi bi-calculator me-1"></i>Line Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($q['items'] as $index => $item): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-secondary me-2"><?= $index + 1 ?></span>
                                                <div>
                                                    <strong><?= htmlspecialchars($item['drug_name']) ?></strong>
                                                    <br>
                                                    <small class="text-muted">Medicine</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-info fs-6"><?= (int)$item['quantity'] ?></span>
                                        </td>
                                        <td class="text-end">
                                            <span class="text-success fw-bold">$<?= number_format((float)$item['unit_price'], 2) ?></span>
                                        </td>
                                        <td class="text-end">
                                            <span class="text-primary fw-bold">$<?= number_format((float)$item['line_total'], 2) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-success">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold fs-4">
                                        <i class="bi bi-calculator-fill me-2 text-primary"></i>Total Amount:
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-success fs-4 p-3">
                                            $<?= number_format((float)$q['total'], 2) ?>
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Action Section -->
                    <?php if ($q['status'] === 'sent'): ?>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    <strong>Action Required:</strong> Please review the quotation above and choose your action.
                                </div>
                                
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="bi bi-hand-thumbs-up me-2"></i>What would you like to do?
                                        </h6>
                                        
                                        <form method="post" action="?action=respond-quotation" class="d-flex gap-3 justify-content-center">
                                            <?php csrf_field(); ?>
                                            <input type="hidden" name="prescription_id" value="<?= (int)$q['prescription_id'] ?>">
                                            
                                            <button name="action_type" value="accept" type="submit" 
                                                    class="btn btn-success btn-lg px-4">
                                                <i class="bi bi-check-lg me-2"></i>Accept Quotation
                                            </button>
                                            
                                            <button name="action_type" value="reject" type="submit" 
                                                    class="btn btn-danger btn-lg px-4">
                                                <i class="bi bi-x-lg me-2"></i>Reject Quotation
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">
                                            <i class="bi bi-flag-fill me-2"></i>Quotation Status
                                        </h6>
                                        <?php
                                        $statusClass = match($q['status']) {
                                            'accepted' => 'bg-success',
                                            'rejected' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                        $statusIcon = match($q['status']) {
                                            'accepted' => 'bi-check-circle-fill',
                                            'rejected' => 'bi-x-circle-fill',
                                            default => 'bi-question-circle'
                                        };
                                        $statusMessage = match($q['status']) {
                                            'accepted' => 'You have accepted this quotation. The pharmacy will prepare your medicines.',
                                            'rejected' => 'You have rejected this quotation.',
                                            default => 'Status: ' . ucfirst($q['status'])
                                        };
                                        ?>
                                        <span class="badge <?= $statusClass ?> fs-5 p-3 mb-3">
                                            <i class="<?= $statusIcon ?> me-2"></i>
                                            <?= ucfirst(htmlspecialchars($q['status'])) ?>
                                        </span>
                                        <p class="text-muted mb-0"><?= $statusMessage ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Additional Information -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card border-info">
                                <div class="card-body text-center">
                                    <i class="bi bi-calendar-check text-info mb-2 fs-4"></i>
                                    <h6 class="card-title">Quotation Date</h6>
                                    <small class="text-muted">
                                        <?= date('M j, Y g:i A', strtotime($q['created_at'] ?? 'now')) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <i class="bi bi-building text-primary mb-2 fs-4"></i>
                                    <h6 class="card-title">Pharmacy</h6>
                                    <small class="text-muted">Professional Medical Services</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include BASE_PATH . '/app/views/partials/footer.php'; ?>
