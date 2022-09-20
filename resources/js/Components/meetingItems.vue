<template>

    <div class="p-6 bg-white sm:rounded-sm  border-x-4 transition ease-in-out duration-800"
        :class="meeting.statut == 'open' ? 'border-emerald-200' : 'border-red-200'">
        <div @click="displayMore = !displayMore" class="flex flex-row justify-between cursor-pointer">
            <h2 class="block text-xl font-semibold my-auto text-[#137C8B]">{{ meeting.title }}</h2>
            <div class="flex space-x-5 ">
                <div>
                    <h2 class="m-auto font-semibold text-[#137C8B]">Le {{
                    meeting.date.toLocaleString('fr')
                    }}</h2>
                </div>
            </div>
        </div>
        <Transition>
            <div v-if="displayMore" class=" mt-5 flex flex-row justify-between text-[#344d59]">

                <div class="">
                    <button @click="copy()"
                        class="text-[#137C8B] hover:text-[#344d59] transition ease-in-out duration-500 font-semibold text-l">Le
                        lien de votre réunion
                        <font-awesome-icon
                            class="text-[#137C8B] hover:text-[#344d59] transition ease-in-out duration-500"
                            icon="fa-solid fa-copy" />
                    </button>
                    <p class="font-semibold mt-5">{{ meeting.description }}</p>
                    <h2 class="italic">Lieu : {{ meeting.place }}</h2>
                    <p class="mt-5">Participants : </p>
                    <ul v-for="participant in meeting.participant" :key="participant.id">
                        <li class="ml-5 font-bold text-[#137C8B]" v-if="participant.user_id == meeting.user_id">{{
                        participant.name
                        +
                        ' ' + participant.firstname + ' (Créateur)'
                        }}</li>

                        <li class="ml-5" v-else>{{ participant.name + ' ' + participant.firstname }}</li>
                    </ul>
                </div>
                <div class="w-fit space-y-5 mt-3">

                    <Link v-if="meeting.statut == 'open'"
                        class="text-sm text-gray-300 m-auto block focus:text-[#137C8B] hover:text-[#137C8B] transition ease-in-out duration-500"
                        :href="'editmeeting/' + meeting.slug" as="button">Modifier la réunion
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
<script lang="ts">
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
        };
    },

    setup() {
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
    transition: opacity 0.5s ease;

}

.v-enter-from,
.v-leave-to {
    opacity: 0;
    transition: all 0.5s ease;
}
</style>
