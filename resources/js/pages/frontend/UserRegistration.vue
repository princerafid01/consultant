<template>
    <div class="sign-area ">
    <div class="container flex flex-col lg:flex-row overflow-x-hidden"  >
        <div class="w-full md:w-2/3 mx-auto lg:w-1/2   " >
            <div class="  flex flex-col w-10/12 border mx-auto px-10 pb-6 " style="background:#fff;" >
                <img src="/public/frontend/img/interface/logo.png" alt="1" class="h-40 w-40 object-contain mx-auto">
                <h2 class="login100-form-title uppercase font-medium my-4 mb-8 text-primary" >User Registration</h2>
                <ul class="mt-2"  v-if="errors">
                    <li class="alert alert-danger" v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
                <div class="form-area-full bg-transparent">
                    <div class="input-line my-3 mb-4 flex w-full items-center">
                        <input class="form-control" placeholder="Username" type="text" v-model="user.name" required>
                        <i class="fa fa-user  -ml-8"></i>
                    </div>
                    <div class="input-line my-3 mb-4 flex w-full items-center">
                        <input class="form-control" placeholder="Enter Email" type="email" v-model="user.email" required>
                        <i class="fa fa-envelope -ml-8"></i>
                    </div>
                    <div class="input-line my-3 mb-4 flex w-full items-center">
                        <input class="form-control" placeholder="Enter Password" type="password" v-model="user.password">
                        <i class="fa fa-key -ml-8"></i>
                    </div>
                    <div class="input-line my-3 mb-4 flex w-full items-center">
                        <input class="form-control" placeholder="Confirm Password" type="password" v-model="user.password_confirmation">
                        <i class="fa fa-key -ml-8"></i>
                    </div>
                    <div class="input-check flex w-full items-center my-4">
                        <input type="checkbox" v-model="user.checkbox">
                        <p class="mx-2   px-2 py-2 mt-3">Accept <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></p>
                    </div>
                    <a class="btn btn-form login100-form-btn w-full py-3 bg-primary flex-none px-4 rounded shadow uppercase" href="#"  @click.prevent="register" :disabled="!user.checkbox">Sign Up</a>


                    <!-- <h4 class="text-center text-muted pt-3">or signup with</h4> -->
                        <!-- <div class="flex-c-m">
                            <a href="" class="login100-social-item bg2" @click.prevent="AuthProvider('linkedin')">
                                <i class="fa fa-linkedin"></i>
                            </a>

                            <a href="" class="login100-social-item bg3" @click.prevent="AuthProvider('google')">
                                <i class="fa fa-google"></i>
                            </a>

                        </div> -->
                </div>
            </div>
        </div>
        <!-- <div class="col-md-2 col-sm-12 bg-primary">
             <div class="p-t-80 text-center mt-5">
                 <h1 class="display-1 pt-5 mt-5">or</h1>
            </div>
        </div> -->

                <div class="w-full md:w-2/3 mx-auto lg:w-1/2 " >
             <div class="  flex flex-col border  w-10/12 mx-auto px-10 pb-2" style="background:#fff;">
                <img src="/public/frontend/img/interface/logo.png" alt="1" class="h-40 w-40 object-contain mx-auto">
                <!-- <h2 class="login100-form-title uppercase font-medium my-4 mb-8 text-primary" >User Login</h2> -->
                    <form class="login100-form validate-form  flex flex-col space-y-2 md:w-10/12 mx-auto px-10 pb-6">
                        <div class="wrap-input100 validate-input m-b-23" data-validate = "email is required">
                            <span class="label-input100">Email</span>
                            <input class="input100" type="text" v-model="loginData.email" placeholder="Enter email">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <span class="label-input100">Password</span>
                            <input class="input100" type="password" v-model="loginData.password" placeholder="Enter password">
                            <span class="focus-input100"></span>
                        </div>
                        <template v-if="error">
                        <span class="alert alert-danger mt-2" >{{ error }}</span>
                        </template>

                        <div class="text-right p-t-20 p-b-30">
                            <a href="#" @click.prevent="showModal">
                                Forgot password?
                            </a>
                            <modal name="forgetPassword">
                                <div class="p-4 mt-5">
                                    <input type="email" v-model="resetEmail" placeholder="Enter your email" class="form-control" required>
                                    <span class="alert alert-danger" v-if="resetError">{{resetError}}</span>
                                    <span class="alert alert-success" v-if="resetSuccess">{{ resetSuccess }} . Please check your mail.</span>
                                    <button class="btn btn-info pull-left ml-3 mb-5" @click.prevent="hideModal">Close</button>
                                    <button class="btn btn-info pull-right mr-3 mb-5" @click.prevent="resetPassword">Reset Password</button>
                                </div>
                            </modal>
                        </div>

                        <div class="container-login100-form-btn m-b-20">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn" style="text-transform: capitalize;" @click.prevent="login">
                                    Login
                                </button>
                            </div>
                        </div>
                        <h4 class="text-center text-muted">or login with</h4>

                        <div class="flex-c-m">
                            <!-- <a href="#" class="login100-social-item bg1">
                                <i class="fa fa-facebook"></i>
                            </a> -->

                            <a href="" class="login100-social-item bg2" @click.prevent="AuthProvider('linkedin')">
                                <i class="fa fa-linkedin"></i>
                            </a>

                            <a href="" class="login100-social-item bg3" @click.prevent="AuthProvider('google')">
                                <i class="fa fa-google"></i>
                            </a>
                        </div>
                    </form>
            </div>
        </div>




    </div>
