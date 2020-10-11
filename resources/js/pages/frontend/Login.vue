<template>
    <div class="limiter">
		<div class="container-login100" >
			<div class=" w-full md:w-1/2 tablet:w-1/2 lg:w-1/3 lg:mt-32 px-10 py-8  rounded-xl" style="background: #fff;">
				<form class="login100-form validate-form border-none" style="border-color: #4960CE">

					<!-- <img style="display: block;
  margin-left: auto;
  margin-right: auto;
  " src="/public/frontend/img/logo1.png"> -->

					<span class="login100-form-title pt-28 pb-20 text-primary tracking-wide font-bold">
						Geek Login
					</span>

					<!-- <router-link class="HeaderButton w-100 mb-5 d-block text-center" :to="{name: 'user-registration'}" >Login as a User</router-link> -->



					<div class="wrap-input100 validate-input m-b-23" data-validate = "email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" v-model="user.email" placeholder="Enter email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" v-model="user.password" placeholder="Enter password">
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

					<div class="flex-col-c p-t-25">
						<span class="txt1 p-b-17">
							Don't have an account?
						</span>

						<router-link :to="{name: 'registration'}" class="txt2">
							Sign Up
						</router-link>

					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
import nProgress from 'nprogress'
import EventService from '../../services/EventService';
    export default {
		data(){
			return {
				user: {
					email: '',
					password: ''
				},
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
                        role: 'expert'
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
			login(){
				this.error=null
				this.$store.dispatch('login', this.user)
				.then(() => {
                        this.$router.push({name: 'profile'});
                    }).catch((error) => {
						nProgress.done()
						console.log(error)
						this.user.password = ""
						this.error = error.response.data.error
                    });
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
				nProgress.start()
                this.$http.post('/api/sociallogin/'+provider+'/expert',response).then(({data}) => {
					this.$store.dispatch('socialLogin',data)
					nProgress.done()
                    this.$router.push({name: 'profile'});
                }).catch(err => {
					nProgress.done()

					console.log({err:err})
					this.user.password = ""
					this.error = err.response.data.error
                })
			},
		}

    }
</script>

<style lang="scss" scoped>
.alert {display: block;font-size: 14px;}
.mt-2 {margin-top: 20px!important;}
</style>
<style  scoped>
.wrap-login100 {

    margin-top: 85px;

}
.container-login100{
    background: #F8F9FF!important;
}
.login100-form-title {
	padding-top: 50px;
}
button.btn.btn-info {
    background: #3B5998;
    border: none;
    font-size: 20px;
    padding: 7px 31px;
    margin-top: 15px;
}

.HeaderButton {
  background-color: #3a88ec !important;
  font-size: 15px !important;
  /* font-family: Poppins; */
  font-weight: 600 !important;
  color: #fff;
  padding: 12px 40px !important;
  border-radius: 100px !important;
  border: none !important;
}

.w-full.py-8.rounded-xl {
	border: 1px solid #d2d2d2!important;
}
</style>
