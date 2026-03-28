<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_admin();
require_once __DIR__ . '/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf_or_fail();

    $cedula = trim((string) ($_POST['cedula'] ?? ''));
    $nombre = trim((string) ($_POST['nombre'] ?? ''));
    $fechaIngreso = trim((string) ($_POST['fecha_ingreso'] ?? ''));
    $telefono = trim((string) ($_POST['telefono'] ?? ''));
    $correo = trim((string) ($_POST['correo'] ?? ''));

    if ($cedula === '' || $nombre === '' || $fechaIngreso === '') {
        $errors[] = 'Los campos marcados con * son obligatorios.';
    }

    if ($correo !== '' && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Debes ingresar un correo valido.';
    }

    if ($errors === []) {
        $statement = $conn->prepare(
            'INSERT INTO empleados (cedula, nombre, fecha_ingreso, telefono, correo)
             VALUES (?, ?, ?, ?, ?)'
        );
        $statement->bind_param('sssss', $cedula, $nombre, $fechaIngreso, $telefono, $correo);

        try {
            $statement->execute();
            set_flash('success', 'Empleado creado correctamente.');
            redirect('dashboard.php');
        } catch (mysqli_sql_exception $exception) {
            if ((int) $exception->getCode() === 1062) {
                $errors[] = 'Ya existe un empleado con esa cedula.';
            } else {
                error_log('Error creating employee: ' . $exception->getMessage());
                $errors[] = 'No fue posible guardar el empleado.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Empleado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm col-lg-6 mx-auto">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-1">Nuevo empleado</h1>
                        <p class="text-muted mb-0">Completa los datos para registrar al empleado.</p>
                    </div>
                    <a href="dashboard.php" class="btn btn-outline-secondary">Volver</a>
                </div>

                <?php if ($errors !== []): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($errors as $error): ?>
                            <div><?php echo e($error); ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" novalidate>
                    <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">

                    <div class="mb-3">
                        <label for="cedula" class="form-label">Cedula *</label>
                        <input type="text" id="cedula" name="cedula" class="form-control" required value="<?php echo e(old('cedula')); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required value="<?php echo e(old('nombre')); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="fecha_ingreso" class="form-label">Fecha de ingreso *</label>
                        <input type="date" id="fecha_ingreso" name="fecha_ingreso" class="form-control" required value="<?php echo e(old('fecha_ingreso')); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo e(old('telefono')); ?>">
                    </div>

                    <div class="mb-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" id="correo" name="correo" class="form-control" value="<?php echo e(old('correo')); ?>">
                    </div>

                    <button class="btn btn-success w-100">Guardar empleado</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
