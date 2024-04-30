// Recupero gli elementi DOM
const inputsFields = document.querySelectorAll('.form-control');
const forms = document.querySelectorAll('.dishes-form');
const dishNameSuggest = document.getElementById('dish-name-suggest');
const ingredientsSuggest = document.getElementById('ingredients-suggest');
const priceSuggest = document.getElementById('price-suggest');

//# Funzione per validare i campi obbligatori
const inputsFieldsValidation = (allFieldsValid) => {

    // Preparo un messaggio da stampare
    const message = `<span class="text-danger">Il campo è obbligatorio.</span>`

    // Per ogni input
    inputsFields.forEach(input => {

        // Se il campo è obbligatorio
        if (input.hasAttribute('required')) {
            if (!input.value) {
                allFieldsValid = false;

                if (input.id === 'name') {
                    dishNameSuggest.innerHTML = message;
                } else if (input.id === 'ingredients') {
                    ingredientsSuggest.innerHTML = message;
                } else if (input.id === 'price') {
                    priceSuggest.innerHTML = message;
                }
            }
        }
    });
    // Restituisco lo status dei campi obbligatori
    return allFieldsValid;
}

//! SVOLGIMENTO -------------------------------------------------------------------------

// Per ogni form
forms.forEach(form => {
    form.addEventListener('submit', e => {

        // Flag per verificare se tutti i campi sono validi
        let allFieldsValid = true;


        allFieldsValid = inputsFieldsValidation(allFieldsValid);

        // Se tutti i campi non sono compilati
        if (!allFieldsValid) {
            e.preventDefault();
        } else {
            form.submit();
        }
    })
});
