import Vue from "vue";
import VueRouter from "vue-router";
import HomePage from "./components/Pages/HomePage";
import RestaurantPage from "./components/Pages/RestaurantPage";

Vue.use(VueRouter);

const routes = new VueRouter({
    mode: "history",
    routes: [
        //name verrà usato se la pagina cresce
        { path: "/", component: HomePage, name: "home" },
        {
            path: "/restaurants/:id",
            component: RestaurantPage,
            name: "restaurant",
        },
    ],
});

export default routes;
