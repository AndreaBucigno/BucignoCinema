<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: ../login.php");
  exit;
}



require_once __DIR__ . "/../config/db.php";

$clienti = $pdo->query("
    SELECT * FROM utenti 
    WHERE ruolo = 'user' 
    AND attivo = 'true' ORDER BY cognome  
")->fetchAll(PDO::FETCH_ASSOC);

$righe = '';
foreach ($clienti as $c) {
  $nome    = htmlspecialchars($c['nome']);
  $cognome = htmlspecialchars($c['cognome'] ?? '');
  $nascita = htmlspecialchars($c['data_nascita'] ?? '');
  $email   = htmlspecialchars($c['email'] ?? '');
  $righe .= "
    <tr>
        <td>{$c['id']}</td>
        <td>{$nome}</td>
        <td>{$cognome}</td>
        <td>{$email}</td>
        <td>{$nascita}</td>
        <td>
            <button class='btn btn-sm btn-primary' 
                data-bs-toggle='modal' 
                data-bs-target='#editClienteModal'
                onclick=\"apriEditCliente('{$c['id']}', '{$nome}', '{$cognome}', '{$email}', '{$nascita}')\">
                <i class='bi bi-pencil'></i> Edit
            </button>
        </td>
        <td>
            <form method='POST' action='../Handler/ClientiHandler.php' style='display:inline'>
                <input type='hidden' name='action' value='delete_cliente'>
                <input type='hidden' name='id' value='{$c['id']}'>
                <button type='submit' class='btn btn-sm btn-danger'
                    onclick=\"return confirm('Sei sicuro di voler eliminare il cliente {$nome}?')\">
                    <i class='bi bi-trash'></i> Elimina
                </button>
            </form>
        </td>
    </tr>";
}

$stmt = "SELECT COUNT(*) AS totale FROM utenti WHERE ruolo = 'user' AND attivo = 'true'";
$result = $pdo->query($stmt)->fetch(PDO::FETCH_ASSOC);
$valore_db = $result['totale'];

$title      = 'Clienti';
$activePage = 'utenti';

$body = " 
<div class='container-fluid text-white p-4'>
    <div class='row justify-content-center mb-5'>
        <div class='col-auto'>
            <div class='card bg-dark border-secondary rounded shadow-sm'>
                <div class='card-body text-center p-4 px-5'>
                    <h6 class='text-uppercase mb-2 text-light fw-semibold'>
                        Totale Clienti
                    </h6>
                    <h2 class='fw-bold mb-0 text-danger display-6'>
                        {$valore_db}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class='d-flex justify-content-between align-items-center mb-4'>
        <h2 class='mb-0'>Clienti</h2>
        <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#addClienteModal'>
            <i class='bi bi-plus-circle me-1'></i>Aggiungi Cliente
        </button>
    </div>
    <div class='table-responsive'>
      <table class='table table-striped table-dark' id='clientiTable'>
        <thead><tr><th>ID</th><th>Nome</th><th>Cognome</th><th>Email</th><th>Data Nascita</th><th>Azioni</th></tr></thead>
        <tbody>$righe</tbody>
      </table>
    </div>
</div>

<div class='modal fade' id='addClienteModal' tabindex='-1'>
  <div class='modal-dialog'><div class='modal-content bg-dark border-danger'>
    <div class='modal-header bg-danger text-white border-0'>
      <h5 class='modal-title fw-bold'><i class='bi bi-plus-circle me-2'></i>Aggiungi Cliente</h5>
      <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
    </div>
    <div class='modal-body p-4'>
      <form method='POST' action='../Handler/ClientiHandler.php' id='addClienteForm'>
        <input type='hidden' name='action' value='add'>
        <div class='row g-3'>
          <div class='col-md-6'><label class='form-label text-white'>Nome</label><input type='text' class='form-control' name='nome' required></div>
          <div class='col-md-6'><label class='form-label text-white'>Cognome</label><input type='text' class='form-control' name='cognome' required></div>
          <div class='col-12'><label class='form-label text-white'>Data di Nascita</label><input type='date' class='form-control' name='data_nascita'></div>
          <div class='col-12'><label class='form-label text-white'>Email</label><input type='email' class='form-control' name='email' required></div>
          <div class='col-12'><label class='form-label text-white'>Password</label><input type='password' class='form-control' name='password' required></div>
        </div>
      </form>
    </div>
    <div class='modal-footer bg-dark border-danger'>
      <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button>
      <button type='submit' form='addClienteForm' class='btn btn-danger fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button>
    </div>
  </div></div>
</div>

<div class='modal fade' id='editClienteModal' tabindex='-1'>
  <div class='modal-dialog'><div class='modal-content bg-dark border-danger'>
    <div class='modal-header bg-danger text-dark border-0'>
      <h5 class='modal-title fw-bold'><i class='bi bi-pencil-fill me-2'></i>Modifica Cliente</h5>
      <button type='button' class='btn-close btn-close-dark' data-bs-dismiss='modal'></button>
    </div>
    <div class='modal-body p-4'>
      <form method='POST' action='../Handler/ClientiHandler.php' id='editClienteForm'>
        <input type='hidden' name='action' value='edit'>
        <input type='hidden' name='id' id='editId'>
        <div class='row g-3'>
          <div class='col-md-6'><label class='form-label text-white'>Nome</label><input type='text' class='form-control' name='nome' id='editNome' required></div>
          <div class='col-md-6'><label class='form-label text-white'>Cognome</label><input type='text' class='form-control' name='cognome' id='editCognome' required></div>
          <div class='col-12'><label class='form-label text-white'>Data di Nascita</label><input type='date' class='form-control' name='data_nascita' id='editNascita'></div>
          <div class='col-12'><label class='form-label text-white'>Email</label><input type='email' class='form-control' name='email' id='editEmail'></div>
        </div>
      </form>
    </div>
    <div class='modal-footer bg-dark border-danger'>
      <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Annulla</button>
      <button type='submit' form='editClienteForm' class='btn btn-warning text-dark fw-semibold'><i class='bi bi-check-circle me-1'></i>Salva</button>
    </div>
  </div></div>
</div>

<script>
function apriEditCliente(id, nome, cognome, email, nascita) {
    document.getElementById('editId').value      = id;
    document.getElementById('editNome').value    = nome;
    document.getElementById('editCognome').value = cognome;
    document.getElementById('editEmail').value   = email;
    document.getElementById('editNascita').value = nascita;
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
