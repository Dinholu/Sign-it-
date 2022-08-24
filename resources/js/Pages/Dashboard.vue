
<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-[#344D59] leading-tight">
                Liste de vos réunions
            </h2>
            <BreezeInput id="searchbar" type="text" class="mt-5 w-full block rounded-xl" required autofocus autocomplete="rechercher" />
            </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="meetings.length > 1 " class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="meeting in meetings" :key="meeting" class="p-6 bg-white border-b border-gray-200">
                        {{meeting.title}}
                  </div>

                </div>
                <div v-else class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="p-6 bg-white border-b border-gray-200"> Vous n'avez pas de réunions</h2>
                    <Link :href="route('createmeeting')">Ajouter une Réunion</Link>

                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeInput
    },
    name: 'Dashboard',
    props: {
        meetings: {
            type: Object,
        }
    },

}
</script>
