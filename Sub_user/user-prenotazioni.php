<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
require_once __DIR__ . "/../config/db.php";

$prenotazioni = $pdo->prepare("
    SELECT pr.id, pr.data_operazione, pr.numero_biglietti, pr.costo,
           s.titolo AS spettacolo, p.data_ora, c.nome AS cinema, sa.nome AS sala
    FROM prenotazione pr
    JOIN proiezione p ON pr.id_proiezione = p.id
    JOIN spettacolo s ON p.id_spettacolo = s.id
    JOIN sala sa ON p.id_sala = sa.id
    JOIN cinema c ON sa.id_cinema = c.id
    WHERE pr.id_cliente = :id
    ORDER BY pr.data_operazione DESC
");
$prenotazioni->execute([':id' => $_SESSION['user_id']]);
$prenotazioni = $prenotazioni->fetchAll(PDO::FETCH_ASSOC);

// Proiezioni future disponibili
$proiezioni = $pdo->query("
    SELECT p.id, s.titolo, p.data_ora, c.nome AS cinema, sa.nome AS sala, sa.capienza
    FROM proiezione p
    INNER JOIN spettacolo s ON p.id_spettacolo = s.id
    INNER JOIN sala sa ON p.id_sala = sa.id
    INNER JOIN cinema c ON sa.id_cinema = c.id
    WHERE p.data_ora > NOW() AND c.attivo = 'true' AND sa.attivo = 'true'   
    ORDER BY p.data_ora ASC
")->fetchAll(PDO::FETCH_ASSOC);

$righe = '';
if (empty($prenotazioni)) {
    $righe = "<tr><td colspan='7' class='text-center text-muted'>Nessuna prenotazione effettuata</td></tr>";
} else {
    foreach ($prenotazioni as $p) {
        $spettacolo = htmlspecialchars($p['spettacolo']);
        $cinema     = htmlspecialchars($p['cinema']);
        $sala       = htmlspecialchars($p['sala']);
        $dataOp     = htmlspecialchars($p['data_operazione'] ?? '—');
        $dataProi   = htmlspecialchars($p['data_ora']);
        $costo      = number_format($p['costo'], 2);
        $righe .= "
        <tr>
            <td>{$p['id']}</td>
            <td>{$spettacolo}</td>
            <td>{$cinema} — {$sala}</td>
            <td>{$dataProi}</td>
            <td>{$p['numero_biglietti']}</td>
            <td>€{$costo}</td>
            <td>{$dataOp}</td>
        </tr>";
    }
}

$optProiezioni = '<option value="" disabled selected>Seleziona proiezione...</option>';
foreach ($proiezioni as $p) {
    $label = htmlspecialchars($p['titolo'] . ' — ' . $p['cinema'] . ' ' . $p['sala'] . ' — ' . $p['data_ora']);
    $optProiezioni .= "<option value='{$p['id']}' data-capienza='{$p['capienza']}'>{$label}</option>";
}

$title      = 'Le mie Prenotazioni';
$activePage = 'prenotazioni';

$body = "
<!-- MODAL NUOVA PRENOTAZIONE -->
<div class='modal fade' id='addPrenotazioneModal' tabindex='-1'>
  <div class='modal-dialog'><div class='modal-content bg-dark border-danger'>
    <div class='modal-header bg-danger text-white border-0'>
      <h5 class='modal-title fw-bold'><i class='bi bi-ticket-perforated me-2'></i>Nuova Prenotazione</h5>
      <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
    </div>
    <div class='modal-body p-4'>
      <form method='POST' action='../Handler/PrenotazioniHandler.php' id='addPrenotazioneForm'>
        <input type='hidden' name='action' value='add'>
        <input type='hidden' name='id_cliente' value='{$_SESSION['user_id']}'>
        <input type='hidden' name='data_operazione' id='dataOperazione'>
        <div class='row g-3'>
          <div class='col-12'><label class='form-label text-white'>Proiezione</label>
            <select class='form-select' name='id_proiezione' id='selectProiezione' required onchange='calcolaCosto()'>{$optProiezioni}</select>
          </div>
          <div class='col-md-6'><label class='form-label text-white'>N° Biglietti</label>
            <input type='number' class='form-control' name='numero_biglietti' id='numBiglietti' required min='1' max='10' value='1' oninput='calcolaCosto()'>
          </div>
          <div class='col-md-6'><label class='form-label text-white'>Costo Totale</label>
            <div class='input-group'>
              <span class='input-group-text bg-dark text-white border-secondary'>€</span>
              <input type='number' step='0.01' class='form-control' name='costo' id='costoTotale' readonly>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class='modal-footer bg-dark border-danger'>
      <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button>
      <button type='submit' form='addPrenotazioneForm' class='btn btn-danger fw-semibold'><i class='bi bi-check-circle me-1'></i>Conferma</button>
    </div>
  </div></div>
</div>

<div class='container py-4'>
    <div class='d-flex justify-content-between align-items-center mb-4'>
        <h2 class='sezione-titolo mb-0'>Le mie Prenotazioni</h2>
        <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#addPrenotazioneModal'>
            <i class='bi bi-plus-circle me-1'></i>Nuova Prenotazione
        </button>
    </div>
    <div class='table-responsive'>
        <table class='table table-striped table-dark' id='UserprenotazioniTable'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Spettacolo</th>
                    <th>Cinema / Sala</th>
                    <th>Data Proiezione</th>
                    <th>Biglietti</th>
                    <th>Costo</th>
                    <th>Data Prenotazione</th>
                </tr>
            </thead>
            <tbody>{$righe}</tbody>
        </table>
    </div>
</div>

<script>
const PREZZO_BIGLIETTO = 8.00;

document.querySelector('[name=data_operazione]').value = new Date().toISOString().slice(0, 19).replace('T', ' ');

function calcolaCosto() {
    const num = parseInt(document.getElementById('numBiglietti').value) || 0;
    document.getElementById('costoTotale').value = (num * PREZZO_BIGLIETTO).toFixed(2);
}
calcolaCosto();
</script>
";

$template = file_get_contents("../inc/user_page.inc.php");
$template = str_replace("{{title}}",  $title,  $template);
$template = str_replace("{{body}}",   $body,   $template);
$voci = ['profilo', 'prenotazioni'];
foreach ($voci as $voce) {
    $template = str_replace("{{active_$voce}}", $activePage === $voce ? 'active' : '', $template);
}
echo $template;
