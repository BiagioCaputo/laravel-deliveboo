// Recupero gli elementi dal DOM
const addButton = document.getElementById('add-new-type');
const saveButton = document.getElementById('new-type-save');
const arrayTypes = document.getElementsByName('types[]');
const checkboxes = document.getElementById('checkboxes');

console.log('Array:', arrayTypes[0].labels[0].innerText)
// arrayTypes.forEach(input => {
//     console.log(input.labels)

// });

const currentTypes = [];

for (let i = 0; i < arrayTypes.length; i++) {
    const element = arrayTypes[i];

    arrayTypes[i].labels.forEach(label => {
        // console.log(label)
        currentTypes.push(label.innerText);
    });
}
console.log(currentTypes)


// Al click sul tasto crea tipologia
addButton.addEventListener('click', () => {

    // Recupero l'input
    let newType = document.getElementById('new-type');

    // Appare il tasto salva
    saveButton.classList.remove('d-none');
    saveButton.classList.add('mb-3');

    // Al click sul tasto salva
    saveButton.addEventListener('click', () => {

        // Id della nuova tipologia calcolato sulla lunghezza del nodo
        const newTypeId = arrayTypes.length + 1;

        // Recupero la label della nuova tipologia
        let typeLabel = newType.value.trim()

        // Capitalizzo il primo carattere della label
        typeLabel = (typeLabel[0].toUpperCase()) + typeLabel.slice(1);

        // Se la label non è vuota e non è presente tra le tipologie proposte
        if (typeLabel.length && !currentTypes.includes(typeLabel)) {

            // Preparo il template per la nuova tipologia
            let newInput = `
            <div class="form-check form-check-inline">
            <input class="form-check-input" name="types[]" type="checkbox" id="tech-${newTypeId}"
            value="${newTypeId}" @if (in_array(${newTypeId}, old('types', $previous_types ?? []))) checked @endif >
            <label class="form-check-label" for="tech-${newTypeId}">${typeLabel}</label>
            </div>`

            // Aggiorno l'array delle tipologie presenti
            currentTypes.push(typeLabel)

            // Stampo il template
            checkboxes.innerHTML += newInput;

            console.log(typeLabel)
        }
        // newType.value = '';

        console.log(currentTypes)

        console.log(arrayTypes)

    });

});


