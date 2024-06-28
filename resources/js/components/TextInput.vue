<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue', 'borderless']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
            class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 outline-none"
            :class="{'border-gray-300': !borderless}"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input"
    />
</template>
