<?php include BASE_PATH . '/app/views/partials/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-file-medical me-2"></i>All Prescriptions
    </h1>
    <div>
        <span class="badge bg-info fs-6">
            <i class="bi bi-list-ul me-1"></i><?= count($items) ?> Total
        </span>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php if (empty($items)): ?>
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                    <h5>No Prescriptions Available</h5>
                    <p class="text-muted">No prescriptions have been uploaded by patients yet.</p>
                </div>
            </div>
        <?php else: ?>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">
                                        <i class="bi bi-hash me-1"></i>ID
                                    </th>
                                    <th scope="col">
                                        <i class="bi bi-person me-1"></i>Patient
                                    </th>
                                    <th scope="col">
                                        <i class="bi bi-geo-alt me-1"></i>Delivery Address
                                    </th>
                                    <th scope="col">
                                        <i class="bi bi-clock me-1"></i>Time Slot
                                    </th>
                                    <th scope="col">
                                        <i class="bi bi-flag me-1"></i>Status
                                    </th>
                                    <th scope="col" class="text-center">
                                        <i class="bi bi-gear me-1"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $p): ?>
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">#<?= (int)$p['id'] ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person-circle text-muted me-2"></i>
                                                <strong><?= htmlspecialchars($p['user_name']) ?></strong>
                                            </div>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <i class="bi bi-house me-1"></i>
                                                <?= htmlspecialchars($p['delivery_address'] ?? 'Not specified') ?>
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                <i class="bi bi-clock me-1"></i>
                                                <?= htmlspecialchars($p['delivery_slot']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            $statusClass = match($p['status']) {
                                                'uploaded' => 'bg-info',
                                                'quoted' => 'bg-warning text-dark',
                                                'accepted' => 'bg-success',
                                                'rejected' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                            ?>
                                            <span class="badge <?= $statusClass ?>">
                                                <?= ucfirst(htmlspecialchars($p['status'])) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="?action=pharmacy-create-quotation&prescription_id=<?= (int)$p['id'] ?>" 
                                                   class="btn btn-primary" 
                                                   title="Create/Update Quotation">
                                                    <i class="bi bi-plus-lg"></i>
                                                </a>
                                                <a href="?action=pharmacy-view-quotation&prescription_id=<?= (int)$p['id'] ?>" 
                                                   class="btn btn-outline-secondary"
                                                   title="View Quotation">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Tips:</strong> Click the <i class="bi bi-plus-lg"></i> button to create a new quotation, 
                        or <i class="bi bi-eye"></i> to view existing quotations for each prescription.
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include BASE_PATH . '/app/views/partials/footer.php'; ?>
