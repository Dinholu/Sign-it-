<script setup>
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faBars } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex flex-row h-[100vh]">
        <div class="bg-white w-[25%] h-full text-center text-[#344D59] flex flex-col justify-between">
            <Link :href="route('dashboard')">
                <h1 class="mt-8 mb-12 text-5xl font-bold">Sign-it</h1>
            </Link>
            <div class="grow mt-16">
                <ul class="space-y-16 text-xl text-left w-[65%] m-auto ">
                        <li class="hover:text-[#137C8B] text-bold active:text-[#137C8B] focus:outline-none focus:border-[#137C8B] focus:shadow-outline-gray transition ease-in-out duration-150"><Link :href="route('dashboard')">
                            <font-awesome-icon icon="fa-solid fa-house" class="pr-12 text-2xl" />Vos réunion</Link></li>
                    <li class="hover:text-[#137C8B] active:text-[#137C8B] focus:outline-[#137C8B] focus:border- focus:shadow-outline-[#137C8B] transition ease-in-out duration-150"><Link :href="route('createmeeting')">
                        <font-awesome-icon icon="fa-solid fa-folder-plus" class="pr-12 text-2xl"/>Ajouter une réunion</Link></li>
                    <li class="hover:text-[#137C8B] active:text-[#137C8B] focus:outline-none focus:border-[#137C8B] focus:shadow-outline-gray transition ease-in-out duration-150"><Link :href="route('dashboard')">
                        <font-awesome-icon icon="fa-solid fa-gear" class="pr-12 text-2xl"/>Réglages</Link></li>
                </ul>
            </div>
            <div class="px-4 py-5 mb-12 border-2 border-[#137c8b] rounded-xl m-20">
               <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
               <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>

            </div>
            <Link :href="route('logout')" method="post" as="button" class="mb-4 text-sm text-gray-300">Déconnexion</Link>
        </div>
        <div class="bg-gray-100 w-[75%]">
                <header class="bg-white shadow" v-if="$slots.header">
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

