<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    firstname: '',
    email: '',
    phone: '',
    ip: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <BreezeGuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="name" value="Nom" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />
                <BreezeInputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <BreezeLabel for="firstname" value="Prénom" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.firstname" required autofocus
                    autocomplete="firstname" />
                <BreezeInputError class="mt-2" :message="form.errors.firstname" />
            </div>
            <div class="mt-4">
                <BreezeLabel for="email" value="E-mail" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="email" />
                <BreezeInputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="mt-4">
                <BreezeLabel for="phone" value="Numéro de Téléphone" />
                <BreezeInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required
                    autocomplete="phone" />
                <BreezeInputError class="mt-2" :message="form.errors.phone" />
            </div>
            <div class="mt-4">
                <BreezeLabel for="ip" value="IP" />
                <BreezeInput id="ip" type="ip" class="mt-1 block w-full" v-model="form.ip" required autocomplete="ip" />
                <BreezeInputError class="mt-2" :message="form.errors.ip" />
            </div>
            <div class="mt-4">
                <BreezeLabel for="password" value="Mot de passe" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirmation mot de passe" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Déjà inscrit ?
                </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    S'enregistrer
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
