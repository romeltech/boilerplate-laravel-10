import axios from "axios";
import { useAuthStore } from "@/stores/auth";

/**
 * Local api calls with bearer token
 */
const authStore = useAuthStore();
const bearerToken = authStore.token;
const apiUrl = import.meta.env.VITE_APP_URL;
const clientApi = axios.create({
    baseURL: apiUrl,
    headers: {
        // Accept: "application/json",
        // "Content-Type": "application/json",
        "Authorization": `Bearer ${bearerToken}`,
    },
});

export { clientApi };
