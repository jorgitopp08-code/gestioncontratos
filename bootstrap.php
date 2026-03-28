<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit();
}

function e(?string $value): string
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function is_admin_logged_in(): bool
{
    return isset($_SESSION['admin_id'], $_SESSION['admin_user']);
}

function require_admin(): void
{
    if (!is_admin_logged_in()) {
        set_flash('error', 'Debes iniciar sesion para continuar.');
        redirect('index.php');
    }
}

function login_admin(array $admin): void
{
    session_regenerate_id(true);
    $_SESSION['admin_id'] = (int) $admin['id'];
    $_SESSION['admin_user'] = (string) $admin['usuario'];
}

function logout_admin(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            (bool) $params['secure'],
            (bool) $params['httponly']
        );
    }

    session_destroy();
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'][$type] = $message;
}

function get_flash(string $type): ?string
{
    if (!isset($_SESSION['flash'][$type])) {
        return null;
    }

    $message = (string) $_SESSION['flash'][$type];
    unset($_SESSION['flash'][$type]);

    return $message;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return (string) $_SESSION['csrf_token'];
}

function verify_csrf_or_fail(): void
{
    $requestToken = (string) ($_POST['csrf_token'] ?? '');
    $sessionToken = (string) ($_SESSION['csrf_token'] ?? '');

    if ($requestToken === '' || $sessionToken === '' || !hash_equals($sessionToken, $requestToken)) {
        http_response_code(400);
        exit('Solicitud no valida.');
    }
}

function old(string $key, string $default = ''): string
{
    return isset($_POST[$key]) ? trim((string) $_POST[$key]) : $default;
}