</div>
</template>

<script>
import nProgress from 'nprogress'
import EventService from '../../services/EventService';

    export default {
        props: {
            user_name: {
                type: String,
            },
        },
        data(){
            return {
                user: {
                    name: '',
                    username: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    checkbox:''
                },
                loginData: {
                    user: '',
                    password: '',
                },
                errors: null,
                error: null,
                resetEmail: null,
                resetError: null,
                resetSuccess: null,
            }
        },
        methods: {
            showModal() {
                this.$modal.show('forgetPassword');
            },
            hideModal() {
                this.$modal.hide('forgetPassword');
            },
            resetPassword(){
                if(this.resetEmail != null){
                    this.resetError = null
                    this.resetSuccess = null
                    nProgress.start();


                    EventService.forgetPassword({
                        email: this.resetEmail,
                        role: 'user'
                    })
                    .then(({data}) => {


                        if(data.status == 400){
                            this.resetError = data.message
                        } else {
                            this.resetSuccess = data.message
                        }
                        nProgress.done();

                    });
                }
            },
            register(){
                if(this.user.checkbox){
                    nProgress.start();

                this.$store.dispatch('userRegister',this.user)
                    .then(() => {
                        nProgress.done();
                        if(this.user_name) {
                            this.$router.push({name: 'geek-show', params: {username: this.user_name}});
                        } else {
                            this.$router.push({name: 'account'});
                        }
                    }).catch((error) => {
                        nProgress.done();
                        if (error.response.status == 422){
                            let errors = error.response.data.errors;
                            this.errors = Object.values(errors).flat();
                            console.log(this.errors)
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
                nProgress.start();
                this.$http.post('/api/sociallogin/'+provider+'/user',response).then(({data}) => {
                    nProgress.done();
                    this.$store.dispatch('socialLogin',data)
                    if(this.user_name) {
                        this.$router.push({name: 'geek-show', params: {username: this.user_name}});
                    } else {
                        this.$router.push({name: 'account'});
                    }
                }).catch(err => {
                    nProgress.done();
                    console.log({err:err})
                    this.user.password = ""
					this.error = err.response.data.error
                })
            },
            login(){
                this.error=null
                nProgress.start();
				this.$store.dispatch('userLogin', this.loginData)
				.then(() => {
                        nProgress.done();
                        if(this.user_name) {
                            this.$router.push({name: 'geek-show', params: {username: this.user_name}});
                        } else {
                            this.$router.push({name: 'account'});
                        }
                    }).catch((error) => {
                        nProgress.done();

						console.log(error)
                        this.loginData.password = ""
						this.error = error.response.data.error
                    });
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

.wrap-login100 {width : auto;}
.container-login100 {min-height: auto;}
.sign-area {
    width: 100%;
    float: left;
    display: block;
    padding: 110px 0 50px 0;
}
.sign-box {
    padding: 30px;
    height: 600px;
}
button.btn.btn-info {
    background: #3B5998;
    border: none;
    font-size: 20px;
    padding: 7px 31px;
    margin-top: 15px;
}
@media screen and (max-width: 992px) {
	.sign-box {
		height:auto!important;
	}
}
@media screen and (max-width: 564px) {
	.sign-box {
		padding: 5px !important;
	}
    .sign-area {
        padding-top:10px;
    }
}
</style>