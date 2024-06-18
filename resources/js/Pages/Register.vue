<script setup lang="ts">
import Wrapper from '../components/Wrapper.vue'
import TextInput from '../components/TextInput.vue'
import {reactive, ref, watch} from 'vue'
import PrimaryButton from '../components/PrimaryButton.vue'
import MyLink from '../components/MyLink.vue'
import { useRepository } from '../composable/repository'

const email = ref('')
const username = ref('')
const password = ref('')
const passwordConfirmation = ref('')

const emailValidation = reactive({
    isValid: true,
    message: ''
})

const usernameValidation = reactive({
    isValid: true,
    message: ''
})

let validationTimer = null
watch(email, (newEmail) => {
    if (newEmail === '') {
        return
    }

    clearTimeout(validationTimer)
    validationTimer = setTimeout(async () => {
        const response = await useRepository().validateEmail(newEmail)
        console.log(response);
        emailValidation.isValid = !response.error
        emailValidation.message = response.message
    }, 500)
})

</script>

<template>
    <Wrapper class="mx-auto w-1/2">
        <h2 class="text-xl text-center">Register</h2>
        <form>
            <div class="mb-6">
                <label for="default-input" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Username</label>
                <TextInput v-model="username" type="text" required />
            </div>
            <div class="mb-6">
                <label for="default-input" class="block mb-2 text-sm text-gray-900 dark:text-white font-bold" :class="{
                    'text-red-500': !emailValidation.isValid
                }">Email</label>
                <TextInput v-model="email" type="email" required :class="{
                    'border-red-500': !emailValidation.isValid,
                    'border-emerald-500': emailValidation.isValid && email.length > 0
                }"/>
                <span v-if="!emailValidation.isValid" class="text-red-500 text-sm">{{ emailValidation.message }}</span>
            </div>
            <div class="mb-6">
                <label for="default-input" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Password</label>
                <TextInput v-model="password" type="password" required />
            </div>
            <div class="mb-6">
                <label for="default-input" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Password Confirmation</label>
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