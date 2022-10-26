<template>
    <main>
        <div class="container">
            <h2> Benvenuto in TheLiveBoo!</h2>
            <div>
                    Cosa vuoi mangiare? Spunta le catogorie per visuallizare i ristoranti 
                    <div v-for="(category , i) in categories" :key="i" class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">{{category.label}}</label>
                    </div>
                    <!-- <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                    </div> -->
                    <button type="button" class="btn btn-sm btn-info"> Mostra ristoranti</button>
            </div> 
        </div>
    </main>
    
</template>

<script>
export default {
name:'HomePage',
data(){
    return {
        restaurants: [],
        categories: [],
    };
},
methods: {
    fetchData(){
        axios
            .get('http://127.0.0.1:8000/api/restaurants')
            .then((res) => {
                console.log(res)
                this.restaurants = res.data.restaurants;
                this.categories = res.data.categories;
            })
            .catch((err) => {
                console.log(err);
            });
    },
},
mounted (){
    this.fetchData()
},
}
</script>

<style>

</style>