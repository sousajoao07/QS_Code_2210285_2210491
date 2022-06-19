import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: {},
        tokenType: "",
        token: "",
        expiration: 0,
        category_id:"",
        category_name:""
    }, 
    mutations:{
        saveCategoryId(state,id){
            state.category_id=id;
            localStorage.setItem('id', JSON.stringify(id));
        },
        saveCategoryName(state,name){
            state.category_name=name;
            localStorage.setItem('name', JSON.stringify(name));
        },
        setToken(state, {token, tokenType, expiration}) {
            state.token = token;
            state.tokenType = tokenType;
            state.expiration = expiration;
            localStorage.setItem('token_type', tokenType);
            localStorage.setItem('access_token', token);
            localStorage.setItem('expiration_time', expiration);
            axios.defaults.headers.common.Authorization = "Bearer " + token;
            
        },
        setAuthUser(state,user){
            state.user=user;
            localStorage.setItem('user', JSON.stringify(user));
        },

        clearUserAndToken(state) {
            state.user = null;
            state.token = "";
            state.expiration = 0;
            localStorage.removeItem('user');
            localStorage.removeItem('token_type')
            localStorage.removeItem('access_token');
            localStorage.removeItem('expiration_time')
            axios.defaults.headers.common.Authorization = undefined;
        },
        
    },
    getters:{ 
        getToken(state) {
            let token = localStorage.getItem('access_token');
            let tokenType = localStorage.getItem('token_type');
            let expiration = localStorage.getItem('expiration_time');

            if (!token || !tokenType || !expiration) {
                return null;
            }

            if (Date.now() > parseInt(expiration)) {
                state.token = "";
                state.tokenType = "";
                localStorage.removeItem('token_type');
                localStorage.removeItem('access_token');
                localStorage.removeItem('expiration_time');
                localStorage.removeItem('user');
                axios.defaults.headers.common.Authorization = undefined;
                return null;
            }

            return token;
        },
        getTokenType(state) {
            let tokenType = localStorage.getItem('token_type');

            if (!tokenType) {
                return null;
            }

            return tokenType;
        },
        getExpiration(state) {
            let expiration = localStorage.getItem('expiration_time')

            if (!expiration) {
                return null;
            }

            return expiration;
        },
        getAuthUser(state) {
            let user = localStorage.getItem('user')

            if (!user) {
                return null;
            }

            return JSON.parse(user);
        },

        isAuthenticated(state) {
            if(state.user && state.token && state.tokenType ){
                console.log(state.user);
                console.log(state.token);
                console.log(state.expiration);
               return true;
            }
            return false;
        },
        isOperator(state){
            if(state.user){
                return state.user.type =="o" ? true : false;
            }
            return false;
        },
        isAdmin(state){
            if(state.user){
                return state.user.type =="a" ? true : false;
            }
            return false;
        }
    },

    actions:{
        setAuthUser({commit},data){
            commit('setAuthUser',data);
        },
    }
});