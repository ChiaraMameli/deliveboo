<template>
    <div class="center">

        <div class="ring">
            
            <span>Loading...</span>
        </div>
    </div>
    </template>

<script>
export default {
name: 'AppLoader',
}
</script>

<style scoped lang="scss">
//sfondo
.center{
    background: #F6E7C1;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height:100vh;
    z-index: 1000;
.ring {
        position: absolute;

        width: 250px;
        height: 250px;
        border-radius: 50%;
        color: #ff2000;
        text-shadow: 0 0 10px #ff0000;
        // posizionato ad occhio sulla vh
        span {
            color:#ce3737;
            position: fixed;
            top: calc(50% - 100px);
            left: calc(50% - 60px);
            line-height:200px;
            font-size: 1.3rem;
            letter-spacing: 0.3rem;
            text-transform: uppercase;
            //animazione testo
            animation: text 3s ease-in-out infinite;
        }


    }
    //anello con animazione che ruota
    .ring::before {
     position: absolute;
     content: '';
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     box-shadow: 0 0 20px rgba($color: #ce3737, $alpha: .4);
     border-radius: 50%;
     animation: ring 2s linear infinite;
    }
   
}
@keyframes text {


    50% {
       color:white;
    }

}

;
@keyframes ring {
    0% {
    transform: rotate(0deg);
    box-shadow: 1px 5px 2px #e65c00;
    }


    50% {
transform: rotate(180deg);
    box-shadow: 1px 5px 2px #18b201;
}

    100% {
    transform: rotate(360deg);
        box-shadow: 1px 5px 2px #0456c8;
    }
}

;
</style>