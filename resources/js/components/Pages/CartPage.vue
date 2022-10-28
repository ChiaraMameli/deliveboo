<template>
    <main id="cart">
        <h2>Cart</h2>
        <div class="container">
            <input type="text" v-model="dish">

            <p>{{dish}}</p>
        </div>
    </main>
</template>

<script>
export default{
    name: 'CartPage',
    data(){
        return{
            dish: '',
        }
    },
    mounted(){
        if(localStorage.dish){
            this.dish = localStorage.dish;
        }
    },
    watch:{
        dish(newDish){
            localStorage.dish = newDish;
        }
    }
}
</script>

<style lang="scss" scoped>
    #cart{
        min-height: calc(100vh - 50px);
        background-color: rgb(164, 164, 164);
    }
</style>