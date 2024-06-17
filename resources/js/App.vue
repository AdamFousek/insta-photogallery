<script setup lang="ts">
import Menu from "./Layout/Menu.vue";
</script>

<template>
    <div class="bg-gradient-to-t from-white to-rose-50 min-h-screen">
        <Menu />

        <router-view name="header" />

        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <router-view />
        </main>
    </div>
</template>

<style scoped>

</style>