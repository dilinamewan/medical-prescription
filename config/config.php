<?php
// Database configuration and app settings
session_start();

// Define base path
define('BASE_PATH', dirname(__DIR__));
define('UPLOAD_PATH', BASE_PATH . '/public/uploads');

// Database configuration
$host = 'localhost';
$dbname = 'meds'; // Change this to your actual database name
$username = 'root';
$password = ''; // Default XAMPP MySQL password is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Include helper files
require_once BASE_PATH . '/helpers/auth.php';
require_once BASE_PATH . '/helpers/csrf.php';
require_once BASE_PATH . '/helpers/mailer.php';

// Include models
require_once BASE_PATH . '/app/models/BaseModel.php';
require_once BASE_PATH . '/app/models/User.php';
require_once BASE_PATH . '/app/models/Prescription.php';
require_once BASE_PATH . '/app/models/PrescriptionImage.php';
require_once BASE_PATH . '/app/models/Quotation.php';
require_once BASE_PATH . '/app/models/QuotationItem.php';

// Include controllers
require_once BASE_PATH . '/app/controllers/AuthController.php';
require_once BASE_PATH . '/app/controllers/PrescriptionController.php';
require_once BASE_PATH . '/app/controllers/PharmacyController.php';
require_once BASE_PATH . '/app/controllers/QuotationController.php';
