import {computed, ref} from 'vue'
import type User from "../Models/User";
import {defineStore} from "pinia";

export const useUserStore = defineStore('user', () => {
    const user = ref<User | null>(null)
    const accessToken = ref<string>('')
    const isLoggedIn = computed(() => user !== null)

    function login(newUser: User, newAccessToken: string) {
        user.value = newUser
        accessToken.value = newAccessToken
    }

    function logout() {
        user.value = null
        accessToken.value = ''
    }

    return {user, accessToken, isLoggedIn, login, logout}
})