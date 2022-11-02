<template>
  <main id="restaurant-details">
    <div id="jumbotron" v-bind:style="{ backgroundImage: 'url(' + restaurant.image + ')' }">
      <h2 class="text-white text-center p-5">{{restaurant.name}}</h2>
    </div>
    <p class="text-center p-1">Indirizzo: {{restaurant.address}}</p>
    <div class="container">
      <h2 class="text-white text-center p-5">Menu:</h2>
      <ul class="d-flex flex-wrap list-unstyled">
        <li class="p-3 col-12 col-md-6 col-lg-3" v-for="dish in restaurant.dishes" :key="dish.id">
          <div class="card dish p-2">
            <img :src="dish.image" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{dish.name}}</h5>
              <p class="card-text">{{dish.description}}</p>
              <strong class="">{{dish.price}}€</strong>
              <i @click="addToCart(dish), getFeedback(dish);" class="fa-solid fa-plus d-flex justify-content-center align-items-center mt-3"></i>
              <div class="alert alert-primary d-none">
              Hai aggiunto il piatto al carrello
            </div>
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
        getFeedback(){

          const addDish = document.querySelectorAll('.fa-plus');
          const alert = document.querySelectorAll('.alert');        

          // PARTE AL SECONDO CLICK
          for(let i = 0; i < addDish.length; i++){
            
            addDish[i].addEventListener('click', function(){
                alert[i].classList.remove('d-none');  
              })
          }
        

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
            'quantity': 1,
          };

          const element = this.cart.find(element => element.dish === dish.id);

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

          this.$emit('populated-cart', this.cart);

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
          if(this.currentCartt){
            localStorage.cart = JSON.stringify(newCart);
          } else{
            localStorage.cart = JSON.stringify(newCart);
          } 
        },
    }
}
</script>

<style lang="scss" scoped>
  #restaurant-details{
    background-color: #E84342;
    padding-bottom: 50px;

    h2{
        min-width: 500px;
        font-size: 76px;
        text-shadow: 0 0 6px rgb(16, 16, 16);
      }
    
    #jumbotron{
      padding-top: 150px;
      height: 500px;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }

    p{
      background-color: white;
    }

    ul{
      li{
        .card.dish{
          border-radius: 20px;
          border: none;

          img{
            border-radius: 20px 20px 0 0;
            height: 250px;
            object-fit: cover;
          }

          strong{
            font-size: 22px;
          }

          i{
            cursor: pointer;
            border-radius: 50%;
            border: 2px solid #E84342;
            color: #E84342;
            display: inline-block;
            width: 50px;
            height: 50px;
            font-size: 20px;
            transition: 0.5s;

          &:hover{
            background-color: #E84342;
            color: white;
          }
        }
        }
      }
    }
    
    
    

  }
</style>