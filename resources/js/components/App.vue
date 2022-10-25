<template>
    <div class="container">
        <AppHeader/>
        <div class="row justify-content-center">
           <router-view></router-view>
        </div>
    </div>
</template>

<script>
import HomePage from './Pages/HomePage.vue';
import RestaurantPage from './Pages/RestaurantPage.vue';
import AppHeader from './AppHeader.vue';
    export default {
        name: 'App',
    components: { HomePage, AppHeader, RestaurantPage },
    }
</script>
