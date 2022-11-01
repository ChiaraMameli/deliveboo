<template>
    <AppLoader v-if="isLoading" />
    <main v-else>
    <div id="home-jumbo"></div>
        <div class="container">
            <div class="row">

                <!-- filtro -->
                <div class="col-12 my-3">
                    Cosa vuoi mangiare? Spunta le catogorie per visualizzare i
                    ristoranti
                </div>
                <div class="col-12 d-flex my-3 justify-content-between">
                    <div v-for="(category, i) in categories" :key="i" class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" v-model="category.isSelected"
                            :value="category.id" />
                        <label class="form-check-label">{{ category.label }}</label>
                    </div>
                    <!-- filtro con map i ristoranti per categoria al click -->
                    <button @click="filterRestaurants()" type="button" class="btn btn-sm bg-dred text-white">
                        Mostra ristoranti
                    </button>
                </div>
                <!-- prova lista ristoranti-->
                <div class="d-flex justify-content-between flex-wrap p">
                    <div class="card restaurant" v-for="restaurant in restaurants" :key="restaurant.id">
                        <img :src="restaurant.image" class="card-img-top" :alt="restaurant.name">
                        <div class="card-body">
                            <h5 class="card-title">{{ restaurant.name }}</h5>
                            <p class="card-text">{{ restaurant.description }}</p>
                            <strong class="">{{ restaurant.address }}</strong>
                            <h5>
                                <strong>Categorie: </strong> <br /><span v-for="(category, i) in restaurant.categories"
                                    :key="i">{{ category.label }} <br /></span>
                            </h5>

                            <router-link :to="{
                                name: 'restaurant-details',
                                params: { id: restaurant.id },
                            }" class="btn btn-success mb-2">Vedi
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import AppLoader from "../AppLoader";
export default {
    name: "HomePage",
    data() {
        return {
            restaurants: [],
            categories: [],
            restaurantWithSelected: [],
            isLoading: false,
        };
    },
    components:{
        AppLoader
    },
    methods: {
        fetchData() {
            this.isLoading = true;
            axios
                .get("http://127.0.0.1:8000/api/restaurants")
                .then((res) => {
                    this.restaurants = res.data.restaurants;
                    this.categories = res.data.categories;
                    console.log(this.restaurants);
                    this.isLoading = false;

                })
                .catch((err) => {
                    console.log(err);
                    this.isLoading = false;
                });
        },

        filterRestaurants() {
            // filtro dalle categorie quelle selezionate
            let categorySelected = this.categories.filter(
                (category) => category.isSelected
            );
            //categoria filtrata

            if (categorySelected.length > 0) {
                this.restaurantWithSelected = this.restaurants.filter(
                    (restaurant) => {
                        for (const category1 of restaurant.categories) {
                            for (const category2 of categorySelected) {
                                if (category1.id === category2.id) {
                                    return true;
                                }
                            }
                        }
                        return false;
                    }
                );
            } else {
                this.restaurantWithSelected = this.restaurants;
            }
        },
    },

    mounted() {
        this.fetchData();
    },
};
</script>

<style lang="scss" scoped>
main{
    min-height: 100vh;
    background-color: #F6E7C1;

        #home-jumbo{
        padding-top: 100px;
        height: 600px;
        background-image: url('../../../image/jumbo-home.png');
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;

        }
    
    input{
        accent-color: rgb(188, 33, 33);
    }
    
    .card.restaurant{
        width: calc(25% - 10px);
        border-radius: 20px;
        padding-left: 0;
        padding-right: 0;
        border: none;

          img{
            border-radius: 20px 20px 0 0;
          }

          strong{
            font-size: 22px;
          }

          i{
          cursor: pointer;
          border-radius: 50%;
          border: 2px solid rgb(188, 33, 33);
          color: rgb(188, 33, 33);
          display: inline-block;
          width: 50px;
          height: 50px;
          font-size: 20px;
          transition: 0.5s;

          &:hover{
            background-color: rgb(188, 33, 33);
            color: white;
          }
        }
    }}
    .bg-dred{
        background-color: rgb(188, 33, 33);
    }
</style>
