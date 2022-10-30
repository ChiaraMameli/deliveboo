<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <router-link :to="{name:'home'}" class="nav-link">
      <img src="../../image/logo-deliveboo.png" alt="" @click="closeTendina()">
    </router-link>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link class="nav-link" :to="{name:'cart'}"><span @click="closeTendina()">Cart</span></router-link>
        </li>
      </ul>
    </div>
    <i @click="toggleTendina()" class="fa-sharp fa-solid fa-bag-shopping"><span>{{currentCart.length > 0 ? currentCart.length : cart.length}}</span></i>
    <div id="tendina">
      <ul class="list-unstyled">
        <li v-if="!currentCart.length" v-for="dish in cart">
          <div class="cart-container d-flex align-items-center justify-content-between">
            <div class="dish-card d-flex align-items-center">
              <img :src="dish.image" alt="">
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
              <img :src="dish.image" alt="">
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
      // removeDish(dish){
      //   console.log(dish);
      //   this.currentCart = this.currentCart.filter(item => item !== dish);
      //   this.cart = this.cart.filter(item => item !== dish);
      //   localStorage.cart = JSON.stringify(this.cart);

      //   this.$emit('unpopulated-cart', this.currentCart);
      // },
    },
    props:{
        currentCart: Array,
    },

}
</script>

<style lang="scss" scoped>
header{
  position: fixed;
  top: 10px;
  left: 10px;
  right: 10px;
  z-index: 1;

  nav{
    position: relative;
    border-radius: 40px;
    padding: 15px;
    box-shadow: 0 0 5px rgb(146, 146, 146);

    img{
      height: 30px;
    }

    i.fa-bag-shopping{
      height: 40px;
      width: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
      background-color: rgb(188, 33, 33);
      color: white;

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
      min-height: 200px;
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
          border: 2px solid rgb(188, 33, 33);
          margin-right: 10px;
        }
      }
    }
  }
}

</style>