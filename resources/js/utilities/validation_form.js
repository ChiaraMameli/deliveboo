const dishName = document.getElementById('name');
const price = document.getElementById('price');
const ingredients = document.getElementById('ingredients');
const form = document.getElementById('form');
const error = document.getElementById('error');

console.log('ciao');

form.addEventListener('submit', e => {
    let message = [];

    if(dishName.value === '' || dishName.value == null){
        message.push('Il nome del piatto è obbligatorio')
    }

    if(dishName.value.length > 30){
        message.push('Il nome del piatto è troppo lungo')
    }

    if(price.value === '' || price.value == null){
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
