<?php
require_once __DIR__ . "/../config/db.php";

switch ($_POST['action'] ?? '') {
    case 'add':
        try {
            $pdo->prepare("INSERT INTO casaproduttrice (nome, sede) VALUES (:nome, :sede)")
                ->execute([':nome' => $_POST['nome'], ':sede' => $_POST['sede'] ?: null]);
        } catch (PDOException $e) {
            $message = "Inserimento non andanto a buon fine";
            appLog(40,$message);
        }
        break;
    case 'edit':
        try {
            $pdo->prepare("UPDATE casaproduttrice SET nome=:nome, sede=:sede WHERE id=:id")
                ->execute([':id' => $_POST['id'], ':nome' => $_POST['nome'], ':sede' => $_POST['sede'] ?: null]);
        } catch (PDOException $e) {
            $message = "Modifica non andata a buon fine";
            appLog(40,$message);
        }
        break;
}
header("Location: ../Sub_Admin/admin-case.php");
exit;
