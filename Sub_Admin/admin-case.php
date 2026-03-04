<?php
require_once __DIR__ . "/../config/db.php";

$case = $pdo->query("SELECT * FROM casaproduttrice ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

$righe = '';
foreach ($case as $c) {
  $nome = htmlspecialchars($c['nome'] ?? '');
  $sede = htmlspecialchars($c['sede'] ?? '—');
  $righe .= "
    <tr>
        <td>{$c['id']}</td>
        <td>{$nome}</td>
        <td>{$sede}</td>
        <td>
            <button class='btn btn-sm btn-primary'
                data-bs-toggle='modal' data-bs-target='#editCasaModal'
                data-id='{$c['id']}' data-nome='{$nome}' data-sede='{$sede}'>
                <i class='bi bi-pencil'></i> Edit
            </button>s
        </td>
    </tr>";
}

$title      = 'Case Produttrici';
$activePage = 'case';

$body = "
<!-- MODAL AGGIUNGI -->
<div class='modal fade' id='addCasaModal' tabindex='-1'>
  <div class='modal-dialog'>
    <div class='modal-content bg-dark border-danger'>
      <div class='modal-header bg-danger text-white border-0'>
        <h5 class='modal-title fw-bold'><i class='bi bi-plus-circle me-2'></i>Aggiungi Casa Produttrice</h5>
        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body p-4'>
        <form method='POST' action='handler/casa_handler.php' id='addCasaForm'>
          <input type='hidden' name='action' value='add'>
          <div class='row g-3'>
            <div class='col-12'><label class='form-label text-white'>Nome</label><input type='text' class='form-control' name='nome' required placeholder='Nome casa produttrice'></div>
            <div class='col-12'><label class='form-label text-white'>Sede</label><input type='text' class='form-control' name='sede' placeholder='Città / Paese'></div>
          </div>
        </form>
      </div>
      <div class='modal-footer bg-dark border-danger'>
        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button>
        <button type='submit' form='addCasaForm' class='btn btn-danger fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT -->
<div class='modal fade' id='editCasaModal' tabindex='-1'>
  <div class='modal-dialog'>
    <div class='modal-content bg-dark border-warning'>
      <div class='modal-header bg-warning text-dark border-0'>
        <h5 class='modal-title fw-bold'><i class='bi bi-pencil-fill me-2'></i>Modifica Casa Produttrice</h5>
        <button type='button' class='btn-close btn-close-dark' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body p-4'>
        <form method='POST' action='handler/casa_handler.php' id='editCasaForm'>
          <input type='hidden' name='action' value='edit'>
          <input type='hidden' name='id' id='editId'>
          <div class='row g-3'>
            <div class='col-12'><label class='form-label text-white'>Nome</label><input type='text' class='form-control' name='nome' id='editNome' required></div>
            <div class='col-12'><label class='form-label text-white'>Sede</label><input type='text' class='form-control' name='sede' id='editSede'></div>
          </div>
        </form>
      </div>
      <div class='modal-footer bg-dark border-warning'>
        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button>
        <button type='submit' form='editCasaForm' class='btn btn-warning text-dark fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva Modifiche</button>
      </div>
    </div>
  </div>
</div>



<div class='container-fluid text-white p-4'>
    <div class='d-flex justify-content-between align-items-center mb-4'>
        <h2 class='mb-0'>Case Produttrici</h2>
        <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#addCasaModal'><i class='bi bi-plus-circle me-1'></i>Aggiungi</button>
    </div>
    <div class='table-responsive'>
      <table class='table table-striped table-dark' id='caseTable'>
        <thead><tr><th>ID</th><th>Nome</th><th>Sede</th><th>Azioni</th></tr></thead>
        <tbody>$righe</tbody>
      </table>
    </div>
</div>

";

$template = file_get_contents("../inc/admin_page.inc.php");
$template = str_replace("{{title}}",      $title,                             $template);
$template = str_replace("{{body}}",       $body,                              $template);
$template = str_replace("{{admin_name}}", $_SESSION['admin_name'] ?? 'Admin', $template);
$voci = ['dashboard', 'film', 'programmazione', 'biglietti', 'utenti', 'statistiche', 'impostazioni', 'registi', 'case'];
foreach ($voci as $voce) {
  $template = str_replace("{{active_$voce}}", $activePage === $voce ? 'active' : '', $template);
}
echo $template;
