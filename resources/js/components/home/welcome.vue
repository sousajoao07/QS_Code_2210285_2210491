<template>
    <body>
        <!-- Masthead-->
            <header class="masthead bg-frutos text-white text-center" id="page-top">
                <div class="container d-flex align-items-center flex-column" >
                    <!-- Masthead Avatar Image-->
                    <img class="masthead-avatar mb-5" src="../../../assets/images/unnamed.png"  alt="Logo" style="width:360px;height:200px;" />
                    <!-- Masthead Heading-->
                    <h1 class="masthead-heading mb-0">Bem Vindo!</h1>
                    <!-- Icon Divider-->
                    <div class="divider-custom divider-light">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-seedling"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <!-- Masthead Subheading-->
                    <p class="masthead-subheading font-weight-light mb-0">Produtos de excelência</p>
                </div>
            </header>
            <section class="page-section portfolio" id="produtos">
                <div class="container">
                    <!-- Portfolio Section Heading-->
                    <h2 class="page-section-heading text-center text-secondary mb-0">Categorias dos Produtos</h2>
                    <!-- Icon Divider-->
                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-seedling"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <!-- Lista de categorias-->
                    <div class="row justify-content-center">
                        <!-- Portfolio Item 1-->
                            <div class="col-md-6 col-lg-4 mb-5" v-for="category in categories" :key="category.id">
                                <div class="portfolio-item mx-auto" >
                                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                        <div class="portfolio-item-caption-content text-center text-white">{{category.name}}</div>
                                    </div>
                                    <img class="img-fluid"  v-bind:src="itemImageURL(!category.image == '' ? category.image : 'unknown.png')" alt="aperitivos" />
                                    <!-- <img class="img-fluid" src="./../../../../storage/aperitivos.png" alt="aperitivos" /> -->

                                </div>
                            </div>
                    </div>
                </div>
            </section>

            <!-- Seccao de sobre a empresa-->
            <section class="page-section bg-produtos text-black-50 mb-0" id="empresa">
                <div class="container" >
                    <!-- About Section Heading-->
                    <h2 class="page-section-heading text-center text-secondary">Sobre a Empresa</h2>
                    <!-- Icon Divider-->
                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-seedling"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <!-- About Section Content-->
                    <div >
                        <p class>Frutos do Oeste ė uma empresa de comércio e torrefação de frutos secos, fundada por Maria de Lurdes Santos, e em atividade há mais de 50 anos, localizando-se no distrito de Leiria.
                            </p>
                        <p class>Com o crescimento da empresa sentiu-se a necessidade de criar uma marca mais apelativa e contextualizada, dentro do nosso ramo de comércio, nascendo assim em Maio de 2013 a marca Frutos do Oeste.</p>
                        <p class>A nossa missão é prestar serviços de excelência a fim de desenvolver a percepção de satisfação em cada cliente, conseguindo superar as expectativas.</p>
                        <p class>Temos como visão o crescimento e expansão dos nossos produtos a nível nacional e internacional, para sermos reconhecidos como uma referência positiva por parte dos mercados que usufruem dos nossos serviços. Neste processo é sempre implementada a nossa marca para assim assumirmos um lugar de liderança.</p>
                        <p class>Estamos preparados para satisfazer as necessidades de todos os clientes, desde consumidor final a revendedores, oferecendo sempre uma solução inteligente e económica a quem procura os nossos produtos.</p>
                    </div>
                </div>
            </section>

             <!-- Contact Section-->
            <section class="page-section" id="contactos">
                <div class="container">
                    <!-- Contact Section Heading-->
                    <h2 class="page-section-heading text-center text-secondary mb-0">Contacte-nos</h2>
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
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label>Nome</label>
                                        <input class="form-control" id="name" type="text" placeholder="Nome"  v-model="$v.content.name.$model"/>
                                    </div>
                                    <div v-if="$v.content.name.$error">
                                            <div class="help-block text-danger" v-if="!$v.content.name.required">Este campo é obrigatório.</div>
                                            <div class="help-block text-danger" v-if="!$v.content.name.minLength">O nome tem de ter pelo menos {{$v.content.name.$params.minLength.min}} caracteres.</div> 
                                        </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label>Endereço de email</label>
                                        <input class="form-control" id="email" type="email" placeholder="Endereço de email" v-model="$v.content.sourceUser.$model"/>
                                        <div v-if="$v.content.sourceUser.$error">
                                            <div class="help-block text-danger" v-if="!$v.content.sourceUser.required">Este campo é obrigatório.</div>
                                            <div class="help-block text-danger" v-if="!$v.content.sourceUser.mail">O email nâo é válido. </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label>Número de telemóvel</label>
                                        <input class="form-control" id="phone" type="tel" placeholder="Número de telemóvel"  v-model="$v.content.phone.$model" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label>Mensagem (encomendas ou outros assuntos)</label>
                                        <textarea class="form-control" id="message" rows="5" placeholder="Mensagem (encomendas ou outros assuntos)" v-model="$v.content.msg.$model"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <br />
                                <div id="success"></div>
                                <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit" @click.prevent="sendEmail">Enviar</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Footer-->
            <footer class="footer text-center bg-contacts" >
                <div class="container">
                    <div class="row">
                        <!-- Footer Location-->
                        <div class="col-lg-4 mb-5 mb-lg-0">
                            <h4 class="text-uppercase mb-4">Localização</h4>
                            <p class="lead mb-0">
                                Travessa Pinheirinho, 2 A-do-Barbas                    
                            </p>                           
                            <a class="btn btn-outline-light btn-social mx-1" href="https://goo.gl/maps/gY2uZm32WhV8ox6G7"><i class="fab fa-fw fa-google"></i></a>
                        </div>
                        <!-- Footer Social Icons-->
                        <div class="col-lg-4 mb-5 mb-lg-0">
                            <h4 class="text-uppercase mb-4">Encontre-nos nas redes sociais</h4>
                            <a class="btn btn-outline-light btn-social mx-1" href="https://www.facebook.com/frutosoeste/"><i class="fab fa-fw fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social mx-1" href="https://www.instagram.com/frutos_do_oeste_/"><i class="fab fa-fw fa-instagram"></i></a>
                        </div>
                        <!-- Footer About Text-->
                        <div class="col-lg-4">
                            <h4 class="text-uppercase mb-4">Contacte-nos</h4>
                            <p class="lead mb-0">
                                Email: <a href="mailto: geral@frutosdooeste.com"> geral@frutosdooeste.com</a>
                                
                            </p>
                            <p class="lead mb-0">
                                Telefone: 244 777 456
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Copyright Section-->
            <div class="py-4 text-center text-black">
                <div class="container"><small>Copyright © Frutos do Oeste 2022</small></div>
            </div>
    </body>        
</template>
<script>
import { required,minLength, email, maxLength,numeric } from 'vuelidate/lib/validators'
export default {
    
    data(){
        return {
            categories: [],
            storagePath:"storage/",
            content:{
                name:"",
                sourceUser:"",
                phone:"",
                msg:"",
            }
        }
    },
    validations: {
            content:{
                name: {
                    required,
                    minLength:minLength(3)
                },
                sourceUser:{
                    required,
                    email,
                },
                phone:{
                    //TODO fazer match com um tamanho
                    numeric,
                    minLength: minLength(9),
                    maxLength: maxLength(9)
                },
                msg:{
                    required,
                    minLength:maxLength(500)
                }

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
            return this.storagePath+ photo;            
        },
        sendEmail(){
            axios.post('api/email', this.content).then(response => {
                console.log(response);
            });
        }
    
    },

    mounted(){
        this.getCategories();
    }

}
</script>
<style>
@import '../../../assets/css/styles.css';

.bg-contacts {
    background-color: #2e2e2e;
}
</style>
