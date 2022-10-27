<template>
  <main id="restaurant-details">
    <div class="container">
      <h2 class="text-white text-center p-5">{{restaurant.name}}</h2>
      <ul class="d-flex flex-wrap justify-content-center list-unstyled">
        <li class="p-3" v-for="dish in restaurant.dishes" :key="dish.id">
          <div class="card" style="width: 18rem;">
            <img :src="dish.image" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{dish.name}}</h5>
              <p class="card-text">{{dish.description}}</p>
              <i @click="addToCart(dish)" class="fa-solid fa-plus btn btn-danger"></i>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div>
      <p class="text-white" v-for="item in cart" :key="item">{{item}}</p>
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

<style lang="scss" scoped>
  #restaurant-details{
    background-color: rgb(188, 33, 33);
    
    i{
      cursor: pointer;
    }
  }
</style>