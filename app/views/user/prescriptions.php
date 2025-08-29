<?php include BASE_PATH . '/app/views/partials/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-file-text me-2"></i>My Prescriptions
    </h1>
    <div>
        <a href="?action=upload" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Upload New Prescription
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php if (empty($items)): ?>
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                    <h5>No Prescriptions Found</h5>
                    <p class="text-muted">You haven't uploaded any prescriptions yet.</p>
                    <a href="?action=upload" class="btn btn-primary">
                        <i class="bi bi-cloud-upload me-2"></i>Upload Your First Prescription
                    </a>
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
                                        <i class="bi bi-clock me-1"></i>Delivery Slot
                                    </th>
                                    <th scope="col">
                                        <i class="bi bi-flag me-1"></i>Status
                                    </th>
                                    <th scope="col">
                                        <i class="bi bi-calendar me-1"></i>Uploaded
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
                                            <i class="bi bi-clock-history me-2 text-muted"></i>
                                            <?= htmlspecialchars($p['delivery_slot']) ?>
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
                                        <td class="text-muted">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            <?= date('M j, Y', strtotime($p['created_at'] ?? 'now')) ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="?action=view-quotation&prescription_id=<?= (int)$p['id'] ?>" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye me-1"></i>View Quotation
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include BASE_PATH . '/app/views/partials/footer.php'; ?>
