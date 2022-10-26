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

          let element = this.cart.find(element => element.dish === dish.id);
          if(typeof element == "undefined"){
            this.cart.push({'dish': dish.id, 'quantity': 1})
          } else {
            const quantity = element.quantity += 1;
            this.cart.splice(this.cart.findIndex(e => e.dish === dish.id), 1);
            this.cart.push({'dish': dish.id, 'quantity': quantity})

          }
          // if (index !== -1) {
          //   arr[index].name = 'John';
          // }

          // this.cart.push({'dish': dish.id, 'quantity': 1})
          // if(this.cart['dish'].includes(dish.id)){
          //   console.log('c\'è');
          // }

          // this.cart.forEach((element, index) => {
          //   if(element.dish != dish.id){
          //     this.cart.push({'dish': dish.id, 'quantity': 1})
          //   } else {
          //     this.cart.splice(index, 1);
          //   }
          // })
          // if(!dishes.includes(dish)){
          //   this.cart.push({'dish': dish.id, 'quantity': 1});
          //   console.log(dishes);
          // }

          // temporaryCart.forEach(element => {
          //   if(!element.dish === dish.id){
          //     console.log(element.dish, dish.id);

          //     temporaryCart.push(parseInt(element.quantity) + 1)
          //     console.log(temporaryCart);
          //   }
          // })
          // console.log(dish);
          // console.log(this.cart);
          // if(this.cart.includes(dish)){
          //   this.cart.push({'dish': dish.id, 'quantity': 1});
          // } else{
          //   dish['quantity'] = dish['quantity'] + 1;
          // }
          
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