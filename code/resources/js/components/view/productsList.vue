
<template  >
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                    Tabela dos Produtos
                    <button type="button" class="btn btn-info" @click.prevent="addProduct"><b-icon-plus-circle-fill /></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Nome</th>
                                    <th>Foto</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody  v-for="product in products" :key="product.id" >
                                <td>{{ product.category_name }}</td>
                                <td>{{ product.name }}</td>
                                <td><img  v-bind:src="itemImageURL(product.image)" width="30" height="30" alt=""></td>
                                <td>{{product.description.length >= 25 ? product.description.substring(0,25)+"..." : product.description }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-danger" @click.prevent="deleteProduct(product.id, product.image, product.name)"><b-icon-trash/></button>
                                        <button type="button" class="btn btn-info" @click.prevent="editProduct(product.id)"> Editar </button>
                                    
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
            products:[],
            storagePath:"storage/",

 
        }      
    },

    methods:{
        
        getProducts(){
            axios.get('api/products')
            .then(response=>{
                console.log(response);
                this.products=response.data.data;
            }).catch(function(err){
            console.log(err);
            })
        },

        itemImageURL(photo){
            console.log(photo);
            return this.storagePath+ String(photo);            
        },

        deleteProduct(id,image,name){

            axios.delete('api/product/' + id, { data: {"image":image}}).then(response=>{
                console.log(response);
                this.getProducts();
                this.$toasted.show("O produto " + "'" + name +  "'" + " foi apagado com sucesso!");
            }).catch(function(err){
                console.log(err);
            })
            
        },
        addProduct(){
            this.$router.push('add-product');
        },
        editProduct(id){
            localStorage.setItem('id-product-edit', JSON.stringify(id));
            this.$router.push('edit-product');
        },

        

    },
     mounted(){
         this.getProducts();
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








