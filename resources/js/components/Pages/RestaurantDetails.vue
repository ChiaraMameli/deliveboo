<template>

  <AppLoader v-if="isLoading" />
  <main v-else id="restaurant-details">
    <div id="jumbotron" v-bind:style="{ backgroundImage: 'url(' + restaurant.image + ')' }">
      <h2 class="text-white text-center p-5">{{restaurant.name}}</h2>
    </div>
    <p class="text-center p-1">Indirizzo: {{restaurant.address}}</p>
    <div class="container">
      <h2 class="text-white text-center p-5">Menu:</h2>
      <ul class="d-flex flex-wrap list-unstyled">
        <li class="p-3 col-12 col-md-6 col-lg-3" v-for="dish in dishes" :key="dish.id">

          <!-- card dish -->
          <div class="card dish p-2">
            <img :src="dish.image" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{dish.name}}</h5>
              <p class="card-text">{{cutDescription(dish.description)}}</p>
              <strong class="">{{dish.price}}€</strong>

              <!-- modale -->
              <div id="overlay" class="d-none">
                <div id="modale" class="bg-white p-5 rounded d-none">
                  <p>Non puoi inserire un piatto di un altro ristorante. Vuoi svotare il carrello?</p>
                  <a id="modale-button-no" class="btn btn-primary">Annulla</a>
                  <a @click="emptyCart(dish)" id="modale-button-yes" href="" class="btn btn-primary">Ok</a>
                </div>
              </div>

              <!-- button add to cart -->
              <div class="d-flex">
                <i @click="addToCart(dish), getFeedback(dish);" class="fa-solid fa-plus d-flex justify-content-center align-items-center mt-3"></i>
                <span class="alert alert-primary d-none">
                Hai aggiunto il piatto al carrello
                </span>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </main>
</template>

<script>
import AppLoader from "../AppLoader";
export default {
name:'RestaurantDetails',
data(){
  return{
    restaurant: null,
    cart: [],
    dishes:[],
    isLoading: false
  }
},
components:{
        AppLoader
    },
computed: {
  setImage(){
    return this.dish.image ?? "https://image.shutterstock.com/image-vector/ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg";
  }
},
methods: {
        fetchRestaurant() {
            this.isLoading = true;

            axios.get("http://localhost:8000/api/restaurants/" + this.$route.params.id).then((res) => {
                this.restaurant = res.data.restaurant;
                const dishes = res.data.restaurant.dishes;
                console.log(dishes)

                dishes.forEach(dish => {
                  if(dish.is_visible) this.dishes.push(dish);
                })
              
                this.isLoading = false;
            }).catch(err => {
                console.log(err);
                this.isLoading = false;
            });
        },
        getFeedback(){

          const addDish = document.querySelectorAll('.fa-plus');
          const alert = document.querySelectorAll('.alert');        

          // PARTE AL SECONDO CLICK
          for(let i = 0; i < addDish.length; i++){
            
            addDish[i].addEventListener('click', function(){
                alert[i].classList.remove('d-none');  
                addDish[i].classList.remove('d-flex');
                addDish[i].classList.add('d-none');
                setTimeout(function(){
                  alert[i].classList.add('d-none');
                  addDish[i].classList.add('d-flex');
                  addDish[i].classList.remove('d-none');
              },2000);
              })
          }
        },
        cutDescription(dishDescription){
            let description = dishDescription.substring(0, 100) + '...';
            return description;
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

            // Recupero gli elementi per mostrare la modale
            const modale = document.getElementById('modale');
            const overlay = document.getElementById('overlay');
            const modaleButtonNo = document.getElementById('modale-button-no');

            // mostro la modale in pagina
            overlay.classList.remove('d-none');
            modale.classList.remove('d-none');
            
            modaleButtonNo.addEventListener('click', function(){
              overlay.classList.add('d-none');
              modale.classList.add('d-none');
            })
          }

          this.$emit('populated-cart', this.cart);

        },
        emptyCart(dish){
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

          this.cart = [];
          this.cart.push(currentDish)
          return this.cart;
        },
    },
    mounted() {
        this.fetchRestaurant();
        if(localStorage.cart){
            this.cart = JSON.parse(localStorage.cart);
        }

        // const jumbotron = document.getElementById('jumbotron');
        // console.log(jumbotron);
        // jumbotron.style.backgroundImage = "url(" + this.restaurant.image + ")";
    },
    created(){
      console.log(this.restaurant);
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
    position: relative;

    #overlay {
      position: fixed; /* Sit on top of the page content */
      width: 100%; /* Full width (cover the whole page) */
      height: 100%; /* Full height (cover the whole page) */
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.8); /* Black background with opacity */
      z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
      cursor: pointer; /* Add a pointer on hover */

        #modale{
        position: absolute;
        top: 50vh;
        left: 50vw;
        transform: translate(-50%, -50%);
        z-index: 1;
      }
    }
    

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
          height: 580px;

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