import Vue from "vue";
import VueRouter from "vue-router";
import HomePage from "./components/Pages/HomePage";
import RestaurantDetails from "./components/Pages/RestaurantDetails";
import CartPage from "./components/Pages/CartPage";
import ThankYouPage from "./components/Pages/ThankYouPage";

Vue.use(VueRouter);

const routes = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [
        //name verrà usato se la pagina cresce
        { path: "*", component: HomePage, name: "home" },
        {
            path: "/restaurants/:slug",
            component: RestaurantDetails,
            name: "restaurant-details",
        },
        { path: "/cart", component: CartPage, name: "cart" },
        {
            path: "/thank-you-page",
            component: ThankYouPage,
            name: "thank-you-page",
        },
    ],
});

export default routes;
