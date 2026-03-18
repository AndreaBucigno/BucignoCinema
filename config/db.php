<?php

$host = "localhost";
$dbname = "bucignocinema";
$user = "root";
$pass = "";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Errore di connessione: " . $e->getMessage());
}

function appLog($level, $message) {
    $date = date("Y-m-d H:i:s");
    $line = "[$date] [$level] $message" . PHP_EOL;
    file_put_contents(__DIR__ . "/app.log", $line, FILE_APPEND);
}

/*
TRACE / DEBUG (10): 
Messaggi molto dettagliati, utili durante lo sviluppo e la diagnostica approfondita dei problemi.
INFO (20): 
Conferma che le attività del sistema stanno procedendo correttamente (es. avvio, spegnimento, eventi di routine).
WARN / WARNING (30): 
Indica situazioni inaspettate, anomalie o potenziali problemi futuri che non bloccano il funzionamento immediato del software.
ERROR (40): 
Segnala problemi seri in cui un'operazione o una funzionalità specifica è fallita.
FATAL / CRITICAL / ALERT (50): 
Errori molto gravi che causano l'interruzione o l'impossibilità di proseguire l'esecuzione del programma.
*/