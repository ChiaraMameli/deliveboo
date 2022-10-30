<template>
  <div id="ring">
    Loading
    <span></span>
  </div>
</template>

<script>
export default {
name: 'AppLoader',
}
</script>

<style scoped lang="scss">
main{
    background: #262626;
}
@keyframes animateC {
    0% {
        background-color: red;
    }

    25% {
        background-color: yellow;
    }

    50% {
        background-color: blue;
    }

    100% {
        background-color: green;
    }
};
@keyframes animate {
    0% {
        background-color: red;
    }

    25% {
        background-color: yellow;
    }

    50% {
        background-color: blue;
    }

    100% {
        background-color: green;
    }
};
#ring::before {
    content: '';
    position: absolute;
    z-index: 10;
    top: -3px;
    left: -3px;
    width: 100%;
    height: 100%;
    border: 3px solid #db1b1b;
    border-top: 3px solid #db1b1b;
    border-right: 3px solid #db1b1b;
    border-radius: 50%;
    animation-name: animateC ;
    animation: 2s linear infinite;
}
#ring{
    top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        position: fixed; 
        display: flex;
        align-items: center;
        justify-content: center;

    width:180px;
    height:180px;
    background: transparent;
    border: 3px solid #3c3c3c;
    border-radius: 50%;
    text-align: center;
    line-height: 180px;
    font-size: 1.3rem;
    color: #ff2000;
    letter-spacing: 4px;
    text-transform: uppercase;
    text-shadow: 0 0 10px #ff0000;
    box-shadow: 0 0 20px rgba(0, 0, 0, .5);
    
    span{
        display: block;
        position: absolute;
        top: calc(50% - 2px);
        left: 50%;
        width: 50%;
        height: 4px;
        background: transparent;
        transform-origin:left;
        animation-name: animate;
        animation: 2s linear infinite;
    }
}
</style>