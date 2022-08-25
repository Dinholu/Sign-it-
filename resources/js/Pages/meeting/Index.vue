
<template>
    <Head title="Liste de vos réunions" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-[#344D59] leading-tight">
                Liste de vos réunions
            </h2>
            <BreezeInput id="searchbar" type="text" class="mt-5 w-full block rounded-xl" required autofocus autocomplete="rechercher" />
            </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col">


                <div v-if="meetings.length > 0 " class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-2">
                    <div v-for="meeting in meetings" :key="meeting" @click="displayMore = !displayMore" class="p-6 bg-white border-b border-gray-200">

                        <div class="flex flex-row justify-between">
                            <h2 class="block">{{meeting.title}}</h2>
                            <div class="flex space-x-5">
                                <h2>{{meeting.date}}</h2>
                                <div v-if="meeting.statut == 'open'" class="block bg-green-500 rounded-xl p-2 h-2 m-1"></div>
                            </div>
                        </div>
                <div v-if="displayMore">
                <p>{{meeting.description}}</p>
                <p>Le lien de votre réunion : <Link :href="'/meetings/'+meeting.slug"> http://tmed-signit.test/meetings/{{meeting.slug}}</Link></p>
                </div>

                </div>

                  </div>

                <div v-else class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                    <h2 class="p-6 block"> Vous n'avez pas de réunions. Cliquez <Link :href="route('createmeeting')">ici</Link> pour ajouter une réunion</h2>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeInput,
        Link
    },
    name: 'Index',
    props: {
        meetings: {
            type: Object,
        }
    },
    data() {
        return {
            displayMore: false,
        }
    },


}
</script>
