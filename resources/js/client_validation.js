// Recupero gli elementi dal DOM

// Elementi Form
const form = document.getElementById('register-form');
const inputFields = document.querySelectorAll('.form-control');
const restaurantTypes = document.querySelectorAll('.btn-deliveboo');

// Suggerimenti
const nameSuggest = document.getElementById('name-suggest');
const emailSuggest = document.getElementById('email-suggest');
const passwordSuggest = document.getElementById('password-suggest');
const confirmPasswordSuggest = document.getElementById('confirmation-password-suggest');
const activityNameSuggest = document.getElementById('activity-name-suggest');
const addressSuggest = document.getElementById('address-suggest');
const vatSuggest = document.getElementById('vat-suggest');
const restaurantTypesSuggest = document.getElementById('restaurant-types-suggest');

// Elementi modale
const modal = document.getElementById('modal');
const modalLabel = document.getElementById('modalLabel');
const modalBody = document.querySelector('.modal-body');
const deleteButton = document.getElementById('modal-delete-confirmation');
const backButton = document.getElementById('modal-back-button');
const sendFormButton = document.getElementById('send-form-button');

// Preparo una variabile per conteggiare le tipologie scelte
let counter = 0;

// Preparo una variabile messaggio da mostrare
let message;

// Variabile per verificare se c'è matching tra il testo e le mail a sistema
let emailExsist = false;

//# Funzione per validare i campi del form
const fieldsValidation = () => {

    // Variabili per memorizzare il valore inserito dall'utente
    let passwordValue;
    let confirmPasswordValue;

    inputFields.forEach(input => {
        // Se il campo è obbligatorio
        if (input.hasAttribute('required')) {

            // Quando lascio il campo input
            input.addEventListener('blur', () => {

                // Recupero il valore inserito dall'utente senza spazi e con caratteri minuscoli
                const inputValue = input.value.toLowerCase().trim();

                // Se l'utente ha inserito del testo
                if (inputValue) {

                    // Nel campo name
                    if (input.id === 'name') {
                        // Se il testo inserito è almeno 3 caratteri
                        if (inputValue.length > 2) {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                            message = `<span class="text-success">Nome utente valido.</span>`;
                        } else {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                            message = `<span class="text-danger">Il nome utente deve contenere almeno 3 caratteri.</span>`;
                        }
                    }

                    // Nel campo email
                    if (input.id === 'email') {

                        // Variabile per verificare se la mail include @, .it, .com
                        const isEmailOk = inputValue.includes('@') && (inputValue.includes('.it') || inputValue.includes('.com'));

                        // Verifico se la mail inserita è già presente a sistema
                        for (const user of users) {
                            // Se c'è matching allora
                            if (user.email === inputValue) {
                                emailExsist = true;
                                break;
                            }
                        }

                        // Se la mail inserita rispetta le condizioni
                        if (isEmailOk && !emailExsist) {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                            message = `<span class="text-success">Indirizzo email valido.</span>`;
                        } else if (isEmailOk && emailExsist) {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                            message = `<span class="text-danger">L'indirizzo ${inputValue} è già in uso. Prova il reset password.</span>`;
                        } else {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                            message = `<span class="text-danger">Indirizzo mail non valido.</span>`;
                        }

                    }

                    // Variabile per verificare se le passwords hanno almeno 8 caratteri
                    const isPasswordOk = inputValue.length > 7;

                    // Nel campo password
                    if (input.id === 'password') {
                        // Inserisco il valore dell'input nella variabile
                        passwordValue = input.value.toLowerCase().trim();

                        // Se la password è lunga almneno 8 caratteri
                        if (isPasswordOk) {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                            message = `<span class="text-success">Password valida.</span>`;
                        }
                        // Se la password non è lunga almeno 8 caratteri
                        else {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                            message = `<span class="text-danger">La password deve contenere almeno 8 caratteri.</span>`;
                        }
                    }

                    // Nel campo password-confirm
                    if (input.id === 'password-confirm') {
                        // Inserisco il valore dell'input nella variabile
                        confirmPasswordValue = input.value.toLowerCase().trim();

                        // Se la password è lunga almneno 8 caratteri
                        if (isPasswordOk) {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                            message = `<span class="text-success">Password valida.</span>`;
                        }
                        // Se la password non è lunga almeno 8 caratteri
                        else {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                            message = `<span class="text-danger">La password deve contenere almeno 8 caratteri.</span>`;

                        }
                        // Se le password coincidono
                        if (passwordValue === confirmPasswordValue) {
                            input.classList.add('is-valid');
                            input.classList.remove('is-invalid');
                            message = `<span class="text-success">Le password coincidono.</span>`;
                        }
                        // Se non coincidono
                        else {
                            input.classList.remove('is-valid');
                            input.classList.add('is-invalid');
                            message = `<span class="text-danger">Le password non coincidono.</span>`;
                        }
                    }

                } else {
                    // Se l'utente non ha inserito testo e lascia l'input
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    message = `<span class="text-danger">Campo obbligatorio.</span>`;
                }

                // Stampo il messaggio
                if (input.id === 'name') nameSuggest.innerHTML = message;
                if (input.id === 'email') emailSuggest.innerHTML = message;
                if (input.id === 'password') passwordSuggest.innerHTML = message;
                if (input.id === 'password-confirm') confirmPasswordSuggest.innerHTML = message;

            });
        }

    });
}

//# Funzione per verificare se è stata selezionata almeno una tipologia di ristorante
const hasTypes = () => {

    // Giro sull'array di nodi
    restaurantTypes.forEach(type => {
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

// Chiamo la funzione per validare i campi
fieldsValidation()

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
