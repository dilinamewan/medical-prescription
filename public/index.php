<?php
// Debug: Show errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/config.php';

$action = $_GET['action'] ?? 'home';

// Debug: Show what's happening
echo "<!-- Debug: Action = $action, User = " . (current_user() ? current_user()['name'] : 'none') . " -->";

$auth = new AuthController($pdo);
$pres = new PrescriptionController($pdo);
$phar = new PharmacyController($pdo);
$quot = new QuotationController($pdo);

switch ($action) {
  case 'home':
    if (!current_user()) { header('Location: ?action=login'); exit; }
    if (current_user()['role']==='user') { $pres->userDashboard(); }
    else { $phar->dashboard(); }
    break;

  // Auth
  case 'login': $auth->showLogin(); break;
  case 'login-post': $auth->login(); break;
  case 'register': $auth->showRegister(); break;
  case 'register-post': $auth->register(); break;
  case 'logout': $auth->logout(); break;

  // User prescriptions
  case 'upload': $pres->showUpload(); break;
  case 'upload-post': $pres->upload(); break;
  case 'my-prescriptions': $pres->myPrescriptions(); break;
  case 'view-quotation': $pres->viewQuotation(); break;
  case 'respond-quotation': $pres->respondQuotation(); break;

  // Pharmacy
  case 'pharmacy-prescriptions': $phar->listPrescriptions(); break;
  case 'pharmacy-create-quotation': $quot->createForm(); break;
  case 'pharmacy-create-quotation-post': $quot->create(); break;
  case 'pharmacy-view-quotation': $quot->viewForPharmacy(); break;

  default:
    http_response_code(404); echo "Not Found";
}