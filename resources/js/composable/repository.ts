import axios from "axios";
import type ValidateEmailResponse from "../responses/ValidateEmailResponse";

export function useRepository() {
    const axiosInstance= axios.create({
        baseURL: import.meta.env.VITE_APP_URL,
        timeout: 10000,
    });

    const validateEmail = async (email: string): Promise<ValidateEmailResponse> => {
        return getData('POST', '/api/validate-email', {email});
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
    }
}