<?php
session_start();
require __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email']    ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM utenti WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $utente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($utente && password_verify($password, $utente['password_hash']) && $utente['ruolo'] === 'admin' && $utente['attivo'] === 'true') {
                $_SESSION['admin_id']   = $utente['id'];
                $_SESSION['admin_name'] = $utente['nome'];
                $_SESSION['admin_role'] = $utente['ruolo'];
                appLog(10, "Login admin: {$utente['email']}");
                $_SESSION['error'] = $message;
                header("Location: ../admin.php");
                $_SESSION["message"]
                exit;
            } else if ($utente && password_verify($password, $utente['password_hash']) && $utente['ruolo'] === 'user' && $utente['attivo'] === 'true') {
                $_SESSION['user_id']   = $utente['id'];
                $_SESSION['user_name'] = $utente['nome'];
                $_SESSION['user_role'] = $utente['ruolo'];
                $message = "Login user: {$utente['email']}";
                $_SESSION['error'] = $message;
                appLog(10,$message);
                header("Location: ../user.php");
                exit;
            } else {
                appLog(30, "Tentativo di login fallito per email: $email");
                header("Location: ../login.php");
                exit;
            }
        } catch (PDOException $e) {
            $message = "Errore del server durante il login";
            appLog(40, $message);
            $_SESSION['error'] = $message;
            header("Location: ../login.php");
            exit;
        }
    }
}