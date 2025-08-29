<?php
function csrf_token() {
    if (empty($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(16)); }
    return $_SESSION['csrf'];
}
function csrf_field() {
    $t = htmlspecialchars(csrf_token());
    echo "<input type='hidden' name='csrf' value='{$t}'>";
}
function csrf_verify() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'])) {
            http_response_code(400); die('Invalid CSRF token');
        }
    }
}
