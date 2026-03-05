<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: ../login.php");
  exit;
}
require_once __DIR__ . "/../config/db.php";

$registi = $pdo->query("SELECT * FROM regista ORDER BY cognome")->fetchAll(PDO::FETCH_ASSOC);

$righe = '';
foreach ($registi as $r) {
  $nome    = htmlspecialchars($r['nome']);
  $cognome = htmlspecialchars($r['cognome']);
  $nascita = htmlspecialchars($r['data_nascita'] ?? '');
  $righe .= "
    <tr>
        <td>{$r['id']}</td>
        <td>{$nome}</td>
        <td>{$cognome}</td>
        <td>{$nascita}</td>
        <td>
            <button class='btn btn-sm btn-primary'
                data-bs-toggle='modal' data-bs-target='#editRegistaModal'
                onclick=\"apriEditRegista('{$r['id']}', '{$nome}', '{$cognome}', '{$nascita}')\">
                <i class='bi bi-pencil'></i> Edit
            </button>
        </td>
    </tr>";
}

$title      = 'Registi';
$activePage = 'registi';

$body = "
<!-- MODAL AGGIUNGI -->
<div class='modal fade' id='addRegistaModal' tabindex='-1'>
  <div class='modal-dialog'>
    <div class='modal-content bg-dark border-danger'>
      <div class='modal-header bg-danger text-white border-0'>
        <h5 class='modal-title fw-bold'><i class='bi bi-plus-circle me-2'></i>Aggiungi Regista</h5>
        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body p-4'>
        <form method='POST' action='../Handler/RegistaHandler.php' id='addRegistaForm'>
          <input type='hidden' name='action' value='add'>
          <div class='row g-3'>
            <div class='col-md-6'><label class='form-label text-white'>Nome</label><input type='text' class='form-control' name='nome' required placeholder='Nome'></div>
            <div class='col-md-6'><label class='form-label text-white'>Cognome</label><input type='text' class='form-control' name='cognome' required placeholder='Cognome'></div>
            <div class='col-12'><label class='form-label text-white'>Data di Nascita</label><input type='date' class='form-control' name='data_nascita'></div>
          </div>
        </form>
      </div>
      <div class='modal-footer bg-dark border-danger'>
        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button>
        <button type='submit' form='addRegistaForm' class='btn btn-danger fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT -->
<div class='modal fade' id='editRegistaModal' tabindex='-1'>
  <div class='modal-dialog'>
    <div class='modal-content bg-dark border-warning'>
      <div class='modal-header bg-warning text-dark border-0'>
        <h5 class='modal-title fw-bold'><i class='bi bi-pencil-fill me-2'></i>Modifica Regista</h5>
        <button type='button' class='btn-close btn-close-dark' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body p-4'>
        <form method='POST' action='../Handler/RegistaHandler.php' id='editRegistaForm'>
          <input type='hidden' name='action' value='edit'>
          <input type='hidden' name='id' id='editId'>
          <div class='row g-3'>
            <div class='col-md-6'><label class='form-label text-white'>Nome</label><input type='text' class='form-control' name='nome' id='editNome' required></div>
            <div class='col-md-6'><label class='form-label text-white'>Cognome</label><input type='text' class='form-control' name='cognome' id='editCognome' required></div>
            <div class='col-12'><label class='form-label text-white'>Data di Nascita</label><input type='date' class='form-control' name='data_nascita' id='editNascita'></div>
          </div>
        </form>
      </div>
      <div class='modal-footer bg-dark border-warning'>
        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button>
        <button type='submit' form='editRegistaForm' class='btn btn-warning text-dark fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva Modifiche</button>
      </div>
    </div>
  </div>
</div>

<div class='container-fluid text-white p-4'>
    <div class='d-flex justify-content-between align-items-center mb-4'>
        <h2 class='mb-0'>Registi</h2>
        <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#addRegistaModal'>
            <i class='bi bi-plus-circle me-1'></i>Aggiungi Regista
        </button>
    </div>
    <div class='table-responsive'>
      <table class='table table-striped table-dark' id='registiTable'>
        <thead><tr><th>ID</th><th>Nome</th><th>Cognome</th><th>Data Nascita</th><th>Azioni</th></tr></thead>
        <tbody>$righe</tbody>
      </table>
    </div>
</div>

<script>
function apriEditRegista(id, nome, cognome, nascita) {
    document.getElementById('editId').value      = id;
    document.getElementById('editNome').value    = nome;
    document.getElementById('editCognome').value = cognome;
    document.getElementById('editNascita').value = nascita;
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
