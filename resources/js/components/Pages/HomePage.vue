<template>
    <main>
        <div class="container">
            <h2>Benvenuto in TheLiveBoo!</h2>
            <!-- filtro -->
            <div>
                Cosa vuoi mangiare? Spunta le catogorie per visuallizare i
                ristoranti

                <div
                    v-for="(category, i) in categories"
                    :key="i"
                    class="form-check form-switch"
                >
                    <input
                        class="form-check-input"
                        type="checkbox"
                        role="switch"
                        v-model="category.isSelected"
                        :value="category.id"
                    />
                    <label class="form-check-label">{{ category.label }}</label>
                </div>
                <!-- filtro con map i ristoranti per categoria al click -->
                <button
                    @click="filterRestaurants()"
                    type="button"
                    class="btn btn-sm btn-info"
                >
                    Mostra ristoranti
                </button>
            </div>
            <!-- prova lista ristoranti-->
            <div class="d-flex my-5">
                <div>
                    <div
                        class="card"
                        v-for="restaurant in restaurantWithSelected"
                        :key="restaurant.id"
                    >
                        <h2>{{ restaurant.name }}</h2>
                        <img class="h100" :src="restaurant.image" alt="" />
                        <h5>
                            <strong>Indirizzo: </strong>{{ restaurant.address }}
                        </h5>

                        <h5>
                            <strong>Categorie: </strong> <br /><span
                                v-for="(category, i) in restaurant.categories"
                                :key="i"
                                >{{ category.label }} <br
                            /></span>
                        </h5>
                        <router-link
                            :to="{
                                name: 'restaurant',
                                params: { id: restaurant.id },
                            }"
                            class="btn btn-success m-auto"
                            >Vedi
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
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
.h100 {
    height: 300px;
}
</style>
