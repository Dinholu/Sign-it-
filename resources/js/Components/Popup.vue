<template>
    <div class="fixed top-0 left-0 right-0 bottom-0 z-[99] flex m-auto justify-center items-center">
        <div class="p-8 backdrop-blur-sm bg-[#7ca8b3]/80 space-y-5 w-[80vh] rounded-xl shadow-xl">
            <slot />
        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="name" value="Votre nom" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>
            <div class="mt-4">
                <BreezeLabel for="firstname" value="Votre Prénom" />
                <BreezeInput id="firstname" type="text" class="mt-1 block w-full" v-model="form.firstname" required autofocus autocomplete="firstname" />
            </div>
            <div class="mt-4">
                <BreezeLabel for="email" value="Votre E-mail" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="email" />
            </div>
            <div class="mt-4 flex flex-row justify-between">
                <div class="w-[48%]">
                <BreezeLabel for="phone" value="Votre numéro de telephone" />
                <BreezeInput id="phone" type="tel" class="mt-1 block w-full" v-model="form.phone" required autofocus autocomplete="phone" />
            </div>
            <div class="w-[48%]">
                <BreezeLabel for="ip" value="Votre code personnel" />
                <BreezeInput id="ip" type="text" class="mt-1 block w-full" v-model="form.ip" required autofocus autocomplete="ip" />
            </div>
            </div>

                <div class="mt-4 flex flex-row justify-between">
            <BreezeButton @click="TriggerButton">Annuler</BreezeButton>
            <BreezeButton @click="submit">S'enregistrer</BreezeButton>

            </div>

            </form>
        </div>
    </div>
</template>
<script>
import BreezeButton from '@/Components/Button.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeInput from '@/Components/Input.vue';

export default {
    name : 'Popup',
    components: {
        BreezeButton,
        BreezeLabel,
        BreezeInput,
    },
    props: {
        TriggerButton: {
            type: Function,
            required: true
        },
        meetingid: {
            type: Number,
        }},
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                firstname: null,
                email: null,
                phone: null,
                ip: null,
                meeting_id: null,
            }),
        }
    },
    methods: {
        submit() {
            this.form.meeting_id = this.meetingid;
            this.form.post("/createparticipant")

        }
    }
}
</script>
