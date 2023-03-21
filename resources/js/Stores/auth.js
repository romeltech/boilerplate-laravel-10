import { defineStore } from 'pinia'

export const useAuth = defineStore({
  id: 'auth',
  state: () => ({
    auth_user: {},
    token: '',
  }),
  getters: {
    authUser: (state) => state.auth_user,
     
  },
  actions: {
    validateToken(token){

    },
    setAuth(auth){
      this.auth_user = Object.assign({}, auth); 
    },
    setToken(token){
      this.token = token;
    }
  },
  
})