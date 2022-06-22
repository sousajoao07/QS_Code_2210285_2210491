<template>
<!-- Menu Section-->
            <section class="page-section" id="menu-admin">
                <div class="container">
                    <!-- About Section Heading-->
                    <h2 class="page-section-heading text-center text-secondary">Menu Administradors</h2>
                    <!-- Icon Divider-->
                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-seedling"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>

                    <b-list-group>
                    <b-list-group-item v-if="isOperator" variant="danger">Utilizadores - Não tem permissões para aceder a esta opção.</b-list-group-item>
                    <b-list-group-item v-if="isAdmin" @click.prevent="users"  button>Utilizadores</b-list-group-item>
                    <b-list-group-item @click.prevent="categories"  button>Categorias</b-list-group-item>
                    <b-list-group-item @click.prevent="products" button>Produtos</b-list-group-item>
                    </b-list-group>

                    
                </div>
            </section>
</template>

<script type="text/javascript">
    export default {
        name : 'Login',
        data() {
            return {
            }
        },
        methods:{
            users(){
            this.$router.push('users-list');
            },
            categories(){
            this.$router.push('categories-list');
            },
            products(){
            this.$router.push('products-list');    
            },
            
        },
        computed:{
            isOperator() {
                    return this.$store.getters.isOperator;
                },
            isAdmin() {
                    return this.$store.getters.isAdmin;
                },
        },
    }
</script>
<style scoped>
#menu-admin{
    margin-top: 50px;
}
</style>