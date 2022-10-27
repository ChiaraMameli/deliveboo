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
                <div v-if="isSelected">
                    <div class="card" v-for="restaurant in restaurantWithSelected" :key="restaurant.id">
                        
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
            isSelected: true,
            categorySelected: [],
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
                
                // provo con map/filter******************
                    
                    //  let restaurantWithSelected = this.restaurants.filter((restaurant) => {
                    //      if (restaurant.categories[0]['id'] === categorySelected[0]['id'])
                    //              console.log(restaurant.categories.id)
                    //      this.restaurantWithSelected.push(restaurant)
                    //      return true
                        
                    //          });
                    //          console.log(categorySelected['id']);

                // provo con map/filter******************

                //provo col foreach
                if(categorySelected[0]) {
                    this.restaurants.forEach(restaurant => {
                      //    controllo che l'id della categoria del singolo ristorante nel ciclo sia la stessa della categoria filtrata
                      if (restaurant.categories[0]['id'] == categorySelected[0]['id']){
                          
                         this.isSelected = true
                         
                          return this.restaurantWithSelected.push(restaurant)
                      } 
                     
                    });
                    this.restaurants[0]['categories'].forEach(restCaty => {
                        if (restCaty['id'] == this.categorySelected[0]['id'] )
                         return this.restaurantWithSelected.push(this.restaurants[0])
                    })
                } else this.isSelected = false

                
                
                //id della categoria filtrata
                //console.log(categorySelected[0]);
                    // l'id della categoria del singolo ristorante nel ciclo 
              // console.log(this.restaurants.categories[0]['id'])
               //  console.log(this.restaurantWithSelected)
              // console.log(categorySelected[0]['id'])
               //    restaurant.categories[0]['id'] == categorySelected[0]['id'] ? this.restaurantWithSelected.push(restaurant) : this.restaurantWithSelected = []
     
              // console.log(restaurant.categories[0]['id'])
            
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