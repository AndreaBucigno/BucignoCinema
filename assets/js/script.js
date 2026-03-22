document.addEventListener('DOMContentLoaded', function () {

    // ── DATATABLES ──
    if (document.getElementById('spettacoliTable'))   new DataTable('#spettacoliTable');
    if (document.getElementById('registiTable'))      new DataTable('#registiTable');
    if (document.getElementById('caseTable'))         new DataTable('#caseTable');
    if (document.getElementById('cinemaTable'))       new DataTable('#cinemaTable');
    if (document.getElementById('saleTable'))         new DataTable('#saleTable');
    if (document.getElementById('proiezioniTable'))   new DataTable('#proiezioniTable');
    if (document.getElementById('prenotazioniTable')) new DataTable('#prenotazioniTable');
    if (document.getElementById('clientiTable'))      new DataTable('#clientiTable');
    if (document.getElementById('UserprenotazioniTable'))       new DataTable('#UserprenotazioniTable');

});
