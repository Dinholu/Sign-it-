<template>
    <Head :title="meeting.title" />

        <GuestLayout class="bg-[url('/public/ecran.png')] bg-cover h-[100vh] ">

        <div class="backdrop-blur-sm bg-white/30 p-6 rounded-xl space-y-5 text-center">
            <h1 class="text-6xl mb-6 font-bold">Vous êtes invité</h1>
            <font-awesome-icon  class="text-center text-6xl animate-waving-hand" icon="fa-solid fa-hand" />
            <h1 class="text-3xl text-center mb-6 font-bold">{{meeting.title}}</h1>
            <div class="m-auto w-[55%] text-left">
                <p>{{meeting.description}}</p>
                <p>{{meeting.place}}</p>
                <p>{{meeting.date}}</p>
            </div>
            <p class="text-center">Voulez vous participez a cette réunion ?</p>
            <div class="flex flex-row justify-between px-6">
                <BreezeButton class="">
                    Participer
                </BreezeButton>
                <BreezeButton class="">
                    <Link href="/">Décliner</Link>
                </BreezeButton>
            </div>
            </div>
        </GuestLayout>

</template>
<script>
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import GuestLayout from '@/Layouts/Guest.vue';
import BreezeButton from '@/Components/Button.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faBars } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

export default {
    name: 'ShowMeeting',
    props: {
        meeting: {
            type: Object,
            required: true
        }
    },
    components: {
        Head,
        Link,
        GuestLayout,
        BreezeButton
    },
}
</script>
