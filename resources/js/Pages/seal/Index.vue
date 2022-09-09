<template>

    <Head title="Vos documents"></Head>
    <BreezeAuthenticatedLayout class="">
        <template #header>
            <div>
                <h2 class="font-semibold text-xl text-[#344D59] leading-tight ">
                    Vos documents
                </h2>
                <BreezeInput id="searchbar" type="text" class="mt-5 w-full block rounded-xl"
                    placeholder="Rechercher... " v-model="searchbar" required autofocus autocomplete="rechercher" />
            </div>
        </template>
        <div class="bg-gray-100 m-2 py-12 px-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col mb-5">
                <div v-if="seals.length > 0" class="overflow-hidden shadow-sm sm:rounded-lg m-2">
                    <div class="" v-for=' seal in filteredSeals' :key="seal.id">

                        <div class="p-6 bg-white sm:rounded-sm  border-x-4 mb-5 m-2 flex justify-between ">
                            <div>
                                <h2 class="block text-xl font-semibold my-auto text-[#137C8B]">{{ seal.meeting.title }}
                                </h2>
                                <p>{{ seal.meeting.date }}</p>
                            </div>
                            <Link :href="'/seal/' + seal.id">
                            <font-awesome-icon
                                class="transition ease-in-out text-4xl text-[#137C8B] hover:text-[#344d59] duration-300 "
                                icon="fa-solid fa-download" />
                            </Link>
                        </div>
                    </div>
                </div>

                <div v-else class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                    <h2 class="p-6 block"> Vous n'avez pas de encore de document.
                    </h2>
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
    name: 'IndexSeal',
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeInput,
        Link
    },
    props: {
        seals: {
            type: Object
        }
    },
    data() {
        return {
            searchbar: '',
        }
    },

    computed: {
        filteredSeals() {
            return this.seals.filter((seal) => {
                return seal.meeting.title.toLowerCase().includes(this.searchbar.toLowerCase());
            });
        }
    },
    methods: {


    }
}</script>
