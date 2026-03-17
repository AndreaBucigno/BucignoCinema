<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ./login.php");
    exit;
}
require_once __DIR__ . '/config/db.php';


$title      = 'Dashboard';
$activePage = 'dashboard';
$body = '<div class="container-fluid bg-dark text-white p-4">
    <h1 class="mb-4">Benvenuto, ' . ($_SESSION['admin_name'] ?? 'Admin') . '!</h1>
    <p>Utilizza il menu laterale per gestire interamente il tuo cinema.</p>
</div>
';

$template = file_get_contents("inc/admin_page.inc.php");
$template = str_replace("{{active_Home}}", $activePage == 'dashboard' ? 'active' : '', $template);
$template = str_replace("{{admin_name}}", $_SESSION['admin_name'], $template);
$template = str_replace("{{title}}", $title, $template);
$template = str_replace("{{body}}", $body, $template);
echo $template;
