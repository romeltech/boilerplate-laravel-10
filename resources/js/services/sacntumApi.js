import axios from "axios";

// login from auth api
let apiUrl = import.meta.env.VITE_SANCTUM_USER_URL;
const authApi = axios.create({
    baseURL: apiUrl,
    // withCredentials: true,
    // headers: { Accept: "application/json" },
});

// sanctum api calls with bearer token
const axiosWithBearer = (bearer) => {
    return axios.create({
        baseURL: apiUrl,
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization: `Bearer ${bearer}`,
        },
    });
};

export { authApi, axiosWithBearer };
