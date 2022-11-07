<template>
    <main id="cart">
        <div class="jumbotron">
            <img src="../../../image/deliveboo-cart.png" alt="">
        </div>
        <div class="container pt-3 pb-5">
            <router-link v-if="!cart.length == 0"
                :to="{ name: 'restaurant-details', params: { id: goToRestaurantMenu() } }">
                <a class="btn btn-danger p-3"><i class="fa-solid fa-utensils"></i> Torna al menu</a>
            </router-link>
            <router-link v-else :to="{ name: 'home' }">
                <a class="btn btn-danger p-3"><i class="fa-solid fa-house"></i> Torna all Home</a>
            </router-link>
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
                            <td scope="row"><i @click="removeDish(dish)" class="fa-solid fa-xmark"></i></td>
                            <td>{{ dish.name }}</td>
                            <td>{{ dish.price }}€</td>
                            <td>
                                <button @click="dish.quantity -= 1"  class="btn btn-outline">-</button>
                                <input type="number" step="1" min="1" max="50" id="quantity" :value="dish.quantity" disabled>
                                <button @click="dish.quantity += 1" class="btn btn-outline">+</button>
                            </td>
                            <td>{{ getSubTotal(dish) }}€</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <thead class="bg-danger text-white">
                        <tr class="d-flex justify-content-between">
                            <th scope="col">Totale</th>
                            <th scope="col">{{ getTotal() }}</th>
                        </tr>
                    </thead>
                </table>
                <div class="d-flex justify-content-between">
                    <button @click="removeAll()" class="btn btn-warning">
                        <i class="fa-solid fa-trash"> Svuota carrello</i>
                    </button>
                    <button @click="buy()" class="btn btn-primary updated">
                        <i class="fa-solid fa-rotate-right"> Aggiorna il carrello</i>
                    </button>
                </div>
            </div>

            <!-- modale -->
            <div id="overlay" class="d-none">
                <div id="modale" class="bg-white p-5 rounded d-none">
                  <p>Sei sicuro di voler svuotare il carrello?</p>
                  <a id="modale-button-no" class="btn btn-primary">Annulla</a>
                  <a id="modale-button-yes" href="" class="btn btn-primary">Ok</a>
                </div>
              </div>

            <div id="id" class="card cart p-5 mt-5">
                <!-- @submit.prevent="getPivotData()" -->
                <form  action="http://127.0.0.1:8000/payment" >
                    <div class="form-group">
                        <label for="name">Nome e cognome</label>
                        <input type="text" v-model="form.customer_name" class="form-control" id="name">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Indirizzo email</label>
                            <input type="email" v-model="form.customer_email" class="form-control" id="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Numero di telefono</label>
                            <input type="phone" v-model="form.customer_phone" class="form-control" id="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Indirizzo completo</label>
                        <input type="text" v-model="form.customer_address" class="form-control" id="address">
                    </div>
                    <button @click.prevent="getData()" type="submit" class="btn btn-primary">Ordina</button>
                </form>
            </div>
        </div>
    </main>
</template>

