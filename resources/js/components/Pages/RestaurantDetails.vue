<template>
  <main>
    <div class="container">
      <h2>{{restaurant.name}}</h2>
      <ul>
        <li @click="addToCart(dish)" v-for="dish in restaurant.dishes" :key="dish.id">{{dish.name}}</li>
      </ul>
    </div>
    <div>
      <p v-for="item in cart" :key="item">{{item}}</p>
    </div>
  </main>
</template>

<script>
export default {
name:'RestaurantDetails',
data(){
  return{
    restaurant: null,
    pippo: '',
    cart: [],
  }
},
methods: {
        fetchRestaurant() {
            axios.get("http://localhost:8000/api/restaurants/" + this.$route.params.id).then((res) => {
                this.restaurant = res.data.restaurant;
            }).catch(err => {
                console.log(err);
            });
        },
        addToCart(dish){

          let element = this.cart.find(element => element.dish === dish.id);
          if(typeof element == "undefined"){
            this.cart.push({'dish': dish.id, 'quantity': 1})
          } else {
            const quantity = element.quantity += 1;
            this.cart.splice(this.cart.findIndex(e => e.dish === dish.id), 1);
            this.cart.push({'dish': dish.id, 'quantity': quantity})
          }
        }
    },
    mounted() {
        this.fetchRestaurant();
        if(localStorage.cart){
            this.cart = JSON.parse(localStorage.cart);
        }
    },
    watch:{
        cart(newCart){
            localStorage.cart = JSON.stringify(newCart);
        }
    }
}
</script>

<style>

</style>