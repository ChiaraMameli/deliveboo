<template>
    <main id="thank-you">
        <div class="container">
            <h2 class="text-center">Grazie per aver ordinato su Deliveboo!</h2>
            <p class="text-center mb-5">A breve riceverai una mail di conferma.</p>
            <h3 class="text-center">Questo è il riepilogo del tuo ordine:</h3>
            <div class="card p-4">
                <strong>Piatti ordinati:</strong>
                <ul class="list-unstyled">
                    <li>Pappa al pomodoro</li>
                    <li>Penne agli scampi</li>
                    <li>Orata al forno</li>
                    <li>Kebab</li>
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
            cart: [],
        }
    }
}
</script>

<style lang="scss" scoped>
#thank-you{
    background-color: #F6E7C1;
    min-height: 100vh;
    padding-top: 150px;
}
</style>