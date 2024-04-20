// Recupero gli elementi dal DOM
const htmlElement = document.documentElement;
const switchElement = document.getElementById('darkModeSwitch');
const switchLabel = document.getElementById('darkModeLabel');
let currentTheme;

// Imposto lo switch in base al tema selezionato in precedenza
switchElement.checked = localStorage.getItem('bsTheme') === 'dark';

// Recupero ed imposto il tema selezionato dallo storage
currentTheme = localStorage.getItem('bsTheme');
htmlElement.setAttribute('data-bs-theme', currentTheme);
switchLabel.innerText = currentTheme === 'dark' ? '🌙' : '☀️';

// Allo switch...
switchElement.addEventListener('change', function () {

    // Se ON allora imposto il tema e la label dark e aggiorno lo storage
    this.checked ? htmlElement.setAttribute('data-bs-theme', 'dark') : htmlElement.setAttribute('data-bs-theme', 'light');
    this.checked ? localStorage.setItem('bsTheme', 'dark') : localStorage.setItem('bsTheme', 'light')
    this.checked ? switchLabel.innerText = '🌙' : switchLabel.innerText = '☀️';
});
