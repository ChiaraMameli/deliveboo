<template>
    <main id="thank-you">
        <div class="container pb-5">
            <h2 class="text-center">Grazie per aver ordinato su Deliveboo!</h2>
            <p class="text-center mb-5">A breve riceverai una mail di conferma.</p>
            <h3 class="text-center">Questo è il riepilogo del tuo ordine:</h3>
            <div class="card p-4">
                <strong>Piatti ordinati:</strong>
                <ul class="list-unstyled">
                    <li v-for="dish in order">{{dish.name}}</li>
                </ul>
            </div>
        </div>
    </main>
</template>

<script>
export default{
    name: 'ThankYouPage',
    data(){
        return{
            order: [],
        }
    },
    mounted() {
        if (localStorage.cart) {
            this.order = JSON.parse(localStorage.cart);
        };
    },
   

    watch:{
        cart(newCart){
            localStorage.order = JSON.stringify(newCart);
        },
        amount(newAmount) {
            localStorage.amount = JSON.stringify(newAmount);
        }
    },
}
</script>

<style lang="scss" scoped>
#thank-you{
    background-color: #F6E7C1;
    min-height: 100vh;
    padding-top: 150px;
}
</style>