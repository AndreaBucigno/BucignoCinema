<?php
require_once __DIR__ . "/../config/db.php";

switch ($_POST['action'] ?? '') {
    case 'add':
        try {
            $pdo->prepare("INSERT INTO prenotazione (data_operazione, numero_biglietti, costo, id_cliente, id_proiezione) VALUES (:data_operazione,:numero_biglietti,:costo,:id_cliente,:id_proiezione)")
                ->execute([
                    ':data_operazione'  => $_POST['data_operazione'] ?: null,
                    ':numero_biglietti' => $_POST['numero_biglietti'],
                    ':costo'            => $_POST['costo'] ?: null,
                    ':id_cliente'       => $_POST['id_cliente'],
                    ':id_proiezione'    => $_POST['id_proiezione'],
                ]);
        } catch (PDOException $e) {
            $message = "Errore nell'inserimento della prenotazione";
            appLog(40, $message);
        }
        break;
}
header("Location: ../Sub_Admin/admin-prenotazioni.php");
exit;