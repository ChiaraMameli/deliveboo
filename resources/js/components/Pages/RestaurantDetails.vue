<template>
  <main id="restaurant-details">
    <div class="container">
      <h2 class="text-white text-center p-5">{{restaurant.name}}ciao</h2>
      <ul class="d-flex flex-wrap list-unstyled">
        <li class="p-3" v-for="dish in restaurant.dishes" :key="dish.id">
          <div class="card dish">
            <img :src="dish.image" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{dish.name}}</h5>
              <p class="card-text">{{dish.description}}</p>
              <strong class="">{{dish.price}}€</strong>
              <i @click="addToCart(dish)" class="fa-solid fa-plus d-flex justify-content-center align-items-center mt-3"></i>
            </div>
          </div>
        </li>
      </ul>
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
          const currentDish = {
            'dish': dish.id, 
            'restaurant': dish.restaurant_id,             
            'name': dish.name, 
            'image': dish.image,
            'description': dish.description,
            'ingredients': dish.ingredients,
            'price': dish.price,
            'quantity': 1
          };

          const element = this.cart.find(element => element.dish === dish.id);
          
          console.log(element);
          // Se è il primo
          if(this.cart.length === 0){
            this.cart.push(currentDish)

          }
          // Se è già presente nell'array e se il piatto appartiene al ristorante del primo elemento  
          else if(typeof element !== "undefined" && (this.cart[0].restaurant === dish.restaurant_id)){

              currentDish.quantity = element.quantity += 1;
              this.cart.splice(this.cart.findIndex(e => e.dish === dish.id), 1);
              this.cart.push(currentDish);

          } 
          // Se non è presente nell'array e il piatto appartiene al ristorante del primo elemento
          else if(typeof element == "undefined" && (this.cart[0].restaurant === dish.restaurant_id)){
              this.cart.push(currentDish);

          } 
          // Se non è il primo elemento e il piatto appartiene a un ristorante diverso rispetto al primo piatto del carrello
          else if((this.cart.length > 0) && (this.cart[0].restaurant != dish.restaurant_id)) {
            console.log('non puoi');
            const hasConfirmed = confirm("Non puoi inserire un piatto di un altro ristorante. Vuoi svotare il carrello?");
              if(hasConfirmed) {
                this.cart = [];
                this.cart.push(currentDish)
              } else {
                die();
              }
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
    padding: 50px;

    h2{
      font-size: 46px;
      text-shadow: 0 0 5px rgb(39, 39, 39);
    }

    ul{
      li{
        width: 25%;
        .card.dish{
          width: 25;
          border-radius: 20px;
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
        }
      }
    }
    
    
    

  }
</style>