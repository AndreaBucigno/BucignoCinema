<?php
require_once __DIR__ . "/../config/db.php";

switch ($_POST['action'] ?? '') {
    case 'add_cinema':
        try {
            $stmt = $pdo->prepare("INSERT INTO cinema (nome, indirizzo, citta) VALUES (:nome,:indirizzo,:citta)");
            $stmt->execute([':nome' => $_POST['nome'], ':indirizzo' => $_POST['indirizzo'] ?: null, ':citta' => $_POST['citta'] ?: null]);
        } catch (PDOException $e) {
            $message = "errore nell'inserimento di un nuovo cinema";
            appLog()
        }
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'edit_cinema':
        try {
            $stmt = $pdo->prepare("UPDATE cinema SET nome=:nome,indirizzo=:indirizzo,citta=:citta WHERE id=:id");
            $stmt->execute([':id' => $_POST['id'], ':nome' => $_POST['nome'], ':indirizzo' => $_POST['indirizzo'] ?: null, ':citta' => $_POST['citta'] ?: null]);
        } catch (PDOException $e) {}
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'add_sala':
        try {
            $stmt = $pdo->prepare("INSERT INTO sala (nome, capienza, id_cinema) VALUES (:nome,:capienza,:id_cinema)");
            $stmt->execute([':nome' => $_POST['nome'] ?: null, ':capienza' => $_POST['capienza'], ':id_cinema' => $_POST['id_cinema']]);
        } catch (PDOException $e) {

        }
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'edit_sala':
        try {
            $stmt = $pdo->prepare("UPDATE sala SET nome=:nome,capienza=:capienza,id_cinema=:id_cinema WHERE id=:id");
            $stmt->execute([':id' => $_POST['id'], ':nome' => $_POST['nome'] ?: null, ':capienza' => $_POST['capienza'], ':id_cinema' => $_POST['id_cinema']]);
        } catch (PDOException $e) {

        }
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'delete_sala':
        try {
            $stmt = $pdo->prepare("UPDATE sala SET attivo=:attivo WHERE id=:id");
            $stmt->execute([':id' => $_POST['id'], ':attivo' => 'false']);
        } catch (PDOException $e) {}
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'delete_cinema':
        try {
            $stmt = $pdo->prepare("UPDATE cinema SET attivo=:attivo WHERE id=:id");
            $stmt->execute([':id' => $_POST['id'], ':attivo' => 'false']);
        } catch (PDOException $e) {}
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;
}
exit;
