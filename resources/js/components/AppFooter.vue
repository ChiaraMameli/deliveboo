<template>
    <footer class="d-flex flex-column justify-content-between">
        <div class="container pt-5 d-flex flex-wrap">
            <div class="left col-md-6 col-12">
                <img class="mb-3" src="../../image/logo-deliveboo.png" alt="">
                <i class="d-block p-3 fa-solid fa-envelope"> info@deliveboo.com</i>
                <i class="d-block p-3 fa-solid fa-phone"> 800-900-700</i>
                <i class="d-block p-3 fa-solid fa-location-dot">Via Pippo, 13</i>
            </div>
            <div class="right col-md-6 col-12">
                
            </div>
        </div>
        <div class="container bottom-footer d-flex justify-content-between pl-5 pr-5">
            <p>©2021 Delivboo All rights reserved</p>
            <p>Created by Team 6</p>
        </div>
    </footer>
</template>

<script>
export default{
    name: 'AppFooter'
}
</script>

<style scoped lang="scss">
footer{
    height: 400px;
    background-image: url(../../image/dishes-bg-2.jpg);
    background-size: cover;
    background-position: center;
    position: relative;
    box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.8);
    color: white;
    .container{
        
        img{
            width: 300px;
        }
    }
}
</style>