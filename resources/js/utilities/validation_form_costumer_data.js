const costumerName = document.getElementById('name');
const costumerEmail = document.getElementById('email');
const price = document.getElementById('price');
const ingredients = document.getElementById('ingredients');
const form = document.getElementById('form');
const error = document.getElementById('error');

console.log('ciao');

form.addEventListener('submit', e => {
    let message = [];

    if(costumerName.value === '' || costumerName.value == null){
        message.push('Inserisci nome e cognome per procedere')
    }

    if(costumerEmail.value === '' || costumerEmail.value == null){
        message.push('Il prezzo del piatto è obbligatorio')
    }

    if(price.value > 1000){
        message.push('Il prezzo del piatto non può essere superiore a 1000')
    }

    if(ingredients.value === '' || ingredients.value == null){
        message.push('Gli ingredienti sono obbligatori')
    }

    if(message.length > 0){
        e.preventDefault();
        error.innerText = message.join(' - ');
        error.classList.add("alert-danger");
    }
    
})