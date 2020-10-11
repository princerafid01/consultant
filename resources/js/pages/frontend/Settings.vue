<template>
    <section class="profile-area settings" v-if="loggedIn && isGeek">
    <div class="container">
    <h1>Settings</h1>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="profile-img">
                <img :src="avatarImage">
            </div>
            <label class="btn btn-request text-center text-white">
                Edit Profile Picture<input type="file" @change="onFileSelected" style="display: none;">
            </label>

        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <h2>General Profile <small>(Your profile will not be approved if you don't fill up all the required information)</small> </h2>
                <div class="tab-area">
                    <div class="tab">
                        <button class="tablinks active" onclick="openCity(event, 'London')"> General Profile</button>
                        <button class="tablinks" onclick="openCity(event, 'Paris')">Experties</button>
                        <button class="tablinks" onclick="openCity(event, 'Privacy')">Privacy</button>
                    </div>

                    <div id="London" class="tabcontent" style="display:block">
                        <p class="tab-head mt-5">Basic Info</p>
                        <BaseInput label="Name" v-model="user.name" type="text" placeholder="Enter you Name" />
                        <BaseInput label="Title" v-model="user.title" type="text" placeholder="Enter your title (eg: Freelance Business Analysis)" />
                        <BaseInput label="Email"  smallText="(not visible to users)" v-model="user.email" type="email" placeholder="Enter you Email" />
                        <BaseInput label="Phone" smallText="(not visible to users)" v-model="user.phone" type="text" placeholder="Enter you Phone" />
                        <BaseInput label="Home Address" smallText="(not visible to users)" v-model="user.address" type="text" placeholder="Enter you address" />

                        <p class="tab-head mt-5">About Me</p>
                        <div class="form-group mt-4">
                            <label>Biography ( You must enter minimum <strong>{{ Math.max(0 , bioMax - (user.bio ? user.bio.length : 0))  }}/500 letters</strong> )</label>
                            <textarea v-model="user.bio" placeholder="Write about yourself..." class="form-control p-4" cols="30" rows="10"></textarea>
                        </div>
                        <BaseInput smallText="(Optional)" label="Link YouTube Profile Video" v-model="user.video_profile" type="text" placeholder="Post your URL profile video in YouTube" />

                        <p class="tab-head mt-5">External Links</p>
                        <BaseInput smallText="(Optional)" label="Linkedin URL" v-model="user.linkedin_id" type="text" placeholder="Post your Linkedin profile link here" />
                        <!-- <BaseInput smallText="(Optional)" label="Twitter URL" v-model="user.twitter_id" type="text" placeholder="Post your Twitter profile link here" />
                        <BaseInput smallText="(Optional)" label="YouTube Channel URL" v-model="user.youtube_channel" type="text" placeholder="Post your YouTube Channel link here" /> -->
                        <BaseInput smallText="(Optional)" label="Instragram ID" v-model="user.instagram_id" type="text" placeholder="Enter your Instagram ID (eg: @jeremyrosee)D" />

                    </div>
                    <div id="Paris" class="tabcontent">
                         <p class="tab-head mt-5">Experties</p>

                         <!-- <BaseSelect label="What is the main service you offer?"  :options="services" v-model="user.main_service" className="form-control custom"/> -->



                    <div class="form-group mt-4">
                        <label>What is the main service you offer?</label>
                        <select   class="form-control custom" v-model="user.main_service">
                            <option v-for="(option,index) in services"
                            :value="option.name"
                            :key="index"
                            :selected="option.name === user.main_service"
                            >{{option.name}}</option>
                        </select>
                    </div>
                    <div class="form-group mt-4" v-if="user.main_service">
                        <label>Choose a subcategory</label>
                            <select  class="form-control custom pull-left" v-model="user.sub_cat">
                                <template v-for="option in services">
                                    <option
                                    :value="subCat"
                                    :key="index"
                                    :selected="subCat === user.sub_cat"
                                    v-for="(subCat ,index) in option[user.main_service]"
                                    >{{subCat}}</option>
                                </template>
                            </select> <i class="fa fa-close bg-red text-white fa-2x pul-left px-2 py-1" @click="user.sub_cat = null" v-if="user.sub_cat"></i>
                    </div>



                         <div>
                            <label class="typo__label">What skills do you offer clients?</label>
                            <multiselect v-model="user.tags" tag-placeholder="Add this as new skills" placeholder="Start typing to search for skills" label="name" track-by="id" :options="tags" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
                            <div class="pull-right pt-3 pb-3" v-if="user.tags">Enter up to {{ (5  - user.tags.length) < 0 ? 0:(5  - user.tags.length) }} more skills</div>
                        </div>
                        <br />
                        <br />
                        <br />


                    <!--  Add Post -->
                        <!-- <BaseButton className="btn-simple" class="pull-right mt-5" @click.prevent="showAddPost = true"> <i class="fa fa-plus-square rounded 2x pr-2"></i>Add Post</BaseButton>
                         <p class="tab-head mt-5">Experience</p>
                        <template v-if="showAddPost">
                            <BaseInput  label="Post Title" v-model="post.title" type="text" placeholder="Enter Post title" />
                            <template v-if="postErrors && postErrors.title">
                                <div class="alert alert-danger"  role="alert">
                                    <span v-for="err in postErrors.title" :key="err" class="rf-2"> {{err}}</span>
                                </div>
                            </template>
                            <BaseInput  label="Location" v-model="post.location" type="text" placeholder="Enter the location" />
                            <template v-if="postErrors && postErrors.location">
                                <div class="alert alert-danger"  role="alert">
                                    <span v-for="err in postErrors.location" :key="err" class="rf-2"> {{err}}</span>
                                </div>
                            </template>
                            <div class="form-group mt-4">
                                <label>Description</label>
                                <textarea v-model="post.desc" placeholder="Write the description..." class="form-control p-4" cols="30" rows="10"></textarea>
                                <template v-if="postErrors && postErrors.desc">
                                    <div class="alert alert-danger"  role="alert">
                                       <span v-for="err in postErrors.desc" :key="err" class="rf-2"> {{err}}</span>
                                    </div>
                                </template>
                            </div>
                            <label class="mt-4">Upload Images</label>
                            <div class="form-group ">
                                <label class="btn-file">
                                    Choose File<input type="file" @change="onPostImageSelected" style="display: none;">
                                </label>
                                <img :src="`${$imagePath}${post.image}`" :alt="post.title" width="200" height="100" v-if="post.image">
                                <template v-if="postErrors && postErrors.image">
                                    <div class="alert alert-danger"  role="alert">
                                       <span v-for="err in postErrors.image" :key="err" class="rf-2"> {{err}}</span>
                                    </div>
                                </template>
                            </div>

                            <BaseButton className="btn-base" class="pull-left mr-3 mt-4 mb-4" @click.prevent="onPostAdd">Save</BaseButton>
                            <BaseButton className="btn-simple" class="pull-left mt-4 mb-4" @click.prevent="showAddPost = false">Cancel</BaseButton>

                            <br>
                            <br>
                            <br>

                        </template>

                        <template v-if="user.posts && user.posts.length">
                            <p class="tab-head mt-5"></p>
                            <div class="media" v-for="post in user.posts" :key="post.id">
                                <div class="row">
                                    <div class="col-md-4 d-flex">
                                        <img class="rounded" :src="`${$imagePath}${post.image}`" :alt="post.title">
                                    </div>
                                    <div class="col-md-8 pl-0">
                                        <div class="media-body" >

                                            <h2 class="mt-0">{{ post.title }}</h2>

                                            <span class="mt-2 location">Created {{ post.created_at }} in <a href="" class="d-inline-block">{{ post.location}}</a></span>
                                            <p class="post-desc pr-5">{{ post.desc }}</p>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                        </template> -->

                    <!--  Add Certificate -->
                        <BaseButton className="btn-simple" class="pull-right mt-5" @click.prevent="showAddCertification = true"> <i class="fa fa-plus-square rounded 2x pr-2"></i>Add Certification</BaseButton>
                        <p class="tab-head mt-5">Certifications</p>
                        <template v-if="showAddCertification">
                            <BaseInput  label="Certification Title" v-model="certification.title" type="text" placeholder="Enter Certification title" /> (required)
                            <template v-if="certificationErrors && certificationErrors.title">
                                <div class="alert alert-danger"  role="alert">
                                    <span v-for="err in certificationErrors.title" :key="err" class="rf-2"> {{err}}</span>
                                </div>
                            </template>
                            <div class="form-group mt-4">
                                <label>Description (required)</label>
                                <textarea v-model="certification.description" placeholder="Write the description..." class="form-control p-4" cols="30" rows="10"></textarea>
                                <template v-if="certificationErrors && certificationErrors.description">
                                    <div class="alert alert-danger"  role="alert">
                                       <span v-for="err in certificationErrors.description" :key="err" class="rf-2"> {{err}}</span>
                                    </div>
                                </template>
                            </div>
                            <label class="mt-4">Upload Certification Image (required)</label>
                            <div class="form-group ">
                                <label class="btn-file">
                                    Choose File<input type="file" @change="onCertificationImageSelected" style="display: none;">
                                </label>
                                <img :src="`${$imagePath}${certification.image}`" :alt="certification.title" width="200" height="100" class="object-contain" v-if="certification.image">
                                <template v-if="certificationErrors && certificationErrors.image">
                                    <div class="alert alert-danger"  role="alert">
                                       <span v-for="err in certificationErrors.image" :key="err" class="rf-2"> {{err}}</span>
                                    </div>
                                </template>
                            </div>

                            <BaseButton className="btn-base" class="pull-left mr-3 mt-4 mb-4" @click.prevent="onCertificationAdd">Save</BaseButton>
                            <BaseButton className="btn-simple" class="pull-left mt-4 mb-4" @click.prevent="showAddCertification = false">Cancel</BaseButton>

                            <br>
                            <br>
                            <br>

                        </template>

                        <template v-if="user.certifications && user.certifications.length > 0">
                            <p class="tab-head mt-5"></p>
                            <div class="media" v-for="certification in user.certifications" :key="certification.id">
                                <div class="row">
                                    <div class="col-md-4 d-flex">
                                        <img class="rounded object-contain" :src="`${$imagePath}${certification.image}`" :alt="certification.title" >
                                    </div>
                                    <div class="col-md-8 pl-0">
                                        <div class="media-body">
                                            <h2 class="mt-0">{{ certification.title }}</h2>
                                            <p class="post-desc pr-5">{{ certification.description }}</p>
                                            <BaseButton className="btn-base btn btn-danger bg-red" class="pull-left mr-3 mt-4 mb-4 " @click.prevent="onCertificationDelete(certification.id)"><i class="fa fa-trash"></i></BaseButton>

                                        </div>
                                    </div>
                                    </div>
                            </div>
                        </template>

                    <p class="tab-head mt-5">Additional Information</p>
                    <div class="hourly pt-5">
                        <h2>Hourly Rate</h2>
                        <span class="pull-right p-3"> $ / minute </span>
                        <input type="text" class="pull-right text-right" placeholder="0.00" v-model="user.hourly_rate">
                        <p class="post-desc mt-4">Total amount the client will see</p>
                    </div>
                    <p class="tab-head"></p>


                    </div>
                    <div id="Privacy" class="tabcontent">
                        <p class="tab-head mt-5">Security</p>
                        <BaseInput  label="Current Password" v-model="password.current_password" type="password" :disabled="user.provider"/>
                        <BaseInput  label="New Password" v-model="password.new_password" type="password" :disabled="user.provider" />
                    </div>
                </div>
                    <BaseButton @click.prevent="settingsSave" className="btn-base m-4 d-inline-block rpx-5">Save</BaseButton>
                    <BaseButton className="btn-simple-border mt-4 d-inline-block rpx-5" @click="cancel">Cancel</BaseButton>

            </div>
        </div>
    </div>
</section>
</template>

<script>
import { mapGetters } from 'vuex'
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import EventService from '../../services/EventService.js'
import nProgress from 'nprogress'



    export default {
        computed: {
            ...mapGetters({
                user: 'currentUser',
                tags: 'tags',
                services: 'categories',
                loggedIn: 'loggedIn',
                isGeek: 'isGeek',
                }),
            avatarImage(){
            if( this.user && this.user.avatar){
                if(this.user.avatar.includes('http')){
                    return this.user.avatar;
                } else {
                        return `${this.$imagePath}${this.user.avatar}`
                }
                } else{
                    return '/public/frontend/img/interface/avatar.png';
                }
            }
        },
        components: { Multiselect },
        data(){
            return {
                bioMax: 500,
                post: {
                    title: null,
                    location: null,
                    desc: null,
                    image: null,
                    user_id: null
                },
                certification: {
                    title: null,
                    description: null,
                    image: null
                },
                postErrors: null,
                certificationErrors: null,
                password: {
                    current_password: null,
                    new_password: null,
                },
                showAddPost: false,
                showAddCertification: false,
            }
        },
        methods: {
            cancel(){
                this.$router.push({name:'profile'})
            },
            addTag (newTag) {
                const tag = {
                    name: newTag,
                    code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                }
                this.tags.push(tag)
                this.user.tags.push(tag)
            },
            onFileSelected(event){
                const fd = new FormData();
                fd.append('image',event.target.files[0],event.target.files[0].name)
                fd.append('folderName','avatars')
                fd.append('id',this.user.id)
                this.$store.dispatch('uploadAvatar',fd)
            },
            onPostImageSelected(event){
                const fd = new FormData();
                fd.append('image',event.target.files[0],event.target.files[0].name)
                fd.append('folderName','posts')
                nProgress.start()
                EventService.uploadImage(fd)
                    .then(({data}) => {
                        this.post.image = data
                        nProgress.done()
                    }).catch((err) => {
                        swal("Error!", "Uploading Image Failed!", "error");
                        nProgress.done()
                    });
            },
            onCertificationImageSelected(event){
                const fd = new FormData();
                fd.append('image',event.target.files[0],event.target.files[0].name)
                fd.append('folderName','certifications')
                nProgress.start()
                EventService.uploadImage(fd)
                    .then(({data}) => {
                        this.certification.image = data
                        nProgress.done()
                    }).catch((err) => {
                        swal("Error!", "Uploading Image Failed!", "error");
                        nProgress.done()
                    });
            },
            onPostAdd(){
                this.post.user_id = this.user.id
                nProgress.start()
                EventService.savePost(this.post)
                    .then((response) => {
                        this.$store.dispatch('addPost',response.data)
                        this.post.title = null;
                        this.post.location = null;
                        this.post.desc = null;
                        this.post.image = null;
                        this.showAddPost = false;
                        swal("Success!", 'Post added!', "success");
                        nProgress.done()
                    }).catch((err) => {
                        nProgress.done()
                        this.postErrors = err.response.data.errors;
                    });
            },
            onCertificationAdd(){
                nProgress.start()
                EventService.saveCertification(this.certification)
                    .then((response) => {
                        this.$store.dispatch('addCertification',response.data)
                        this.certification.title = null;
                        this.certification.description = null;
                        this.certification.image = null;
                        this.showAddCertification = false;
                        swal("Success!", 'Certification added!', "success");
                        nProgress.done()
                    }).catch((err) => {
                        nProgress.done()
                        this.certificationErrors = err.response.data.errors;
                    });
            },
            onCertificationDelete(id){
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.$store.dispatch('deleteCertificate',id)
                            .then(() => {
                                swal("Poof! Your certificate has been deleted!", {
                                    icon: "success",
                                });
                            });
                    } else {
                        swal("Your information is safe!");
                    }
                });

            },
            settingsSave(){
                // let notAllowed =  ['linkedin_id','instagram_id','youtube_channel','video_profile','twitter_id','provider','provider_id','email_verified_at' ,'is_approved','avatar'];

                let allowed = ['name' , 'email','title','phone','bio','address','main_service','hourly_rate']

                if(
                    !Object.keys(this.user).filter(key => allowed.includes(key)).reduce((r, k) => r.concat(this.user[k]), [])
                    .some(field => field === null || field === [])
                    &&
                    Object.entries(this.user).some(([key,value]) => key === 'tags' && value.length > 0)
                    &&
                    this.user.bio.length > this.bioMax
                    ){
                    this.$store.dispatch('settingsSave',{
                        user: this.user,
                        passwords: this.password
                    }).then(() => {
                        this.$router.push({name: 'profile'});
                        this.password.current_password = null
                        this.password.new_password = null
                    })
                } else {
                    swal("Error!", "Please fill all the Information in the Settings!", "error");
                }

            }
        },
        created(){
        }
    }
