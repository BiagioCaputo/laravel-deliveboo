const placeholder = "https://marcolanci.it/boolean/assets/placeholder.png";
const logoField = document.getElementById('logo');
const previewFieldLogo = document.getElementById('preview-logo');

const changeLogoButton = document.getElementById('change-logo-button');
const previousLogoField = document.getElementById('previous-logo-field');

let blobUrl;

logoField.addEventListener('change', () => {

    //controllo se ho file
    if (logoField.files && logoField.files[0]) {

        //prendo il file
        const file = logoField.files[0];

        //preparo un url TEMPORANEO
        blobUrl = URL.createObjectURL(file);

        //lo inserisco nell'src
        previewFieldLogo.src = blobUrl;
    }
    else {
        previewFieldLogo.src = placeholder;
    }


});


//Gestione campo file

//al click cambio l'input mostrato

changeLogoButton.addEventListener('click', () => {
    previousLogoField.classList.add('d-none');
    logoField.classList.remove('d-none');
    previewField.src = placeholder;
    logoField.click();
})

window.addEventListener('click', () => {
    if (blobUrl) URL.revokeObjectURL(blobUrl);
})