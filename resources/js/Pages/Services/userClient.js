import axios from "axios";
 
let apiUrl = import.meta.env.VITE_BASE_URL;
 
const userClient = axios.create({
  baseURL: apiUrl,
  //withCredentials: true,
});

export default userClient;
