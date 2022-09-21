<template>

    <Head title="Créer une Réunion" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-[#344D59] leading-tight">
                Créer une réunion
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 mb-5">

            <form @submit.prevent="submit" class="text-[#344D59] mt-5 px-8">
                <div>
                    <BreezeLabel for="title" value="Titre" />
                    <BreezeInput v-model="form.title" @change="slugcreate" id="title" type="text"
                        class="mt-1 block w-full" required autofocus autocomplete="title" />
                    <BreezeInputError class="mt-2" />
                </div>
                <div class="mt-4">
                    <BreezeLabel for="description" value="Description" />
                    <BreezeInput v-model="form.description" id="description" type="text" class="mt-1 block w-full"
                        required autocomplete="Votre description" />
                    <BreezeInputError class="mt-2" />
                </div>
                <div class="mt-4">
                    <BreezeLabel for="place" value="Lieu" />
                    <BreezeInput v-model="form.place" id="place" type="text" class="mt-1 block w-full" required
                        autocomplete="Lieu" />
                    <BreezeInputError class="mt-2" />
                </div>
                <div class="mt-4 flex flex-row w-full justify-between">
                    <div class="w-[45%]">
                        <BreezeLabel for="date" value="Date de la réunion" />
                        <BreezeInput v-model="form.date" id="date" type="datetime-local" @change="closingcreate"
                            class="mt-1 block w-full" required autocomplete="DateMeeting" />


                    </div>
                    <div class="w-[45%]">
                        <BreezeLabel for="privilege" value="Privileges" />
                        <select v-model="form.privilege"
                            class="mt-1 block w-full border-gray-300 focus:border-[#137C8B] focus:ring focus:ring-[#137C8B] focus:ring-opacity-50 rounded-md shadow-sm"
                            name="privilege" id="privilege">
                            <option value="public">Public</option>
                            <option value="private">Privée</option>
                        </select>
                        <BreezeInputError class="mt-2" />
                    </div>
                </div>

                <div class=" mt-12 text-right">
                    <BreezeButton class="ml-4" :disabled="form.processing">
                        Ajouter la réunion
                    </BreezeButton>
                </div>
            </form>
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


export default {
    name: 'CreateMeeting',
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeInput,
        BreezeButton,
        BreezeCheckbox,
        BreezeInputError,
        BreezeLabel,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: null,
                description: null,
                place: null,
                date: null,
                closing: null,
                privilege: null,
                slug: null
            }),

        };
    },

    methods: {

        slugcreate() {
            this.form.slug = this.form.title.replace(/\s+/g, '-').toLowerCase() + '-' + Math.floor(Math.random() * 100);
        },

        closingcreate() {
            let close = new Date(this.form.date);
            close.setHours(close.getHours() + 23);
            this.form.closing = close.getFullYear() + '-' + (close.getMonth() + 1) + '-' + close.getDate() + 'T' + close.getHours() + ':' + close.getMinutes();
        },

        submit() {
            this.form.post("/createmeeting");
            console.log("lets go");

        }
    },
    updated() {
    }
}
</script>
<style>

</style>
