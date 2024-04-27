// Recupero gli elementi dal DOM
const buttonsNode = document.querySelectorAll('.btn-deliveboo');
const form = document.getElementById('register-form');
const nameField = document.getElementById('name');
const emailField = document.getElementById('email');
const passwordField = document.getElementById('password');
const confirmPasswordField = document.getElementById('password-confirm');
const activityNameField = document.getElementById('activity_name');
const addressField = document.getElementById('address');
const vatField = document.getElementById('vat');
const modal = document.getElementById('modal');
const modalLabel = document.getElementById('modalLabel');
const modalBody = document.querySelector('.modal-body');
const deleteButton = document.getElementById('modal-delete-confirmation');
const backButton = document.getElementById('modal-back-button');
const sendFormButton = document.getElementById('send-form-button');

const emailSuggest = document.getElementById('email-suggest');

// Preparo una variabile per conteggiare le tipologie scelte
let counter = 0;

//# Funzione per verificare se è stata selezionata almeno una tipologia di ristorante
const hasTypes = () => {

    // Giro sull'array di nodi
    buttonsNode.forEach(type => {
        // Al click su un button
        type.addEventListener('click', e => {

            // Aggiungo la classe clicked
            e.target.classList.toggle('clicked');

            // Se il button è stato cliccato aumento il counter di 1 altrimenti sottraggo di 1
            e.target.classList.contains('clicked') ? ++counter : --counter;
            console.log(counter)
        })
    });
}

//# Funzione per preparare la modale
const makeModal = () => {
    // Preparo la modale
    deleteButton.classList.add('d-none');
    backButton.innerText = 'Ho capito!';
    modalLabel.innerText = 'Dati mancanti';
    modalBody.classList.add('my-2');
    modalBody.innerText = 'Per poter procedere con la registrazione è necessario inserire tutti i dati richiesti!';
}

//! SVOLGIMENTO -------------------------------------------------------------------------

// Chiamo la funzione che verifica se c'è almeno una tipologia
hasTypes();

// All'invio del form
form.addEventListener('submit', e => {

    // Verifico se sono soddisfatte le condizioni per l'invio del form
    if (!nameField.value || !emailField.value || !passwordField.value || !confirmPasswordField.value || !activityNameField.value || !addressField.value || !vatField.value || !counter) {
        e.preventDefault();
        showModal();
    } else {
        modal.classList.add('d-none');
        form.submit();
    }
})
