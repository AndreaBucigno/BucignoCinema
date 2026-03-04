<?php
require_once __DIR__ . "/../config/db.php";

// Fetch spettacoli con JOIN per regista, tematica, casa produttrice
$stmt = $pdo->query("
    SELECT 
        s.id,
        s.titolo,
        s.trama,
        CONCAT(r.nome, ' ', r.cognome) AS regista,
        t.nome AS tematica,
        cp.nome AS casa_produttrice
    FROM spettacolo s
    LEFT JOIN regista r ON s.id_regista = r.id
    LEFT JOIN tematica t ON s.id_tematica = t.id
    LEFT JOIN casaproduttrice cp ON s.id_casa_produttrice = cp.id
    ORDER BY s.id ASC
");
$spettacoli = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch registi per il select della modal
$registi = $pdo->query("SELECT id, CONCAT(nome, ' ', cognome) AS nome_completo FROM regista ORDER BY cognome")->fetchAll(PDO::FETCH_ASSOC);

// Fetch tematiche per il select della modal
$tematiche = $pdo->query("SELECT id, nome FROM tematica ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

// Fetch case produttrici per il select della modal
$case = $pdo->query("SELECT id, nome FROM casaproduttrice ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

// Costruisce le righe della tabella
$righe = '';
foreach ($spettacoli as $s) {
  $titolo          = htmlspecialchars($s['titolo']);
  $trama           = htmlspecialchars($s['trama'] ?? '');
  $regista         = htmlspecialchars($s['regista'] ?? '—');
  $tematica        = htmlspecialchars($s['tematica'] ?? '—');
  $casa            = htmlspecialchars($s['casa_produttrice'] ?? '—');

  $righe .= "
    <tr>
        <td>{$s['id']}</td>
        <td>{$titolo}</td>
        <td>{$tematica}</td>
        <td>{$regista}</td>
        <td>{$casa}</td>
        <td>
            <button class='btn btn-sm btn-primary btn-edit'
                data-bs-toggle='modal'
                data-bs-target='#editSpettacoloModal'
                data-id='{$s['id']}'
                data-titolo='{$titolo}'
                data-trama='{$trama}'
                data-regista='{$s['id_regista']}'
                data-tematica='{$s['id_tematica']}'
                data-casa='{$s['id_casa_produttrice']}'>
                <i class='bi bi-pencil'></i> Edit
            </button>
          
        </td>
    </tr>";
}

// Costruisce le option dei select
function buildOptions(array $items, string $labelKey): string
{
  $html = '<option value="" disabled>Seleziona...</option>';
  foreach ($items as $item) {
    $html .= "<option value='{$item['id']}'>" . htmlspecialchars($item[$labelKey]) . "</option>";
  }
  return $html;
}

$optRegisti  = buildOptions($registi,  'nome_completo');
$optTematiche = buildOptions($tematiche, 'nome');
$optCase     = buildOptions($case,     'nome');

$title      = 'Spettacoli';
$activePage = 'film';

$body = "
<!-- MODAL AGGIUNGI -->
<div class='modal fade' id='addSpettacoloModal' tabindex='-1'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content bg-dark border-danger'>
      <div class='modal-header bg-danger text-white border-0'>
        <h5 class='modal-title fw-bold'><i class='bi bi-plus-circle me-2'></i>Aggiungi Spettacolo</h5>
        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body p-4'>
        <form method='POST' action='handler/spettacolo_handler.php' id='addSpettacoloForm'>
          <input type='hidden' name='action' value='add'>
          <div class='row g-3'>
            <div class='col-12'>
              <label class='form-label text-white'>Titolo</label>
              <input type='text' class='form-control' name='titolo' required placeholder='Titolo del film'>
            </div>
            <div class='col-12'>
              <label class='form-label text-white'>Trama</label>
              <textarea class='form-control' name='trama' rows='3' placeholder='Descrizione...'></textarea>
            </div>
            <div class='col-md-4'>
              <label class='form-label text-white'>Regista</label>
              <select class='form-select' name='id_regista'>$optRegisti</select>
            </div>
            <div class='col-md-4'>
              <label class='form-label text-white'>Tematica</label>
              <select class='form-select' name='id_tematica'>$optTematiche</select>
            </div>
            <div class='col-md-4'>
              <label class='form-label text-white'>Casa Produttrice</label>
              <select class='form-select' name='id_casa_produttrice'>$optCase</select>
            </div>
          </div>
        </form>
      </div>
      <div class='modal-footer bg-dark border-danger'>
        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button>
        <button type='submit' form='addSpettacoloForm' class='btn btn-danger fw-semibold'>
          <i class='bi bi-check-circle me-1'></i>Salva
        </button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT -->
<div class='modal fade' id='editSpettacoloModal' tabindex='-1'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content bg-dark border-warning'>
      <div class='modal-header bg-warning text-dark border-0'>
        <h5 class='modal-title fw-bold'><i class='bi bi-pencil-fill me-2'></i>Modifica Spettacolo</h5>
        <button type='button' class='btn-close btn-close-dark' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body p-4'>
        <form method='POST' action='handler/spettacolo_handler.php' id='editSpettacoloForm'>
          <input type='hidden' name='action' value='edit'>
          <input type='hidden' name='id' id='editId'>
          <div class='row g-3'>
            <div class='col-12'>
              <label class='form-label text-white'>Titolo</label>
              <input type='text' class='form-control' name='titolo' id='editTitolo' required>
            </div>
            <div class='col-12'>
              <label class='form-label text-white'>Trama</label>
              <textarea class='form-control' name='trama' id='editTrama' rows='3'></textarea>
            </div>
            <div class='col-md-4'>
              <label class='form-label text-white'>Regista</label>
              <select class='form-select' name='id_regista' id='editRegista'>$optRegisti</select>
            </div>
            <div class='col-md-4'>
              <label class='form-label text-white'>Tematica</label>
              <select class='form-select' name='id_tematica' id='editTematica'>$optTematiche</select>
            </div>
            <div class='col-md-4'>
              <label class='form-label text-white'>Casa Produttrice</label>
              <select class='form-select' name='id_casa_produttrice' id='editCasa'>$optCase</select>
            </div>
          </div>
        </form>
      </div>
      <div class='modal-footer bg-dark border-warning'>
        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button>
        <button type='submit' form='editSpettacoloForm' class='btn btn-warning text-dark fw-semibold'>
          <i class='bi bi-check-circle me-1'></i>Salva Modifiche
        </button>
      </div>
    </div>
  </div>
</div>


<!-- TABELLA -->
<div class='container-fluid text-white p-4'>
    <div class='d-flex justify-content-between align-items-center mb-4'>
        <h2 class='mb-0'>Spettacoli</h2>
        <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#addSpettacoloModal'>
            <i class='bi bi-plus-circle me-1'></i>Aggiungi Spettacolo
        </button>
    </div>
    <div class='table-responsive'>
      <table class='table table-striped table-dark' id='spettacoliTable'>
        <thead>
          <tr>
            <th>ID</th>
            <th>Titolo</th>
            <th>Tematica</th>
            <th>Regista</th>
            <th>Casa Produttrice</th>
            <th>Azioni</th>
          </tr>
        </thead>
        <tbody>
          $righe
        </tbody>
      </table>
    </div>
</div>


";

$template = file_get_contents("../inc/admin_page.inc.php");
$template = str_replace("{{title}}",      $title,                             $template);
$template = str_replace("{{body}}",       $body,                              $template);
$template = str_replace("{{admin_name}}", $_SESSION['admin_name'] ?? 'Admin', $template);

$voci = ['dashboard', 'film', 'programmazione', 'biglietti', 'utenti', 'statistiche', 'impostazioni'];
foreach ($voci as $voce) {
  $template = str_replace("{{active_$voce}}", $activePage === $voce ? 'active' : '', $template);
}

echo $template;
