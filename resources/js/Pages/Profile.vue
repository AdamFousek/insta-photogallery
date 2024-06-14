<script setup lang="ts">
import {useUserStore} from "../stores/userStore";

const user = useUserStore().user
</script>

<template>
    <h1>Profile - {{ user.username }}</h1>
</template>

<style scoped>

</style>