<template>
    <main>
        <div class="container">
            <input type="text" v-model="dish">

            <p>{{dish}}</p>
            <AppPayments />
        </div>
    </main>
</template>

<script>
import AppPayments from '../AppPayments.vue';
export default{
    name: 'CartPage',
    components: {AppPayments},
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