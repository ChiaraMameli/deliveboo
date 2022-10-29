<template>
    <div>
        <div id="dropin-container">
            <form method="post" id="payment-form" action="/checkout">
                <input type="hidden" name="_token" :value="csrf">
                <section>
                    <label for="amount">
                        <span class="input-label">Amount</span>
                        <div class="input-wrapper amount-wrapper">
                            <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                        </div>
                    </label>

                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="button" type="submit"><span>Test Transaction</span></button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AppPayments',
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    mounted(){
        braintree.dropin.create({
            container: document.getElementById('dropin-container'),
            // ...plus remaining configuration
            }, (error, dropinInstance) => {
            // Use `dropinInstance` here
            // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
            });
    }
}
</script>

<style>

</style>