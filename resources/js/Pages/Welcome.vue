<template>

<div class="h-full flex" >
    <Head title="Bienvenue" />
    <div class="bg-white w-[120%]">
        <Login/>
    </div>
    <div class="bg-[#fec898] w-full text-center flex flex-col ">
        <h1 class="text-white text-9xl mt-14 font-bold">Sign-it</h1>
        <p class="text-white text-3xl mt-8 m-5 grow">Votre application de gestion de réunions</p>
        <h1 id="imageConn" class="text-[12vh] text-[#fec898] mb-14">CONNEXION</h1>
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
  text-shadow: #e19b5e 0px 0 40px;
  font-family: 'Montserrat';

 }
</style>

