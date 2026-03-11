<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        // Cerca solo per email
        $stmt = $pdo->prepare("SELECT * FROM utenti WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $utente = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica password con password_verify
        if ($utente && password_verify($password, $utente['password'])) {
            $_SESSION['admin_id']   = $utente['id'];
            $_SESSION['admin_name'] = $utente['nome'];
            $_SESSION['admin_role'] = $utente['ruolo'];
            header("Location: ../admin.php");
            exit;
        } else {
            $_SESSION['login_error'] = 'Email o password errati.';
            header("Location: ../login.php");
            exit;
        }
    } else {
        $_SESSION['login_error'] = 'Compila tutti i campi.';
        header("Location: ../login.php");
        exit;
    }
}