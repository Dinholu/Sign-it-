<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue'], ['cols'], ['rows']);


defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <textarea
        class="border-gray-300 focus:border-[#137C8B] focus:ring focus:ring-[#137C8B] focus:ring-opacity-50 rounded-md shadow-sm py-2 px-3 resize-none"
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" cols="20" rows="4" />
</template>
