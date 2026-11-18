<?php
// ============================================================
// Pemeriksaan login & hak akses. Pakai di halaman yang dilindungi:
//   require 'auth.php';
//   require_login();                // semua user yang sudah login
//   require_role('owner');          // khusus owner
// ============================================================
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
} else {
    require_once __DIR__ . '/../config.php';
}

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function require_login(): void
{
    if (!current_user()) {
        $loginUrl = file_exists('login.php') ? 'login.php' : '../login.php';
        header('Location: ' . $loginUrl);
        exit;
    }
}

function require_role(string $role): void
{
    require_login();
    if (current_user()['role'] !== $role) {
        http_response_code(403);
        exit('Akses ditolak: halaman ini khusus ' . e($role) . '.');
    }
}
