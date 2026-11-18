<?php
if (file_exists(__DIR__ . '/auth.php')) {
    require_once __DIR__ . '/auth.php';
} else {
    require_once __DIR__ . '/../auth.php';
}
require_role('owner');   // hanya owner yang boleh menambah kasir

$pesan = '';
$error = '';
$nama = $email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $ulang    = $_POST['password2'] ?? '';

    if (!csrf_check()) {
        $error = 'Sesi tidak valid, silakan muat ulang halaman.';
    } elseif ($nama === '' || $email === '' || $password === '') {
        $error = 'Semua kolom wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } elseif (strlen($password) < 8) {
        $error = 'Kata sandi minimal 8 karakter.';
    } elseif ($password !== $ulang) {
        $error = 'Konfirmasi kata sandi tidak sama.';
    } else {
        try {
            db()->prepare(
                'INSERT INTO users (nama, email, password_hash, role) VALUES (?, ?, ?, ?)'
            )->execute([$nama, $email, password_hash($password, PASSWORD_DEFAULT), 'kasir']);
            $pesan = 'Kasir "' . $nama . '" berhasil ditambahkan.';
            $nama = $email = '';
        } catch (PDOException $ex) {
            // 23000 = pelanggaran UNIQUE (email sudah terdaftar)
            $error = $ex->getCode() === '23000'
                ? 'Email tersebut sudah terdaftar.'
                : 'Terjadi kesalahan saat menyimpan data.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah Kasir - Amanah Store</title>
<style>
  *{box-sizing:border-box}
  body{margin:0;background:#fbf8df;font-family:system-ui,sans-serif;padding:20px;color:#222}
  form{background:#fff;border-radius:18px;padding:22px;max-width:420px;margin:0 auto;box-shadow:0 2px 12px rgba(0,0,0,.06)}
  label{display:block;font-weight:600;font-size:14px;margin:12px 0 6px}
  input{width:100%;padding:11px 13px;border:1px solid #cfcfa8;border-radius:10px;font-size:15px}
  button{margin-top:18px;width:100%;padding:13px;border:0;border-radius:12px;background:#5c5f00;color:#fff;font-weight:700;font-size:15px;cursor:pointer}
  .ok{background:#e6f6e6;color:#145a14;padding:10px 12px;border-radius:10px}
  .err{background:#fde8e8;color:#a40000;padding:10px 12px;border-radius:10px}
</style>
</head>
<body>
<form method="post" action="tambah_kasir.php">
  <h2>Tambah Kasir</h2>
  <?php if ($pesan): ?><div class="ok"><?= e($pesan) ?></div><?php endif; ?>
  <?php if ($error): ?><div class="err"><?= e($error) ?></div><?php endif; ?>
  <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
  <label>Nama</label><input name="nama" value="<?= e($nama) ?>" required>
  <label>Email</label><input type="email" name="email" value="<?= e($email) ?>" required>
  <label>Kata Sandi (min. 8 karakter)</label><input type="password" name="password" required>
  <label>Ulangi Kata Sandi</label><input type="password" name="password2" required>
  <button type="submit">Simpan Kasir</button>
  <p><a href="../dashboard.php">&larr; Kembali ke dashboard</a></p>
</form>
</body>
</html>
