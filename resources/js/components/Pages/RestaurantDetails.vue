<template>
  <main>
    <div class="container">
      <h2>{{restaurant.name}}</h2>
      <ul>
        <li @click="addToCart(dish)" v-for="dish in restaurant.dishes" :key="dish.id">{{dish.name}}</li>
      </ul>
    </div>
    <div>
      <p v-for="item in cart">{{item}}</p>
    </div>
  </main>
</template>

<script>
export default {
name:'RestaurantPage',
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
          console.log(dish);
          console.log(this.cart);
          if(this.cart.includes(dish)){
            this.cart.push({'dish': dish.id, 'quantity': 1});
          } else{
            dish['quantity'] = dish['quantity'] + 1;
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