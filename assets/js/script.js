// ── SPETTACOLI ──
const editSpettacoloModal = document.getElementById('editSpettacoloModal');
if (editSpettacoloModal) {
    editSpettacoloModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        document.getElementById('editId').value       = btn.dataset.id;
        document.getElementById('editTitolo').value   = btn.dataset.titolo;
        document.getElementById('editTrama').value    = btn.dataset.trama;
        document.getElementById('editRegista').value  = btn.dataset.regista;
        document.getElementById('editTematica').value = btn.dataset.tematica;
        document.getElementById('editCasa').value     = btn.dataset.casa;
    });
}
if (document.getElementById('spettacoliTable')) {
    new DataTable('#spettacoliTable');
}

// ── REGISTI ──
const editRegistaModal = document.getElementById('editRegistaModal');
if (editRegistaModal) {
    editRegistaModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        document.getElementById('editId').value      = btn.dataset.id;
        document.getElementById('editNome').value    = btn.dataset.nome;
        document.getElementById('editCognome').value = btn.dataset.cognome;
        document.getElementById('editNascita').value = btn.dataset.nascita === '—' ? '' : btn.dataset.nascita;
    });
}
if (document.getElementById('registiTable')) {
    new DataTable('#registiTable');
}

// ── CASE PRODUTTRICI ──
const editCasaModal = document.getElementById('editCasaModal');
if (editCasaModal) {
    editCasaModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        document.getElementById('editId').value   = btn.dataset.id;
        document.getElementById('editNome').value = btn.dataset.nome;
        document.getElementById('editSede').value = btn.dataset.sede === '—' ? '' : btn.dataset.sede;
    });
}
if (document.getElementById('caseTable')) {
    new DataTable('#caseTable');
}

// ── CINEMA & SALE ──
const editCinemaModal = document.getElementById('editCinemaModal');
if (editCinemaModal) {
    editCinemaModal.addEventListener('show.bs.modal', function(e) {
        const b = e.relatedTarget;
        document.getElementById('editCinemaId').value    = b.dataset.id;
        document.getElementById('editCinemaNome').value  = b.dataset.nome;
        document.getElementById('editCinemaInd').value   = b.dataset.indirizzo === '—' ? '' : b.dataset.indirizzo;
        document.getElementById('editCinemaCitta').value = b.dataset.citta === '—' ? '' : b.dataset.citta;
    });
}
const editSalaModal = document.getElementById('editSalaModal');
if (editSalaModal) {
    editSalaModal.addEventListener('show.bs.modal', function(e) {
        const b = e.relatedTarget;
        document.getElementById('editSalaId').value       = b.dataset.id;
        document.getElementById('editSalaNome').value     = b.dataset.nome;
        document.getElementById('editSalaCapienza').value = b.dataset.capienza;
        document.getElementById('editSalaCinema').value   = b.dataset.cinema;
    });
}
if (document.getElementById('cinemaTable')) new DataTable('#cinemaTable');
if (document.getElementById('saleTable'))   new DataTable('#saleTable');

// ── PROIEZIONI ──
const editProiezioneModal = document.getElementById('editProiezioneModal');
if (editProiezioneModal) {
    editProiezioneModal.addEventListener('show.bs.modal', function(e) {
        const b = e.relatedTarget;
        document.getElementById('editId').value         = b.dataset.id;
        document.getElementById('editData').value       = b.dataset.data.replace(' ', 'T');
        document.getElementById('editSpettacolo').value = b.dataset.spettacolo;
        document.getElementById('editSala').value       = b.dataset.sala;
    });
}
if (document.getElementById('proiezioniTable')) new DataTable('#proiezioniTable');

// ── PRENOTAZIONI ──
if (document.getElementById('prenotazioniTable')) new DataTable('#prenotazioniTable');

// ── CLIENTI ──
const editClienteModal = document.getElementById('editClienteModal');
if (editClienteModal) {
    editClienteModal.addEventListener('show.bs.modal', function(e) {
        const b = e.relatedTarget;
        document.getElementById('editId').value      = b.dataset.id;
        document.getElementById('editNome').value    = b.dataset.nome;
        document.getElementById('editCognome').value = b.dataset.cognome;
        document.getElementById('editNascita').value = b.dataset.nascita === '—' ? '' : b.dataset.nascita;
    });
}
if (document.getElementById('clientiTable')) new DataTable('#clientiTable');