<template>
    <main id="thank-you">
        <div class="container pb-5">
            <h2 class="text-center">Grazie per aver ordinato su Deliveboo!</h2>
            <p class="text-center mb-5">A breve riceverai una mail di conferma.</p>
            <h3 class="text-center">Questo è un breve riepilogo del tuo ordine:</h3>
            <div class="card p-4">
                <table class="table">
                    <thead class="bg-danger text-white">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Piatti ordinati</th>
                            <th scope="col">Quantità</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dish in order">
                            <td scope="row"></td>
                            <td>{{ dish.name }}</td>
                            <td>{{ dish.quantity }}</td>
                        </tr>
                    </tbody>
                </table>
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
        if (localStorage.order) {
            this.order = JSON.parse(localStorage.order);
        };
    },
   

    watch:{
        order(newOrder){
            localStorage.order = JSON.stringify(newOrder);
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