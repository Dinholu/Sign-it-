<template>

    <Head title="Réglages"></Head>
    <BreezeAuthenticatedLayout class="">
        <template #header>
            <div>
                <h2 class="font-semibold text-xl text-[#344D59] leading-tight ">
                    Modifiez vos informations
                </h2>
            </div>
        </template>
        <div class="bg-gray-100 m-2 py-12 px-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col mb-5">
                <form @submit.prevent="submit" class="text-[#344D59]">
                    <div>
                        <BreezeLabel for="name" value="Votre Nom" />
                        <BreezeInput v-model="form.name" id="name" type="text" class="mt-1 block w-full" required
                            autofocus autocomplete="Votre nom" />
                        <BreezeInputError class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="firstname" value="Votre prénom" />
                        <BreezeInput v-model="form.firstname" id="firstname" type="text" class="mt-1 block w-full"
                            required autocomplete="Votre prénom" />
                        <BreezeInputError class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="email" value="Votre email" />
                        <BreezeInput v-model="form.email" id="email" type="text" class="mt-1 block w-full" required
                            autocomplete="Votre email" />
                        <BreezeInputError class="mt-2" />
                    </div>
                    <div class="mt-4 flex flex-row w-full justify-between">
                        <div class="w-[45%]">
                            <BreezeLabel for="phone" value="Votre numéro de telephone" />
                            <BreezeInput v-model="form.phone" id="phone" type="text" class="mt-1 block w-full" required
                                autocomplete="Votre numero de telephone" />
                            <BreezeInputError class="mt-2" />
                        </div>
                        <div class="w-[45%]">
                            <BreezeLabel for="ip" value="Votre IP" />
                            <BreezeInput v-model="form.ip" id="ip" type="text" class="mt-1 block w-full" required
                                autocomplete="Votre IP" />
                            <BreezeInputError class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-12 text-right">
                        <BreezeButton class="ml-4" :disabled="form.processing">
                            Modifier la réunion
                        </BreezeButton>
                    </div>
                </form>
            </div>
        </div>

    </BreezeAuthenticatedLayout>


</template>
<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeButton from '@/Components/Button.vue';

export default {
    name: 'Settings',
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeInput,
        Link,
        BreezeLabel,
        BreezeInputError,
        BreezeButton,
    },
    props: {
        user: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: null,
                firstname: null,
                email: null,
                phone: null,
                ip: null,
            })
        }
    },
    mounted: function () {
        this.form.name = this.user.name;
        this.form.firstname = this.user.firstname;
        this.form.email = this.user.email;
        this.form.phone = this.user.phone;
        this.form.ip = this.user.ip;
    },

    methods: {
        submit() {
            this.form.post(route('settings.update'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.$inertia.reload();
                }
            })
        }

    }
}</script>
