<template>

    <div class="p-6 bg-white sm:rounded-sm  border-x-4 transition ease-in-out duration-800"
        :class="meeting.statut == 'open' ? 'border-emerald-200' : 'border-red-200'">
        <div @click="displayMore = !displayMore" class="flex flex-row justify-between cursor-pointer">
            <h2 class="block text-2xl font-semibold my-auto text-[#137C8B]">{{ meeting.title }}</h2>
            <div class="flex space-x-5 ">
                <div>
                    <h2 class="m-auto font-semibold text-[#137C8B]">{{
                    meetingDate }} à {{meetingHour}}</h2>

                </div>
            </div>
        </div>
        <Transition mode="out-in">
            <div v-if="displayMore" class=" mt-8 px-5 flex flex-row justify-between text-[#344d59]">
                <div class="flex flex-col gap-8 cursor-pointer ">
                    <div @click="copy()" class="flex flex-row gap-5 items-center">
                        <font-awesome-icon class="text-[#137C8B]  text-2xl pointer " icon="fa-solid fa-copy" />
                        <p class="pointer text-[#137C8B]  font-semibold text-l ">Cliquez ici pour copier votre lien</p>
                    </div>
                    <div class="flex flex-row gap-5 items-center">
                        <font-awesome-icon icon="fa-solid fa-pen-to-square" class="text-[#137C8B]  text-2xl" />
                        <p class="text-[#137C8B]  font-semibold text-l ">{{ meeting.description }}</p>
                    </div>
                    <div class="flex flex-row gap-5 items-center">
                        <font-awesome-icon class="text-[#137C8B]  text-2xl" icon="fa-solid fa-location-dot" />
                        <h2 class="text-[#137C8B]  font-semibold text-l">Lieu : <span> {{ meeting.place }}</span>
                        </h2>
                    </div>
                    <div class="flex flex-row gap-5 items-center">
                        <font-awesome-icon class="text-[#137C8B]  text-2xl" icon="fa-solid fa-user-check" />
                        <div>
                            <h2 class="text-[#137C8B]  font-semibold text-l">Participants : </h2>
                            <ul v-for="participant in meeting.participant" :key="participant.id">
                                <li class="ml-5 font-bold text-[#137C8B]" v-if="participant.user_id == meeting.user_id">
                                    {{
                                    participant.name
                                    +
                                    ' ' + participant.firstname + ' (Créateur)'
                                    }}</li>

                                <li class="ml-5" v-else>{{ participant.name + ' ' + participant.firstname }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-fit space-y-5 mt-3">

                    <Link v-if="meeting.statut == 'open'"
                        class="text-sm text-gray-300 m-auto block focus:text-[#137C8B] hover:text-[#137C8B] transition ease-in-out duration-500"
                        :href="'editmeeting/' + meeting.slug" as="button">Modifier la réunion
                    </Link>
                    <Link v-if="meeting.statut == 'open'"
                        class="text-sm text-gray-300 m-auto block focus:text-[#137C8B] hover:text-[#137C8B] transition ease-in-out duration-500"
                        :href="'participantedit/' + meeting.slug" method="get" as="button">Gérer les participants
                    </Link>
                    <Link v-if="meeting.statut == 'open'" as="button"
                        class="text-sm text-gray-300 m-auto block focus:text-[#137C8B] hover:text-[#137C8B] transition ease-in-out duration-500"
                        :href="'closemeeting/' + meeting.slug" method="put">Marquer comme close
                    </Link>
                    <Link
                        class="text-sm text-gray-300 m-auto block focus:text-[#137C8B] hover:text-[#137C8B] transition ease-in-out duration-500"
                        :href="'deletemeeting/' + meeting.slug" method="DELETE" as="button">Supprimer la
                    réunion
                    </Link>


                </div>
            </div>
        </Transition>
    </div>
</template>
<script >
import { Link } from '@inertiajs/inertia-vue3';
import { Method } from '@inertiajs/inertia';
import useClipboard from 'vue-clipboard3'
const { toClipboard } = useClipboard()

export default {

    components: { Link },
    emit: ['copied'],
    props: {
        meeting: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            displayMore: false,
            date: new Date(),
        };
    },
    computed: {
        meetingDate() {
            this.meeting.date = new Date(this.meeting.date);
            return this.meeting.date.toLocaleDateString('fr-FR', {
                weekday: 'long', year: 'numeric', month: 'long', day:
                    'numeric'

            });
        },
        meetingHour() {
            this.meeting.date = new Date(this.meeting.date);
            return this.meeting.date.toLocaleTimeString('fr-FR', {
                hour: '2-digit', minute: '2-digit'
            });
        }
    },
    methods: {
        copy() {
            try {
                toClipboard('http://tmed-signit.test/meetings/' + this.meeting.slug)
                console.log('Copied to clipboard')
                this.$emit('copied', 'Copié dans le presse papier')
            } catch (e) {
                console.error(e)
            }
        }

    }
}

</script>
<style scoped>
.v-enter-active,
.v-leave-active {
    max-height: 500px;
    transition: max-height 1s ease 1s;
    transition: all 1s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
    max-height: 0;
    margin: 0;
    transition: all 0.5s ease-out;
}
</style>
