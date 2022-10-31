<template>
    <AppLoader v-if="isLoading"/>
    <main v-else>
        <div class="container">
            <h1> Benvenuto in DeliveBoo!</h1>
            <div class="row">
                <div id="jumbotron">//to choose a jumbo</div>
                    <!-- filtro -->
                <div class="col-12 my-3">
                    Cosa vuoi mangiare? Spunta le catogorie per visuallizare i ristoranti:
                </div>
                <!-- <div class="col-12 my-3">
                    Oppure inserisci tu la tipologia di ristorante che stai cercando: <input v-model="searchByCategory" type="textarea"/>
                </div> -->
                <div class="col-12 d-flex my-3 justify-content-between">
                        
                
                    <div v-for="(category, i) in categories" :key="i" class="form-check form-switch ">
                        <input class="form-check-input pointer" type="checkbox" role="switch" v-model="category.isSelected" :value="category.id" >
                        <label class="form-check-label"  >{{ category.label }}</label>
                    </div>
                        <!-- filtro con map i ristoranti per categoria al click -->
                    <button @click="filteredRestaurants()" type="button" class="btn btn-sm btn-info"> Mostra ristoranti</button>
                    
                </div>
            <!-- lista ristoranti-->
            <!-- default, tutti i ristoranti isSelected = false, da gestire -->
                <div class="row" v-if="isSelected">
                    

                        <div class="card col-xl-3 col-lg-4 col-md-6 col-sm-12 my-3 justify-content-between py-2 b-radius-1" v-for="restaurant in restaurantWithSelected" :key="restaurant.id">
                            <div>
                                <h2>{{ restaurant.name }}</h2>
                                
                                <img class="rounded img-fluid" :src="restaurant.image" alt="">
                                <h5>Indirizzo: </h5> 
                                <span>{{ restaurant.address }}</span>
                                
                                <h5>Categorie: </h5> 
                                <span v-for="(category, i) in restaurant.categories" :key="i">{{ category.label}} <br/></span>
                                <router-link :to="{ name: 'restaurant-details', params: { id: restaurant.id } }"
                                class="btn btn-success mb-2">Vedi
                            </router-link>
                            
                        </div>
                    </div>
              
                </div>
                <div class="row" v-else>  
                   

                        <div class=" card col-xl-3 col-lg-4 my-3 col-md-6 col-sm-12 justify-content-between py-2 b-radius-1" v-for="restaurant in restaurants" :key="restaurant.id">
                            <h2>{{ restaurant.name }}</h2>
                            <img class="rounded img-fluid" :src="restaurant.image" alt="">
                            <h5>Indirizzo: </h5> 
                            <span>{{ restaurant.address }}</span>
                            
                            <h5>Categorie:  </h5> 
                            <span v-for="(category, i) in restaurant.categories" :key="i">{{ category.label}} <br/></span>
                            <router-link :to="{ name: 'restaurant-details', params: { id: restaurant.id } }"
                        class="btn btn-success mb-2">Vedi
                    </router-link>
                    
                
                </div>
                
           
        </div>
    </div>
</div>
</main>

</template>

<script>
import AppLoader from '../AppLoader';
export default {
    name: 'HomePage',
    data() {
        return {
            restaurants: [],
            categories: [],
            categorySelected: [],
            restaurantWithSelected: [],
            isSelected: false,
            isLoading: false,
            searchByCategory: '',
        };
    },
    components:{
        AppLoader,
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
                this.isLoading = true;
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
                this.isLoading = false;
            },
            selectedToggle(){
                this.isSelected = !this.isSelected
            },
       
        },
        
    mounted() {
        this.fetchData()
    },
}
</script>

<style>
.h-250 {
    height: 260.5px;
}

.pointer{
    cursor: pointer;
}
.b-radius-1{
    border-radius: 1rem;
}

h5{
    margin: 0.8rem 0;
    font-weight: bold;
}
</style>