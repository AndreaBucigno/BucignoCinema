<?php
require_once __DIR__ . "/../config/db.php";
switch ($_POST['action'] ?? '') {
    case 'add':
        $pdo->prepare("INSERT INTO cliente (nome, cognome, data_nascita) VALUES (:nome,:cognome,:data_nascita)")
            ->execute([':nome' => $_POST['nome'], ':cognome' => $_POST['cognome'], ':data_nascita' => $_POST['data_nascita'] ?: null]);
        break;
    case 'edit':
        $pdo->prepare("UPDATE cliente SET nome=:nome,cognome=:cognome,data_nascita=:data_nascita WHERE id=:id")
            ->execute([':id' => $_POST['id'], ':nome' => $_POST['nome'], ':cognome' => $_POST['cognome'], ':data_nascita' => $_POST['data_nascita'] ?: null]);
        break;
}
header("Location: ../admin-clienti.php");
exit;
