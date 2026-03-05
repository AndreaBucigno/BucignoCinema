<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: ../login.php");
  exit;
}
require_once __DIR__ . "/../config/db.php";

$cinema = $pdo->query("SELECT * FROM cinema ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$sale   = $pdo->query("SELECT s.*, c.nome AS nome_cinema FROM sala s JOIN cinema c ON s.id_cinema = c.id ORDER BY c.nome, s.nome")->fetchAll(PDO::FETCH_ASSOC);

$righeCinema = '';
foreach ($cinema as $c) {
  $nome  = htmlspecialchars($c['nome']);
  $ind   = htmlspecialchars($c['indirizzo'] ?? '');
  $citta = htmlspecialchars($c['citta'] ?? '');
  $righeCinema .= "
    <tr>
        <td>{$c['id']}</td><td>{$nome}</td><td>{$ind}</td><td>{$citta}</td>
        <td>
            <button class='btn btn-sm btn-primary'
                data-bs-toggle='modal' data-bs-target='#editCinemaModal'
                onclick=\"apriEditCinema('{$c['id']}', '{$nome}', '{$ind}', '{$citta}')\">
                <i class='bi bi-pencil'></i> Edit
            </button>
        </td>
    </tr>";
}

$righeSale = '';
foreach ($sale as $s) {
  $nome     = htmlspecialchars($s['nome'] ?? '');
  $cinema_n = htmlspecialchars($s['nome_cinema']);
  $righeSale .= "
    <tr>
        <td>{$s['id']}</td><td>{$nome}</td><td>{$s['capienza']}</td><td>{$cinema_n}</td>
        <td>
            <button class='btn btn-sm btn-primary'
                data-bs-toggle='modal' data-bs-target='#editSalaModal'
                onclick=\"apriEditSala('{$s['id']}', '{$nome}', '{$s['capienza']}', '{$s['id_cinema']}')\">
                <i class='bi bi-pencil'></i> Edit
            </button>
        </td>
    </tr>";
}

$optCinema = '';
foreach ($cinema as $c) {
  $optCinema .= "<option value='{$c['id']}'>" . htmlspecialchars($c['nome']) . "</option>";
}

$title      = 'Cinema & Sale';
$activePage = 'cinema';

$body = "
<!-- MODAL ADD CINEMA -->
<div class='modal fade' id='addCinemaModal' tabindex='-1'>
  <div class='modal-dialog'><div class='modal-content bg-dark border-danger'>
    <div class='modal-header bg-danger text-white border-0'><h5 class='modal-title fw-bold'><i class='bi bi-plus-circle me-2'></i>Aggiungi Cinema</h5><button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button></div>
    <div class='modal-body p-4'><form method='POST' action='../Handler/CinemaHandler.php' id='addCinemaForm'><input type='hidden' name='action' value='add_cinema'>
      <div class='row g-3'>
        <div class='col-12'><label class='form-label text-white'>Nome</label><input type='text' class='form-control' name='nome' required placeholder='Nome cinema'></div>
        <div class='col-md-8'><label class='form-label text-white'>Indirizzo</label><input type='text' class='form-control' name='indirizzo' placeholder='Via...'></div>
        <div class='col-md-4'><label class='form-label text-white'>Città</label><input type='text' class='form-control' name='citta' placeholder='Città'></div>
      </div>
    </form></div>
    <div class='modal-footer bg-dark border-danger'><button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button><button type='submit' form='addCinemaForm' class='btn btn-danger fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button></div>
  </div></div>
</div>

<!-- MODAL EDIT CINEMA -->
<div class='modal fade' id='editCinemaModal' tabindex='-1'>
  <div class='modal-dialog'><div class='modal-content bg-dark border-warning'>
    <div class='modal-header bg-warning text-dark border-0'><h5 class='modal-title fw-bold'><i class='bi bi-pencil-fill me-2'></i>Modifica Cinema</h5><button type='button' class='btn-close btn-close-dark' data-bs-dismiss='modal'></button></div>
    <div class='modal-body p-4'><form method='POST' action='../Handler/CinemaHandler.php' id='editCinemaForm'><input type='hidden' name='action' value='edit_cinema'><input type='hidden' name='id' id='editCinemaId'>
      <div class='row g-3'>
        <div class='col-12'><label class='form-label text-white'>Nome</label><input type='text' class='form-control' name='nome' id='editCinemaNome' required></div>
        <div class='col-md-8'><label class='form-label text-white'>Indirizzo</label><input type='text' class='form-control' name='indirizzo' id='editCinemaInd'></div>
        <div class='col-md-4'><label class='form-label text-white'>Città</label><input type='text' class='form-control' name='citta' id='editCinemaCitta'></div>
      </div>
    </form></div>
    <div class='modal-footer bg-dark border-warning'><button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button><button type='submit' form='editCinemaForm' class='btn btn-warning text-dark fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button></div>
  </div></div>
</div>

<!-- MODAL ADD SALA -->
<div class='modal fade' id='addSalaModal' tabindex='-1'>
  <div class='modal-dialog'><div class='modal-content bg-dark border-danger'>
    <div class='modal-header bg-danger text-white border-0'><h5 class='modal-title fw-bold'><i class='bi bi-plus-circle me-2'></i>Aggiungi Sala</h5><button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button></div>
    <div class='modal-body p-4'><form method='POST' action='../Handler/CinemaHandler.php' id='addSalaForm'><input type='hidden' name='action' value='add_sala'>
      <div class='row g-3'>
        <div class='col-12'><label class='form-label text-white'>Nome Sala</label><input type='text' class='form-control' name='nome' placeholder='Es. Sala 1'></div>
        <div class='col-md-6'><label class='form-label text-white'>Capienza</label><input type='number' class='form-control' name='capienza' required min='1'></div>
        <div class='col-md-6'><label class='form-label text-white'>Cinema</label><select class='form-select' name='id_cinema' required><option value='' disabled selected>Seleziona...</option>$optCinema</select></div>
      </div>
    </form></div>
    <div class='modal-footer bg-dark border-danger'><button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button><button type='submit' form='addSalaForm' class='btn btn-danger fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button></div>
  </div></div>
</div>

<!-- MODAL EDIT SALA -->
<div class='modal fade' id='editSalaModal' tabindex='-1'>
  <div class='modal-dialog'><div class='modal-content bg-dark border-warning'>
    <div class='modal-header bg-warning text-dark border-0'><h5 class='modal-title fw-bold'><i class='bi bi-pencil-fill me-2'></i>Modifica Sala</h5><button type='button' class='btn-close btn-close-dark' data-bs-dismiss='modal'></button></div>
    <div class='modal-body p-4'><form method='POST' action='../Handler/CinemaHandler.php' id='editSalaForm'><input type='hidden' name='action' value='edit_sala'><input type='hidden' name='id' id='editSalaId'>
      <div class='row g-3'>
        <div class='col-12'><label class='form-label text-white'>Nome Sala</label><input type='text' class='form-control' name='nome' id='editSalaNome'></div>
        <div class='col-md-6'><label class='form-label text-white'>Capienza</label><input type='number' class='form-control' name='capienza' id='editSalaCapienza' required min='1'></div>
        <div class='col-md-6'><label class='form-label text-white'>Cinema</label><select class='form-select' name='id_cinema' id='editSalaCinema'>$optCinema</select></div>
      </div>
    </form></div>
    <div class='modal-footer bg-dark border-warning'><button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button><button type='submit' form='editSalaForm' class='btn btn-warning text-dark fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button></div>
  </div></div>
</div>

<div class='container-fluid text-white p-4'>
    <div class='d-flex justify-content-between align-items-center mb-4'>
        <h2 class='mb-0'>Cinema</h2>
        <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#addCinemaModal'><i class='bi bi-plus-circle me-1'></i>Aggiungi Cinema</button>
    </div>
    <div class='table-responsive mb-5'>
      <table class='table table-striped table-dark' id='cinemaTable'>
        <thead><tr><th>ID</th><th>Nome</th><th>Indirizzo</th><th>Città</th><th>Azioni</th></tr></thead>
        <tbody>$righeCinema</tbody>
      </table>
    </div>

    <div class='d-flex justify-content-between align-items-center mb-4'>
        <h2 class='mb-0'>Sale</h2>
        <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#addSalaModal'><i class='bi bi-plus-circle me-1'></i>Aggiungi Sala</button>
    </div>
    <div class='table-responsive'>
      <table class='table table-striped table-dark' id='saleTable'>
        <thead><tr><th>ID</th><th>Nome</th><th>Capienza</th><th>Cinema</th><th>Azioni</th></tr></thead>
        <tbody>$righeSale</tbody>
      </table>
    </div>
</div>

<script>
function apriEditCinema(id, nome, indirizzo, citta) {
    document.getElementById('editCinemaId').value    = id;
    document.getElementById('editCinemaNome').value  = nome;
    document.getElementById('editCinemaInd').value   = indirizzo;
    document.getElementById('editCinemaCitta').value = citta;
}
function apriEditSala(id, nome, capienza, idCinema) {
    document.getElementById('editSalaId').value       = id;
    document.getElementById('editSalaNome').value     = nome;
    document.getElementById('editSalaCapienza').value = capienza;
    document.getElementById('editSalaCinema').value   = idCinema;
}
</script>
";

$template = file_get_contents("../inc/admin_page.inc.php");
$template = str_replace("{{title}}",      $title,                             $template);
$template = str_replace("{{body}}",       $body,                              $template);
$template = str_replace("{{admin_name}}", $_SESSION['admin_name'] ?? 'Admin', $template);
$voci = ['dashboard', 'film', 'programmazione', 'biglietti', 'utenti', 'statistiche', 'impostazioni', 'registi', 'case', 'cinema'];
foreach ($voci as $voce) {
  $template = str_replace("{{active_$voce}}", $activePage === $voce ? 'active' : '', $template);
}
echo $template;
