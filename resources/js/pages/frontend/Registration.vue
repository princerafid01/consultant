<template>
    <div class="sign-area">
    <div class="container mx-auto flex flex-col lg:flex-row">
        <div class="w-full lg:w-5/12 ">
            <div class="sign-box w-full">
                <div >
                <img src="/public/frontend/img/interface/logo.png" alt="1" class="object-contain" >
                </div>

                <!-- <router-link class=" bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 mt-5 text-center px-4 rounded text-2xl md:text-3xl block whitespace-no-wrap" style="text-transform: capitalize;" :to="{name: 'user-registration'}" >Click here for user registration </router-link> -->

                <h2 style="text-transform: capitalize;">Geek sign up with </h2>


                <ul>
                    <li><a href="" @click.prevent="AuthProvider('linkedin')"><i class="fa fa-linkedin 2x"></i>LINKEDIN</a></li>/
                    <li><a href="" @click.prevent="AuthProvider('google')"> <img src="/public/frontend/img/interface/google.png" alt="Google"> GOOGLE</a></li>
                </ul>
                <div class="line"><p>or</p></div>



                <ul class="mt-2"  v-if="errors">
                    <li class="alert alert-danger" v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
                <ul class="mt-2"  v-if="error">
                    <li class="alert alert-danger">{{ error }}</li>
                </ul>
                <div class="form-area-full">
                    <div class="input-line">
                        <input class="form-control" placeholder="Display Name" type="text" v-model="user.name" required>
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="input-line">
                        <input class="form-control" placeholder="Enter Username" type="text" v-model="user.username" required>
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="input-line">
                        <input class="form-control" placeholder="Enter Email" type="email" v-model="user.email" required>
                        <i class="fa fa-envelope"></i>
                    </div>
                    <!-- <div class="input-line">
                        <input class="form-control" placeholder="Enter Phone" type="text" v-model="user.phone" required>
                        <i class="fa fa-phone"></i>
                    </div> -->
                    <div class="input-line">
                        <input class="form-control" placeholder="Enter Password" type="password" v-model="user.password">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="input-line">
                        <input class="form-control" placeholder="Confirm Password" type="password" v-model="user.password_confirmation">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="input-check">
                        <input type="checkbox" v-model="user.checkbox">
                        <p>Accept <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></p>
                    </div>
                    <a class="btn btn-form" href="#" @click.prevent="register" :disabled="!user.checkbox">Sign Up</a>
                    <h5>Already have an account?<strong><router-link :to="{name: 'login'}" class="mx-3">Login Now</router-link></strong></h5>



                </div>
            </div>
        </div>
        <div class=" w-full  lg:w-7/12">
            <div class="img-box">
                <img src="/public/frontend/img/interface/sign-img.png">
            </div>
        </div>
    </div>
</div>
</template>

<script>
import nProgress from 'nprogress'

    export default {
        data(){
            return {
                user: {
                    name: '',
                    username: '',
                    phone: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    checkbox:''
                },
                errors: null,
                error: null,
            }
        },
        methods: {
            register(){
                if(this.user.checkbox){
                    nProgress.start()
                this.$store.dispatch('register',this.user)
                    .then(() => {
                        nProgress.done()
                        this.$router.push({name: 'profile'});
                    }).catch((error) => {
                        nProgress.done()
                        if (error.response.status == 422){
                            let errors = error.response.data.errors;
                            this.errors = Object.values(errors).flat();
                        }
                    });
                }
            },
            AuthProvider(provider) {
              var self = this
              this.$auth.authenticate(provider).then(response =>{
                self.SocialLogin(provider,response)
                }).catch(err => {
                    console.log({err:err})
                })
            },
            SocialLogin(provider,response){
                this.$http.post('/api/sociallogin/'+provider+'/expert',response).then(({data}) => {
                    this.$store.dispatch('socialLogin',data)
                    this.$router.push({name: 'profile'});
                }).catch(err => {
                    console.log({err:err})
                    this.user.password = ""
                    this.errors = null
                    this.error = err.response.data.error


                })
            },
        }
    }
</script>

<style  scoped>
.alert {display: block;font-size: 14px;}
.mt-2 {margin-top: 20px!important;}
i {
    font-size: 15px!important;
}
i.fa-linkedin {
    background:#0072b1;
    color:#fff;
    padding: 4px 8px;
    margin-right: 5px;
}

.img-box img {
    margin-top: 35%!important;
}


</style>