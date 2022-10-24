const formRestaurant = document.getElementById('form-restaurant');
const errorRestaurant = document.getElementById('error-restaurant');
const address = document.getElementById('address');

console.log('ciao');

formRestaurant.addEventListener('submit', e => {
    let message = [];

    if(address.value === '' || address.value == null){
        message.push('Gli ingredienti sono obbligatori')
    }

    if(message.length > 0){
        e.preventDefault();
        errorRestaurant.innerText = message.join(' - ');
        errorRestaurant.classList.add("alert-danger");
    }
    
})