</script>

<style lang="scss" scoped>
.settings .tab-area {
    background: transparent;
    border: none;
}

.settings .tab-area button.tablinks {
    margin-right: 30px;
    border: none;
}

.settings .tab-area button.tablinks.active {
    color: #455CC7;
    border-color: #455CC7;
}
.settings .tab-area p.tab-head {
    color: #000;
    font-size: 18px;
    font-weight: bold;
}

label {
    font-size: 16px;
    color: #000;
}
textarea{
    border-radius: 5px;
    font-size: 15px;
    color: #000;
    border: 1px solid #A7ACC0;
}
textarea:focus {
    border: 1px solid #455CC7!important;
    box-shadow: none;
}
.pull-right{
    color: #868585!important;
    font-size: 15px;
}
.btn-file {
    background: #455CC7;
    color: #fff !important;
    padding: 8px 16px;
    border-radius: 5px;
    font-weight: 400;
    font-size: 15px;
}
.location{
    font-size: 14px;
    color: #9B9B9B;
}
.location a{
    font-size: 14px;
    color: #4ADBBD;
}

.d-flex img {
    max-height: 150px;
    width:100%;
}
p.post-desc {
    color: #848484;
    font-size: 14px;
    padding-right: 10px;
    border: none;
}
.hourly p{
    font-size: 16px;
}

.hourly input, .hourly input:focus {
    border: 1px solid #A7ACC0!important;
    padding: 10px;
    border-radius: 5px;
}

h1 {
    font-size: 42px;
    color: #868585;
    margin-left: 13px;
    padding-bottom: 30px;
}


.rf-2 {font-size: 15px;}

label {
    font-size: 16px;
    color: #000;
}
select {
    border-radius: 5px;
    font-size: 15px;
    color: #000;
    height: auto!important;
    padding: 12px !important;
}
select.custom {
    border: none;
    -webkit-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
    -moz-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
    box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
}
select:focus {
    border: 1px solid #455CC7!important;
    -webkit-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
    -moz-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
    box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
}

textarea {
    min-height: 180px;
}

</style>

<style>
.bg-red{
    background: #C82333!important;
}
.multiselect__tag {
    color: #868585!important;
    background: #EDEDED!important;
}
.multiselect__tag i {
    color: #868585!important;
}

</style>