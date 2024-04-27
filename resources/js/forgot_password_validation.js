// Recupero gli elementi dal DOM
const form = document.getElementById('forgot-password-form');
const sendButton = document.getElementById('send-button');
const input = document.getElementById('email');

// Elementi modale
const modal = document.getElementById('modal');
const modalLabel = document.getElementById('modalLabel');
const modalHeader = document.querySelector('.modal-header');
const modalBody = document.querySelector('.modal-body');
const deleteButton = document.getElementById('modal-delete-confirmation');
const backButton = document.getElementById('modal-back-button');
const sendFormButton = document.getElementById('send-form-button');

const emailSuggest = document.getElementById('email-suggest');

let message = `<span class="text-danger fw-bold">Campo obbligatorio.</span>`;

//# Funzione per preparare la modale
const makeModal = () => {
    // Preparo la modale
    deleteButton.classList.add('d-none');
    backButton.classList.remove('btn-secondary');
    backButton.classList.add('btn-deliveboo');
    modalHeader.classList.add('bg-deliveboo');
    backButton.innerText = 'Ho capito!';
    modalLabel.innerText = 'Dati mancanti';
    modalBody.classList.add('my-2');
    modalBody.innerText = 'Per poter procedere con il reset password è necessario inserire un indirizzo email!';
}

// All'invio del form
form.addEventListener('submit', e => {

    // Flag per verificare se tutti i campi sono validi
    let isFieldValid = true;

    // Se non abbiamo valori nell'input
    if (!input.value) {
        // Imposto il flag a falso
        isFieldValid = false;
        emailSuggest.innerHTML = message;
    }

    // Se il campo non contiene value, non invio il form
    if (!isFieldValid) {
        // Impedisco l'invio del form
        e.preventDefault();
        // Mostro la modale di avviso
        makeModal();
    } else {
        modal.classList.add('d-none');
        form.submit();
    }
})
