<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $stmt = $pdo->prepare("SELECT * FROM utenti WHERE email = :email AND password = MD5(:password)");
        $stmt->execute([':email' => $email, ':password' => $password]);
        $utente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utente) {
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
