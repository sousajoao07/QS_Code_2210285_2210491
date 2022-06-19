<template>
<!-- Contact Section-->
            <section class="page-section" id="add-user">
                <div class="container">
                    <h2 class="page-section-heading text-center text-secondary mb-0">Editar Categoria</h2>
                    <!-- Icon Divider-->
                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-seedling"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <!-- Contact Section Form-->
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <form id="contactForm" name="sentMessage" novalidate="novalidate">
                                <div class="control-group">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Nome</label>
                                        <input class="form-control" id="name" type="text" placeholder="Nome" v-model="$v.category.name.$model" />
                                        <div v-if="$v.category.name.$error">
                                            <div class="help-block text-danger" v-if="!$v.category.name.required">Este campo é obrigatório.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Fotografia da Categoria</label>
                                        <div>
                                        <input class="form-data" id="foto" accept="image/*" type="file" placeholder="Fotografia" @change="onFileSelected"/>
                                        </div>
                                    </div>
                                </div>

                                <br />
                                <div id="success"></div>
                                <div class="form-group"><button type="button" class="btn btn-warning" @click.prevent="editCategory">Guardar</button>
                                <button type="button" class="btn btn-warning" @click.prevent="cancel">Cancelar</button></div>
                                <div class="help-block text-danger" v-if="submitStatus==='ERROR'">Preencha os campos em falta.</div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
</template>

<script type="text/javascript">
import { required } from 'vuelidate/lib/validators'
    export default {
        name : 'Login',
        data() {
            return {
                category:{
                    name:"",
                    image: "",
                },
                category_id:"",
                submitStatus:null
            }
        },
        validations: {
            category:{
                name: {
                    required,
                },

            }
        },
        methods:{
            onFileSelected(event){
                let fileReader = new FileReader();
                fileReader.readAsDataURL(event.target.files[0]);
                fileReader.onload=(event)=>{
                    this.category.image=event.target.result;
                }

            },
            editCategory(){
                this.$v.$touch()
                console.log('submit!')
                this.$v.$touch()
                if (this.$v.$invalid) {
                    this.submitStatus = 'ERROR'
                } else {
                    axios.patch('/api/category/'+ this.category_id, this.category)
                    .then(response=>{
                        console.log(response);
                        this.$toasted.show("A categoria " + + "'" + this.category.name +  "'" + + " foi editada com sucesso!");
                        setTimeout(() => {
                                    this.$router.push("/categories-list");
                                }, 1000); 
                        
                        })
                        .catch(error=>{
                                console.log(error);
                        })
                }
            },

            getCategory(){
                axios.get('/api/category/'+ this.category_id)
                .then(response=>{
                    console.log(response);
                    this.category.name=response.data.data.name;
                    this.category.image=response.data.data.image;
                    

                })
                .catch(error=>{
                    console.log(error);
                })
            },
            cancel(){
                this.$router.push("/categories-list");
            }
            
            
    },

    mounted(){
        this.category_id=JSON.parse(localStorage.getItem('id-category-edit'));
        this.getCategory();
        
    }
    }
</script>
<style scoped>
#add-user{
    margin-top: 50px;
}
</style>