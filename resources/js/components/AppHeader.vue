<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <!-- logo -->
    <router-link :to="{name:'home'}" class="nav-link">
      <img src="../../image/logo-deliveboo.png" alt="" @click="closeTendina()">
    </router-link>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse d-lg-flex justify-content-between" id="navbarNav">
      <div class="left-menu">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link class="nav-link" :to="{name:'cart'}"><span @click="closeTendina()">Carello</span></router-link>
          </li>
        </ul>
      </div>
      <div class="right-menu d-lg-flex align-items-center">
        <div id="login-btn">
          <p class="d-inline">Sei un ristoratore? </p>
          <a href="/register" class="btn btn-primary">Registrati</a> <p class="d-inline">o</p> <a href="/login" class="btn btn-warning">Accedi</a>
        </div>
        <i @click="toggleTendina()" class="fa-sharp fa-solid fa-bag-shopping ml-4"><span>{{getTotalQuantity(currentCart.length > 0 ? currentCart : cart)}}</span></i>
      </div>
    </div>

    <div id="tendina" :class="{ 'open': clicked }">
      <ul class="list-unstyled">
        <li v-if="!currentCart.length" v-for="dish in cart">
          <div class="cart-container d-flex align-items-center justify-content-between">
            <div class="dish-card d-flex align-items-center">
              <img :src="'/storage/' + dish.image" alt="">
              <div class="description">
                <h5 class="d-block">{{dish.name}}</h5>
                <strong class="d-block">{{dish.price}}€</strong>
                <span>Quantità: {{dish.quantity}}</span>
              </div>
            </div>
            <!-- <i @click="removeDish(dish)" class="fa-solid fa-xmark"></i> -->
          </div>
        </li>
        <li v-if="currentCart.length" v-for="dish in currentCart">
          <div class="cart-container d-flex align-items-center justify-content-between">
            <div class="dish-card d-flex align-items-center">
              <img :src="'/storage/' + dish.image" alt="">
              <div class="description">
                <h5 class="d-block">{{dish.name}}</h5>
                <strong class="d-block">{{dish.price}}€</strong>
                <span>Quantità: {{dish.quantity}}</span>
              </div>
            </div>
            <!-- <i @click="removeDish(dish)" class="fa-solid fa-xmark"></i> -->
          </div>
        </li>
      </ul>
      <router-link class="nav-link" :to="{name:'cart'}"><a class="btn btn-danger" @click="closeTendina()">Vai al carrello</a></router-link>
    </div>
    
  </nav>
  </header>
</template>

<script>
export default {
    name:'AppHeader',
    data(){
      return{
        cart: [],
      }
    },
    mounted(){
        if(localStorage.cart){
            this.cart = JSON.parse(localStorage.cart);
        }
    },
    methods:{
      toggleTendina(){
        const tendina = document.getElementById('tendina');
        tendina.classList.toggle('open')
      },
      closeTendina(){
        const tendina = document.getElementById('tendina');
        if(tendina.classList.contains('open')){
          tendina.classList.remove('open');
        }
      },
      getTotalQuantity(cart){
        let totalQuantity = 0;
          cart.forEach(dish => {
            totalQuantity += dish.quantity;
          });
          return totalQuantity;
      }
    },
    props:{
        currentCart: Array,
        clicked: Boolean,
    },

}
</script>

<style lang="scss" scoped>
header{
  position: fixed;
  top: 10px;
  left: 10px;
  right: 10px;
  z-index: 4;

  nav{
    position: relative;
    border-radius: 40px;
    padding: 15px;
    box-shadow: 0 0 5px rgb(146, 146, 146);

    img{
      height: 30px;
    }

    i.fa-bag-shopping{
      height: 50px;
      width: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
      background-color: #E84342;
      color: white;
      cursor: pointer;

      span{
        margin-left: 5px;
      }
    }
    #tendina{
      display: none;
      position: absolute;
      bottom: 0;
      right: 0;
      transform: translate(0, 100%);
      padding: 20px;
      background-color: white;
      width: 320px;
      min-height: 100px;
      border-radius: 20px;
      box-shadow: 0 0 5px rgb(146, 146, 146);

      &.open{
        display: block;
      }

      .cart-container{
        margin-top: 5px;

        h5{
          font-size: 16px;
        }

        img{
          width: 80px;
          height: 80px;
          object-fit: cover;
          border-radius: 50%;
          border: 2px solid #E84342;
          margin-right: 10px;
        }
      }
    }
  }
}

</style>