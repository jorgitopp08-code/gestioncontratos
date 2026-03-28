<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_admin();
require_once __DIR__ . '/db.php';

$result = $conn->query(
    'SELECT id, cedula, nombre, fecha_ingreso, telefono, correo
     FROM empleados
     ORDER BY id DESC'
);

$employees = $result->fetch_all(MYSQLI_ASSOC);
$successMessage = get_flash('success');
$errorMessage = get_flash('error');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Empleados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Gestion de Empleados</span>
            <div class="d-flex align-items-center gap-2">
                <span class="text-white-50 small">Sesion: <?php echo e((string) $_SESSION['admin_user']); ?></span>
                <a href="crear.php" class="btn btn-success btn-sm">Nuevo empleado</a>
                <form action="logout.php" method="POST" class="m-0">
                    <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
                    <button type="submit" class="btn btn-outline-light btn-sm">Salir</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1 class="h3 mb-1">Empleados registrados</h1>
                <p class="text-muted mb-0">Consulta, edita y elimina la informacion del personal.</p>
            </div>
        </div>

        <?php if ($successMessage !== null): ?>
            <div class="alert alert-success" role="alert"><?php echo e($successMessage); ?></div>
        <?php endif; ?>

        <?php if ($errorMessage !== null): ?>
            <div class="alert alert-danger" role="alert"><?php echo e($errorMessage); ?></div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Cedula</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha de ingreso</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Correo</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($employees === []): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No hay empleados registrados.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($employees as $employee): ?>
                                    <tr>
                                        <td><?php echo e((string) $employee['cedula']); ?></td>
                                        <td><?php echo e((string) $employee['nombre']); ?></td>
                                        <td><?php echo e((string) $employee['fecha_ingreso']); ?></td>
                                        <td><?php echo e((string) $employee['telefono']); ?></td>
                                        <td><?php echo e((string) $employee['correo']); ?></td>
                                        <td class="text-end">
                                            <a href="editar.php?id=<?php echo (int) $employee['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <form action="eliminar.php" method="POST" class="d-inline" onsubmit="return confirm('Se eliminara este empleado.');">
                                                <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
                                                <input type="hidden" name="id" value="<?php echo (int) $employee['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
