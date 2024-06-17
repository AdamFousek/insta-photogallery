<script setup lang="ts">
import {computed} from "vue";

export interface Props {
    style?: string
}
const props = withDefaults(defineProps<Props>(), {
    style: 'default',
})

const classes = computed(() => {
    return {
        'outline': 'bg-indigo-500 text-white active:bg-indigo-600 hover:bg-indigo-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 disabled:opacity-25',
        'default': 'inline-flex items-center px-4 py-2 bg-rose-500 text-white border border-transparent rounded-md font-semibold text-xs uppercase mr-1 tracking-widest hover:bg-rose-600 active:bg-rose-700 focus:outline-none focus:border-rose-500 focus:ring ring-rose-500 disabled:opacity-25 transition ease-in-out duration-150',
    }[props.style];
});
</script>

<template>
    <button class="" :class="classes">
        <slot />
    </button>
</template>

<style scoped>

</style>