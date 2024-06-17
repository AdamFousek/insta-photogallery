<script setup lang="ts">
import Wrapper from '../components/Wrapper.vue'
import TextInput from '../components/TextInput.vue'
import { ref, watch } from 'vue'
import PrimaryButton from '../components/PrimaryButton.vue'
import MyLink from '../components/MyLink.vue'
import { useRepository } from '../composable/repository'

const email = ref('')
const username = ref('')
const password = ref('')
const passwordConfirmation = ref('')

let validationTimer = null
watch(email, (newEmail) => {
    clearTimeout(validationTimer)
    validationTimer = setTimeout(() => {
        useRepository().validateEmail(newEmail)
    }, 500)
})

</script>

<template>
    <Wrapper class="mx-auto w-1/2">
        <h2 class="text-xl text-center">Register</h2>
        <form>
            <div class="mb-6">
                <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <TextInput v-model="username" type="text" required />
            </div>
            <div class="mb-6">
                <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <TextInput v-model="email" type="email" required />
            </div>
            <div class="mb-6">
                <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <TextInput v-model="password" type="password" required />
            </div>
            <div class="mb-6">
                <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Confirmation</label>
                <TextInput v-model="passwordConfirmation" type="password" required />
            </div>
            <div class="flex justify-between">
                <MyLink to="/login">Login</MyLink>
                <PrimaryButton>Register</PrimaryButton>
            </div>
        </form>
    </Wrapper>

</template>

<style scoped>

</style>