<script>
import axios from 'axios';
export default{
    name: 'CartPage',
    data() {
        return {
            cart: [],
            form: {
                customer_name: '',
                customer_email: '',
                customer_phone: '',
                customer_address: '',
            },
            amount: 0,
            restaurant_id: 0,
            dishes: [],
            dish_ids: [],
            dish_id: 0,
            quantity: 0,
        }
    },
    methods: {
        goToRestaurantMenu() {
            let restaurantMenu = this.cart[0].restaurant;
            return restaurantMenu
        },

        removeDish(dish) {
            this.cart = this.cart.filter(item => item !== dish);
            localStorage.cart = JSON.stringify(this.cart);

            this.$emit('unpopulated-cart', this.cart);
        },
        getSubTotal(dish) {
            let subTotal = 0;
            subTotal = dish.price * dish.quantity;
            return subTotal;
        },
        getTotal() {
            let totalPrice = 0;
            this.cart.forEach(dish => {
                totalPrice += dish.price * dish.quantity;
            });
            this.amount = totalPrice;
            return totalPrice + '€';
        },
        removeAll() {
            // Recupero gli elementi per mostrare la modale
            const modale = document.getElementById('modale');
            const overlay = document.getElementById('overlay');
            const modaleButtonNo = document.getElementById('modale-button-no');
            const modaleButtonYes = document.getElementById('modale-button-yes');

            // mostro la modale in pagina
            overlay.classList.remove('d-none');
            modale.classList.remove('d-none');
            
            modaleButtonNo.addEventListener('click', function(){
              overlay.classList.add('d-none');
              modale.classList.add('d-none');
            })

            modaleButtonYes.addEventListener('click', function(){
              localStorage.cart = [];
              this.cart = []
            })
        },
        buy(){
            localStorage.cart = JSON.stringify(this.cart);

            this.$emit('populated-cart', this.cart);
            // window.scrollTo(0, 1000);
        },
        getPivotData(){
            const dishes = [];

        //     this.cart.forEach(item => {
        //         const dish = {
        //             'id': item.dish,
        //             'quantity': item.quantity
        //         }
        //         dishes.push(dish);
        //         this.restaurant_id = item.restaurant;
        //     });
        //     console.log(dishes);
            
        //      this.$http.post('http://127.0.0.1:8000/api/pivot', {
        //         dish_id: dishes[0].id,
        //         order_id: this.order_id,
        //         quantity: dishes[0].quantity,
               

       }, 

        //     }).then(() => {
        //     });

       // }, 
            // saveData(){
        //     axios.post('http://127.0.0.1:8000/api/orders-store', {
        //         customer_name: this.form.customer_name,
        //         customer_email: this.form.customer_email,
        //         customer_phone: this.form.customer_phone,
        //         customer_address: this.form.customer_address,
        //         restaurant_id: this.restaurant_id,
        //         amount: this.amount,

      // },

        getData(){
            this.cart.forEach(item => {
                const dish = {
                    'id': item.dish,
                    'quantity': item.quantity
                }
                this.dishes.push(dish);
                this.restaurant_id = item.restaurant;
                this.dish_id = item.dish;
                this.dish_ids.push(item.dish);
                this.quantity = item.quantity;
                //console.log(item.dish);
            });
            // this.dish_id.forEach(item => {
            //     this.dish = item
            // });
            // console.log(this.dish);
            console.log(this.dishes); 
          
            axios.post('http://127.0.0.1:8000/api/orders-store', {
                
                customer_name: this.form.customer_name,
                customer_email: this.form.customer_email,
                customer_phone: this.form.customer_phone,
                customer_address: this.form.customer_address,
                restaurant_id: this.restaurant_id,
                amount: this.amount,
                cart_dishes: JSON.stringify(this.dishes)
                // dish_id: this.dish_id,
                // quantity: this.quantity,
                
                
            }).then(() => {
                // console.log(data)
                
                this.form.customer_name = '',
                this.form.customer_email = '',
                this.form.customer_phone = '',
                this.form.customer_address = '',
                
                
                this.amount = ''
            });               
        },
    },
    mounted() {
        if (localStorage.cart) {
            this.cart = JSON.parse(localStorage.cart);
        };
    },
   

    watch:{
        cart(newCart){
            localStorage.cart = JSON.stringify(newCart);
        },
        amount(newAmount) {
            localStorage.amount = JSON.stringify(newAmount);
        }
    },
}
</script>

<style lang="scss" scoped>
#cart {
    min-height: calc(100vh - 50px);
    background-color: #F6E7C1;

    #overlay {
      position: fixed; /* Sit on top of the page content */
      width: 100%; /* Full width (cover the whole page) */
      height: 100%; /* Full height (cover the whole page) */
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.8); /* Black background with opacity */
      z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
      cursor: pointer; /* Add a pointer on hover */

        #modale{
        position: absolute;
        top: 50vh;
        left: 50vw;
        transform: translate(-50%, -50%);
        z-index: 1;
      }
    }

    table{

        thead {
            border-radius: 20px;

            th {
                border: none;
            }
        }

        #quantity{
            color: black;
            border: 2px solid red;
            border-radius: 10px;
        }

    }

    .jumbotron {
        height: 600px;
        background-image: url('../../../image/delivery-1.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;

        img {
            width: 50%;
            position: absolute;
            bottom: 50%;
            left: 50%;
            transform: translate(-50%, 50%);
        }
    }

    .card.cart {
        border: none;
        border-radius: 20px;
        box-shadow: 0 0 5px rgb(146, 146, 146);
    }
}
</style>