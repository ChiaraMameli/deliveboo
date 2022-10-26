<template>
    <main>
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

<style></style>