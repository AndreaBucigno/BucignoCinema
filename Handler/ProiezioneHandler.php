<?php
require_once __DIR__ . "/../config/db.php";
switch ($_POST['action'] ?? '') {
    case 'add':
        $pdo->prepare("INSERT INTO proiezione (data_ora, id_spettacolo, id_sala) VALUES (:data_ora,:id_spettacolo,:id_sala)")
            ->execute([':data_ora' => $_POST['data_ora'], ':id_spettacolo' => $_POST['id_spettacolo'], ':id_sala' => $_POST['id_sala']]);
        break;
    case 'edit':
        $pdo->prepare("UPDATE proiezione SET data_ora=:data_ora,id_spettacolo=:id_spettacolo,id_sala=:id_sala WHERE id=:id")
            ->execute([':id' => $_POST['id'], ':data_ora' => $_POST['data_ora'], ':id_spettacolo' => $_POST['id_spettacolo'], ':id_sala' => $_POST['id_sala']]);
        break;
}
header("Location: ../Sub_Admin/admin-proiezioni.php");
exit;
