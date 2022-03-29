<template>
<!-- Contact Section-->
            <section class="page-section" id="add-user">
                <div class="container">
                    <h2 class="page-section-heading text-center text-secondary mb-0">Editar Utilizador</h2>
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
                                        <input class="form-control" id="name" type="text" placeholder="Nome" required="required" v-model="$v.user.name.$model" />
                                        <div v-if="$v.user.name.$error">
                                            <div class="help-block text-danger" v-if="!$v.user.name.required">Este campo é obrigatório.</div>
                                            <div class="help-block text-danger" v-if="!$v.user.name.minLength">O nome tem de ter pelo menos {{$v.user.name.$params.minLength.min}} caracteres.</div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Endereço de email</label>
                                        <input class="form-control" id="email" type="email" placeholder="Endereço de email" required="required" v-model="$v.user.email.$model"/>
                                        <div v-if="$v.user.email.$error">
                                            <div class="help-block text-danger" v-if="!$v.user.email.required">Este campo é obrigatório.</div>
                                            <div class="help-block text-danger" v-if="!$v.user.email.email">O email não é válido.</div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="form-group  controls mb-0 pb-2">
                                        <label>Tipo de utilizador</label>
                                        <select class="form-control" id="userType" name="userType" placeholder="Tipo de uitilizador" data-validation-required-message="Please choose an option." v-model="$v.user.type.$model">
                                                <option value="a">Administrator</option>
                                                <option value="o">Operator</option>
                                        </select>                                        
                                        <div v-if="$v.user.type.$error">
                                            <div class="help-block text-danger" v-if="!$v.user.type.required">Este campo é obrigatório.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Mudar a palavra passe</label>
                                        <input type="checkbox" id="password-checkbox" v-model="change">
                                    </div>
                                </div>

                                 <div class="control-group" v-if="change===true">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Antiga Password</label>
                                        <input class="form-control" id="old-password" type="password" placeholder="Old Password" required="required" v-model="$v.user.old_password.$model"/>
                                        <div v-if="$v.user.old_password.$error">
                                            <div class="help-block text-danger" v-if="!$v.user.old_password.required">Este campo é obrigatório.</div>
                                            <div class="help-block text-danger" v-if="!$v.user.old_password.minLength">O nome tem de ter pelo menos {{$v.user.old_password.$params.minLength.min}} caracteres.</div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group" v-if="change===true">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Password</label>
                                        <input class="form-control" id="password" type="password" placeholder="Password" required="required" v-model="$v.user.password.$model"/>
                                        <div v-if="$v.user.password.$error">
                                            <div class="help-block text-danger" v-if="!$v.user.password.required">Este campo é obrigatório.</div>
                                            <div class="help-block text-danger" v-if="!$v.user.password.minLength">A palavra passe tem de ter pelo menos {{$v.user.password.$params.minLength.min}} caracteres.</div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group" v-if="change===true">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Confirmação da Password</label>
                                        <input class="form-control" id="password-confirmation" type="password" placeholder="Password Confirmation" required="required" v-model="$v.user.password_confirmation.$model"/>
                                        <div v-if="$v.user.password_confirmation.$error">
                                            <div class="help-block text-danger" v-if="!$v.user.password_confirmation.sameAsPassword">As palavras passe têm ser as mesmas.</div>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div id="success"></div>
                                <div class="form-group"><button type="button" class="btn btn-warning" @click.prevent="saveUser">Guardar</button>
                                <button type="button" class="btn btn-warning" @click.prevent="cancel">Cancelar</button></div>
                                <div class="help-block text-danger" v-if="submitStatus==='ERROR'">Preencha os campos em falta.</div>
                                <div class="help-block text-danger" v-if="showMessage">{{message}}</div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
</template>

<script type="text/javascript">
import { email, required, minLength, sameAs, requiredIf } from 'vuelidate/lib/validators'
    export default {
        name : 'Login',
        data() {
            return {
                message:"",
                showMessage: false,
                submitStatus: null,
                change:false,
                user_id: "",
                user:{
                    name:"",
                    email: "",
                    type:"",
                    password: "",
                    password_confirmation: "",
                    old_password:""
                    
                },
                user_without_pass:{
                    name:"",
                    email: "",
                    type:""
                }

            }
        },
        validations:{
          user:{
                name: {
                    required,
                    minLength: minLength(3),

                },

                email: {
                    required,
                    email,
                },

                type: {
                    required
                },

                old_password: {
                    required: requiredIf(function(change){
                    return this.change === true;
                    }),

                    minLength: minLength(3),
                },

                password: {
                    required: requiredIf(function(change){
                      return this.change === true;
                    }),

                    minLength: minLength(3)
                },

                password_confirmation: {
                    sameAsPassword: sameAs('password')
                }
             },

        },
        methods:{
            saveUser(){
                this.$v.$touch();
                if (this.$v.$invalid) {
                    this.submitStatus = 'ERROR';
                } else {
                    if(this.change === true){
                    axios.patch("api/user/" + this.user_id, this.user).then(response=>{
                        console.log(response);    
                        this.$toasted.show("O utilizador " + "'" + this.user.name +  "'" + " foi editado com sucesso!");
                        this.$router.push('/users-list');
                        }).catch(error=>{
                            console.log(error.response.data.error);
                            if(error.response.data.error){
                               this.showMessage = true;
                               this.messageType = "alert-danger"
                               this.message = 'A antiga password  não é a correta.'; 
                            }
                    })
                    }else{
                        this.user_without_pass.name=this.user.name;
                        this.user_without_pass.email=this.user.email;
                        this.user_without_pass.type=this.user.type;
                        axios.patch("api/withoutpass/user/" + this.user_id, this.user_without_pass).then(response=>{
                        console.log(response);
                        this.$toasted.show("O utilizador " + + "'" + this.user_without_pass.name +  "'" + " foi editado com sucesso!");    
                        this.$router.push('/users-list');
                        }).catch(error=>{
                            console.log(error.response);
                    })
                        
                    }
                    this.submitStatus = 'PENDING';
                    setTimeout(() => {
                        this.submitStatus = 'OK'
                    }, 500)
                }
            }, 
            getUser(id){
                axios.get("api/user/" + id)
                .then(response=>{
                    console.log(response);
                    this.user.name=response.data.data.name;
                    this.user.email=response.data.data.email;
                    this.user.type=response.data.data.type;

                })
                .catch(error=>{
                    console.log(error);
                })
            },
            cancel(){
                this.$router.push("/users-list");
            }     
        },
        mounted(){
                this.user_id=JSON.parse(localStorage.getItem('id-user-edit'));
                this.getUser(this.user_id);
        }
    }
</script>
<style scoped>
#add-user{
    margin-top: 50px;
}
</style>