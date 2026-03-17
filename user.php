<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
require_once __DIR__ . "/config/db.php";
try{
$stmt = $pdo->prepare("SELECT * FROM utenti WHERE id = :id");
$stmt->execute([':id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    die("Errore nella connessione al database: " . $e->getMessage());
}



$title      = 'Area Personale';
$activePage = 'profilo';

$body = "
<div class='container text-white py-4 text-center align-item-center'>
<h2 class='sezione-titolo mb-4'>Benvenuto, " . htmlspecialchars($_SESSION['user_name'] ?? 'Utente') . "!</h2>
<p style='color:var(--testo-muted);'>Questa è la tua area personale.</p>
<br>

<div style='background-color:var(--grigio-1); border:1px solid var(--grigio-3); border-radius:8px; padding:24px; max-width:500px; margin:24px auto; display:flex; flex-direction:column; align-items:center; gap:16px;'>
    <img src='https://randomuser.me/api/portraits/lego/8.jpg' class='rounded-circle img-thumbnail' alt='Profile Picture' style='width:100px; height:100px;'>
    <h5 style='color:var(--testo); border-bottom:1px solid var(--grigio-3); padding-bottom:12px; margin-bottom:16px; width:100%; text-align:center;'>
        Informazioni Account
    </h5>
    <p style='color:var(--testo-muted); width:100%;'><span style='color:var(--testo);'>Nome:</span> {$user['nome']} {$user['cognome']}</p>
    <p style='color:var(--testo-muted); width:100%;'><span style='color:var(--testo);'>Email:</span> {$user['email']}</p>
    <p style='color:var(--testo-muted); width:100%;'><span style='color:var(--testo);'>Ruolo:</span> {$user['ruolo']}</p>
    <p style='color:var(--testo-muted); width:100%;'><span style='color:var(--testo);'>Data nascita:</span> " . ($user['data_nascita'] ?? '—') . "</p>
</div>
</div>
";

$template = file_get_contents("inc/user_page.inc.php");
$template = str_replace("{{title}}",  $title,  $template);
$template = str_replace("{{body}}",   $body,   $template);
$voci = ['profilo', 'prenotazioni'];
foreach ($voci as $voce) {
    $template = str_replace("{{active_$voce}}", $activePage === $voce ? 'active' : '', $template);
}
echo $template;