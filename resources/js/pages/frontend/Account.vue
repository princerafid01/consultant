<template>
    <section class="profile-area" v-if="loggedIn && isUser">

        <div class="container">
            <tabs :options="{ useUrlFragment: false }">
                <tab name="Pending Bookings" class="w-100">
                    <h1>Your pending bookings</h1>

                    <div class="geeks pt-5" v-if="userBookings">
                        <div class="row">
                            <template  v-for="(booking , index) in userBookings">
                                <div class="col-md-4 col-sm-6 col-xs-12" :key="index" v-if="booking.status === 'unapproved'">
                                    <div class="geek-box bookings">
                                        <router-link :to="{ name: 'geek-show', params: { username: getGeekByID(booking.geek_id).username }}" class="top-area pb-3">
                                            <div class="pro-img online">
                                                <img :src="getGeekByID(booking.geek_id).avatar" v-if="getGeekByID(booking.geek_id).avatar && getGeekByID(booking.geek_id).avatar.includes('http')" alt="">
                                                <img  :src="getGeekByID(booking.geek_id).avatar ? `${$imagePath}${getGeekByID(booking.geek_id).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                            </div>
                                            <div class="text-box">
                                                <h1>{{ getGeekByID(booking.geek_id).name }}</h1>
                                                <h3>{{ getGeekByID(booking.geek_id).title }}</h3>
                                            </div>
                                            <h5 class="rate">${{ getGeekByID(booking.geek_id).hourly_rate }}/minute</h5>
                                        </router-link >
                                        <div class="sec-area d-block">
                                            <h3>Your preferred schedule is on <strong class="pt-3">{{  new Date(booking.date).toLocaleDateString() }} at {{ booking.time }} on {{ booking.timezone }}</strong></h3>
                                            <h3 class="pt-3">You can talk <strong>{{booking.talk_time}} Minuite</strong></h3>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-if="userBookings.filter(book => book.status === 'unapproved').length === 0">
                                    <span class="nothing">No Pending Meetings!</span>
                            </template>
                        </div>
                    </div>
                </tab>

                <tab name="Upcoming Bookings" class="w-100">
                    <h1>Your Upcoming meetings</h1>

                    <div class="geeks pt-5" v-if="userBookings">
                        <div class="row">
                            <template  v-for="(booking , index) in userBookings">
                                <div class="col-md-4 col-sm-6 col-xs-12" :key="index" v-if="booking.status === 'approved'">
                                    <div class="geek-box bookings">
                                        <router-link :to="{ name: 'geek-show', params: { username: getGeekByID(booking.geek_id).username }}" class="top-area pb-3">
                                            <div class="pro-img online">
                                                <img :src="getGeekByID(booking.geek_id).avatar" v-if="getGeekByID(booking.geek_id).avatar && getGeekByID(booking.geek_id).avatar.includes('http')" alt="">
                                                <img  :src="getGeekByID(booking.geek_id).avatar ? `${$imagePath}${getGeekByID(booking.geek_id).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                            </div>
                                            <div class="text-box">
                                                <h1>{{ getGeekByID(booking.geek_id).name }}</h1>
                                                <h3>{{ getGeekByID(booking.geek_id).title }}</h3>
                                            </div>
                                            <h5 class="rate">${{ getGeekByID(booking.geek_id).hourly_rate }}/minute</h5>
                                        </router-link >
                                        <div class="sec-area d-block">
                                            <h3>Your preferred schedule is on <strong class="pt-3">{{  new Date(booking.date).toLocaleDateString() }} at {{ booking.time }} on {{ booking.timezone }}</strong></h3>
                                            <h3 class="pt-3">You can talk <strong>{{booking.talk_time}} Minuite</strong></h3>
                                            <template v-if="isToday(new Date(booking.date))">
                                                <a v-if="currentUser.user_meetings.find(meeting => meeting.booking_id == booking.id)" :href='`/bbb/join?meeting_id=${ currentUser.user_meetings.find(meeting => meeting.booking_id == booking.id).meetingId }&username=${currentUser.name}&booking_id=${booking.id}`' class="btn btn-success confirm-booking mt-4" onClick="location.reload()" target="_blank">Join Meeting</a>
                                                <div v-else class="refresher mt-3">
                                                    Please wait until geek joins the meeting  . You can refresh it to check if the geek joins or not. <a href="" @click.prevent="refresh"><i class="fa fa-refresh"></i></a>
                                                </div>
                                            </template>

                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-if="userBookings.filter(book => book.status === 'approved').length === 0">
                                <span  class="nothing">No Upcoming Meetings!</span>
                            </template>
                        </div>
                    </div>
                </tab>

                <tab name="Finished Bookings" class="w-100">
                    <h1>Your Finished meetings</h1>

                    <div class="geeks pt-5" v-if="userBookings">
                        <div class="row">
                            <template  v-for="(booking , index) in userBookings">
                                <div class="col-md-4 col-sm-6 col-xs-12" :key="index" v-if="booking.status === 'finished'">
                                    <div class="geek-box bookings">
                                        <router-link :to="{ name: 'geek-show', params: { username: getGeekByID(booking.geek_id).username }}" class="top-area pb-3">
                                            <div class="pro-img online">
                                                <img :src="getGeekByID(booking.geek_id).avatar" v-if="getGeekByID(booking.geek_id).avatar && getGeekByID(booking.geek_id).avatar.includes('http')" alt="">
                                                <img  :src="getGeekByID(booking.geek_id).avatar ? `${$imagePath}${getGeekByID(booking.geek_id).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                            </div>
                                            <div class="text-box">
                                                <h1>{{ getGeekByID(booking.geek_id).name }}</h1>
                                                <h3>{{ getGeekByID(booking.geek_id).title }}</h3>
                                            </div>
                                            <h5 class="rate">${{ getGeekByID(booking.geek_id).hourly_rate }}/minute</h5>
                                        </router-link >
                                        <div class="sec-area d-block">
                                            <h3>Your schedule was on <strong class="pt-3">{{  new Date(booking.date).toLocaleDateString() }} at {{ booking.time }} on {{ booking.timezone }}</strong></h3>
                                            <h3 class="pt-3">You have talked <strong>{{booking.talk_time}} Minuite</strong></h3>

                                            <a v-if="loggedIn && isUser"  @click.prevent="showModal(currentUser.user_meetings.find(meeting => meeting.booking_id == booking.id).meetingId)"  class="btn btn-success confirm-booking mt-4 ml-0 d-block text-white">Request Meeting Recodings</a>

                                            <a v-if="loggedIn && isUser && !booking.review_id"  @click.prevent="showModalReview(getGeekByID(booking.geek_id),booking)"  class="btn btn-success confirm-booking mt-4 text-white pull-left w-100 ml-0">Give a Review</a>
                                            <span v-else class="alert alert-success pull-left mt-3 w-100 text-center" style="font-size:16px">Review Given</span>

                                            <a v-if="loggedIn && isUser && !refundsBookingId.includes(booking.id)"  @click.prevent="showModalRefund(getGeekByID(booking.geek_id),booking)"  class="btn btn-success confirm-booking mt-4 text-white pull-left w-100 ml-0">Request a Refund</a>

                                            <a v-if="loggedIn && isUser && refundsBookingId.includes(booking.id) && getRefundByBookingID(booking.id).status === 'accepted'"  @click.prevent class="btn bg-success confirm-booking mt-4 text-white pull-left w-100 ml-0">Refund Accepted.</a>

                                            <a v-if="loggedIn && isUser && refundsBookingId.includes(booking.id) &&  getRefundByBookingID(booking.id).status === 'rejected'"  @click.prevent class="btn bg-red confirm-booking mt-4 text-white pull-left w-100 ml-0">Refund Rejected.</a>

                                            <a v-if="loggedIn && isUser && refundsBookingId.includes(booking.id) &&  getRefundByBookingID(booking.id).status === 'pending'"  @click.prevent class="btn btn-success confirm-booking mt-4 text-white pull-left w-100 ml-0">Refund Request Pending...</a>


                                        </div>
                                    </div>
                                </div>
                            </template>
                            <modal name="recordings">
                                <div class="p-5">
                                    <button class="pull-right closeModal" @click="hideModal"><i class="fa fa-close"></i></button>

                                    <h1 class="mb-4">Your call recordings</h1>
                                    <template v-if="modalData.data && modalData.data.published">
                                        <a  :href="modalData.data.download" class="btn btn-success confirm-booking mr-4 mt-4 text-white" target="_blank">Download</a>
                                        <a class="btn btn-success confirm-booking mt-4 text-white" :href="modalData.data.stream" target="_blank">Stream</a>
                                    </template>
                                    <template v-else>
                                        <h4>Your call recodings is not ready. Please try again after some time</h4>
                                    </template>
                                </div>
                            </modal>

                            <modal name="refund">
                                <div class="p-5">
                                    <button class="pull-right closeModal" @click="hideModalRefund"><i class="fa fa-close"></i></button>

                                    <h1 class="mb-4">Request a refund for booking number {{ this.refundBooking ?  `#${this.refundBooking.id}` : '' }} </h1>
                                    <textarea class="form-control mt-3" id="" cols="30" rows="10" v-model="refundText"></textarea>

                                    <button @click.prevent="hideModalRefund" class="btn btn-success confirm-booking mr-4 mt-4 text-white pull-left mb-5">Close</button>
                                    <button @click.prevent="submitRefund" class="btn btn-success confirm-booking mr-4 mt-4 text-white pull-right mb-5">Submit Request</button>
                                </div>
                            </modal>

                            <modal name="reviews">
                                <div class="p-5">
                                    <button class="pull-right closeModal" @click="hideModalReview"><i class="fa fa-close"></i></button>

                                    <h1 class="mb-4">Give a Rating to {{ reviewGeek ? reviewGeek.name : null }} for this call</h1>
                                    <star-rating v-model="review.star"></star-rating>
                                    <textarea class="form-control mt-3" id="" cols="30" rows="10" v-model="review.text"></textarea>

                                    <button @click.prevent="hideModalReview" class="btn btn-success confirm-booking mr-4 mt-4 text-white pull-left mb-5">Close</button>
                                    <button @click.prevent="submitReview" class="btn btn-success confirm-booking mr-4 mt-4 text-white pull-right mb-5">Submit</button>
                                </div>
                            </modal>
                            <template v-if="userBookings.filter(book => book.status === 'finished').length === 0">
                                <span  class="nothing">No Finished Meetings yet!</span>
                            </template>
                        </div>
                    </div>
                </tab>
            </tabs>
        </div>


        <div class="container">
            <h1>Your Favourite Geeks</h1>

            <div class="geeks pt-5" v-if="loggedIn && isUser">
                <div class="row">
                    <template  v-for="(geek , index) in geeks">
                        <div class="col-md-4 col-sm-6 col-xs-12" v-if="favouriteGeeks.includes(String(geek.id))" :key="index">
                            <div class="geek-box">
                                <router-link :to="{ name: 'geek-show', params: { username: geek.username }}" class="top-area">
                                    <div class="pro-img online">
                                        <img :src="geek.avatar" v-if="geek.avatar && geek.avatar.includes('http')"  alt="">
                                        <img  :src="geek.avatar ? `${$imagePath}${geek.avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                    </div>
                                    <div class="text-box">
                                        <h1>{{ geek.name }}</h1>
                                        <h3>{{ geek.title }}</h3>
                                    </div>
                                    <h5 class="rate">${{ geek.hourly_rate }}/minute</h5>
                                </router-link >
                                <div class="sec-area">
                                    <h5>9.7 Rating</h5>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                            <span class="sr-only">70% Complete</span>
                                        </div>
                                    </div>
                                    <a id="myDIV" v-if="loggedIn && isUser">
                                        <i type="btn" class="fa fa-heart fav"  :class="favouriteGeeks.includes(String(geek.id)) ? 'loved':''" @click.prevent="addToFavourite(geek.id)"></i>
                                    </a>
                                </div>
                                <p>{{ geek.bio ? geek.bio.substring(0,230)+ '...' : '' }}</p>
                                <ul class="options">
                                    <li v-for="(tag, index) in geek.tags" :key="index"><router-link :to="{name:'geeks' , params : {text : tag.name}}" class="btn btn-opt">{{ tag.name }}</router-link></li>
                                    <!-- <li><a href="#" class="btn btn-opt">+ 5 More</a></li> -->
                                </ul>
                                <ul class="main-btn">
                                    <li v-if="!loggedIn"><router-link :to="{name: 'user-registration'}"  class="btn btn-m-btn extra" >Book</router-link></li>


                                    <li v-if="loggedIn && isUser" class="w-100"><router-link :to="{name: 'booking', params: {username : geek.username}}"  class="btn btn-m-btn extra py-3  px-4 rounded-xl shadow-lg hover:bg-primary hover:text-white w-100" >Book</router-link></li>
                                    <li class="w-100"><router-link :to="{ name: 'geek-show', params: { username: geek.username }}" style="margin-left:10px; padding: 4px 35px!important;"  class="btn btn-m-btn py-3 px-4 rounded-xl shadow-lg mx-1 w-100">Profile</router-link></li>
                                </ul>
                            </div>
                        </div>
                    </template>
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="news-inner-1">
                            <div class="number-page">

                                <a href="#" @click.prevent="movePagination(page_number - 1)" v-if="page_number !== 1"><p><i class="fa fa-angle-left" aria-hidden="true"></i></p></a>

                                <template v-if="paginate_numbers !== 1">
                                    <a href="#" v-for="(n,index) in paginate_numbers" :key="index" @click.prevent="movePagination(n)" :class="(page_number === n) ? 'active' : ''" ><p>{{ n }}</p></a>
                                </template>

                                <a href="#" @click.prevent="movePagination(page_number + 1)" v-if="page_number !== paginate_numbers && allGeeks.length"><p><i class="fa fa-angle-right" aria-hidden="true"></i></p></a>

                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex'
