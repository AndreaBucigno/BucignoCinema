<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($email && $password) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM utenti WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $utente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utente && password_verify($password, $utente['password_hash']) && $utente['ruolo'] === 'admin' && $utente['attivo'] === 'true') {
            $_SESSION['admin_id']   = $utente['id'];
            $_SESSION['admin_name'] = $utente['nome'];
            $_SESSION['admin_role'] = $utente['ruolo'];
            header("Location: ../admin.php");
            exit;
        } else if ($utente && password_verify($password, $utente['password_hash']) && $utente['ruolo'] === 'user' && $utente['attivo'] === 'true') {
            $_SESSION['user_id']   = $utente['id'];
            $_SESSION['user_name'] = $utente['nome'];
            $_SESSION['user_role'] = $utente['ruolo'];
            header("Location: ../user.php");
            exit;
        } else {
            $message = 'Email o password errati.';
            header("Location: ../login.php");
            exit;
        }
    } catch (PDOException $e) {
        $message = 'Errore del server. Riprova più tardi.';
        header("Location: ../login.php");
        exit;
    }
}