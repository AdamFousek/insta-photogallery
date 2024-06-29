<script setup lang="ts">
import Wrapper from '../components/Wrapper.vue'
import { ref } from "vue";
import {useRepository} from "../composable/repository";

const username = ref('');
const password = ref('');

const login = () => {
    const registerUser = () => {
        if (username.value === '' || password.value === '') {
            return
        }

        useRepository().loginUser({
            username: username.value,
            password: password.value
        })
    }
}
</script>

<template>
    <Wrapper class="mx-auto w-1/2">
        <h2 class="text-xl text-center">Register</h2>
        <form @submit.prevent="login" class="flex flex-col gap-6">
        </form>
    </Wrapper>
</template>

<style scoped>

</style>