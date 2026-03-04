<?php

require_once __DIR__ . "/config/db.php";


$title      = 'Dashboard';
$activePage = 'dashboard';
$body = '<div class="container-fluid bg-dark text-white p-4">
    <h1 class="mb-4">Benvenuto, ' . ($_SESSION['admin_name'] ?? 'Admin') . '!</h1>
    <p>Qui puoi gestire tutti gli aspetti del tuo cinema, dalle programmazioni agli utenti.</p>
</div>
';

$template = file_get_contents("inc/admin_page.inc.php");
$template = str_replace("{{title}}", $title, $template);
$template = str_replace("{{body}}", $body, $template);
echo $template;
