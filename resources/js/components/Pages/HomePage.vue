<template>
    <AppLoader v-if="isLoading" />
    <main v-else>
        <div class="container">
            <h2>Benvenuto in TheLiveBoo!</h2>
            <div class="row">
                <div class="jumbotron"></div>


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
                    <button @click="filterRestaurants()" type="button" class="btn btn-sm btn-info">
                        Mostra ristoranti
                    </button>
                </div>
                <!-- prova lista ristoranti-->

                <div class="card col-xl-3 col-lg-4 col-md-6 col-sm-12 my-3 justify-content-between py-2 b-radius-1"
                    v-for="restaurant in restaurantWithSelected" :key="restaurant.id">
                    <h2>{{ restaurant.name }}</h2>
                    <img class="rounded img-fluid" :src="restaurant.image" alt="" />
                    <h5>
                        <strong>Indirizzo: </strong>{{ restaurant.address }}
                    </h5>

                    <h5>
                        <strong>Categorie: </strong> <br /><span v-for="(category, i) in restaurant.categories"
                            :key="i">{{ category.label }} <br /></span>
                    </h5>
                    <router-link :to="{
                        name: 'restaurant',
                        params: { id: restaurant.id },
                    }" class="btn btn-success mb-2">Vedi
                    </router-link>
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
        };
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

<style>
.h-250 {
    height: 260.5px;
}

.pointer {
    cursor: pointer;
}

.b-radius-1 {
    border-radius: 1rem;
}

h5 {
    margin: 0.8rem 0;
    font-weight: bold;
}
</style>
