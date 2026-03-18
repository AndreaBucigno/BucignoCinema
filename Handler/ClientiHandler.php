<?php
session_start();
require_once __DIR__ . "/../config/db.php";

switch ($_POST['action'] ?? '') {
    case 'add':
        try {
            $pdo->prepare("INSERT INTO utenti (nome, cognome, data_nascita, email, password, password_hash, ruolo, attivo) 
                           VALUES (:nome, :cognome, :data_nascita, :email, :password, :password_hash, 'user', 'true')")
                ->execute([
                    ':nome'          => $_POST['nome'],
                    ':cognome'       => $_POST['cognome'],
                    ':data_nascita'  => $_POST['data_nascita'] ?: null,
                    ':email'         => $_POST['email'],
                    ':password'      => $_POST['password'],
                    ':password_hash' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['error'] = "Errore nell'inserimento del cliente: EMAIL già esistente";
            } else {
                $_SESSION['error'] = "Errore nell'inserimento del cliente";
            }
            appLog(40, $_SESSION['error']);
        }
        break;

    case 'edit':
        try {
            $pdo->prepare("UPDATE utenti SET nome=:nome, cognome=:cognome, data_nascita=:data_nascita, email=:email
                           WHERE id=:id")
                ->execute([
                    ':id'           => $_POST['id'],
                    ':nome'         => $_POST['nome'],
                    ':cognome'      => $_POST['cognome'],
                    ':data_nascita' => $_POST['data_nascita'] ?: null,
                    ':email'        => $_POST['email'],
                ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['error'] = "Email già esistente, scegline un'altra.";
            } else {
                $_SESSION['error'] = "Errore nella modifica del cliente";
            }
            appLog(40, $_SESSION['error']);
        }
        break;

    case 'delete_cliente':
        try {
            $pdo->prepare("UPDATE utenti SET attivo='false' WHERE id=:id")
                ->execute([':id' => $_POST['id']]);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Errore nell'eliminazione del cliente";
            appLog(40, $_SESSION['error']);
        }
        break;
}
header("Location: ../Sub_Admin/admin-clienti.php");
exit;