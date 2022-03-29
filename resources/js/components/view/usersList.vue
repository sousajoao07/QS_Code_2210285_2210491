
<template  >
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                    Tabela de utilizadores
                    <button type="button" class="btn btn-info" @click.prevent="addUser"><b-icon-plus-circle-fill /></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    
                                    <th>Nome</th>
                                    <th>E-Mail</th>
                                    <th>Tipo de utilizador</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody  v-for="user in users" :key="user.id" >
                                
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.type == 'a' ? "Administrador" : "Operador"}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button v-if="isAuthUser(user)" type="button" class="btn btn-danger" disabled><b-icon-trash/></button>
                                        <button v-if="!isAuthUser(user)" type="button" class="btn btn-danger" @click.prevent="deleteUser(user.id, user.name)"><b-icon-trash/></button>
                                        <button type="button" class="btn btn-info" @click.prevent="editUser(user.id)"> Editar </button>
                                    
                                    </div>
                                </td>

                            </tbody>
                        </table>
                        </div>
                </div>
        </div>
    </div>
</template>


<script type="text/javascript">
export default {
    data() {
        return {
            users:[],
            filters:null,
            pagination:{},
            filters:'',
        }      
    },

    methods:{
        
        getUsers(){
            axios.get('api/users')
            .then(response=>{
                console.log(response);
                this.users=response.data.data;
            }).catch(function(err){
            console.log(err);
            })
        },

        addUser(){
            this.$router.push('/add-user');
        },

        deleteUser(id, name){
            axios.delete('api/user/' + id)
            .then(response => {
                console.log(response);
                this.getUsers();
                this.$toasted.show("O utilizador " + "'" + name +  "'" + " foi apagada com sucesso!");
            })
        },
        
        editUser(id){
            this.$router.push('/edit-user');
            localStorage.setItem('id-user-edit', JSON.stringify(id));
        },
        isAuthUser(user) {
            return user.email === this.$store.state.user.email ? true : false
        },

    },
    mounted(){
         this.getUsers();
    },
    
   
}
</script>
<style  scoped >
.card{
    margin-top: 120px;
}

.card-header{
    display: flex; 
    justify-content: space-between;
}
</style>









