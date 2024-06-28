import axios from "axios";
import type ValidateEmailResponse from "../responses/ValidateEmailResponse";
import type ValidateUsernameResponse from "../responses/ValidateUsernameResponse";

export function useRepository() {
    const axiosInstance= axios.create({
        baseURL: import.meta.env.VITE_APP_URL,
        timeout: 10000,
    });

    const validateEmail = async (email: string): Promise<ValidateEmailResponse> => {
        return getData('POST', '/api/validate/email', {email});
    }

    const validateUsername = async (username: string): Promise<ValidateUsernameResponse> => {
        return getData('POST', '/api/validate/username', {username});
    }

    const registerUser = async (username: string): Promise<ValidateUsernameResponse> => {
        return getData('POST', '/api/user/register', {username});
    }


    const getData = async (method: string, url: string, body: object) => {
        try {
            const response = await axiosInstance.request({
                    url,
                    method,
                    data: body,
            })

            return response.data
        } catch (error) {
            return error.response.data;
        }
    }

    return {
        validateEmail,
        validateUsername,
    }
}