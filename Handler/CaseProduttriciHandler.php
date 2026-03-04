<?php
require_once __DIR__ . "/../config/db.php";
switch ($_POST['action'] ?? '') {
    case 'add':
        $pdo->prepare("INSERT INTO casaproduttrice (nome, sede) VALUES (:nome, :sede)")
            ->execute([':nome' => $_POST['nome'], ':sede' => $_POST['sede'] ?: null]);
        break;
    case 'edit':
        $pdo->prepare("UPDATE casaproduttrice SET nome=:nome, sede=:sede WHERE id=:id")
            ->execute([':id' => $_POST['id'], ':nome' => $_POST['nome'], ':sede' => $_POST['sede'] ?: null]);
        break;
}
header("Location: ../Sub_Admin/admin-case.php");
exit;
