<template>
    <main>
        <div class="container">
            <h2> Benvenuto in TheLiveBoo!</h2>
            <!-- filtro -->
            <div>
                Cosa vuoi mangiare? Spunta le catogorie per visuallizare i ristoranti
               
                <div v-for="(category, i) in categories" :key="i" class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" v-model="category.isSelected" :value="category.id" >
                    <label class="form-check-label"  >{{ category.label }}</label>
                </div>
                    <!-- filtro con map i ristoranti per categoria al click -->
                <button @click="filteredRestaurants()" type="button" class="btn btn-sm btn-info"> Mostra ristoranti</button>
                
            </div>
            <!-- prova lista ristoranti-->
            <div class="d-flex my-5">
                <div v-if="catchedRestaurant">
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
            selectedRestaurants: [],
            restaurantWithSelected: [],
            isSelected: false,
            categorySelected: [],
            catchedRestaurant: null,
        };
    },
    computed: {
        // generare il nuovo array con tutti i ristoranti che hanno le categorie selezionate
        // filteredRestaurants() {
        //     return this.restaurants.map((restaurant) => {
        //         if (restaurant.categories === this.selectedCategories) return true;
        //       //  else return false;
        //      })
    },
    
    methods: {
        fetchData() {
            axios
                .get('http://127.0.0.1:8000/api/restaurants')
                .then((res) => {
                    this.restaurants = res.data.restaurants;
                    this.categories = res.data.categories;
                    console.log(this.restaurants);
                    
                })
                .catch((err) => {
                    console.log(err);
                });
            },
            filteredRestaurants() {
                // filtro dalle categorie quelle selezionate
                let categorySelected = this.categories.filter((category)=>{
                   if( category.isSelected && category.isSelected == true)
                   return true
                  
                   else []
                })
                //categoria filtrata
                console.log(categorySelected);
                
                // provo con map/filter******************
                
                // let restaurantWithSelected = this.restaurants.filter((restaurant) => {
                    //     if (restaurant.categories.id === categorySelected[0]['id'])
                    //         console.log(restaurant.categories.id)
                    //         return this.selectedRestaurants.push(restaurantWithSelected)
                    
                    //     });
                    //    // console.log(categorySelected['id']);
                    // },
                // provo con map/filter******************

            //id della categoria filtrata
            console.log(categorySelected[0]['id']);
                // l'id della categoria del singolo ristorante nel ciclo 
           // console.log(restaurant.categories[0]['id'])
                //provo col foreach
                this.restaurants.forEach(restaurant => {
                // controllo che l'id della categoria del singolo ristorante nel ciclo sia la stessa della categoria filtrata
                restaurant.categories[0]['id'] == categorySelected[0]['id'] ? this.restaurantWithSelected.push(restaurant) : this.restaurantWithSelected = [] 
                });
            console.log(this.restaurantWithSelected)
            //     return this.selectedRestaurants.push(restaurantWithSelected)
            
        },
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