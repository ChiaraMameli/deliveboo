import Vue from 'vue';
import VueRouter from 'vue-router';
import HomePage from './components/Pages/HomePage';
import RestaurantPage from './components/Pages/RestaurantPage';
import CartPage from './components/Pages/CartPage';

Vue.use(VueRouter);

const routes = new VueRouter({
    mode: 'history',
    routes: [
        //name verrà usato se la pagina cresce    
        {path: '/' , component: HomePage, name:'home'},
        {path: '/restaurant/:id' , component: RestaurantPage, name:'restaurant-details'},
        {path: '/cart' , component: CartPage, name:'cart'},
        
    ],
})

export default routes;