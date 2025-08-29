<?php
class PharmacyController {
    private PDO $db;
    private Prescription $prescModel;
    public function __construct(PDO $pdo) {
        $this->db = $pdo;
        $this->prescModel = new Prescription($pdo);
    }
    public function dashboard() {
        require_login(); 
        // Debug: Show current user info
        echo "<!-- Debug: Current user role = " . current_user()['role'] . " -->";
        require_role('pharmacy');
        include BASE_PATH . '/app/views/pharmacy/dashboard.php';
    }
    public function listPrescriptions() {
        require_login(); require_role('pharmacy');
        $items = $this->prescModel->all();
        include BASE_PATH . '/app/views/pharmacy/prescriptions.php';
    }
}
