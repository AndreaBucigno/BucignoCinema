<?php
require_once __DIR__ . "/../config/db.php";

switch ($_POST['action'] ?? '') {
    case 'add':
        try {
            $pdo->prepare("INSERT INTO utenti (nome, cognome, data_nascita, email, password, ruolo) 
                           VALUES (:nome, :cognome, :data_nascita, :email, MD5(:password), 'user')")
                ->execute([
                    ':nome'         => $_POST['nome'],
                    ':cognome'      => $_POST['cognome'],
                    ':data_nascita' => $_POST['data_nascita'] ?: null,
                    ':email'        => $_POST['email'],
                    ':password'     => $_POST['password'],
                ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                // Email duplicata
                session_start();
                $_SESSION['cliente_error'] = 'Email già esistente, scegline un\'altra.';
            }
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
                session_start();
                $_SESSION['cliente_error'] = 'Email già esistente, scegline un\'altra.';
            }
        }
        break;
}

header("Location: ../Sub_Admin/admin-clienti.php");
exit;
