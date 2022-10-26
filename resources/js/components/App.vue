<template>
    <div>
        <AppHeader/>
        <router-view></router-view>
    </div>
</template>

<script>
import HomePage from './Pages/HomePage.vue';
import RestaurantPage from './Pages/RestaurantPage.vue';
import CartPage from './Pages/CartPage.vue';
import AppHeader from './AppHeader.vue';
    export default {
        name: 'App',
    components: { HomePage, AppHeader, RestaurantPage, CartPage, },
    }
</script>
