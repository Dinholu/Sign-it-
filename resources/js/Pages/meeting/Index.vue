
<template >

    <Head title="Liste de vos réunions" />

    <BreezeAuthenticatedLayout class="">
        <template #header>
            <h2 class="font-semibold text-xl text-[#344D59] leading-tight ">
                Liste de vos réunions
            </h2>
            <BreezeInput id="searchbar" type="text" class="mt-5 w-full block rounded-xl" required autofocus
                autocomplete="rechercher" />

            <div class="flex gap-8 px-5 pt-5">
                <div class="py-4 px-6 bg-emerald-200 rounded-full text-xl ">Réunion en cours</div>
                <div class="py-4 px-6 bg-red-200 rounded-full text-xl ">Réunion close</div>
                <div class="text-xl my-auto">Clear</div>

            </div>
        </template>


        <div id="text" class="py-12 bg-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col mb-5">
                <div v-if=$page.props.flash.message
                    class="fixed bottom-5 bg-[#344D59] px-8 py-4 rounded-2xl text-white font-bold right-8">
                    {{ $page.props.flash.message }}
                </div>

                <div v-if="meetings.length > 0" class="overflow-hidden shadow-sm sm:rounded-lg m-2">

                    <meetingItemsVue class="mb-5" v-for='meeting in meetings' :key="meeting.id" :meeting="meeting"
                        :participants="participants"></meetingItemsVue>
                </div>

                <div v-else class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                    <h2 class="p-6 block"> Vous n'avez pas de réunions. Cliquez
                        <Link :href="route('createmeeting')">ici</Link> pour ajouter une réunion
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
import meetingItemsVue from '@/Components/meetingItems.vue';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeInput,
        Link,
        meetingItemsVue
    },
    name: 'Index',
    props: {
        meetings: {
            type: Object,
        },
        participants: {
            type: Object,
        },
    },
    data() {
        return {
            displayMore: false,

        }
    },

    mounted() {
        this.setTimeout()
    },

    methods: {
        setTimeout() {
            setTimeout(() => {
                this.$page.props.flash.message = null;
            }, 3000);
        }
    }

}
</script>
<style>
</style>
