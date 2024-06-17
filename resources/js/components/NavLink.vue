<script setup lang="ts">
import {RouteLocationNamedRaw, RouteLocationPathRaw} from "vue-router";

defineProps<{
    to: string | RouteLocationPathRaw | RouteLocationNamedRaw
}>()
</script>

<template>
    <router-link :to="to" class="rounded-md px-3 py-2 text-sm font-medium text-gray-200 hover:bg-rose-800 hover:text-white" activeClass="bg-rose-800 text-white">
        <slot />
    </router-link>
</template>

<style scoped>

</style>