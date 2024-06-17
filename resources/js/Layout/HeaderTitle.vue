<script setup lang="ts">
defineProps<{
    header: string
}>()
</script>

<template>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">{{ header }}</h1>
        </div>
    </header>
</template>

<style scoped>

</style>