<script setup lang="ts">
import {RouteLocationNamedRaw, RouteLocationPathRaw} from "vue-router";

defineProps<{
    to: string | RouteLocationPathRaw | RouteLocationNamedRaw
}>()
</script>

<template>
    <router-link :to="to" class="underline text-rose-500 hover:text-rose-600 hover:no-underline">
        <slot />
    </router-link>
</template>

<style scoped>

</style>