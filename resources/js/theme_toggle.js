// Recupero gli elementi dal DOM
const htmlElement = document.documentElement;
const switchElement = document.getElementById('darkModeSwitch');
const switchLabel = document.getElementById('darkModeLabel');
const mainElement = document.getElementsByTagName('main')[0];
let currentTheme = 'light';

// Se mi arriva l'attributo in sessione setto il tema prescelto
if (!localStorage.getItem('bsTheme')) htmlElement.setAttribute('data-bs-theme', currentTheme);

// Imposto lo switch in base al tema selezionato in precedenza
switchElement.checked = localStorage.getItem('bsTheme') === 'dark';

// Recupero ed imposto il tema selezionato dallo storage
switchElement.classList.add('d-none');
currentTheme = localStorage.getItem('bsTheme');
htmlElement.setAttribute('data-bs-theme', currentTheme);

switchLabel.innerText = currentTheme === 'dark' ? '🌙' : '☀️';

// Dopo il caricamento della pagina mostriamo lo switch per evitare il flick
window.addEventListener("load", () => {
    switchElement.classList.remove('d-none');
});

// Allo switch...
switchElement.addEventListener('change', function () {

    // Se ON imposto lo sfondo
    this.checked ? mainElement.setAttribute("class", "bg-transparent") : mainElement.setAttribute("class", "bg-white");

    // Se ON allora imposto il tema e la label dark e aggiorno lo storage
    this.checked ? localStorage.setItem('bsTheme', 'dark') : localStorage.setItem('bsTheme', 'light')
    this.checked ? htmlElement.setAttribute('data-bs-theme', 'dark') : htmlElement.setAttribute('data-bs-theme', 'light');
    this.checked ? switchLabel.innerText = '🌙' : switchLabel.innerText = '☀️';
});
