<?php
require_once __DIR__ . "/../config/db.php";

switch ($_POST['action'] ?? '') {
    case 'add':
        try {
            $pdo->prepare("INSERT INTO regista (nome, cognome, data_nascita) VALUES (:nome, :cognome, :data_nascita)")
                ->execute([':nome' => $_POST['nome'], ':cognome' => $_POST['cognome'], ':data_nascita' => $_POST['data_nascita'] ?: null]);
        } catch (PDOException $e) {
            $message = "Errore nell'inserimento del regista";
            appLog(40, $message);
        }
        break;
    case 'edit':
        try {
            $pdo->prepare("UPDATE regista SET nome=:nome, cognome=:cognome, data_nascita=:data_nascita WHERE id=:id")
                ->execute([':id' => $_POST['id'], ':nome' => $_POST['nome'], ':cognome' => $_POST['cognome'], ':data_nascita' => $_POST['data_nascita'] ?: null]);
        } catch (PDOException $e) {
            $message = "Errore nella modifica del regista";
            appLog(40, $message);
        }
        break;
}
header("Location: ../Sub_Admin/admin-registi.php");
exit;