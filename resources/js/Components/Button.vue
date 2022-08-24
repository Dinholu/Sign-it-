<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-[#344D59] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#137C8B] active:bg-[#137C8B] focus:outline-none focus:border-[#137C8B] focus:shadow-outline-gray transition ease-in-out duration-150">
        <slot />
    </button>
</template>
