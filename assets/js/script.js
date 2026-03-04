//TABELLA SPETTACOLI
document.getElementById('editSpettacoloModal').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    document.getElementById('editId').value       = btn.dataset.id;
    document.getElementById('editTitolo').value   = btn.dataset.titolo;
    document.getElementById('editTrama').value    = btn.dataset.trama;
    document.getElementById('editRegista').value  = btn.dataset.regista;
    document.getElementById('editTematica').value = btn.dataset.tematica;
    document.getElementById('editCasa').value     = btn.dataset.casa;
});


document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('deleteId').value      = this.dataset.id;
        document.getElementById('deleteTitolo').textContent = this.dataset.titolo;
        new bootstrap.Modal(document.getElementById('deleteSpettacoloModal')).show();
    });
});


new DataTable('#spettacoliTable');

//TABELLA REGISTI
document.getElementById('editRegistaModal').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    document.getElementById('editId').value      = btn.dataset.id;
    document.getElementById('editNome').value    = btn.dataset.nome;
    document.getElementById('editCognome').value = btn.dataset.cognome;
    document.getElementById('editNascita').value = btn.dataset.nascita === '—' ? '' : btn.dataset.nascita;
});
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('deleteId').value          = this.dataset.id;
        document.getElementById('deleteNome').textContent  = this.dataset.nome;
        new bootstrap.Modal(document.getElementById('deleteRegistaModal')).show();
    });
});
new DataTable('#registiTable');


//CASE PRODUTTRICI
document.getElementById('editCasaModal').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    document.getElementById('editId').value   = btn.dataset.id;
    document.getElementById('editNome').value = btn.dataset.nome;
    document.getElementById('editSede').value = btn.dataset.sede === '—' ? '' : btn.dataset.sede;
});
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('deleteId').value         = this.dataset.id;
        document.getElementById('deleteNome').textContent = this.dataset.nome;
        new bootstrap.Modal(document.getElementById('deleteCasaModal')).show();
    });
});
new DataTable('#caseTable');

//cinema e sale 
document.getElementById('editCinemaModal').addEventListener('show.bs.modal', function(e) {
    const b = e.relatedTarget;
    document.getElementById('editCinemaId').value    = b.dataset.id;
    document.getElementById('editCinemaNome').value  = b.dataset.nome;
    document.getElementById('editCinemaInd').value   = b.dataset.indirizzo === '—' ? '' : b.dataset.indirizzo;
    document.getElementById('editCinemaCitta').value = b.dataset.citta === '—' ? '' : b.dataset.citta;
});
document.querySelectorAll('.btn-delete-cinema').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('deleteCinemaId').value          = this.dataset.id;
        document.getElementById('deleteCinemaNome').textContent  = this.dataset.nome;
        new bootstrap.Modal(document.getElementById('deleteCinemaModal')).show();
    });
});
document.getElementById('editSalaModal').addEventListener('show.bs.modal', function(e) {
    const b = e.relatedTarget;
    document.getElementById('editSalaId').value       = b.dataset.id;
    document.getElementById('editSalaNome').value     = b.dataset.nome;
    document.getElementById('editSalaCapienza').value = b.dataset.capienza;
    document.getElementById('editSalaCinema').value   = b.dataset.cinema;
});
document.querySelectorAll('.btn-delete-sala').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('deleteSalaId').value          = this.dataset.id;
        document.getElementById('deleteSalaNome').textContent  = this.dataset.nome;
        new bootstrap.Modal(document.getElementById('deleteSalaModal')).show();
    });
});
new DataTable('#cinemaTable');
new DataTable('#saleTable');

//proiezioni
document.getElementById('editProiezioneModal').addEventListener('show.bs.modal', function(e) {
    const b = e.relatedTarget;
    document.getElementById('editId').value          = b.dataset.id;
    document.getElementById('editData').value        = b.dataset.data.replace(' ','T');
    document.getElementById('editSpettacolo').value  = b.dataset.spettacolo;
    document.getElementById('editSala').value        = b.dataset.sala;
});
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('deleteId').value          = this.dataset.id;
        document.getElementById('deleteNome').textContent  = this.dataset.nome;
        new bootstrap.Modal(document.getElementById('deleteProiezioneModal')).show();
    });
});
new DataTable('#proiezioniTable');

//prenotazioni
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('deleteId').value          = this.dataset.id;
        document.getElementById('deleteNome').textContent  = this.dataset.nome;
        new bootstrap.Modal(document.getElementById('deletePrenotazioneModal')).show();
    });
});
new DataTable('#prenotazioniTable');

//clienti

document.getElementById('editClienteModal').addEventListener('show.bs.modal', function(e) {
    const b = e.relatedTarget;
    document.getElementById('editId').value      = b.dataset.id;
    document.getElementById('editNome').value    = b.dataset.nome;
    document.getElementById('editCognome').value = b.dataset.cognome;
    document.getElementById('editNascita').value = b.dataset.nascita === '—' ? '' : b.dataset.nascita;
});
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('deleteId').value          = this.dataset.id;
        document.getElementById('deleteNome').textContent  = this.dataset.nome;
        new bootstrap.Modal(document.getElementById('deleteClienteModal')).show();
    });
});
new DataTable('#clientiTable');