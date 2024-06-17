import axios from "axios";

export function useRepository() {
    const axiosInstance= axios.create({
        baseURL: import.meta.env.VITE_APP_URL,
        timeout: 10000,
    });

    const validateEmail = async (email: string) => {
        // todo
        try {
            const response = axiosInstance.post(
                `/api/validate-email/`,
                {
                    email: email,
                }
            );
        } catch (e) {
            console.log(e.response.data);
        }
    }


    const getData = async () => {
        let response = null
        /*
        try {
            response = await axiosInstance({
                method: method,
                url: url,
                headers,
                body: inputData,
            })
        } catch (e: unknown) {
            if (e instanceof FetchError) {
                const errorMessage = `Data could not be loaded from url ${url}. InputData: ${JSON.stringify(inputData)}. ${e}. Response: ${
                    e.response
                }`
                this.sentry?.sentryCaptureException?.(errorMessage)

                throw new Error(errorMessage)
            }

            this.sentry?.sentryCaptureException?.(e)

            throw e
        }

        const data: any = response
        const result = data.result
        const responseData = data.response

        if (result) {
            return responseData
        } else if (data.code === 301) {
            throw new InvalidAccessTokenException('Invalid access token')
        } else if (data.code === 300 || data.code === 307) {
            return data
        } else {
            const Exception = data.code === 404 ? NotFoundError : Error

            throw new Exception(
                `Data could not be loaded from url ${url}. InputData: ${JSON.stringify(inputData)}. Message ${data.message}`
            )
        }*/
    }

    return {
        validateEmail,
        getData,
    }
}