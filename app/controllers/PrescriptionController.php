<?php
class PrescriptionController {
    private PDO $db;
    private Prescription $prescModel;
    private Quotation $quoteModel;
    public function __construct(PDO $pdo) {
        $this->db = $pdo;
        $this->prescModel = new Prescription($pdo);
        $this->quoteModel = new Quotation($pdo);
    }

    public function userDashboard() {
        require_login(); require_role('user');
        include BASE_PATH . '/app/views/user/dashboard.php';
    }

    public function showUpload() {
        require_login(); require_role('user');
        include BASE_PATH . '/app/views/user/upload.php';
    }

    private function handleUploads(int $prescriptionId): void {
        if (empty($_FILES['images'])) return;
        $files = $_FILES['images'];
        $count = is_array($files['name']) ? count($files['name']) : 0;
        if ($count > 5) $count = 5;
        for ($i=0; $i<$count; $i++) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) continue;
            $tmp = $files['tmp_name'][$i];
            $ext = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg','jpeg','png','gif'])) continue;
            $name = 'rx_' . $prescriptionId . '_' . uniqid() . '.' . $ext;
            $dest = UPLOAD_PATH . '/' . $name;
            if (move_uploaded_file($tmp, $dest)) {
                $rel = '/medical-prescription/public/uploads/' . $name;
                $this->prescModel->addImage($prescriptionId, $rel);
            }
        }
    }

    public function upload() {
        require_login(); require_role('user'); csrf_verify();
        $note = trim($_POST['note'] ?? '');
        $addr = trim($_POST['delivery_address'] ?? '');
        $slot = trim($_POST['delivery_slot'] ?? '');
        if (!$addr || !$slot) {
            $_SESSION['flash'] = 'Delivery address and time slot are required';
            header('Location: ?action=upload'); exit;
        }
        $pid = $this->prescModel->create(current_user()['id'], $note, $addr, $slot);
        $this->handleUploads($pid);
        $_SESSION['flash'] = 'Prescription uploaded';
        header('Location: ?action=my-prescriptions'); exit;
    }

    public function myPrescriptions() {
        require_login(); require_role('user');
        $items = $this->prescModel->forUser(current_user()['id']);
        include BASE_PATH . '/app/views/user/prescriptions.php';
    }

    public function viewQuotation() {
        require_login(); require_role('user');
        $prescriptionId = (int)($_GET['prescription_id'] ?? 0);
        
        // Debug: Check if prescription belongs to current user
        $prescription = $this->prescModel->forUser(current_user()['id']);
        $prescriptionIds = array_column($prescription, 'id');
        
        if (!in_array($prescriptionId, $prescriptionIds)) {
            $_SESSION['flash'] = 'Prescription not found or access denied';
            header('Location: ?action=my-prescriptions'); exit;
        }
        
        $q = $this->quoteModel->findByPrescription($prescriptionId);
        // Debug: Log quotation data
        error_log("Quotation data: " . json_encode($q));
        
        include BASE_PATH . '/app/views/user/quotation_view.php';
    }

    public function respondQuotation() {
        require_login(); require_role('user'); csrf_verify();
        $prescriptionId = (int)($_POST['prescription_id'] ?? 0);
        $action = $_POST['action_type'] ?? '';
        $q = $this->quoteModel->findByPrescription($prescriptionId);
        if (!$q) { http_response_code(404); die('Quotation not found'); }

        $status = ($action === 'accept') ? 'accepted' : 'rejected';
        $this->quoteModel->setStatus($q['id'], $status);
        (new Prescription($this->db))->setStatus($prescriptionId, $status);

        // Notify pharmacy via email (optional dashboard also shows status)
        $pharm = (new User($this->db))->findById((int)$q['pharmacy_user_id']);
        if ($pharm) {
            @send_mail(
                $pharm['email'],
                "Quotation {$status}",
                "<p>User has <strong>{$status}</strong> the quotation for prescription #{$prescriptionId}.</p>"
            );
        }

        $_SESSION['flash'] = "You {$status} the quotation.";
        header('Location: ?action=my-prescriptions'); exit;
    }
}
