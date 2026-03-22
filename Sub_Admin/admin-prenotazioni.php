<?php
require_once __DIR__ . "/../config/db.php";
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: ../login.php");
  exit;
}
if (!isset($_SESSION['admin_id'])) {
  header("Location: ../login.php");
  exit;
}

$prenotazioni = $pdo->query("
    SELECT pr.id, pr.data_operazione, pr.numero_biglietti, pr.costo,
           CONCAT(u.nome,' ',u.cognome) AS cliente,
           s.titolo AS spettacolo, p.data_ora
    FROM prenotazione pr
    JOIN utenti u ON pr.id_cliente = u.id
    JOIN proiezione p ON pr.id_proiezione = p.id
    JOIN spettacolo s ON p.id_spettacolo = s.id
    ORDER BY pr.data_operazione DESC
")->fetchAll(PDO::FETCH_ASSOC);

$clienti = $pdo->query("
    SELECT id, CONCAT(nome,' ',cognome) AS nome_completo 
    FROM utenti 
    WHERE ruolo = 'user'
    ORDER BY cognome
")->fetchAll(PDO::FETCH_ASSOC);
$proiezioni = $pdo->query("SELECT p.id, CONCAT(s.titolo,' — ',p.data_ora) AS label FROM proiezione p JOIN spettacolo s ON p.id_spettacolo=s.id ORDER BY p.data_ora DESC")->fetchAll(PDO::FETCH_ASSOC);

$righe = '';
foreach ($prenotazioni as $p) {
  $cliente    = htmlspecialchars($p['cliente']);
  $spettacolo = htmlspecialchars($p['spettacolo']);
  $dataOp     = htmlspecialchars($p['data_operazione'] ?? '—');
  $dataProi   = htmlspecialchars($p['data_ora']);
  $costo      = number_format($p['costo'], 2);
  $righe .= "
    <tr>
        <td>{$p['id']}</td>
        <td>{$dataOp}</td>
        <td>{$cliente}</td>
        <td>{$spettacolo}</td>
        <td>{$dataProi}</td>
        <td>{$p['numero_biglietti']}</td>
        <td>€{$costo}</td>
    </tr>";
}

$optClienti = '<option value="" disabled>Seleziona...</option>';
foreach ($clienti as $c) $optClienti .= "<option value='{$c['id']}'>" . htmlspecialchars($c['nome_completo']) . "</option>";

$optProiezioni = '<option value="" disabled>Seleziona...</option>';
foreach ($proiezioni as $p) $optProiezioni .= "<option value='{$p['id']}'>" . htmlspecialchars($p['label']) . "</option>";

$title      = 'Prenotazioni';
$activePage = 'biglietti';

$body = "
<!-- MODAL ADD -->
<div class='modal fade' id='addPrenotazioneModal' tabindex='-1'>
  <div class='modal-dialog'><div class='modal-content bg-dark border-danger'>
    <div class='modal-header bg-danger text-white border-0'>
      <h5 class='modal-title fw-bold'><i class='bi bi-plus-circle me-2'></i>Aggiungi Prenotazione</h5>
      <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
    </div>
    <div class='modal-body p-4'>
      <form method='POST' action='../Handler/PrenotazioniHandler.php' id='addPrenotazioneForm'>
        <input type='hidden' name='action' value='add'>
        <div class='row g-3'>
          <div class='col-12'><label class='form-label text-white'>Cliente</label><select class='form-select' name='id_cliente' required>$optClienti</select></div>
          <div class='col-12'><label class='form-label text-white'>Proiezione</label><select class='form-select' name='id_proiezione' required>$optProiezioni</select></div>
          <div class='col-md-6'><label class='form-label text-white'>N° Biglietti</label><input type='number' class='form-control' name='numero_biglietti' required min='1'></div>
          <div class='col-md-6'><label class='form-label text-white'>Costo Totale (€)</label><input type='number' step='0.01' class='form-control' name='costo'></div>
          <div class='col-12'><label class='form-label text-white'>Data Operazione</label><input type='datetime-local' class='form-control' name='data_operazione'></div>
        </div>
      </form>
    </div>
    <div class='modal-footer bg-dark border-danger'>
      <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button>
      <button type='submit' form='addPrenotazioneForm' class='btn btn-danger fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button>
    </div>
  </div></div>
</div>

<div class='container-fluid text-white p-4'>
    <div class='d-flex justify-content-between align-items-center mb-4'>
        <h2 class='mb-0'>Prenotazioni</h2>
        <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#addPrenotazioneModal'>
            <i class='bi bi-plus-circle me-1'></i>Aggiungi Prenotazione
        </button>
    </div>
    <div class='table-responsive'>
      <table class='table table-striped table-dark' id='prenotazioniTable'>
        <thead>
          <tr>
            <th>ID</th><th>Data Op.</th><th>Cliente</th><th>Spettacolo</th><th>Proiezione</th><th>Biglietti</th><th>Costo</th>
          </tr>
        </thead>
        <tbody>$righe</tbody>
      </table>
    </div>
</div>
";

$template = file_get_contents("../inc/admin_page.inc.php");
$template = str_replace("{{title}}", $title, $template);
$template = str_replace("{{body}}", $body, $template);
$template = str_replace("{{admin_name}}", strtoupper($_SESSION['admin_name']), $template);
$voci = ['dashboard', 'film', 'programmazione', 'biglietti', 'utenti', 'statistiche', 'impostazioni', 'registi', 'case', 'cinema'];
foreach ($voci as $voce) {
  $template = str_replace("{{active_$voce}}", $activePage === $voce ? 'active' : '', $template);
}
echo $template;
