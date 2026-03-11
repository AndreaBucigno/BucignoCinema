<?php
require_once __DIR__ . "/../config/db.php";
switch ($_POST['action'] ?? '') {
    case 'add_cinema':
        $stmt=$pdo->prepare("INSERT INTO cinema (nome, indirizzo, citta) VALUES (:nome,:indirizzo,:citta)");
        $stmt->execute([':nome' => $_POST['nome'], ':indirizzo' => $_POST['indirizzo'] ?: null, ':citta' => $_POST['citta'] ?: null]);
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;
    case 'edit_cinema':
        $stmt=$pdo->prepare("UPDATE cinema SET nome=:nome,indirizzo=:indirizzo,citta=:citta WHERE id=:id");
        $stmt->execute([':id' => $_POST['id'], ':nome' => $_POST['nome'], ':indirizzo' => $_POST['indirizzo'] ?: null, ':citta' => $_POST['citta'] ?: null]);
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'add_sala':
        $stmt=$pdo->prepare("INSERT INTO sala (nome, capienza, id_cinema) VALUES (:nome,:capienza,:id_cinema)");
        $stmt->execute([':nome' => $_POST['nome'] ?: null, ':capienza' => $_POST['capienza'], ':id_cinema' => $_POST['id_cinema']]);
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;
    case 'edit_sala':
        $stmt=$pdo->prepare("UPDATE sala SET nome=:nome,capienza=:capienza,id_cinema=:id_cinema WHERE id=:id");
        $stmt->execute([':id' => $_POST['id'], ':nome' => $_POST['nome'] ?: null, ':capienza' => $_POST['capienza'], ':id_cinema' => $_POST['id_cinema']]);
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;
    case 'delete_sala':
        $stmt = $pdo->prepare("UPDATE sala SET attivo=:attivo WHERE id=:id");
        $stmt->execute([':id' => $_POST['id'], ':attivo' => 'false']);
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;
    case 'delete_cinema':
        $stmt = $pdo->prepare("UPDATE cinema SET attivo=:attivo WHERE id=:id");
        $stmt->execute([':id' => $_POST['id'], ':attivo' => 'false']);
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;
}
exit;
