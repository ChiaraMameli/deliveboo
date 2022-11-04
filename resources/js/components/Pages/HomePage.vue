<template>
    <AppLoader v-if="isLoading" />
    <main v-else>
        <div id="home-jumbo">
            <img class="img-fluid col-12 col-md-9 col-lg-6 mt-5" src="../../../image/hamburger-3.png" alt="">
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">

                <!-- filtro -->
                <div class="col-12 my-3 pt-3">
                    <h3>Cosa vuoi mangiare?</h3>
                    <p class="mb-5">Spunta le catogorie per visualizzare i ristoranti</p>
                </div>

                <div class="categories-choice col-12 d-md-flex align-items-center">
                    <div
                        class="col-12 col-md-9 d-flex my-3 justify-content-between align-items-center checkbox mb-5 flex-md-wrap">
                        <div v-for="(category, i) in categories" :key="i" class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" v-model="category.isSelected"
                                :value="category.id" />
                            <label class="form-check-label">{{ category.label }}</label>
                        </div>
                        <!-- filtro con map i ristoranti per categoria al click -->
                    </div>
                    <div class="button col-12 col-md-3 d-flex justify-content-center align-items-center mb-4">
                        <button @click="filterRestaurants()" type="button" class="btn">
                            Mostra ristoranti
                        </button>
                    </div>
                </div>


                <!-- <div class="d-flex justify-content-between flex-wrap pb-5">
                    <div class="card restaurant p-2 col-12 col-md-6 col-lg-3" v-for="restaurant in restaurants" :key="restaurant.id">
                        <div class="inside-card p-2">
                            <img :src="restaurant.image" class="card-img-top" :alt="restaurant.name">
                            <div class="card-body">
                                <h5 class="card-title">{{ restaurant.name }}</h5>
                                <p class="card-text">{{ restaurant.description }}</p>
                                <span class="">{{ restaurant.address }}</span>
                                <h5>
                                    <span>Categorie: </span> <br /><span v-for="(category, i) in restaurant.categories"
                                        :key="i">{{ category.label }} <br /></span>
                                </h5>

                                <router-link :to="{
                                    name: 'restaurant-details',
                                    params: { id: restaurant.id },
                                }" class="btn btn-success bg-dred mb-2">Vedi
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div> -->


                <!-- prova lista ristoranti-->
                <!-- if -->
                <div v-if="showAllRestaurants" class="d-flex justify-content-between flex-wrap pb-5">
                    <div class="card restaurant p-2 col-12 col-md-6 col-lg-3" v-for="restaurant in restaurants" :key="restaurant.id">
                        <div class="inside-card p-2">
                            <img :src="restaurant.image" class="card-img-top" :alt="restaurant.name">
                            <div class="card-body">
                                <h5 class="card-title">{{ restaurant.name }}</h5>
                                <p class="card-text">{{ restaurant.description }}</p>
                                <span class="">{{ restaurant.address }}</span>
                                <h5>
                                    <span>Categorie: </span> <br /><span v-for="(category, i) in restaurant.categories"
                                        :key="i">{{ category.label }} <br /></span>
                                </h5>
                                <router-link :to="{
                                    name: 'restaurant-details',
                                    params: { id: restaurant.id },
                                }" class="btn bg-dred mb-2">Vedi
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- else -->
                <div v-else class="d-flex justify-content-between flex-wrap pb-5">
                    <div class="card restaurant p-2 col-12 col-md-6 col-lg-3" v-for="restaurant in restaurantWithSelected" :key="restaurant.id">
                        <div class="inside-card p-2">
                            <img :src="restaurant.image" class="card-img-top" :alt="restaurant.name">
                            <div class="card-body">
                                <h5 class="card-title">{{ restaurant.name }}</h5>
                                <p class="card-text">{{ restaurant.description }}</p>
                                <span class="">{{ restaurant.address }}</span>
                                <h5>
                                    <span>Categorie: </span> <br /><span v-for="(category, i) in restaurant.categories"
                                        :key="i">{{ category.label }} <br /></span>
                                </h5>
                                <router-link :to="{
                                    name: 'restaurant-details',
                                    params: { id: restaurant.id },
                                }" class="btn bg-dred mb-2">Vedi
                                </router-link>

                            </div>
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
            showAllRestaurants: true,


        };
    },
    components: {
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

                })
                .catch((err) => {
                    console.log(err);
                });
            this.isLoading = false;
        },

        filterRestaurants() {
            this.showAllRestaurants = false;
            // filtro dalle categorie quelle selezionate
            let categorySelected = this.categories.filter(
                (category) => category.isSelected
            );
            //categoria filtrata

            if (categorySelected.length > 0) {
                // approccio imperativo
                this.restaurantWithSelected = this.restaurants.filter(
                    (restaurant) => {
                        for (const category1 of categorySelected) {
                            let found = false
                            for (const category2 of restaurant.categories) {

                                if (category1.id === category2.id) {
                                    found = true
                                    break;
                                }
                            }
                            if (!found) return false
                        }
                        return true;
                    }
                );

                // approccio funzionale
                // this.restaurantWithSelected = this.restaurants.filter(
                //     (restaurant) => categorySelected.every(category1 => restaurant.categories.some(category2 => category1.id === category2.id)))

            } else {
                this.restaurantWithSelected = this.restaurants;
            }
            console.log(this.restaurantWithSelected)
        },
    },

    mounted() {
        this.fetchData();
    },
};
</script>

<style lang="scss" scoped>
main {
    min-height: 100vh;
    background-color: #E84342;

    #home-jumbo {
        padding-top: 120px;
        background-image: url('../../../image/logo-deliveboo.png');
        background-repeat: no-repeat;
        background-size: contain;
        background-position: 0 80px;
        display: flex;
        justify-content: center;
        height: 800px;
        position: relative;

        img {
            max-height: 100%;
            object-fit: contain;
        }

        #login-btn {
            background-color: #4D4D4D;
            color: #FFF;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            position: absolute;
            bottom: 10px;
            right: 50%;
            transform: translateX(50%);
        }
    }

    .container {

        h3 {
            text-align: center;
            color: white;
            font-size: 80px;
            line-height: 65px;
            margin-bottom: 30px;
        }

        p {
            text-align: center;
            color: white;
            font-size: 26px;
        }

        .categories-choice {

            .checkbox {
                background-color: white;
                padding: 15px 35px;
                border-radius: 50px;
                box-shadow: 0 0 5px rgb(146, 146, 146);
            }

            .btn {
                background-color: white;
                color: black;
                border-radius: 30px;
                border: 2px solid white;
                padding: 10px 15px;
                transition: 0.5s;

                &:hover {
                    transform: scale(1.2);
                }
            }

        }



        .card.restaurant {
            background-color: #E84342;
            padding: 0;
            border: none;

            .inside-card {
                background-color: white;
                border-radius: 20px;

                img {
                    border-radius: 20px 20px 0 0;
                    height: 200px;
                    object-fit: cover;
                    object-position: center;
                }

                strong {
                    font-size: 22px;
                }
            }

            .btn.bg-dred {
                margin-top: 10px;
                border-radius: 20px;
                border: none;
                background-color: #E84342;
                color: white;
                transition: 0.5s;

                &:hover {
                    transform: scale(1.2);
                }
            }


        }




        input {
            accent-color: #E84342;
        }
    }
}
</style>
