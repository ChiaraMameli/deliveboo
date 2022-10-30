<template>
    <div>
        <AppHeader :currentCart="cart"/>
        <router-view @populated-cart="populatedCart" :currentCart="cart" @unpopulated-cart="unpopulatedCart"></router-view>
    </div>
</template>

<script>
import HomePage from './Pages/HomePage.vue';
import RestaurantDetails from './Pages/RestaurantDetails.vue';
import CartPage from './Pages/CartPage.vue';
import AppHeader from './AppHeader.vue';
    export default {
        name: 'App',
        components: { HomePage, AppHeader, RestaurantDetails, CartPage, },
        data(){
            return{
                cart: [],
            }
        },
        methods:{
            populatedCart(cart){
                this.cart = cart;
            },
            unpopulatedCart(cart){
                this.cart = cart;
            }
        }
    }
</script>
