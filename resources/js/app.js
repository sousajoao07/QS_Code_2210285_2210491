require('./bootstrap');
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import VueRouter from 'vue-router';
import Toasted from 'vue-toasted';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import Vuelidate from 'vuelidate';

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);
Vue.use(Vuelidate);
Vue.use(Toasted,{
   theme: "bubble",
   position: 'top-center', //pode ser top-right, top-center, top-left, bottom-right, bottom-center, bottom-left
   duration: 3000,
   type: 'info',
});

////////////////////////////---- Menu ----///////////////////////////////////
import MenuAdmin from "./components/view/menuAdmin.vue";
const menuAdmin = Vue.component('usersList', MenuAdmin);

////////////////////////////---- Users ----///////////////////////////////////
import UsersList from "./components/view/usersList.vue";
const usersList = Vue.component('usersList', UsersList);

import EditUser from "./components/view/editUser.vue";
const editUser = Vue.component('editUser', EditUser);

import AddUser from "./components/view/addUser.vue";
const addUser = Vue.component('addUser', AddUser);

////////////////////////////---- Categories ----////////////////////////////////
import CategoriesList from "./components/view/categoriesList.vue";
const categoriesList = Vue.component('categoriesList', CategoriesList);

import AddCategory from "./components/view/addCategory.vue";
const addCategory = Vue.component('addCategory', AddCategory);

import EditCategory from "./components/view/editCategory.vue";
const editCategory = Vue.component('editCategory', EditCategory);

///////////////////////////----- Home -----///////////////////////////////////
import Home from "./components/view/home.vue";
const home = Vue.component('home', Home);

import Welcome from "./components/home/welcome.vue";
const welcome = Vue.component('welcome', Welcome);

import Login from "./components/login.vue";
const login = Vue.component('login', Login);

import Navbar from "./components/navbar.vue";
Vue.component('navbar', Navbar);

import Products from "./components/view/products.vue";
const products = Vue.component('list', Products);


/* import router from './router/index.js'; */

import NotFoundComponent from './components/notFound.vue';
const notFound = Vue.component('notFound', NotFoundComponent);


import store from '../store/store.js';

// // Para manter o utilizador logado depois de refrescar a pagina
store.state.user = store.getters.getAuthUser;
store.state.token = store.getters.getToken;
store.state.tokenType = store.getters.getTokenType;
store.state.getExpiration = store.getters.getExpiration;
axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.getters.getToken;

const routes = [
   {
      path:"/",
      name: "home",
      component: home,

   },
   {
      path:"/menu-admin",
      name: "menu",
      component: menuAdmin,
      meta: {
         forAdminAndOperator:true
      }
      
      
   },
   {
      path:"/categories-list",
      name: "categoriesList",
      component: categoriesList,
      meta: {
         forAdminAndOperator:true
      }
      
   },

   {
      path:"/add-category",
      name: "addCategory",
      component: addCategory,
      meta: {
         forAdminAndOperator:true
      }
      
      
   },
   {
      path:"/edit-category",
      name: "editCategory",
      component: editCategory,
      meta: {
         forAdminAndOperator:true
      }
      
      
   },
   
   {
      path:"/users-list",
      name: "usersList",
      component: usersList,
      meta: {
         forAdmin:true
      }
   },

   {
      path:"/add-user",
      name: "adduser",
      component: addUser,
      meta: {
         forAdmin:true
      }
   },

   {
      path:"/edit-user",
      name: "editUser",
      component: editUser,
      meta: {
         forAdmin:true
      }
   },

   {
      path: "*",
      component : notFound
   }

   

];


const router = new VueRouter({
   routes:routes,

});



router.beforeEach((to,from,next)=>{
   if(to.matched.some(record=>record.meta.forVisitors)){
       if(store.getters.isAuthenticated){
           next({
               path: '/'
           })
       }else next()
   }else if(to.matched.some(record=>record.meta.forAuth)) {
       if (!store.getters.isAuthenticated) {
           next({
               path: '/'
           })
       } else next()
   
   }else if(to.matched.some(record=>record.meta.forAdmin)) {
       if (!store.getters.isAdmin) {
           next({
               path: '/'
           })
       } else next()
   }else if(to.matched.some(record=>record.meta.forAdminAndOperator)) {
        if (!(store.getters.isOperator||store.getters.isAdmin)) {
            next({
                path: '/'
            })
        } else next()
    }else next()
});


const app = new Vue({
   router,
   store,
   el: '#app',
});