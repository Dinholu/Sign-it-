<template>

    <Head title="Editer la réunion" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-[#344D59] leading-tight">
                Editer la réunion
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <form @submit.prevent="submit" class="text-[#344D59]">
                <div>
                    <BreezeLabel for="title" value="Titre" />
                    <BreezeInput v-model="form.title" id="title" type="text" class="mt-1 block w-full" required
                        autofocus autocomplete="title" />
                    <BreezeInputError class="mt-2" :message="form.errors.title" />
                </div>
                <div class="mt-4">
                    <BreezeLabel for="description" value="Description" />
                    <BreezetextArea v-model="form.description" id="description" type="text" class="mt-1 block w-full"
                        required autocomplete="Votre description" />
                    <BreezeInputError class="mt-2" :message="form.errors.description" />
                </div>
                <div class="mt-4">
                    <BreezeLabel for="place" value="Lieu" />
                    <BreezeInput v-model="form.place" id="place" type="text" class="mt-1 block w-full" required
                        autocomplete="Lieu" />
                    <BreezeInputError class="mt-2" :message="form.errors.place" />
                </div>
                <div class="mt-4 flex flex-row w-full justify-between">
                    <div class="w-[45%]">
                        <BreezeLabel for="date" value="Date de la réunion" />
                        <BreezeInput v-model="form.date" id="date" type="datetime-local" @change="editclosing"
                            class="mt-1 block w-full" required autocomplete="DateMeeting" />
                        <BreezeInputError class="mt-2" :message="form.errors.date" />
                    </div>
                    <div class="w-[45%]">
                        <BreezeLabel for="privilege" value="Privileges" />
                        <select v-model="form.privilege"
                            class="mt-1 block w-full border-gray-300 focus:border-[#137C8B] focus:ring focus:ring-[#137C8B] focus:ring-opacity-50 rounded-md shadow-sm"
                            name="privilege" id="privilege">
                            <option value="public">Public</option>
                            <option value="private">Privée</option>
                        </select>
                        <BreezeInputError class="mt-2" :message="form.errors.privilege" />
                    </div>
                </div>
                <div class="mt-12 text-right">
                    <BreezeButton class="ml-4" :disabled="form.processing">
                        Modifier la réunion
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
import BreezetextArea from '@/Components/textArea.vue';

import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { watch } from '@vue/runtime-core';


export default {
    name: 'EditMeeting',
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeInput,
        BreezeButton,
        BreezeCheckbox,
        BreezeInputError,
        BreezeLabel,
        BreezetextArea
    },
    props: {
        meeting: {
            type: Object,
            required: true
        }
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

            })
        }
    },

    mounted: function () {
        this.form.title = this.meeting.title;
        this.form.description = this.meeting.description;
        this.form.place = this.meeting.place;
        this.form.date = this.meeting.date;
        this.form.closing = this.meeting.closing;
        this.form.privilege = this.meeting.privilege;
        this.form.slug = this.meeting.slug;
    },

    methods: {
        editclosing() {
            console.log(this.form.date);
            let close = new Date(this.form.date);
            close.setHours(close.getHours() + 23);
            this.form.closing = close.getFullYear() + '-' + (close.getMonth() + 1) + '-' + close.getDate() + 'T' + close.getHours() + ':' + close.getMinutes();
            console.log(this.form.closing);
        },

        submit() {
            this.form.put('/editmeeting/' + this.meeting.slug);
        }
    }

}
</script>
