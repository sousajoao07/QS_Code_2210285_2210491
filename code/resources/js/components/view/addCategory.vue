<template>
<!-- Contact Section-->
            <section class="page-section" id="add-user">
                <div class="container">
                    <h2 class="page-section-heading text-center text-secondary mb-0">Adicionar Categoria</h2>
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
                                        <input class="form-control" id="name" type="text" placeholder="Nome da categoria" v-model="$v.category.name.$model" />
                                        <div v-if="$v.category.name.$error">
                                            <div class="help-block text-danger" v-if="!$v.category.name.required">Este campo é obrigatório.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Fotografia da Categoria</label>
                                        <div>
                                        <input class="form-data" id="foto" accept="image/*" type="file" placeholder="Fotografia"  @change="onFileSelected"/>
                                        </div>
                                        <div class="help-block text-danger" v-if="showError">Este campo é obrigatório.</div>
                                    </div>
                                </div>

                                <br />
                                <div id="success"></div>
                                <div class="form-group"><button type="button" class="btn btn-warning" @click.prevent="addCategory">Criar</button>
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
                showError:false,
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
            addCategory(){
                if(this.category.image === ""){
                    this.showError=true;
                }
                this.$v.$touch()
                console.log('submit!')
                this.$v.$touch()
                if (this.$v.$invalid) {
                    this.submitStatus = 'ERROR'
                } else {
                    axios.post('/api/category',this.category)
                    .then(response=>{
                        console.log(response);
                        this.$toasted.show("A categoria " + "'" + this.category.name +  "'" + " foi criada com sucesso!");
                        setTimeout(() => {
                                    this.$router.push("/categories-list");
                                }, 1000); 
                        
                        })
                        .catch(error=>{
                                console.log(error);
                                
                        })
                    }
            },
            cancel(){
                this.$router.push("/categories-list");
            }
            
    },
    }
</script>
<style scoped>
#add-user{
    margin-top: 50px;
}
</style>