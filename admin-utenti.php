<?php

require_once __DIR__ . "/config/db.php";


$title      = 'Gestione Utenti';
$activePage = 'utenti';
$body = '<div class="container-fluid bg-dark text-white p-4">
    <h2 class="mb-4">Gestione Utenti</h2>
    <div class="mb-3">
        <button class="btn btn-success">+ Aggiungi Utente</button>
    </div>
    <div class="table-responsive mb-4">
      <table class="table table-striped table-dark" id="usersTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Ruolo</th>
            <th>Creazione</th>
            <th>Azioni</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td>1</td>
              <td>marco.rossi@email.com</td>
              <td><span class="badge bg-success">Admin</span></td>
              <td>2025-10-15</td>
              <td><button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Elimina</button></td>
            </tr>
            <tr>
              <td>2</td>
              <td>giulia.bianchi@email.com</td>
              <td><span class="badge bg-info">Moderatore</span></td>
              <td>2025-11-22</td>
              <td><button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Elimina</button></td>
            </tr>
            <tr>
              <td>3</td>
              <td>luca.verdi@email.com</td>
              <td><span class="badge bg-warning text-dark">Utente</span></td>
              <td>2025-12-01</td>
              <td><button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Elimina</button></td>
            </tr>
            <tr>
              <td>4</td>
              <td>anna.neri@email.com</td>
              <td><span class="badge bg-warning text-dark">Utente</span></td>
              <td>2025-12-10</td>
              <td><button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Elimina</button></td>
            </tr>
            <tr>
              <td>5</td>
              <td>Paolo.gialli@email.com</td>
              <td><span class="badge bg-info">Moderatore</span></td>
              <td>2026-01-05</td>
              <td><button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Elimina</button></td>
            </tr>
            <tr>
              <td>6</td>
              <td>sara.blu@email.com</td>
              <td><span class="badge bg-warning text-dark">Utente</span></td>
              <td>2026-02-14</td>
              <td><button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Elimina</button></td>
            </tr>
            </tbody>
      </table>
    </div>
</div>
';

$template = file_get_contents("inc/admin_page.inc.php");
$template = str_replace("{{title}}", $title, $template);
$template = str_replace("{{body}}", $body, $template);
echo $template;
