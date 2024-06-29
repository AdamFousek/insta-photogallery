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

declare interface Validation {
    isValid: boolean,
    message: string
}

const data = reactive({
    emailValidation: {
        isValid: true,
        message: ''
    } as Validation,
    usernameValidation: {
        isValid: true,
        message: ''
    } as Validation,
    passwordValidation: {
        isValid: true,
        message: ''
    } as Validation,
    passwordConfirmationValidation: {
        isValid: true,
        message: ''
    } as Validation
})

let validationTimer = null
watch(email, (newEmail) => {
    if (newEmail === '') {
        return
    }

    clearTimeout(validationTimer)
    validationTimer = setTimeout(async () => {
        const response = await useRepository().validateEmail(newEmail)

        data.emailValidation.isValid = !response.error
        data.emailValidation.message = response.message
    }, 500)
})

watch(username, (newUsername) => {
    if (newUsername === '') {
        return
    }

    clearTimeout(validationTimer)
    validationTimer = setTimeout(async () => {
        const response = await useRepository().validateUsername(newUsername)

        data.usernameValidation.isValid = !response.error
        data.usernameValidation.message = response.message
    }, 500)
})

watch(password, (newPassword) => {
    if (newPassword === '') {
        return
    }

    clearTimeout(validationTimer)
    validationTimer = setTimeout(() => {
        data.passwordValidation.isValid = newPassword.length >= 8
        data.passwordValidation.message = data.passwordValidation.isValid ? '' : 'Password must be at least 8 characters'
    }, 500)
})

watch(passwordConfirmation, (newPasswordConfirmation) => {
    if (newPasswordConfirmation === '') {
        return
    }

    clearTimeout(validationTimer)
    validationTimer = setTimeout(() => {
        data.passwordConfirmationValidation.isValid = newPasswordConfirmation === password.value
        data.passwordConfirmationValidation.message = data.passwordConfirmationValidation.isValid ? '' : 'Passwords do not match'
    }, 500)
})

const registerUser = () => {
    if (!data.emailValidation.isValid || !data.usernameValidation.isValid || !data.passwordValidation.isValid || !data.passwordConfirmationValidation.isValid) {
        return
    }

    useRepository().registerUser({
        email: email.value,
        username: username.value,
        password: password.value
    })
}

</script>

<template>
    <Wrapper class="mx-auto md:w-1/2">
        <h2 class="text-xl text-center">Register</h2>
        <form @submit.prevent="registerUser" class="flex flex-col gap-6">
            <div>
                <label for="default-input" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white" :class="{
                    'text-red-500': !data.usernameValidation.isValid && username.length > 0
                }">Username</label>
                <TextInput
                        v-model="username"
                        type="text"
                        required
                        :class="{
                            'border-gray-300': username.length === 0,
                            'border-red-500': !data.usernameValidation.isValid && username.length > 0,
                            'border-emerald-500': data.usernameValidation.isValid && username.length > 0,
                        }"
                        borderless="true"
                />
                <div v-if="!data.usernameValidation.isValid">
                    <span v-html="data.usernameValidation.message" class="text-xs text-red-500"></span>
                </div>
            </div>
            <div>
                <label for="default-input" class="block mb-2 text-sm text-gray-900 dark:text-white font-bold" :class="{
                    'text-red-500': !data.emailValidation.isValid && email.length > 0
                }">Email</label>
                <TextInput
                        v-model="email"
                        type="email"
                        required
                        :class="{
                            'border-gray-300': email.length === 0,
                            'border-red-500': !data.emailValidation.isValid && email.length > 0,
                            'border-emerald-500': data.emailValidation.isValid && email.length > 0
                        }"
                        borderless="true"
                />
                <div v-if="!data.emailValidation.isValid">
                    <span v-html="data.emailValidation.message" class="text-xs text-red-500"></span>
                </div>
            </div>
            <div>
                <label
                        for="default-input"
                        class="block mb-2 text-sm font-bold text-gray-900 dark:text-white"
                        :class="{
                            'text-red-500': !data.passwordValidation.isValid && password.length > 0
                        }"
                >
                    Password
                </label>
                <TextInput
                        v-model="password"
                        type="password"
                        required
                        :class="{
                            'border-gray-300': password.length === 0,
                            'border-red-500': !data.passwordValidation.isValid && password.length > 0,
                            'border-emerald-500': data.passwordValidation.isValid && password.length > 0
                        }"
                        borderless="true"
                />
                <div v-if="!data.passwordValidation.isValid">
                    <span v-html="data.passwordValidation.message" class="text-xs text-red-500"></span>
                </div>
            </div>
            <div>
                <label
                        for="default-input"
                        class="block mb-2 text-sm font-bold text-gray-900 dark:text-white"
                        :class="{
                            'text-red-500': !data.passwordConfirmationValidation.isValid && passwordConfirmation.length > 0
                        }"
                >
                    Password Confirmation
                </label>
                <TextInput
                        v-model="passwordConfirmation"
                        type="password"
                        required
                        :class="{
                            'border-gray-300': passwordConfirmation.length === 0,
                            'border-red-500': !data.passwordConfirmationValidation.isValid && passwordConfirmation.length > 0,
                            'border-emerald-500': data.passwordConfirmationValidation.isValid && passwordConfirmation.length > 0
                        }"
                        borderless="true"
                />

                <div v-if="!data.passwordConfirmationValidation.isValid">
                    <span v-html="data.passwordConfirmationValidation.message" class="text-xs text-red-500"></span>
                </div>
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