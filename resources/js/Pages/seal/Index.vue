<template>

    <Head title="Vos documents"></Head>
    <BreezeAuthenticatedLayout class="">
        <template #header>
            <div>
                <h2 class="font-semibold text-xl text-[#344D59] leading-tight ">
                    Vos documents
                </h2>
                <BreezeInput id="searchbar" type="text" class="mt-5 w-full block rounded-xl"
                    placeholder="Rechercher... " required autofocus autocomplete="rechercher" />
            </div>
        </template>
        <div class="py-12 bg-gray-100" v-for=' seal in seals' :key="seal.id">
            <div v-if="seals.length > 0" class="overflow-hidden shadow-sm sm:rounded-lg m-2">
                <div class="p-6 bg-white sm:rounded-sm  border-x-4 ">
                    <div class="flex flex-row justify-between cursor-pointer">
                        <h2 class="block text-xl font-semibold my-auto">{{ seal.path }}</h2>

                    </div>
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
}</script>
