<?php
require_once __DIR__ . "/../config/db.php";
session_start();
switch ($_POST['action'] ?? '') {
    case 'add_cinema':
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("INSERT INTO cinema (nome, indirizzo, citta) VALUES (:nome,:indirizzo,:citta)");
            $stmt->execute([':nome' => $_POST['nome'], ':indirizzo' => $_POST['indirizzo'] ?: null, ':citta' => $_POST['citta'] ?: null]);
            $pdo->commit();
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $message = "Errore nell'inserimento di un nuovo cinema";
            appLog(40, $message);
            $_SESSION['error'] = $message;
        }
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'edit_cinema':
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE cinema SET nome=:nome,indirizzo=:indirizzo,citta=:citta WHERE id=:id");
            $stmt->execute([':id' => $_POST['id'], ':nome' => $_POST['nome'], ':indirizzo' => $_POST['indirizzo'] ?: null, ':citta' => $_POST['citta'] ?: null]);
            $pdo->commit();
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $message = "Errore nella modifica del cinema";
            appLog(40, $message);
            $_SESSION['error'] = $message;
        }
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'add_sala':
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("INSERT INTO sala (nome, capienza, id_cinema) VALUES (:nome,:capienza,:id_cinema)");
            $stmt->execute([':nome' => $_POST['nome'] ?: null, ':capienza' => $_POST['capienza'], ':id_cinema' => $_POST['id_cinema']]);
            $pdo->commit();
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $message = "Errore nell'inserimento di una nuova sala";
            appLog(40, $message);
            $_SESSION['error'] = $message;
        }
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'edit_sala':
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE sala SET nome=:nome,capienza=:capienza,id_cinema=:id_cinema WHERE id=:id");
            $stmt->execute([':id' => $_POST['id'], ':nome' => $_POST['nome'] ?: null, ':capienza' => $_POST['capienza'], ':id_cinema' => $_POST['id_cinema']]);
            $pdo->commit();
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $message = "Errore nella modifica della sala";
            appLog(40, $message);
            $_SESSION['error'] = $message;
        }
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'delete_sala':
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE sala SET attivo=:attivo WHERE id=:id");
            $stmt->execute([':id' => $_POST['id'], ':attivo' => 'false']);
            $pdo->commit();
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $message = "Errore nell'eliminazione della sala";
            appLog(40, $message);
            $_SESSION['error'] = $message;
        }
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;

    case 'delete_cinema':
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE cinema SET attivo=:attivo WHERE id=:id");
            $stmt->execute([':id' => $_POST['id'], ':attivo' => 'false']);
            $pdo->commit();
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $message = "Errore nell'eliminazione del cinema";
            appLog(40, $message);
            $_SESSION['error'] = $message;
        }
        header("Location: ../Sub_Admin/admin-cinema.php");
        break;
}
exit;