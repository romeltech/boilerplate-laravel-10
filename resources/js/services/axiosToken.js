import axios from "axios";

// sanctum api calls with bearer token
const apiUrl = import.meta.env.VITE_SANCTUM_USER_URL;
const axiosToken = (bearer) => {
    return axios.create({
        baseURL: apiUrl,
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization: `Bearer ${bearer}`,
        },
    });
};

export { axiosToken };
