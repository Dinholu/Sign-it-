<template>

<div class="h-full flex" >
    <Head title="Bienvenue" />
    <div class="bg-white w-[120%]">
        <Login/>
    </div>
    <div class="bg-[#137C8B] w-full text-center flex flex-col ">
        <h1 class="text-white text-9xl mt-14 font-bold">Sign-it</h1>
        <p class="text-white text-3xl mt-8 m-5 grow">Votre application de gestion de réunions</p>

        <h3 class="text-sm text-italic my-14 text-white"> Crée par T-Med</h3>
    </div>
    <HellosVG />
</div>

</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import HellosVG from '../Components/wavesSvg.vue';
import Login from './Auth/Login.vue';

export default {
    name: 'Welcome',
    components: {
    Head,
    Link,
    HellosVG,
    Login
    },
}

</script>

<style>
body{
    overflow: hidden;

}
#app {
    height : 100vh;
}


 #imageConn{
  text-shadow: #51b6c6 0px 0 60px;
  font-family: 'Gochi Hand', cursive;

 }
</style>

