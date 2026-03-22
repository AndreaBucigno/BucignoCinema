<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: ../login.php");
  exit;
}
require_once __DIR__ . "/../config/db.php";

$proiezioni = $pdo->query("
    SELECT p.id, p.data_ora, p.id_spettacolo, p.id_sala,
           s.titolo AS spettacolo, sa.nome AS sala, c.nome AS cinema
    FROM proiezione p
    JOIN spettacolo s ON p.id_spettacolo = s.id
    JOIN sala sa ON p.id_sala = sa.id
    JOIN cinema c ON sa.id_cinema = c.id
    ORDER BY p.data_ora DESC
")->fetchAll(PDO::FETCH_ASSOC);

$spettacoli = $pdo->query("SELECT id, titolo FROM spettacolo ORDER BY titolo")->fetchAll(PDO::FETCH_ASSOC);
$sale       = $pdo->query("SELECT sa.id, CONCAT(c.nome,' — ',sa.nome) AS label FROM sala sa JOIN cinema c ON sa.id_cinema=c.id ORDER BY c.nome,sa.nome")->fetchAll(PDO::FETCH_ASSOC);

$righe = '';
foreach ($proiezioni as $p) {
  $data       = htmlspecialchars($p['data_ora']);
  $spettacolo = htmlspecialchars($p['spettacolo']);
  $sala       = htmlspecialchars($p['sala']);
  $cinema     = htmlspecialchars($p['cinema']);
  $righe .= "
    <tr>
        <td>{$p['id']}</td><td>{$data}</td><td>{$spettacolo}</td><td>{$sala}</td><td>{$cinema}</td>
        <td>
            <button class='btn btn-sm btn-primary'
                data-bs-toggle='modal' data-bs-target='#editProiezioneModal'
                onclick=\"apriEditProiezione('{$p['id']}', '{$data}', '{$p['id_spettacolo']}', '{$p['id_sala']}')\">
                <i class='bi bi-pencil'></i> Edit
            </button>
        </td>
    </tr>";
}

$optSpettacoli = '<option value="" disabled>Seleziona...</option>';
foreach ($spettacoli as $s) $optSpettacoli .= "<option value='{$s['id']}'>" . htmlspecialchars($s['titolo']) . "</option>";

$optSale = '<option value="" disabled>Seleziona...</option>';
foreach ($sale as $s) $optSale .= "<option value='{$s['id']}'>" . htmlspecialchars($s['label']) . "</option>";

$title      = 'Proiezioni';
$activePage = 'programmazione';

$body = "
<!-- MODAL ADD -->
<div class='modal fade' id='addProiezioneModal' tabindex='-1'>
  <div class='modal-dialog'><div class='modal-content bg-dark border-danger'>
    <div class='modal-header bg-danger text-white border-0'><h5 class='modal-title fw-bold'><i class='bi bi-plus-circle me-2'></i>Aggiungi Proiezione</h5><button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button></div>
    <div class='modal-body p-4'><form method='POST' action='../Handler/ProiezioneHandler.php' id='addProiezioneForm'><input type='hidden' name='action' value='add'>
      <div class='row g-3'>
        <div class='col-12'><label class='form-label text-white'>Data e Ora</label><input type='datetime-local' class='form-control' name='data_ora' required></div>
        <div class='col-md-6'><label class='form-label text-white'>Spettacolo</label><select class='form-select' name='id_spettacolo' required>$optSpettacoli</select></div>
        <div class='col-md-6'><label class='form-label text-white'>Sala</label><select class='form-select' name='id_sala' required>$optSale</select></div>
      </div>
    </form></div>
    <div class='modal-footer bg-dark border-danger'><button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button><button type='submit' form='addProiezioneForm' class='btn btn-danger fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button></div>
  </div></div>
</div>

<!-- MODAL EDIT -->
<div class='modal fade' id='editProiezioneModal' tabindex='-1'>
  <div class='modal-dialog'><div class='modal-content bg-dark border-danger'>
    <div class='modal-header bg-danger text-dark border-0'><h5 class='modal-title fw-bold'><i class='bi bi-pencil-fill me-2'></i>Modifica Proiezione</h5><button type='button' class='btn-close btn-close-dark' data-bs-dismiss='modal'></button></div>
    <div class='modal-body p-4'><form method='POST' action='../Handler/ProiezioneHandler.php' id='editProiezioneForm'><input type='hidden' name='action' value='edit'><input type='hidden' name='id' id='editId'>
      <div class='row g-3'>
        <div class='col-12'><label class='form-label text-white'>Data e Ora</label><input type='datetime-local' class='form-control' name='data_ora' id='editData' required></div>
        <div class='col-md-6'><label class='form-label text-white'>Spettacolo</label><select class='form-select' name='id_spettacolo' id='editSpettacolo'>$optSpettacoli</select></div>
        <div class='col-md-6'><label class='form-label text-white'>Sala</label><select class='form-select' name='id_sala' id='editSala'>$optSale</select></div>
      </div>
    </form></div>
    <div class='modal-footer bg-dark border-danger'><button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button><button type='submit' form='editProiezioneForm' class='btn btn-warning text-dark fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button></div>
  </div></div>
</div>

<div class='container-fluid text-white p-4'>
    <div class='d-flex justify-content-between align-items-center mb-4'>
        <h2 class='mb-0'>Proiezioni</h2>
        <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#addProiezioneModal'><i class='bi bi-plus-circle me-1'></i>Aggiungi Proiezione</button>
    </div>
    <div class='table-responsive'>
      <table class='table table-striped table-dark' id='proiezioniTable'>
        <thead><tr><th>ID</th><th>Data/Ora</th><th>Spettacolo</th><th>Sala</th><th>Cinema</th><th>Azioni</th></tr></thead>
        <tbody>$righe</tbody>
      </table>
    </div>
</div>

<script>
function apriEditProiezione(id, data, idSpettacolo, idSala) {
    document.getElementById('editId').value         = id;
    document.getElementById('editData').value       = data.replace(' ', 'T');
    document.getElementById('editSpettacolo').value = idSpettacolo;
    document.getElementById('editSala').value       = idSala;
}
</script>
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
