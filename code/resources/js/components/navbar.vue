<template>

    <nav class="navbar navbar-expand-lg bg-nav text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" @click="goHome()" href="#app">Frutos do Oeste</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1" ><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" @click="goHome()" href="#produtos">Produtos</a></li>
                        <li class="nav-item mx-0 mx-lg-1" ><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" @click="goHome()" href="#empresa" >Empresa</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" @click="goHome()" href="#contactos">Contactos</a></li>
                        <li v-if="isAuthenticated" class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" @click.prevent="menu()" href="">Admin</a></li>
                        <li v-if="isAuthenticated" class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" @click.prevent="logout()" href="">Logout</a></li>
                        
                    </ul>
                </div>
            </div>
    </nav>
    

</template>
<script>

// Quando é efetuado o scroll , a mainNav é diminuida
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("mainNav").style.padding = "10px 10px";
  } else {
    document.getElementById("mainNav").style.padding = "24px 10px";
  }
}

export default {
    data() {
        return {
            current_component: null,
            show: true,
            home:"home",
            isProductList:false,
            
        }
     },
    methods:{
        goHome(){
            
            this.current_component=this.$route.name;
            if (this.current_component != this.home){
                this.$router.push('/');
            }
        },
        logout(){
            
            axios.get('api/auth/logout')
                    .then(response => {
                        console.log(response);
                        this.$toasted.show("A sua sessão foi terminada com sucesso!");
                        this.$store.commit('clearUserAndToken');
                        if (this.$route.name != this.home){
                            
                            this.$router.push('/');
                            
                        }else{
                            return null;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        this.$store.commit('clearUserAndToken');
                    })
        },
        menu(){
            this.$router.push('menu-admin');
        },
  

    },
    

    computed:{
        isAuthenticated() {
                console.log(this.$store.getters.isAuthenticated);
                return this.$store.getters.isAuthenticated;
            },
        isAdmin() {
                console.log(this.$store.getters.isAdmin);
                return this.$store.getters.isAdmin;
            },
    },
    
}
</script>
<style>
@import '../../assets/css/styles.css';
.bg-nav {
    background-color: #2e2e2e;
}

.bg-frutos {
    background-color: #70706f;
}


</style>