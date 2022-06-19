
<template  >
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                    Tabela das Categorias
                    <button type="button" class="btn btn-info" @click.prevent="addCategory"><b-icon-plus-circle-fill /></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    
                                    <th>Nome</th>
                                    <th>Foto</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody  v-for="category in categories" :key="category.id" >
                                
                                <td>{{ category.name }}</td>
                                <td><img  v-bind:src="itemImageURL(category.image)" width="30" height="30" alt=""></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-danger" @click.prevent="deleteCategory(category.id, category.image, category.name)"><b-icon-trash/></button>
                                        <button type="button" class="btn btn-info" @click.prevent="editCategory(category.id)"> Editar </button>
                                    
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
            categories:[],
            storagePath:"storage/",

 
        }      
    },

    methods:{
        
        getCategories(){
            axios.get('api/categories')
            .then(response=>{
                console.log(response);
                this.categories=response.data.data;
            }).catch(function(err){
            console.log(err);
            })
        },

        itemImageURL(photo){
            console.log(photo);
            return this.storagePath+ String(photo);            
        },

        deleteCategory(id,image,name){

            axios.delete('api/category/' + id, { data: {"image":image}}).then(response=>{
                console.log(response);
                this.getCategories();
                this.$toasted.show("A categoria " + "'" + name +  "'" + " foi apagada com sucesso!");
            }).catch(function(err){
                console.log(err);
            })
            
        },
        addCategory(){
            this.$router.push('add-category');
        },
        editCategory(id){
            localStorage.setItem('id-category-edit', JSON.stringify(id));
            this.$router.push('edit-category');
        },

        

    },
     mounted(){
         this.getCategories();
     }
   
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









