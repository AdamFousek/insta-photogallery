<script setup lang="ts">
import {onMounted} from "vue";

const props = defineProps<{
    username: string
}>()

onMounted(() => {
    console.log('User page mounted ' + props.username)
    // axios to get user info and photo albums
})
</script>

<template>
    <h1>User - {{ username }}</h1>
</template>

<style scoped>

</style>