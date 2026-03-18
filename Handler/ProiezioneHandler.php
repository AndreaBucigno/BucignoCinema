<?php
require_once __DIR__ . "/../config/db.php";
session_start();
switch ($_POST['action'] ?? '') {
    case 'add':
        try {
            $pdo->prepare("INSERT INTO proiezione (data_ora, id_spettacolo, id_sala) VALUES (:data_ora,:id_spettacolo,:id_sala)")
                ->execute([':data_ora' => $_POST['data_ora'], ':id_spettacolo' => $_POST['id_spettacolo'], ':id_sala' => $_POST['id_sala']]);
        } catch (PDOException $e) {
            $message = "Errore nell'inserimento della proiezione";
            appLog(40, $message);
        }
        break;
    case 'edit':
        try {
            $pdo->prepare("UPDATE proiezione SET data_ora=:data_ora,id_spettacolo=:id_spettacolo,id_sala=:id_sala WHERE id=:id")
                ->execute([':id' => $_POST['id'], ':data_ora' => $_POST['data_ora'], ':id_spettacolo' => $_POST['id_spettacolo'], ':id_sala' => $_POST['id_sala']]);
        } catch (PDOException $e) {
            $message = "Errore nella modifica della proiezione";
            appLog(40, $message);
        }
        break;
}
header("Location: ../Sub_Admin/admin-proiezioni.php");
exit;