<?php include BASE_PATH . '/app/views/partials/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-receipt me-2"></i>Quotation Details
    </h1>
    <div>
        <a href="?action=pharmacy-prescriptions" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Prescriptions
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php if (!$q): ?>
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-exclamation-circle display-1 text-warning mb-3"></i>
                    <h5>No Quotation Created</h5>
                    <p class="text-muted">No quotation has been created for this prescription yet.</p>
                    <a href="?action=pharmacy-prescriptions" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Prescriptions
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-receipt me-2"></i>Quotation Summary
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
                                        <i class="bi bi-calculator me-1"></i>Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($q['items'] as $index => $item): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-secondary me-2"><?= $index + 1 ?></span>
                                                <strong><?= htmlspecialchars($item['drug_name']) ?></strong>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-info"><?= (int)$item['quantity'] ?></span>
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
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold fs-5">
                                        <i class="bi bi-calculator-fill me-2 text-primary"></i>Grand Total:
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-success fs-5 p-2">
                                            $<?= number_format((float)$q['total'], 2) ?>
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Status Section -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="card-title">
                                        <i class="bi bi-flag-fill me-2"></i>Quotation Status
                                    </h6>
                                    <?php
                                    $statusClass = match($q['status']) {
                                        'sent' => 'bg-info',
                                        'accepted' => 'bg-success',
                                        'rejected' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                    $statusIcon = match($q['status']) {
                                        'sent' => 'bi-send',
                                        'accepted' => 'bi-check-circle',
                                        'rejected' => 'bi-x-circle',
                                        default => 'bi-question-circle'
                                    };
                                    ?>
                                    <span class="badge <?= $statusClass ?> fs-6 p-3">
                                        <i class="<?= $statusIcon ?> me-2"></i>
                                        <?= ucfirst(htmlspecialchars($q['status'])) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="card-title">
                                        <i class="bi bi-calendar-check me-2"></i>Created Date
                                    </h6>
                                    <span class="text-muted">
                                        <i class="bi bi-clock me-2"></i>
                                        <?= date('M j, Y g:i A', strtotime($q['created_at'] ?? 'now')) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Notes Section -->
                    <?php if (!empty($q['notes'])): ?>
                        <div class="alert alert-info mt-4">
                            <h6>
                                <i class="bi bi-sticky me-2"></i>Additional Notes
                            </h6>
                            <p class="mb-0"><?= nl2br(htmlspecialchars($q['notes'])) ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include BASE_PATH . '/app/views/partials/footer.php'; ?>
