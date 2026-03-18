<?php
require_once __DIR__ . '/config/db.php';
session_start();
$utenti = $pdo->query("SELECT id, password FROM utenti")->fetchAll(PDO::FETCH_ASSOC);

foreach ($utenti as $u) {
    $hash = password_hash($u['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE utenti SET password_hash = :hash WHERE id = :id");
    $stmt->execute([':hash' => $hash, ':id' => $u['id']]);
}
$message = "Ho fatto l hash a: " . count($utenti) . " utenti.";
echo $message;
appLog($10,$message);