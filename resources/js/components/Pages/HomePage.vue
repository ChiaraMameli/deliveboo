<template>
    <main>
        <div class="container">
            <h2> Benvenuto in TheLiveBoo!</h2>
            <div>
                Cosa vuoi mangiare? Spunta le catogorie per visuallizare i ristoranti
                <div v-for="(category, i) in categories" :key="i" class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" v-model="selected">
                    <label class="form-check-label"  >{{ category.label }}</label>
                </div>
                <!-- <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                    </div> -->
                    <!-- filtro con map i ristoranti per categoria al click -->
                <button @click="filteredRestaurants()" type="button" class="btn btn-sm btn-info"> Mostra ristoranti</button>
            </div>
            <!-- prova lista ristoranti-->
            <div class="d-flex my-5">
                <div v-if="selectedCategory">
                    <div class="card" v-for="restaurant in restaurants" :key="restaurant.id">
                        
                        <h2>{{ restaurant.name }}</h2>
                        <img class="h100" :src="restaurant.image" alt="">
                        <h5><strong>Indirizzo: </strong>{{ restaurant.address }}</h5>
                        
                        <h5><strong>Categorie: </strong> <br /><span v-for="(category, i) in restaurant.categories" :key="i">{{ category.label}} <br/></span></h5>
                        <router-link :to="{ name: 'restaurant', params: { id: restaurant.id } }"
                        class="btn btn-success m-auto ">Vedi
                        </router-link>
                    
                    </div>
                </div>
                <div v-else>   
                    <div class="card" v-for="restaurant in filteredRestaurants" :key="restaurant.id">
                        
                        <h2>{{ restaurant.name }}</h2>
                        <img class="h100" :src="restaurant.image" alt="">
                        <h5><strong>Indirizzo: </strong>{{ restaurant.address }}</h5>
                        
                        <h5><strong>Categorie: </strong> <br /><span v-for="(category, i) in restaurant.categories" :key="i">{{ category.label}} <br/></span></h5>
                        <router-link :to="{ name: 'restaurant', params: { id: restaurant.id } }"
                        class="btn btn-success m-auto ">Vedi
                        </router-link>
                    
                    </div>
                
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
            restaurants: [],
            categories: [],
            selected: false,
        };
    },
    computed: {
        // generare il nuovo array con tutti i ristoranti che hanno le categorie selezionate
        filteredRestaurants() {
            return this.restaurants.map((restaurant) => {
                if (restaurant.categories === this.categories) return true;
                else return false;
             })
    },
     },
    methods: {
        fetchData() {
            axios
                .get('http://127.0.0.1:8000/api/restaurants')
                .then((res) => {
                    this.restaurants = res.data.restaurants;
                    this.categories = res.data.categories;
                  //  console.log(res.data)
                  
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        // filteredRestaurants() {
        //     return this.restaurants.map((restaurant) => {
        //         if (restaurant.categories === this.selectedCategory) return true;
        //         else return false;
        //     })
        // },
    },
    mounted() {
        this.fetchData()
    },
}
</script>

<style>
.h100 {
    height: 100px;
}
</style>