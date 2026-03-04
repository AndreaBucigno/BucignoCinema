<?php
require_once __DIR__ . "/../config/db.php";

$action = $_POST['action'] ?? '';

switch ($action) {

    case 'add':
        $stmt = $pdo->prepare("
            INSERT INTO spettacolo (titolo, trama, id_regista, id_tematica, id_casa_produttrice)
            VALUES (:titolo, :trama, :id_regista, :id_tematica, :id_casa_produttrice)
        ");
        $stmt->execute([
            ':titolo'              => $_POST['titolo'],
            ':trama'               => $_POST['trama']               ?: null,
            ':id_regista'          => $_POST['id_regista']          ?: null,
            ':id_tematica'         => $_POST['id_tematica']         ?: null,
            ':id_casa_produttrice' => $_POST['id_casa_produttrice'] ?: null,
        ]);
        break;

    case 'edit':
        $stmt = $pdo->prepare("
            UPDATE spettacolo
            SET titolo = :titolo,
                trama  = :trama,
                id_regista = :id_regista,
                id_tematica = :id_tematica,
                id_casa_produttrice = :id_casa_produttrice
            WHERE id = :id
        ");
        $stmt->execute([
            ':id'                  => $_POST['id'],
            ':titolo'              => $_POST['titolo'],
            ':trama'               => $_POST['trama']               ?: null,
            ':id_regista'          => $_POST['id_regista']          ?: null,
            ':id_tematica'         => $_POST['id_tematica']         ?: null,
            ':id_casa_produttrice' => $_POST['id_casa_produttrice'] ?: null,
        ]);
        break;
}

header("Location: ../admin-spettacoli.php");
exit;
