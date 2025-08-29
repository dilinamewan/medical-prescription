<?php
class QuotationController {
    private PDO $db;
    private Quotation $quoteModel;
    private Prescription $prescModel;

    public function __construct(PDO $pdo) {
        $this->db = $pdo;
        $this->quoteModel = new Quotation($pdo);
        $this->prescModel = new Prescription($pdo);
    }

    public function createForm() {
        require_login(); require_role('pharmacy');
        $prescriptionId = (int)($_GET['prescription_id'] ?? 0);
        $p = $this->prescModel->findWithImages($prescriptionId);
        if (!$p) { http_response_code(404); die('Prescription not found'); }
        
        // Check if quotation already exists and show appropriate message
        $existingQuotation = $this->quoteModel->findByPrescription($prescriptionId);
        if ($existingQuotation) {
            $_SESSION['flash'] = 'Note: A quotation already exists for this prescription. Creating a new quotation will replace the existing one.';
        }
        
        include BASE_PATH . '/app/views/pharmacy/create_quotation.php';
    }

    public function create() {
        require_login(); require_role('pharmacy'); csrf_verify();
        $prescriptionId = (int)($_POST['prescription_id'] ?? 0);
        
        $drugs = $_POST['drug_name'] ?? [];
        $qtys  = $_POST['quantity'] ?? [];
        $prices= $_POST['unit_price'] ?? [];

        $items = [];
        for ($i=0; $i<count($drugs); $i++) {
            $dn = trim($drugs[$i]);
            $q  = (int)$qtys[$i];
            $up = (float)$prices[$i];
            if ($dn && $q>0 && $up>=0) {
                $items[] = ['drug_name'=>$dn,'quantity'=>$q,'unit_price'=>$up];
            }
        }
        if (!$items) {
            $_SESSION['flash'] = 'Please add at least one drug line';
            header('Location: ?action=pharmacy-create-quotation&prescription_id='.$prescriptionId); exit;
        }

        try {
            // Use updateOrCreate to handle existing quotations gracefully
            $qid = $this->quoteModel->updateOrCreate($prescriptionId, current_user()['id'], $items);
            $this->prescModel->setStatus($prescriptionId, 'quoted');

            // Email user about quotation
            $p = $this->prescModel->findWithImages($prescriptionId);
            $user = (new User($this->db))->findById((int)$p['user_id']);
            if ($user) {
                $link = htmlspecialchars((isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].'/index.php?action=view-quotation&prescription_id='.$prescriptionId);
                @send_mail(
                    $user['email'],
                    "Your quotation is ready",
                    "<p>Your quotation for prescription #{$prescriptionId} is ready.</p><p><a href=\"{$link}\">View quotation</a></p>"
                );
            }

            $_SESSION['flash'] = 'Quotation sent to user successfully';
            header('Location: ?action=pharmacy-prescriptions'); exit;
        } catch (PDOException $e) {
            // Log the error for debugging
            error_log("Quotation creation error: " . $e->getMessage());
            $_SESSION['flash'] = 'Error creating quotation. Please try again.';
            header('Location: ?action=pharmacy-create-quotation&prescription_id=' . $prescriptionId); 
            exit;
        }
    }

    public function viewForPharmacy() {
        require_login(); require_role('pharmacy');
        $prescriptionId = (int)($_GET['prescription_id'] ?? 0);
        $q = $this->quoteModel->findByPrescription($prescriptionId);
        include BASE_PATH . '/app/views/pharmacy/quotation_view.php';
    }
}
