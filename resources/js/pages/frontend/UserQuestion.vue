<template>
    <section class="marginer-top" v-if="loggedIn && isUser">
        <div class="container">
            <div class="col-md-12">
                <h1 class="pb-4">Questions and Answers</h1>
                <tabs :options="{ useUrlFragment: false }">
                    <tab name="Unanswered Question" class="w-100">
                        <template v-for="(question , index) in userQuestions">
                            <div class="card mt-5" v-if="!question.is_answered"  :key="index">
                                <div class="card-body">
                                    <button class="btn  bg-red text-white pull-right " style="font-size:17px" @click="deleteMessage(question.id)">Delete</button>
                                    <div class="top-area pb-3">
                                        <router-link :to="{ name: 'geek-show', params: { username: geeks.find(geek => geek.id === Number(question.geek_id)).username }}">
                                            <div class="pro-img online pull-left mr-5">
                                                <img :src="geeks.find(geek => geek.id === Number(question.geek_id)).avatar" v-if="geeks.find(geek => geek.id ===Number( question.geek_id)).avatar && geeks.find(geek => geek.id ===Number( question.geek_id)).avatar.includes('http')" alt="">
                                                <img  :src="geeks.find(geek => geek.id === Number(question.geek_id)).avatar ? `${$imagePath}${geeks.find(geek => geek.id === Number(question.geek_id)).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                            </div>
                                            <div class="text-box">
                                                <h1>{{ geeks.find(geek => geek.id === Number(question.geek_id)).name }}</h1>
                                            </div>
                                        </router-link>
                                    </div>
                                    <h5 class="card-title">Q: {{ question.question }}</h5>
                                    <h5 class="card-title text-gray-600">A: {{ question.answer }}</h5>
                                </div>
                            </div>
                        </template>
                    </tab>
                    <tab name="Answered Question" class="w-100">
                        <template v-for="(question , index) in userQuestions">
                            <div class="card mt-5" v-if="question.is_answered"  :key="index">
                                <div class="card-body">
                                    <button class="btn  bg-red text-white pull-right " style="font-size:17px" @click="deleteMessage(question.id)">Delete</button>
                                    <div class="top-area pb-3">
                                        <router-link :to="{ name: 'geek-show', params: { username: geeks.find(geek => geek.id === Number(question.geek_id)).username }}" style="font-size:17px">
                                            <div class="pro-img online pull-left mr-5">
                                                <img :src="geeks.find(geek => geek.id === Number(question.geek_id)).avatar" v-if="geeks.find(geek => geek.id ===Number( question.geek_id)).avatar && geeks.find(geek => geek.id ===Number( question.geek_id)).avatar.includes('http')" alt="">
                                                <img  :src="geeks.find(geek => geek.id === Number(question.geek_id)).avatar ? `${$imagePath}${geeks.find(geek => geek.id === Number(question.geek_id)).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                            </div>
                                            <div class="text-box ">
                                                <h1 class="text-lg text-primary">{{ geeks.find(geek => geek.id === Number(question.geek_id)).name }}</h1>
                                            </div>
                                        </router-link>
                                    </div>
                                    <h5 class="card-title font-bold mb-2">Q: {{ question.question }}</h5>
                                    <h5 class="card-title text-gray-600 text-base mb-2">A: {{ question.answer }}</h5>
                                </div>
                            </div>
                        </template>
                    </tab>
                </tabs>


            </div>
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex'
import {Tabs, Tab} from 'vue-tabs-component';
import 'vue-tabs-component/docs/resources/tabs-component.css';
import nProgress from 'nprogress'
import swal from 'sweetalert'


    export default {
        computed: {
            ...mapGetters(['userQuestions','isUser','loggedIn','users','geeks'])
        },
        data() {
            return {
                selectedQuesId: null
            }
        },
        methods: {
            getGeekByID(id){
                return this.geeks.filter(geek => geek.id === id)
            },
            deleteMessage(id){
                this.selectedQuesId = id

                swal({
                    title: "Are you sure to delete this message?",
                    text: "Once deleted, you will not be able to recover this message!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        nProgress.start()
                        this.$store.dispatch('deleteQuestion',this.selectedQuesId)
                        .then(({data}) => {
                            // this.geekQuestions = this.geekQuestions.filter(ques =>  ques.id !== data.id)
                            nProgress.done()
                            swal("Success! Your Message has been deleted!", {
                                icon: "success",
                            });
                        }).catch((err) => {
                            nProgress.done()
                            swal("Success! Your Message has been deleted!", {
                                icon: "success",
                            });
                        });

                    } else {
                        swal("Your message is safe!");
                    }
                });

            }
        },

        components: {
            Tabs, Tab
        },
    }
</script>

<style lang="scss" scoped>
.marginer-top {
    margin-top: 100px;
    margin-bottom: 100px;
}
.card .card-title {
    font-size: 18px;
}
textarea , textarea:focus{
    border: 1px solid #ddd!important;
}
textarea.form-control {
    height: 160px !important;
    font-size: 16px;
}
.card .btn.btn-primary {
    font-size: 18px;
}
.card .btn.btn-primary:hover ,
.card .btn.btn-primary {
    background-color: #455CC7;
    border-color: #455CC7;
}
.online img {
    max-width: 100px;
    height: 100px;
}
.avatar-350 {
  height:27rem !important;
  width:27rem !important;
}
</style>