<template>
<!-- Contact Section-->
            <section class="page-section" id="add-user">
                <div class="container">
                    <h2 class="page-section-heading text-center text-secondary mb-0">Adicionar Produto</h2>
                    <!-- Icon Divider-->
                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-seedling"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <!-- Contact Section Form-->
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                            <form id="contactForm" name="sentMessage" novalidate="novalidate">
                                <div class="control-group">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Nome</label>
                                        <input class="form-control" id="name" type="text" placeholder="Nome" v-model="$v.product.name.$model" />
                                        <div v-if="$v.product.name.$error">
                                            <div class="help-block text-danger" v-if="!$v.product.name.required">Este campo é obrigatório.</div>
                                            <div class="help-block text-danger" v-if="!$v.product.name.minLength">O nome tem de ter pelo menos {{$v.product.name.$params.minLength.min}} caracteres.</div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Descrição</label>
                                            <textarea class="form-control" aria-label="With textarea" v-model="$v.product.description.$model"></textarea>
                                            <div v-if="$v.product.description.$error">
                                                <div class="help-block text-danger" v-if="!$v.product.description.required">Este campo é obrigatório.</div>
                                                <div class="help-block text-danger" v-if="!$v.product.description.minLength">O nome tem de ter pelo menos {{$v.product.description.$params.minLength.min}} caracteres.</div> 
                                            </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Selecionar Categoria</label>
                                        <select class="form-control" id="categoryId" name="categoryId" placeholder="Categoria" v-model="$v.product.category_id.$model">
                                            <option v-for="category in this.categories"  v-bind:value="category.id" >{{category.name}}</option>
                                        </select>                                        
                                        <div v-if="$v.product.category_id.$error">
                                            <div class="help-block text-danger" v-if="!$v.product.category_id.required">Este campo é obrigatório.</div>
                                        </div>

                                        
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label>Fotografia do Produto</label>
                                    <div class="form-group controls mb-0 pb-2">
                                        <input class="form-data" id="foto" accept="image/*" type="file" placeholder="Fotografia"  @change="onFileSelected"/>
                                    </div>
                                    <div class="help-block text-danger" v-if="showError">Este campo é obrigatório.</div>
                                </div>

                                

                                <br />
                                <div id="success"></div>
                                <div class="form-group"><button type="button" class="btn btn-warning" @click.prevent="addProduct">Criar</button>
                                <button type="button" class="btn btn-warning" @click.prevent="cancel">Cancelar</button></div>
                                <div class="help-block text-danger" v-if="submitStatus==='ERROR'">Preencha os campos em falta.</div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
</template>

<script type="text/javascript">
import { required,minLength } from 'vuelidate/lib/validators'
    export default {
        name : 'Login',
        data() {
            return {
                categories:[],
                product:{
                    name:"",
                    description:"",
                    image: "",
                    category_id: "",
                },
                showError:"",
                submitStatus:null

            }
        },
        validations: {
            product:{
                name: {
                    required,
                    minLength:minLength(3)
                },
                description:{
                    required,
                    minLength:minLength(5)
                },
                category_id:{
                    required
                }

            }
        },
        methods:{
            onFileSelected(event){
                let fileReader = new FileReader();
                fileReader.readAsDataURL(event.target.files[0]);
                fileReader.onload=(event)=>{
                    this.product.image=event.target.result;
                }

            },
            addProduct(){
                if(this.product.image === ""){
                    this.showError=true;
                }
                this.$v.$touch()
                console.log('submit!')
                this.$v.$touch()
                if (this.$v.$invalid) {
                    this.submitStatus = 'ERROR'
                } else {
                    axios.post('/api/product',this.product)
                    .then(response=>{
                        console.log(response);
                        this.$toasted.show("O produto " + "'" + this.product.name +  "'" + " foi criado com sucesso!");
                        setTimeout(() => {
                                    this.$router.push("/products-list");
                                }, 1000); 
                        
                        })
                        .catch(error=>{
                                console.log(error);
                        })
                }
            },
            getCategories(){
                axios.get('/api/categories')
                .then(response=>{
                    console.log(response);
                    this.categories=response.data.data;
                })
                .catch(error=>{
                        console.log(error);
                })
            },
             cancel(){
                this.$router.push("/products-list");
            }
            
    },
    mounted(){
        this.getCategories();
    }
    }
</script>
<style scoped>
#add-user{
    margin-top: 50px;
}
</style>