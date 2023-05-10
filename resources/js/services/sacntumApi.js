import axios from "axios";

// login from auth api
let apiUrl = import.meta.env.VITE_SANCTUM_USER_URL;
const authApi = axios.create({
    baseURL: apiUrl,
    // withCredentials: true,
    // headers: { Accept: "application/json" },
});

// local api calls with bearer token
// const bearerToken = '_pinia_';
// const bearerToken = process.env.VITE_SANCTUM_USER_TOKEN;
// const authApiWithBearer = axios.create({
//   baseURL: apiUrl,
//   headers: {
//     Accept: "application/json",
//     "Content-Type": "application/json",
//     "WWW-Authenticate": `BASIC ${process.env.VITE_SANCTUM_USER_TOKEN}`,
//   },
// });
export { authApi };
