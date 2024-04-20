const deleteForms = document.querySelectorAll('.delete-form');
const modal = document.getElementById('modal');
const modalLabel = document.getElementById('modalLabel');
const modalBody = document.querySelector('.modal-body');
const deleteButton = document.getElementById('modal-delete-confirmation');
const backButton = document.getElementById('modal-back-button');

// Variabile utile per svuotare il riferimento al form precedente
let activeForm = null;

// Variabile per verificare se il cestino è vuoto
const isEmpty = deleteForms.length === 1;

// Mi metto in ascolto su ogni tasto cestino...
deleteForms.forEach(form => {

    // Al click sul tasto cestino
    form.addEventListener('submit', e => {
        // Blocco il ricarimento della pagina
        e.preventDefault();

        // Il form cliccato è uguale al form attivo
        activeForm = form;

        // Se il cestino è vuoto...
        if (isEmpty) {
            modalLabel.innerText = 'ATTENZIONE';
            modalBody.innerText = "Un bel ☕️ potrebbe aiutarti, il cestino è vuoto!";
            modalBody.classList.add('my-1');
            backButton.innerText = 'Ok';
            deleteButton.classList.add('d-none');
        }

        // Se il cestino non è vuoto...
        if (!isEmpty) {
            // Inserisco contenuto all'interno della modale
            modalLabel.innerText = 'Conferma cancellazione';
            if (form.dataset.dish) {
                modalBody.innerText = `Sei sicuro di voler cancellare il piatto "${form.dataset.dish}"?`;
            } else {
                modalBody.innerText = `Sei sicuro di voler svuotare il cestino?`;

            }
            deleteButton.classList.add('btn-danger');
        }
    });

});

deleteButton.addEventListener('click', () => {
    if (activeForm) activeForm.submit();
})

modal.addEventListener('hidden.bs.modal', () => {
    activeForm = null;
})
