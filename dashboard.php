<?php
require_once __DIR__ . '/backend/auth.php';
require_login();
$u = current_user();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard - Amanah Store</title>
<style>
  body{margin:0;background:#fbf8df;font-family:system-ui,sans-serif;padding:20px;color:#222}
  .card{background:#fff;border-radius:18px;padding:20px;max-width:480px;margin:0 auto;box-shadow:0 2px 12px rgba(0,0,0,.06)}
  a,button.link{color:#5c5f00;font-weight:600}
  button{padding:10px 16px;border:0;border-radius:10px;background:#5c5f00;color:#fff;font-weight:700;cursor:pointer}
</style>
</head>
<body>
<div class="card">
  <h2>Selamat datang, <?= e($u['nama']) ?>!</h2>
  <p>Peran: <b><?= e($u['role']) ?></b></p>
  <p>(Halaman ini placeholder. Ganti dengan dashboard Anda.)</p>
  <?php if ($u['role'] === 'owner'): ?>
    <p><a href="backend/tambah_kasir.php">+ Tambah Kasir</a></p>
  <?php endif; ?>
  <form method="post" action="backend/logout.php">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
    <button type="submit">Keluar</button>
  </form>
</div>
</body>
</html>
