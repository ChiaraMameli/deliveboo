<template>
    <main>
        <div class="container">
            <div>
                <h2> Welcome on the Home page</h2>
                <div v-for="restaurant in restaurants" :key="restaurant.id"><router-link :to="{name:'restaurant-details', params:{id: restaurant.id}}">{{restaurant.name}}</router-link></div>
            </div>
        </div>
    </main>
    
</template>

<script>
export default {
name:'HomePage',
data(){
    return{
        restaurants: [],
    }
},
methods: {
        fetchRestaurants() {
            axios.get("http://localhost:8000/api/restaurants").then(res => {
                this.restaurants = res.data;
            }).catch((err) => {
                this.error = 'Errore durante il fetch dei ristoranti';
            });
        }
    },
    mounted() {
        this.fetchRestaurants();
    },
}
</script>

<style>

</style>