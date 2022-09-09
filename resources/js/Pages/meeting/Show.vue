<template>

    <Head :title="meeting.title" />

    <GuestLayout class="bg-[url('/public/ecran.png')] bg-cover h-[100vh] ">

        <div class="backdrop-blur-sm bg-white/30 px-3 py-6 rounded-xl space-y-7 text-center">
            <font-awesome-icon class="text-center text-6xl animate-waving-hand mt-3" icon="fa-solid fa-hand" />
            <h1 class="text-3xl text-center mb-6 font-bold">{{ meeting.title }}</h1>

            <h1 class="text-5xl mb-6 font-bold p-4">Vous êtes invité</h1>
            <div class="m-auto w-fit max-w-[65%] text-left">
                <p class="font-semibold mb-6 text-justify">{{ meeting.description }}</p>
                <p class="text-center italic font-semibold">{{ meeting.place }}</p>
                <p class="mb-5 text-center italic">{{ meeting.date }}</p>
            </div>
        </div>

        <div class="flex flex-row justify-between px-10 mt-2  backdrop-blur-sm bg-white/30 p-6 rounded-xl">
            <BreezeButton @click="TriggerButton">
                Participer
            </BreezeButton>
            <BreezeButton class="">
                <Link :href="route('index')">Décliner</Link>
            </BreezeButton>
        </div>
    </GuestLayout>
    <PopupVue v-if="buttonTrigger" :meetingid="meeting.id" :TriggerButton="this.TriggerButton" :user="this.user">
        <h1>Vos informations</h1>
    </PopupVue>
</template>
<script>
import { ref } from 'vue';
import PopupVue from '@/Components/Popup.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import GuestLayout from '@/Layouts/Guest.vue';
import BreezeButton from '@/Components/Button.vue';
// import { library } from '@fortawesome/fontawesome-svg-core'
// import { faBars } from '@fortawesome/free-solid-svg-icons'
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { DateTime } from "luxon";

export default {
    name: 'ShowMeeting',
    props: {
        meeting: {
            type: Object,
            required: true,
        }
    },
    components: {
        Head,
        Link,
        GuestLayout,
        BreezeButton,
        PopupVue,
    },
    data() {
        return {
            buttonTrigger: false,
            datemeeting: null,
            user: this.$page.props.auth.user
        }
    },

    methods: {
        TriggerButton() {
            this.buttonTrigger = !this.buttonTrigger;
        }
    },
    mounted() {
        this.datemeeting = this.meeting.date.toLocaleString(DateTime.DATETIME_SHORT)
        console.log(this.datemeeting)
    }


}
</script>
