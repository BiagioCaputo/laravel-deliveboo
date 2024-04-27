// Recupero gli elementi dal DOM
const form = document.getElementById('login-form');
const sendButton = document.getElementById('send-button');
const inputs = document.querySelectorAll('.form-control');

const emailSuggest = document.getElementById('email-suggest');
const passwordSuggest = document.getElementById('password-suggest');

let message = `<span class="text-danger fw-bold">Campo obbligatorio.</span>`;

form.addEventListener('submit', e => {

    // Flag per verificare se tutti i campi sono validi
    let allFieldsValid = true;

    inputs.forEach(input => {
        // Se il campo è obbligatorio
        if (input.hasAttribute('required'))
            // Verifico se i campi non sono vuoti
            if (!input.value) {
                allFieldsValid = false;
                emailSuggest.innerHTML = message;
                passwordSuggest.innerHTML = message;
            }
    });

    // Se tutti i campi non sono validi, non invio il form
    if (!allFieldsValid) {
        // Impedisco l'invio del form
        e.preventDefault();

    } else {
        form.submit();
    }
})
