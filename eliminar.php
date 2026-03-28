<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_admin();
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('dashboard.php');
}

verify_csrf_or_fail();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    set_flash('error', 'Empleado no valido.');
    redirect('dashboard.php');
}

$statement = $conn->prepare('DELETE FROM empleados WHERE id = ?');
$employeeId = (int) $id;
$statement->bind_param('i', $employeeId);
$statement->execute();

if ($statement->affected_rows > 0) {
    set_flash('success', 'Empleado eliminado correctamente.');
} else {
    set_flash('error', 'El empleado ya no existe.');
}

redirect('dashboard.php');
