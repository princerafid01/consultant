<template>
    <div class="container marginer py-4" v-if="loggedIn">
        <div class="row  block mt-48 lg:mt-0">
            <div class="col-md-12" style="background:aliceblue">
                <h1 class="pb-5">Notifications (<a href="" @click.prevent="markReadAll">Mark all as read</a>)</h1>
                <template v-if="currentUser.notifications.length > 0">

                    <h3 v-for="(notification , index) in currentUser.notifications" :key="index" class="my-3" :class="`my-3 ${ Boolean(Number(notification.is_read)) ? '' : 'font-weight-bold'}`">
                    <button class="btn  bg-red text-white" style="font-size:17px" @click="deleteNotification(notification.id)"><i class="fa fa-close"></i></button>

                        ( {{ moment(notification.created_at).format('MMMM Do YYYY, h:mm:ss a')  }} )  You have a new notification on {{ notification.notification_page }} page. Go to <a href="" @click.prevent="goto(notification.notification_page,notification.id)">{{ notification.notification_page }} page. </a></h3>
                </template>
                <template v-else>
                    <div class="alert alert-info">No new notification</div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import moment from 'moment'
import nProgress from 'nprogress'
import EventService from '../../services/EventService'



    export default {
        computed: {
            ...mapGetters(['loggedIn','currentUser','isUser','isGeek'])
        },
        data() {
            return {
                moment: moment,
                selectedNotificationId : null
            }
        },
        methods: {
            goto(pageName,id) {
                nProgress.start()

                EventService.markRead(id).then(({data}) => {

                    const userToken = JSON.parse(localStorage.getItem('user_token'));

                    const userData = EventService.me(userToken).then(({data}) => {
                        EventService.setToken(userToken)
                        this.$store.dispatch('dataOnRefresh',data)
                        nProgress.done()


                        if(pageName.toLowerCase().includes('question')){
                            if(this.isGeek){
                                this.$router.push({name:'geekQuestions'});
                            } else if(this.isUser){
                                this.$router.push({name:'userQuestions'});
                            }
                        } else if(pageName.toLowerCase().includes('earning')){
                            this.$router.push({name:'earnings'});
                        }else if(pageName.toLowerCase().includes('booking')){
                            if(this.isUser){
                                this.$router.push({name:'account'});
                            } else if(this.isGeek){
                                this.$router.push({name:'bookings'});
                            }
                        } else if(pageName.toLowerCase().includes('profile')){
                            if(this.isGeek){
                                this.$router.push({name:'profile'});
                            }
                        }
                    })
                })

            },
            markReadAll(){
                nProgress.start()

                EventService.markReadAll().then(({data}) => {
                    this.currentUser.notifications = data
                    nProgress.done()

                });

            },
            deleteNotification(id){
                this.selectedNotificationId = id

                swal({
                    title: "Are you sure to delete this notification?",
                    text: "Once deleted, you will not be able to recover this notification!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        nProgress.start()
                        this.$store.dispatch('deleteNotification',this.selectedNotificationId)
                        .then(({data}) => {
                            nProgress.done()
                            swal("Success! Your Notification has been deleted!", {
                                icon: "success",
                            });
                        }).catch((err) => {
                            nProgress.done()
                            swal("Success! Your Notification has been deleted!", {
                                icon: "success",
                            });
                        });

                    } else {
                        swal("Your message is safe!");
                    }
                });
            }
        },
        created () {
            const userToken = JSON.parse(localStorage.getItem('user_token'));

            const userData = EventService.me(userToken).then(({data}) => {
                EventService.setToken(userToken)
                this.$store.dispatch('dataOnRefresh',data)
            });
        },
    }
</script>

<style lang="scss" scoped>
.marginer{
    margin-top: 130px;
    min-height: 100vh;
}
a {
    color: rgb(116, 114, 114);
    font-size: 16px;
}

.font-weight-bold {
font-weight: 700;
color: #000;
font-size: 18px;
background: #f9f5f5;
margin-bottom: 5px;
padding: 1rem;
}
</style>