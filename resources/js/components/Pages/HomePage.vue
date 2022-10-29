<template>
    <main>
        <div class="container">
            <h1> Benvenuto in DeliveBoo!</h1>
            <div class="row">
                <div id="jumbotron">//to choose a jumbo</div>
                    <!-- filtro -->
                <div class="col-12 my-3">
                    Cosa vuoi mangiare? Spunta le catogorie per visuallizare i ristoranti:
                </div>
                <div class="col-12 my-3">
                    Oppure inserisci tu la tipologia di ristorante che stai cercando: <input v-model="searchByCategory" type="textarea"/>
                </div>
                <div class="col-12 d-flex my-3 justify-content-between">
                        
                
                    <div v-for="(category, i) in categories" :key="i" class="form-check form-switch ">
                        <input class="form-check-input pointer" type="checkbox" role="switch" v-model="category.isSelected" :value="category.id" >
                        <label class="form-check-label"  >{{ category.label }}</label>
                    </div>
                        <!-- filtro con map i ristoranti per categoria al click -->
                    <button @click="filteredRestaurants()" type="button" class="btn btn-sm btn-info"> Mostra ristoranti</button>
                    
                </div>
            <!-- prova lista ristoranti-->
            <div class="my-3">
                <div class="row" v-if="isSelected">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 my-3 card justify-content-between py-2" v-for="restaurant in restaurantWithSelected" :key="restaurant.id">
                        
                        <h2>{{ restaurant.name }}</h2>
                        <img class=" img-fluid" :src="restaurant.image" alt="">
                        <h5><strong>Indirizzo: </strong>{{ restaurant.address }}</h5>
                        
                        <h5><strong>Categorie: </strong> <br /><span v-for="(category, i) in restaurant.categories" :key="i">{{ category.label}} <br/></span></h5>
                        <router-link :to="{ name: 'restaurant-details', params: { id: restaurant.id } }"
                        class="btn btn-success m-auto ">Vedi
                        </router-link>
                    
                    </div>
                </div>
                <div class="row" v-else>   
                    <div class="col-xl-3 col-lg-4 my-3 col-md-6 col-sm-12 card justify-content-between py-2" v-for="restaurant in restaurants" :key="restaurant.id">
                        
                        <h2>{{ restaurant.name }}</h2>
                        <img class="img-fluid" :src="restaurant.image" alt="">
                        <h5><strong>Indirizzo: </strong>{{ restaurant.address }}</h5>
                        
                        <h5><strong>Categorie: </strong> <br /><span v-for="(category, i) in restaurant.categories" :key="i">{{ category.label}} <br/></span></h5>
                        <router-link :to="{ name: 'restaurant-details', params: { id: restaurant.id } }"
                        class="btn btn-success m-auto ">Vedi
                    </router-link>
                    
                </div>
                
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
            restaurantWithSelected: [],
            isSelected: false,
            categorySelected: [],
            searchByCategory: '',
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
            selectedToggle(){
                this.isSelected = !this.isSelected
            },
            filteredRestaurants() {
                //svuoto gli array al click del bottone
                this.categorySelected = [];
                this.restaurantWithSelected = [];
                // filtro dalle categorie quelle selezionate
                let categorySelected = this.categories.filter((category)=>{
                   if( category.isSelected && category.isSelected == true){

                       this.categorySelected.push(category);
                         return true
                    
                  
                }else{ []}
                })
                //categoria filtrata
                console.log(categorySelected);

                if(categorySelected[0]) {
                    this.restaurants.forEach(restaurant => {
                      //    controllo che l'id della categoria del singolo ristorante nel ciclo sia la stessa della categoria filtrata
                      if (restaurant.categories[0]['id'] == categorySelected[0]['id']){
                          
                         this.isSelected = true
                         
                          return this.restaurantWithSelected.push(restaurant)
                      } 
                     
                    });
                   
                } else this.isSelected = true

                
                
                //id della categoria filtrata
                //console.log(categorySelected[0]);

            // l'id della categoria del singolo ristorante nel ciclo 
            // console.log(restaurant.categories[0]['id'])
            
            // tutti i ristoranti caricati nell'array
            //  console.log(this.restaurantWithSelected)
            
            // ternario equivalente all'if riga 125
            //    restaurant.categories[0]['id'] == categorySelected[0]['id'] ? this.restaurantWithSelected.push(restaurant) : this.restaurantWithSelected = []
            
            // l'id del primo dei ristoranti caricati dal db
            // console.log(this.restaurants.categories[0]['id'])
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
</style>