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
                            <th scope="col">Totale</th>
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
                        <!-- <td >{{getAmount(cart)}}€</td> -->
                         <tr class="d-flex flex-end">

                             <td > {{getTotal()}}</td>
                         </tr> 
                </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <i class="fa-solid fa-rotate-left btn btn-primary updated">Aggiorna carrello</i>
                    <i @click="removeAll()"  class="fa-solid fa-trash btn btn-warning">Svuota carrello</i>
                </div>
            </div>

            <div class="card cart p-5 mt-5">
                <!-- action(?) @submit="getPivotData()" -->
                <form @submit.prevent="getPivotData()" id="checkout-form" action="http://127.0.0.1:8000/payment">
                    <div class="form-group">
                        <label for="customer_name">Nome e cognome</label>
                        <input v-model="form.customer_name" type="text" class="form-control" id="customer_name">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customer_email">Indirizzo email</label>
                            <input v-model="form.customer_email" type="email" class="form-control" id="customer_email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="customer_phone">Numero di telefono</label>
                            <input v-model="form.customer_phone" type="text" class="form-control" id="customer_phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer_address">Indirizzo completo</label>
                        <input v-model="form.customer_address" type="text" class="form-control" id="customer_address">
                    </div>
                    <button @click.prevent="getData()" type="submit" class="btn btn-primary">Ordina</button>
                </form>
            </div>
        </div>
    </main>
</template>

<script>
//import axios from 'axios';
export default{
    name: 'CartPage',
    data(){
        return{
            cart: [],
            form:{
                customer_name: '',
                customer_email: '',
                customer_phone: '',
                customer_address: '',
            },
            amount: 0,
            restaurant_id: 0,
           // order: [], //deve diventare cart
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
        getTotal() {
            let totalPrice = 0;
            this.cart.forEach(dish => {
                totalPrice += dish.price * dish.quantity;
            });
            this.amount = totalPrice;
            return totalPrice + '€';
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
                //svuoto anche db?
              } else {
                die();
              }
        },
        getPivotData(){
            const dishes = [];

            this.cart.forEach(item => {
                const dish = {
                    'id': item.dish,
                    'quantity': item.quantity
                }
                dishes.push(dish);
                this.restaurant_id = item.restaurant;
            });
            console.log(dishes);
            
             this.$http.post('http://127.0.0.1:8000/api/pivot', {
                dish_id: dishes[0].id,
                order_id: this.order_id,
                quantity: dishes[0].quantity,
               


            }).then(() => {
            });

        }, 
            // saveData(){
        //     axios.post('http://127.0.0.1:8000/api/orders-store', {
        //         customer_name: this.form.customer_name,
        //         customer_email: this.form.customer_email,
        //         customer_phone: this.form.customer_phone,
        //         customer_address: this.form.customer_address,
        //         restaurant_id: this.restaurant_id,
        //         amount: this.amount,


        //     }).then(() => {
        //     });
        // },
        getData(){
          
            //axios
            this.getPivotData();
            this.$http.post('http://127.0.0.1:8000/api/orders-store', {
                customer_name: this.form.customer_name,
                customer_email: this.form.customer_email,
                customer_phone: this.form.customer_phone,
                customer_address: this.form.customer_address,
                restaurant_id: this.restaurant_id,
                amount: this.amount,
                
                
            }).then(() => {
                // console.log(data)
                
                 this.form.customer_name = '',
                 this.form.customer_email = '',
                 this.form.customer_phone = '',
                 this.form.customer_address = '',
                 this.amount = ''
                });
                
                
                
                
                //     //dati del form
                //     const formData = res.config['data'];
                //     const parsedData = JSON.parse(formData);
                //     //array del new_order che arriva da db
                //      console.log(res);
                //      console.log(res.data);
                //     //console.log(res.data[0]);
                //     console.log(res.data['new_order']);
                //     // ci carico i dati 
                //     newOrder.push(parsedData);
                // this.order.push(newOrder);
                // console.log(this.order);
                //fill the order with the form data, way2
            //     const data = res.data;
              
                //ora ho un oggett nell'ordine contenente il nuovo ordine, vuoto
               
        },
    },
    mounted(){
        if(localStorage.cart){
            this.cart = JSON.parse(localStorage.cart);
        }
    },
   
    //     this.$http.get('http://127.0.0.1:8000/api/user-details', {
    //         name: this.form.name,
    //         email: this.form.email,
    //         phone: this.form.phone,
    //         address: this.form.address,
    //     }).then(function (data) {
    //         console.log(data)
    //     });

     //},
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