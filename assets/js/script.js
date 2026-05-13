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

    const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

    function getOrCreateFeedback(input) {
        let feedback = input.paren
        tNode.querySelector('.invalid-feedback');
        if (!feedback) {
            feedback = document.createElement('div');
            feedback.className = 'invalid-feedback';
            input.parentNode.appendChild(feedback);
        }
        return feedback;
    }

    function showEmailError(input) {
        input.classList.add('is-invalid');
        getOrCreateFeedback(input).textContent = 'Inserisci un indirizzo email valido.';
    }

    function clearEmailError(input) {
        input.classList.remove('is-invalid');
        const feedback = input.parentNode.querySelector('.invalid-feedback');
        if (feedback) {
            feedback.textContent = '';
        }
    }

    document.querySelectorAll('form').forEach(form => {
        const emailInputs = Array.from(form.querySelectorAll('input[type="email"]'));
        if (!emailInputs.length) {
            return;
        }

        emailInputs.forEach(input => {
            input.addEventListener('input', () => clearEmailError(input));
        });

        form.addEventListener('submit', event => {
            let valid = true;
            emailInputs.forEach(input => {
                const value = input.value.trim();
                if (!value || !emailPattern.test(value)) {
                    valid = false;
                    showEmailError(input);
                } else {
                    clearEmailError(input);
                }
            });

            if (!valid) {
                event.preventDefault();
                emailInputs.find(input => !emailPattern.test(input.value.trim()))?.focus();
            }
        });
    });
});
