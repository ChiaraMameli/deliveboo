<template>
    <main id="cart">
        <div class="container">
            
        </div>
    </main>
</template>

<script>
export default{
    name: 'CartPage',
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
}
</script>

<style lang="scss" scoped>
    #cart{
        min-height: calc(100vh - 50px);
        background-color: rgb(188, 33, 33);
    }
</style>