<template>

    <Head title="Gérer les participants" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-[#344D59] leading-tight">
                Gérer les participants
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 mt-8">
            <div v-if=$page.props.flash.message
                class="fixed bottom-5 bg-[#344D59] px-8 py-4 rounded-2xl text-white font-bold right-8">
                {{ $page.props.flash.message }}
            </div>
            <div class="text-[#344D59]">
                <h1 class="text-xl font-semibold mb-8">Participants à la réunion « {{meeting.title}} »</h1>
                <ul v-for="participant in participants" :key="participant.id" class="ml-4">
                    <li v-if="participant.user_id == meeting.user_id" class="bg-white rounded-xl p-5 my-5">
                        {{participant.name}} {{participant.firstname}} <span class="font-semibold">Créateur</span>
                    </li>
                    <li v-else class="flex flex-row justify-between items-center bg-white rounded-xl p-5 mb-5">
                        <p class="block">{{participant.name}} {{participant.firstname}}</p>
                        <button @click="deleteParticipant(participant.id)" class="text-red-500 block">Supprimer</button>
                    </li>
                </ul>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { watch } from '@vue/runtime-core';

export default {
    name: 'EditMeeting',
    components: {
        BreezeAuthenticatedLayout,
        BreezeInput,
        BreezeButton,
        BreezeCheckbox,
        BreezeInputError,
        BreezeLabel,
        Head
    },
    props: {
        participants: Object,
        meeting: Object,
    },

    mounted() {
        this.setTimeout()
    },
    methods: {
        deleteParticipant(id) {
            this.$inertia.delete('deleteparticipant/' + id)
        },
        setTimeout() {
            setTimeout(() => {
                this.$page.props.flash.message = null;
            }, 3000);
        },
    }
}
</script>
