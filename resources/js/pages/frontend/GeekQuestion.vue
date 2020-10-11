<template>
    <section class="marginer-top" v-if="loggedIn && isGeek && users">
        <div class="container">
            <div class="col-md-12">
                <h1 class="pb-4">Questions and Answers</h1>
                <tabs :options="{ useUrlFragment: false }" >
                    <tab name="Unanswered Question" class="w-100">
                        <template v-for="(question , index) in geekQuestions">
                            <div class="card mt-5" v-if="!question.is_answered"  :key="index">
                                <div class="card-body">
                                    <button class="btn  bg-red text-white pull-right " style="font-size:17px" @click="deleteMessage(question.id)">Delete</button>
                                    <div class="top-area pb-3">
                                        <div class="pro-img online pull-left mr-5 mb-5">
                                            <img :src="users.find(user => user.id === Number(question.user_id)).avatar" v-if="users.find(user => user.id === Number(question.user_id)).avatar && users.find(user => user.id === Number(question.user_id)).avatar.includes('http')" alt="">
                                            <img  :src="users.find(user => user.id === Number(question.user_id)).avatar ? `${$imagePath}${users.find(user => user.id === Number(question.user_id)).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                        </div>
                                        <div class="text-box">
                                            <h1>{{ users.find(user => user.id === Number(question.user_id)).name }}</h1>
                                        </div>
                                    </div>
                                    <h5 class="card-title">Q: {{ question.question }}</h5>
                                    <h5 class="card-title text-gray-500">A: {{ question.answer }}</h5>
                                    <textarea class="form-control" v-model="question.answer" name="" id="" cols="30" rows="10">

                                    </textarea>
                                    <a href="#" class="btn btn-primary mt-4" @click.prevent="answerQuestion(question.id)">Answer</a>
                                </div>
                            </div>
                        </template>
                    </tab>
                    <tab name="Answered Question"  class="w-100">
                        <template v-for="(question , index) in geekQuestions">
                            <div class="card mt-5" v-if="question.is_answered"  :key="index">
                                <div class="card-body">
                                    <button class="btn  bg-red text-white pull-right " style="font-size:17px" @click="deleteMessage(question.id)">Delete</button>
                                    <div class="top-area pb-3">
                                        <div class="pro-img online pull-left mr-5">
                                            <img :src="users.find(user => user.id === Number(question.user_id)).avatar" v-if="users.find(user => user.id === Number(question.user_id)).avatar && users.find(user => user.id === Number(question.user_id)).avatar.includes('http')" alt="">
                                            <img  :src="users.find(user => user.id === Number(question.user_id)).avatar ? `${$imagePath}${users.find(user => user.id === Number(question.user_id)).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                        </div>
                                        <div class="text-box">
                                            <h1>{{ users.find(user => user.id === Number(question.user_id)).name }}</h1>
                                        </div>
                                    </div>
                                    <h5 class="card-title">Q: {{ question.question }}</h5>
                                    <h5 class="card-title text-gray-500">A: {{ question.answer }}</h5>
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
import swal from 'sweetalert'
import nProgress from 'nprogress'


    export default {
        computed: {
            ...mapGetters(['geekQuestions','isGeek','loggedIn','users'])
        },
        components: {
            Tabs, Tab
        },
        data() {
            return {
                selectedQuesId: null
            }
        },
        methods: {
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

            },
            answerQuestion(id){
                let question = this.geekQuestions.find(question => question.id === id);
                this.$store.dispatch('answerQuestion', question);
            }
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
</style>