import axios from "axios";

let apiUrl = import.meta.env.VITE_SANCTUM_API_URL;

/**
 * login
 */
const samctumApi = axios.create({
    baseURL: apiUrl,
    // withCredentials: true,
    // headers: { Accept: "application/json" },
});

/**
 * with credentials
 */
const serverApi = axios.create({
    baseURL: apiUrl,
    withCredentials: true,
    headers: { Accept: "application/json" },
});

/**
 * with bearer token
 */
// const loginextAppApi = axios.create({
//   baseURL: apiUrl,
//   headers: {
//     Accept: "application/json",
//     "Content-Type": "application/json",
//     "WWW-Authenticate": `BASIC ${process.env.REACT_APP_BACKEND_API_TOKEN}`,
//   },
// });
export { samctumApi, serverApi };
