const placeholder = "https://marcolanci.it/boolean/assets/placeholder.png";
const imageField = document.getElementById('image');
const previewField = document.getElementById('preview');

const changeImageButton = document.getElementById('change-image-button');
const previousImageField = document.getElementById('previous-image-field');

let blobUrl;

imageField.addEventListener('change', () => {

    //controllo se ho file
    if (imageField.files && imageField.files[0]) {

        //prendo il file
        const file = imageField.files[0];

        //preparo un url TEMPORANEO
        blobUrl = URL.createObjectURL(file);

        //lo inserisco nell'src
        previewField.src = blobUrl;
    }
    else {
        previewField.src = placeholder;
    }


});


//Gestione campo file

//al click cambio l'input mostrato

changeImageButton.addEventListener('click', () => {
    previousImageField.classList.add('d-none');
    imageField.classList.remove('d-none');
    previewField.src = placeholder;
    imageField.click();
})

window.addEventListener('click', () => {
    if (blobUrl) URL.revokeObjectURL(blobUrl);
})