import Swal from 'sweetalert2'
import swal from 'sweetalert'
import EventService from '../../services/EventService'
import nProgress from 'nprogress'
import StarRating from 'vue-star-rating'
import {Tabs, Tab} from 'vue-tabs-component';
import 'vue-tabs-component/docs/resources/tabs-component.css';

    export default {
        computed: {
            ...mapGetters(['favouriteGeeks','geeks','isUser','loggedIn','userBookings','currentUser','refundsBookingId','refunds']),
        },
        components: {
            StarRating,Tabs, Tab
        },
        methods: {
            addToFavourite(geekId){
                swal({
                    title: "Are you sure?",
                    text: "This Geek will be removed from your favourites list.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer:2000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            },
                            padding: '2rem'
                        })

                        this.$store.dispatch('addToFavourite',geekId).then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: `Removed from Favourites!`
                            })
                        })
                    }
                });

            },
            isToday(date){
                const today = new Date()
                return date.getDate() === today.getDate() &&
                    date.getMonth() === today.getMonth() &&
                    date.getFullYear() === today.getFullYear();
            },
            getGeekByID(id){
                return this.geeks.find(geek => geek.id === Number(id))
            },
            isMeetingReady(meetingId){
                EventService.isMeetingReady()
                .then(({data}) => {
                    console.log(data)
                });
            },
            refresh(){
                nProgress.start()
                const userToken = JSON.parse(localStorage.getItem('user_token'));
                    EventService.me(userToken).then(({data}) => {
                        this.$store.dispatch('dataOnRefresh',data)
                        nProgress.done();
                    })
            },
            getRefundByBookingID(id){
                return this.refunds.find(refund => refund.booking_id === Number(id))
            },
            showModal(id) {
                nProgress.start();
                EventService.getRecordings(id)
                .then(({data}) => {
                    console.log(data)
                    this.modalData.data = data
                    this.$modal.show('recordings');
                    nProgress.done();

                }).catch((err) => {

                });
            },
            hideModal() {
                this.modalData.data = null
                this.$modal.hide('recordings');
            },

            showModalReview(geek,booking) {
                this.$modal.show('reviews');
                this.reviewGeek = geek
                this.reviewBooking = booking
            },
            hideModalReview() {
                this.$modal.hide('reviews');
            },
            showModalRefund(geek,booking) {
                this.$modal.show('refund');
                this.refundGeek = geek
                this.refundBooking = booking
            },
            hideModalRefund() {
                this.$modal.hide('refund');
            },
            submitReview(){
                if(this.review.star != null && this.review.text != null){
                    nProgress.start();
                    EventService.submitReview({
                        'input': {
                        'geek_id' : this.reviewGeek.id,
                        'user_id' : this.currentUser.id,
                        'star' : this.review.star,
                        'text' : this.review.text,
                        },
                        'booking_id' : this.reviewBooking.id,
                    })
                    .then(({data}) => {
                        this.userBookings = this.userBookings.map((booking) => {
                            if(booking.id == data.id){
                                booking.review_id = data.review_id
                            }
                        });
                        nProgress.done();
                        this.$modal.hide('reviews');
                        swal("Good job!", "You have given a review. Thank you!", "success");
                        this.reviewGeek = null;
                        this.reviewBooking = null;
                        this.review.star =  null
                        this.review.text = null

                    }).catch((err) => {

                    });

                }
            },
            submitRefund(){
                if(this.refundText != null){
                    nProgress.start();
                    EventService.submitRefund({
                        'geek_id' : this.refundGeek.id,
                        'user_id' : this.currentUser.id,
                        'text' : this.refundText,
                        'booking_id' : this.refundBooking.id,
                        'booking' : this.refundBooking,
                        'status' : 'pending'
                    })
                    .then(({data}) => {
                        this.$store.state.refunds = data
                        nProgress.done();
                        this.$modal.hide('refund');
                        swal("Done!", "You have requested a refund. We will be notified shortly!", "success");
                        this.refundGeek = null;
                        this.refundBooking = null;
                        this.refundText = null;

                    }).catch((err) => {

                    });

                }
            }
        },
        data() {
            return {
                modalData: {
                    data : null
                },
                reviewGeek: null,
                reviewBooking: null,
                review: {star: null , text:null},
                refundGeek: null,
                refundBooking: null,
                refundText: null
            }
        }
    }
