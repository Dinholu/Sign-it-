<template>
    <div class="p-6 bg-white sm:rounded-sm  border-x-4 "
        :class="meeting.statut == 'open' ? 'border-emerald-200' : 'border-red-200'">
        <div @click="displayMore = !displayMore" class="flex flex-row justify-between cursor-pointer">
            <h2 class="block text-xl font-semibold my-auto">{{ meeting.title }}</h2>
            <div class="flex space-x-5 ">
                <div>
                    <h2 class="m-auto font-semibold">Le {{ meeting.date.toLocaleString('fr') }}</h2>
                    <h2 class="m-auto text-center">Lieu : {{ meeting.place }}</h2>
                </div>
            </div>
        </div>
        <div v-if="displayMore" class=" mt-5 flex flex-row justify-between">
            <div class="">
                <p class="my-2 italic ">{{ meeting.description }}</p>
                <p>Le lien de votre réunion :
                    <Link :href="'/meetings/' + meeting.slug" class="underline text-[#137C8B] m-auto text-sm">
                    http://tmed-signit.test/meetings/{{ meeting.slug }}</Link>

                    <font-awesome-icon @click="copy()" class="hidden" icon="fa-solid fa-copy" />

                </p>
                <p>Participants : </p>
                <ul v-for="parti in this.AllParticipants" :key="parti.id">
                    <li class="ml-5 font-bold text-[#137C8B]" v-if="parti.user_id == meeting.user_id">{{ parti.name
                            +
                            ' ' + parti.firstname + ' (Admin)'
                    }}</li>
                    <li class="ml-5" v-else>{{ parti.name + ' ' + parti.firstname }}</li>
                </ul>
            </div>
            <div class="w-[45%] text-right space-y-1">

                <Link class="text-sm text-gray-300 m-auto block focus:text-[#137C8B] hover:text-[#137C8B]"
                    :href="'editmeeting/' + meeting.slug">Modifier la
                réunion
                </Link>
                <Link class="text-sm text-gray-300 m-auto block focus:text-[#137C8B] hover:text-[#137C8B]"
                    :href="'closemeeting/' + meeting.slug" method="put">Marquée comme close
                </Link>
                <Link class="text-sm text-gray-300 m-auto block focus:text-[#137C8B] hover:text-[#137C8B]"
                    :href="'deletemeeting/' + meeting.slug" method="DELETE">Supprimer la
                réunion
                </Link>

            </div>
        </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
import { Method } from '@inertiajs/inertia';
import useClipboard from 'vue-clipboard3'


export default {
    name: 'meetingItemsVue',
    components: {
        Link
    },
    props: {
        meeting: {
            type: Object,
            required: true
        },
        participants: {
            type: Object,
            required: true
        }

    },
    data() {
        return {
            displayMore: false,
            AllParticipants: [],
            navigator: navigator
        }
    },
    mounted() {
        if (this.participants.length > 0) {
            this.participants.forEach(participant => {
                if (participant.meeting_id == this.meeting.id) {
                    this.AllParticipants.push(participant);
                }
            });
        }
    },
    methods: {
        async copy() {

            try {
                await navigator.clipboard.writeText(location.href);
                console.log('Page URL copied to clipboard');
            } catch (err) {
                console.error('Failed to copy: ', err);
            }

        }
    }

}

</script>
