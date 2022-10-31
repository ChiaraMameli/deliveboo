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
.center{
    background: #262626;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height:100vh;
    z-index: 1000;
.ring {
        // top: 0;
        // right: 0;
        // left: 0;
        // bottom: 0;
        // position: fixed;
        position: absolute;

        width: 250px;
        height: 250px;
        // background: transparent;
        // border: 3px solid #ff3529;
        border-radius: 50%;
        // text-align: center;
        // line-height: 180px;
        // box-shadow: 0 0 20px rgba(0, 0, 0, .5);
        color: #ff2000;
        text-shadow: 0 0 10px #ff0000;
        
        span {
            color:#ce3737;
            position: fixed;
                top: calc(50% - 100px);
                left: calc(50% - 60px);
            line-height:200px;
            font-size: 1.3rem;
            letter-spacing: 0.3rem;
            text-transform: uppercase;
            animation: text 3s ease-in-out infinite;
        }


    }
    
    .ring::before {
     position: absolute;
     content: '';
     // z-index: 1000;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     box-shadow: 0 0 20px rgba($color: #ce3737, $alpha: .4);
     //  border-top: 3px solid #db1b1b;
     //  border-right: 3px solid #db1b1b;
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