<?php
function current_user() {
    return $_SESSION['user'] ?? null;
}
function require_login() {
    if (!current_user()) {
        header('Location: ?action=login'); exit;
    }
}
function require_role(string $role) {
    $u = current_user();
    // Debug: Show what we're checking
    echo "<!-- Debug: Required role = $role, User role = " . ($u['role'] ?? 'none') . " -->";
    if (!$u || $u['role'] !== $role) {
        http_response_code(403); 
        echo "Forbidden - You need role '$role' but have '" . ($u['role'] ?? 'none') . "'"; 
        exit;
    }
}
