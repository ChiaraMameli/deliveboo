<template>
    <main id="cart">
        <div class="jumbotron">
            <img src="../../../image/deliveboo-cart.png" alt="">
        </div>
        <div class="container pt-3 pb-5">
            <div class="card cart p-5 mt-5">
                <table class="table">
                    <thead class="bg-danger text-white">
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">Piatto</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Quantità</th>
                        <th scope="col">Sub-totale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dish in cart" :key="dish.id">
                        <th scope="row"><i @click="removeDish(dish)" class="fa-solid fa-xmark"></i></th>
                        <td>{{dish.dish}}</td>
                        <td>{{dish.price}}€</td>
                        <td><input @change="getCurrentQuantity(dish)" type="number" step="1" min="1" max="50" :value="dish.quantity" id="quantity"></td>
                        <td>{{getSubTotal(dish)}}€</td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <i class="fa-solid fa-rotate-left btn btn-primary updated">Aggiorna carrello</i>
                    <i @click="removeAll()"  class="fa-solid fa-trash btn btn-warning">Svuota carrello</i>
                </div>
            </div>

            <div class="card cart p-5 mt-5">
                <form id="checkout-form">
                    <div class="form-group">
                        <label for="name">Nome e cognome</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Indirizzo email</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Numero di telefono</label>
                            <input type="phone" class="form-control" id="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Indirizzo completo</label>
                        <input type="text" class="form-control" id="address">
                    </div>
                </form>
                <router-link :to="{ name: 'payment'}" class="btn btn-primary m-auto"> Vai al Checkout
                </router-link>
            </div>
        </div>
    </main>
</template>

<script>
export default{
    name: 'CartPage',
    data(){
        return{
            cart: [],
        }
    },
    methods:{
        removeDish(dish){
            console.log(dish);
            this.cart = this.cart.filter(item => item !== dish);
            localStorage.cart = JSON.stringify(this.cart);

            this.$emit('unpopulated-cart', this.cart);
        },
        getSubTotal(dish){
            let subTotal = 0;
            subTotal = dish.price * dish.quantity;
            return subTotal;
        },
        getCurrentQuantity(dish){
            const inputValue = document.getElementById('quantity');

            dish.quantity = inputValue.value;
        },
        removeAll(){
            const hasConfirmed = confirm("Sei sicuro di voler svuotare il carrello?");
              if(hasConfirmed) {
                localStorage.cart = [];
                this.cart = [];
              } else {
                die();
              }
        }
    },
    mounted(){
        if(localStorage.cart){
            this.cart = JSON.parse(localStorage.cart);
        }
    },
    watch:{
        cart(newCart){
            localStorage.cart = JSON.stringify(newCart);
        }
    }
}
</script>

<style lang="scss" scoped>
    #cart{
        min-height: calc(100vh - 50px);
        background-color: #F6E7C1;

        .jumbotron{
            height: 600px;
            background-image: url('../../../image/delivery-1.png');
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;

            img{
                width: 50%;
                position: absolute;
                bottom: 50%;
                left: 50%;
                transform: translate(-50%, 50%);
            }
        }

        .card.cart{
            border: none;
            border-radius: 20px;
            box-shadow: 0 0 5px rgb(146, 146, 146);
        }
    }
</style>