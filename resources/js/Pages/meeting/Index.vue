
<template >

    <Head title="Liste de vos réunions" />

    <BreezeAuthenticatedLayout class="">
        <template #header>
            <h2 class="font-semibold text-xl text-[#344D59] leading-tight ">
                Liste de vos réunions
            </h2>
            <BreezeInput id="searchbar" v-model="searchbar" type="text" class="mt-5 w-full block rounded-xl"
                placeholder="Rechercher... " required autofocus autocomplete="rechercher" />
            <div class="flex gap-8 px-5 pt-5">

                <input class="hidden" type="radio" name="filter bg-[#344D59]" id="filterActive" value="open"
                    v-model="picked" checked><label for="filterActive"
                    class="py-4 px-6 hover:cursor-pointer rounded-full text-xl transition ease-in-out duration-500"
                    :class="picked == 'open' ? ' bg-[#344D59] text-emerald-200 ' : 'hover:text-emerald-200 hover:bg-[#344D59] bg-emerald-200 '">Réunions
                    à venir</label>
                <input class=" hidden" type="radio" name="filter" id="filterClose" value="close" v-model="picked"><label
                    class=" py-4 px-6  rounded-full text-xl  hover:cursor-pointer transition ease-in-out duration-500"
                    for="filterClose"
                    :class="picked == 'close' ? ' bg-[#344D59] text-red-200 ' : 'bg-red-200 hover:text-red-200 hover:bg-[#344D59]'">Réunions
                    closes</label>
                <input class="hidden" type="radio" name="filter" id="filterAll" value="All" v-model="picked"><label
                    for="filterAll"
                    class="text-xl my-auto border-2 py-4 px-6 rounded-full  hover:cursor-pointer transition ease-in-out duration-500"
                    :class="picked == 'All' ? ' text-white bg-[#344D59]' : 'bg-[#137C8B] hover:text-white hover:bg-[#344D59]'">Toutes</label>
            </div>
        </template>


        <div id=" text" class="py-12 bg-gray-100 m-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col mb-5">
                <div v-if=$page.props.flash.message
                    class="fixed bottom-5 bg-[#344D59] px-8 py-4 rounded-2xl text-white font-bold right-8">
                    {{ $page.props.flash.message }}
                </div>

                <div v-if="meetings.length > 0" class="overflow-hidden shadow-sm sm:rounded-lg m-2">

                    <meetingItemsVue class="mb-5" v-for='meeting in meetingFiltered' :key="meeting.id"
                        :meeting="meeting">
                    </meetingItemsVue>

                </div>

                <div v-else class=" bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
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
import { watch } from '@vue/runtime-core';
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
        }
    },
    data() {
        return {
            displayMore: false,
            searchbar: '',
            list: [],
            picked: 'open',
        }
    },

    mounted() {
        this.setTimeout()
        console.log(this.searchbar)
    },

    methods: {
        setTimeout() {
            setTimeout(() => {
                this.$page.props.flash.message = null;
            }, 3000);
        }
    },
    computed: {
        meetingFiltered() {
            if (!this.searchbar) {
                this.list = this.meetings;
            }
            else {
                let searchCleaned = this.searchbar.toLowerCase().trim();
                this.list = this.meetings.filter(meeting => {
                    if ((meeting.title.toLowerCase().includes(searchCleaned) ||
                        meeting.description.toLowerCase().includes(searchCleaned)) ||
                        meeting.place.toLowerCase().includes(searchCleaned)) {
                        return meeting;
                    }
                });

            }
            if (this.picked == 'All') {
                return this.list;
            } else if (this.picked == 'open') {
                return this.list.filter(meeting => {
                    if (meeting.statut == 'open') {
                        return meeting;
                    }

                });
            } else if (this.picked == 'close') {
                return this.list.filter(meeting => {
                    if (meeting.statut == 'close') {
                        return meeting;
                    }
                });
            }

            return this.list;
        },
    },
}


</script>
<style>

</style>
