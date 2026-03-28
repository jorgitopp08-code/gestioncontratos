<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(is_admin_logged_in() ? 'dashboard.php' : 'index.php');
}

verify_csrf_or_fail();
logout_admin();
redirect('index.php');
