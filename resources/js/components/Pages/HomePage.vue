<template>
    <main>
        <div class="container">
            <h2>
                Tutti i Ristoranti
            </h2>
            <div class="d-flex my-5">
                <!-- prova lista ristoranti-->
                <div class="card" v-for="restaurant in restaurants" :key="restaurant.id">
                    <h2>{{ restaurant.name }}</h2>
                    <img class="h100" :src="restaurant.image" alt="">
                    <h5><strong>Indirizzo: </strong>{{ restaurant.address }}</h5>
                    <h5><strong>Categorie: </strong>lista</h5>
                    <router-link :to="{ name: 'restaurant', params: { id: restaurant.id } }"
                        class="btn btn-success m-auto ">Vedi
                    </router-link>

                </div>
            </div>
        </div>
    </main>
</template>
  
<script>
export default {
    name: 'HomePage',
    data() {
        return {
            restaurants: []
        }
    },
    methods: {
        fetchRestaurants() {
            axios.get('http://localhost:8000/api/restaurants')
                .then(res => {
                    this.restaurants = res.data;
                })
                .catch((err) => {
                    console.error(err);
                })

        }
    },
    mounted() {
        this.fetchRestaurants();
    },

}
</script>
  
<style>
.h100 {
    height: 200px;
}
</style>