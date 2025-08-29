<?php
class AuthController {
    private PDO $db;
    private User $userModel;
    public function __construct(PDO $pdo) {
        $this->db = $pdo;
        $this->userModel = new User($pdo);
    }

    public function showLogin() {
        include BASE_PATH . '/app/views/auth/login.php';
    }

    public function login() {
        csrf_verify();
        $email = trim($_POST['email'] ?? '');
        $pass  = $_POST['password'] ?? '';
        $u = $this->userModel->findByEmail($email);
        
        // Debug: Log login attempt
        error_log("Login attempt for: $email");
        if ($u) {
            error_log("User found: " . json_encode($u));
        } else {
            error_log("No user found for email: $email");
        }
        
        if (!$u || !password_verify($pass, $u['password_hash'])) {
            $_SESSION['flash'] = 'Invalid credentials';
            header('Location: ?action=login'); exit;
        }
        
        $_SESSION['user'] = [
            'id'=>$u['id'],'name'=>$u['name'],'email'=>$u['email'],'role'=>$u['role']
        ];
        
        // Debug: Log successful login
        error_log("Login successful for: " . $u['name'] . " (Role: " . $u['role'] . ")");
        
        header('Location: ?'); exit;
    }

    public function showRegister() {
        include BASE_PATH . '/app/views/auth/register.php';
    }

    public function register() {
        csrf_verify();
        $data = [
            'name'=>trim($_POST['name'] ?? ''),
            'email'=>trim($_POST['email'] ?? ''),
            'password'=>$_POST['password'] ?? '',
            'address'=>trim($_POST['address'] ?? ''),
            'contact_no'=>trim($_POST['contact_no'] ?? ''),
            'dob'=>$_POST['dob'] ?? null,
            'role'=>'user'
        ];
        if (!$data['name'] || !$data['email'] || !$data['password']) {
            $_SESSION['flash'] = 'Please fill required fields';
            header('Location: ?action=register'); exit;
        }
        try {
            $this->userModel->create($data);
        } catch (Throwable $e) {
            $_SESSION['flash'] = 'Registration failed: ' . $e->getMessage();
            header('Location: ?action=register'); exit;
        }
        $_SESSION['flash'] = 'Registration successful. Please login.';
        header('Location: ?action=login'); exit;
    }

    public function logout() {
        session_destroy();
        header('Location: ?action=login'); exit;
    }
}
