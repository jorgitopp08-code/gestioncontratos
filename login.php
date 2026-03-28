<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/db.php';

if (is_admin_logged_in()) {
    redirect('dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}

verify_csrf_or_fail();

$usuario = trim((string) ($_POST['usuario'] ?? ''));
$pin = trim((string) ($_POST['pin'] ?? ''));

if ($usuario === '' || $pin === '') {
    set_flash('error', 'Debes completar usuario y PIN.');
    redirect('index.php');
}

$statement = $conn->prepare('SELECT id, usuario, pin FROM admin WHERE usuario = ? LIMIT 1');
$statement->bind_param('s', $usuario);
$statement->execute();

$admin = $statement->get_result()->fetch_assoc();

if (!$admin) {
    set_flash('error', 'Credenciales incorrectas.');
    redirect('index.php');
}

$storedPin = (string) $admin['pin'];

if (!hash_equals($storedPin, $pin)) {
    set_flash('error', 'Credenciales incorrectas.');
    redirect('index.php');
}

login_admin($admin);
set_flash('success', 'Sesion iniciada correctamente.');
redirect('dashboard.php');
