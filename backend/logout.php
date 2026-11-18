<?php
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
} else {
    require_once __DIR__ . '/../config.php';
}

// Logout lewat POST + token CSRF (bukan link biasa) agar tidak bisa dipicu situs lain.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_check()) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}
header('Location: ../login.php');
exit;