</script>

<style lang="scss" scoped>
.loved { color: red!important;}
.geeks .media-body h5 {
    font-size: 22px;
}
.geeks .media-body h6 {
    font-size: 17px;
    color: #FF217C;
    background: #FFEEF5;
}
.geeks .media-body span.title {
    font-size: 18px;
    color: #84888E;
}

.geeks .media img {
    border-radius: 10px;
}
.geek-box {min-height: 380px;}
h5{
    margin-top: 0!important;
    text-align: left;
}
.geek-box .main-btn li .btn-m-btn {
    padding: 4px 50px!important;
}
.profile-area .options {
    padding: 0!important;
}
.bookings {
    min-height: 200px;
}

.nothing {
    font-size: 20px;
    padding: 50px;
    padding-top: 0;
}
.refresher.mt-3 {
    font-size: 16px;
}
button.pull-right.closeModal {
    color: #222;
    font-size: 24px;
    background: transparent;
}
textarea.form-control {
    min-height: 100px;
}
.geek-box{
    background: #fff!important;
}
</style>
<style>
.vue-star-rating-rating-text {
    font-size: 30px!important;
}
.tabs-component-panels{
    display: flex!important;
}
.main-btn li {
    float: left;
}

.geek-box .main-btn li .btn-m-btn {
    margin-left: 0!important;
}
.tabs-component-panel {
    width: 100%!important;
}
</style>