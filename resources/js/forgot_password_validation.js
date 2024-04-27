// Recupero gli elementi dal DOM
const form = document.getElementById('forgot-password-form');
const sendButton = document.getElementById('send-button');
const input = document.getElementById('email');

const emailSuggest = document.getElementById('email-suggest');

let message = `<span class="text-danger fw-bold">Campo obbligatorio.</span>`;

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
    } else {
        form.submit();
    }
})
