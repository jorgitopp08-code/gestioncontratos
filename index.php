<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

if (is_admin_logged_in()) {
    redirect('dashboard.php');
}

$errorMessage = get_flash('error');
$successMessage = get_flash('success');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingreso de Administracion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(circle at top, rgba(255, 255, 255, 0.28), transparent 35%),
                linear-gradient(135deg, #0d6efd 0%, #20c997 100%);
        }

        .login-card {
            width: min(100%, 380px);
            border: 0;
            border-radius: 18px;
        }
    </style>
</head>
<body>
    <div class="card login-card shadow-lg p-4">
        <div class="text-center mb-4">
            <div class="mb-3">
                <span class="fs-1 text-primary"><i class="bi bi-shield-lock"></i></span>
            </div>
            <h1 class="h3 mb-1">Gestion de Empleados</h1>
            <p class="text-muted mb-0">Acceso para administradores</p>
        </div>

        <?php if ($errorMessage !== null): ?>
            <div class="alert alert-danger" role="alert"><?php echo e($errorMessage); ?></div>
        <?php endif; ?>

        <?php if ($successMessage !== null): ?>
            <div class="alert alert-success" role="alert"><?php echo e($successMessage); ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST" autocomplete="off">
            <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" id="usuario" name="usuario" class="form-control" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="pin" class="form-label">PIN</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input type="password" id="pin" name="pin" class="form-control" required>
                </div>
            </div>

            <button class="btn btn-primary w-100">Ingresar</button>
        </form>
    </div>
</body>
</html>
