<template>
<!-- Contact Section-->
            <section class="page-section" id="add-user">
                <div class="container">
                    <h2 class="page-section-heading text-center text-secondary mb-0">Adicionar Utilizador</h2>
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
                                        <input class="form-control" id="name" type="text" placeholder="Nome" v-model.trim="$v.user.name.$model" />
                                        <div v-if="$v.user.name.$error">
                                            <div class="help-block text-danger" v-if="!$v.user.name.required">Este campo é obrigatório.</div>
                                            <div class="help-block text-danger" v-if="!$v.user.name.minLength">O nome tem de ter pelo menos {{$v.user.name.$params.minLength.min}} caracteres.</div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Endereço de email</label>
                                        <input class="form-control" id="email" type="email" placeholder="Endereço de email"  v-model="$v.user.email.$model"/>
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
                                        <label>Password</label>
                                        <input class="form-control" id="password" type="password" placeholder="Password" required="required" data-validation-required-message="Please enter your email address." v-model="$v.user.password.$model"/>
                                        <div v-if="$v.user.password.$error">
                                            <div class="help-block text-danger" v-if="!$v.user.password.required">Este campo é obrigatório.</div>
                                            <div class="help-block text-danger" v-if="!$v.user.password.minLength">A palavra passe tem de ter pelo menos {{$v.user.password.$params.minLength.min}} caracteres.</div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="form-group controls mb-0 pb-2">
                                        <label>Password Confirmation</label>
                                        <input class="form-control" id="password-confirmation" type="password" placeholder="Password Confirmation" required="required" data-validation-required-message="Please enter your email address." v-model="$v.user.password_confirmation.$model"/>
                                        <div v-if="$v.user.password_confirmation.$error">
                                            <div class="help-block text-danger" v-if="!$v.user.password_confirmation.sameAsPassword">As palavras passe têm ser as mesmas.</div>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div id="success"></div>
                                <div class="form-group"><button type="button" class="btn btn-warning" @click.prevent="registerUser">Criar</button>
                                <button type="button" class="btn btn-warning" @click.prevent="cancel">Cancelar</button></div>
                                <div class="help-block text-danger" v-if="submitStatus==='ERROR'">Preencha os campos em falta.</div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
</template>

<script type="text/javascript">
import { email, required, minLength, sameAs } from 'vuelidate/lib/validators'
    export default {
        name : 'Login',
        data() {
            return {
                user:{
                    name:"",
                    email: "",
                    type: "",
                    password: "",
                    password_confirmation: ""
                },
                submitStatus: null

            }
        },
        validations: {
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

                password: {
                    required,
                    minLength: minLength(3)
                },
                password_confirmation: {
                    sameAsPassword: sameAs('password')
                }
            }
        },
        methods:{
            registerUser(){
                this.$v.$touch()
                console.log('submit!')
                this.$v.$touch()
                if (this.$v.$invalid) {
                    this.submitStatus = 'ERROR'
                } else {
                    axios.post('/api/auth/signup',this.user)
                    .then(response=>{
                        console.log(response);
                        this.$toasted.show("O utilizador " + "'" + this.user.name +  "'" + " foi criado com sucesso!");
                        setTimeout(() => {
                                    this.$router.push("/users-list");
                                }, 1000); 
                        
                        })
                        .catch(error=>{
                                console.log(error);
                        })
                        this.submitStatus = 'PENDING'
                        setTimeout(() => {
                            this.submitStatus = 'OK'
                        }, 500)
                }
            },
            cancel(){
                this.$router.push("/users-list");
            }
    },
     
    }
</script>
<style scoped>
#add-user{
    margin-top: 50px;
}
</style>