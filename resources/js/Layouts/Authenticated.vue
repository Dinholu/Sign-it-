<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faBars } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

</script>

<template>
    <div class="flex flex-row h-[100vh]">
        <div class=" w-[25%] h-full text-center bg-[#137C8B] flex flex-col justify-between fixed top-0">
            <Link :href="route('index')">
            <h1 class="mt-8 mb-12 text-5xl font-bold">Sign-it</h1>
            </Link>
            <div class="grow mt-16">
                <ul class="space-y-12 text-xl text-left w-[75%] m-auto ">
                    <li
                        class="hover:text-white text-bold active:text-white focus:outline-none focus:border-[#137C8B] focus:shadow-outline-gray transition ease-in-out duration-150">
                        <Link :href="route('index')"
                            :class="route().current('index') ? 'text-white underline text-bold' : ''">
                        <font-awesome-icon icon="fa-solid fa-house" class="pr-12 text-2xl" />Vos réunion</Link>
                    </li>
                    <li
                        class="hover:text-white active:text-white focus:outline-[#137C8B] focus:border- focus:shadow-outline-[#137C8B] transition ease-in-out duration-150">
                        <Link :href="route('createmeeting')"
                            :class="route().current('createmeeting') ? 'text-white underline text-bold' : ''">
                        <font-awesome-icon icon=" fa-solid fa-handshake" class="pr-12 text-2xl" />Ajouter une réunion
                        </Link>
                    </li>
                    <li
                        class="hover:text-white active:text-white focus:outline-[#137C8B] focus:border- focus:shadow-outline-[#137C8B] transition ease-in-out duration-150">
                        <Link :href="route('createmeeting')"
                            :class="route().current('createmeeting') ? 'text-white underline text-bold' : ''">
                        <font-awesome-icon icon="fa-solid fa-file" class="pr-12 text-2xl" />Vos documents</Link>
                    </li>

                    <li
                        class="hover:text-white active:text-white focus:outline-none focus:border-[#137C8B] focus:shadow-outline-gray transition ease-in-out duration-150">
                        <Link :href="route('index')">
                        <font-awesome-icon icon="fa-solid fa-gear" class="pr-12 text-2xl" />Réglages</Link>
                    </li>
                </ul>
            </div>
            <div class="w-fit px-8 py-5 mb-12 border-2 border-[#137c8b] bg-white rounded-3xl m-auto">
                <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}
                    {{ $page.props.auth.user.firstname }}</div>
                <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>

            </div>
            <Link :href="route('logout')" method="post" as="button" class="mb-4 text-sm text-gray-300">Déconnexion
            </Link>
        </div>
        <div class="bg-gray-100 w-[75%]  ml-[25%] h-full">
            <header class="bg-white shadow sticky top-0" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

