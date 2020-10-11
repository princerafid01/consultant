<template>
    <div v-if="loggedIn && isGeek">
        <div class="container marginer mt-5 pt-5">
            <div class="col-md-12 mt-5 pt-5">
                <tabs :options="{ useUrlFragment: false }">
                    <tab name="Requested Bookings" class="w-100">
                        <div class="geeks pt-5" v-if="geekBooked">
                            <!-- <h1>You are requested to have these appointment(s)</h1> -->
                            <div class="row pt-4">
                                <template  v-for="(booking , index) in geekBooked">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" :key="index" v-if="booking.status === 'unapproved'">
                                        <div class="geek-box bookings">
                                            <div class="top-area pb-3 my-2">
                                                <div class="pro-img online">
                                                    <img :src="getUserByID(booking.user_id).avatar" v-if="getUserByID(booking.user_id).avatar && getUserByID(booking.user_id).avatar.includes('http')" alt="">
                                                    <img  :src="getUserByID(booking.user_id).avatar ? `${$imagePath}${getUserByID(booking.user_id).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                                </div>
                                                <div class="text-box">
                                                    <h1>{{ getUserByID(booking.user_id).name }}</h1>
                                                    <h3>{{ getUserByID(booking.user_id).title }}</h3>
                                                </div>
                                            </div>
                                            <div class="sec-area d-block">
                                                <h3 class="pt-4">Email: {{ getUserByID(booking.user_id).email }}</h3>
                                                <h3 class="pb-4">Phone: {{ getUserByID(booking.user_id).phone }}</h3>
                                                <h3 class="text-gray-500">Client's preferred schedule is on <strong class="pt-3 text-info">{{  new Date(booking.date).toLocaleDateString() }} at {{ booking.time }} on {{ booking.timezone }}</strong></h3>
                                                <h3 class="pt-3 text-gray-500">Talk Time: <strong class="text-primary">{{booking.talk_time}} Minuite</strong></h3>


                                                <div class="col-md-3 col-sm-12 col-xs-12 mt-5 no-padding">
                                                    <datepicker input-class="form-control left w-100" placeholder="MM/DD/YYYY" v-model="booking.date"></datepicker>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12 mt-5 no-padding">
                                                    <div class="tm-box">
                                                        <vue-timepicker input-class="form-control tm-form right  w-100" format="HH:mm A" v-model="booking.time" class="w-100"></vue-timepicker>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12 mt-5">
                                                    <div class="input-group timezone">
                                                        <TimezonePicker v-model="booking.timezone" class="form-control tm-form right  w-100"></TimezonePicker>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12 mt-5 no-padding">
                                                    <div class="tm-box">
                                                        <button class="btn btn-success confirm-booking" @click.prevent="updateBooking(booking.id)">Confirm</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template v-if="geekBooked.filter(book => book.status === 'unapproved').length === 0">
                                    <span  class="nothing">No Meetings!</span>
                                </template>
                            </div>
                        </div>
                    </tab>

                    <tab name="Upcoming Bookings" class="w-100">
                        <div class="geeks pt-5" v-if="geekBooked">
                            <!-- <h1>Your upcoming meeting(s)</h1> -->
                            <div class="row pt-4">
                                <template  v-for="(booking , index) in geekBooked">
                                    <div class="col-md-6 col-sm-12 col-xs-12" :key="index" v-if="booking.status === 'approved'">
                                        <div class="geek-box bookings">
                                            <div class="top-area pb-3">
                                                <div class="pro-img online">
                                                    <img :src="getUserByID(booking.user_id).avatar" v-if="getUserByID(booking.user_id).avatar && getUserByID(booking.user_id).avatar.includes('http')" alt="">
                                                    <img  :src="getUserByID(booking.user_id).avatar ? `${$imagePath}${getUserByID(booking.user_id).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                                </div>
                                                <div class="text-box">
                                                    <h1>{{ getUserByID(booking.user_id).name }}</h1>
                                                    <h3>{{ getUserByID(booking.user_id).title }}</h3>
                                                </div>
                                            </div>
                                            <div class="sec-area d-block">
                                                <h3 class="pt-4">Email: {{ getUserByID(booking.user_id).email }}</h3>
                                                <h3 class="pb-4">Phone: {{ getUserByID(booking.user_id).phone }}</h3>
                                                <h3 class="text-gray-600">Client's preferred schedule is on <strong class="pt-3 text-primary">{{  new Date(booking.date).toLocaleDateString() }} at {{ booking.time }} on {{ booking.timezone }}</strong></h3>
                                                <h3 class="pt-3 my-2">Talk Time: <strong class="text-info">{{booking.talk_time}} Minuite</strong></h3>


                                                <div class="col-md-2 col-sm-12 col-xs-12 no-padding mt-4">
                                                    <div class="tm-box">
                                                        <a :href='`/bbb/start?talk_time=${booking.talk_time}&user_id=${booking.user_id}&geek_id=${currentUser.id}&booking_id=${booking.id}`' class="btn btn-success confirm-booking" onClick="location.reload()" target="_blank" v-if="isToday(new Date(booking.date))">Start Meeting</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template v-if="geekBooked.filter(book => book.status === 'approved').length === 0">
                                    <span  class="nothing">No Meetings!</span>
                                </template>
                            </div>
                        </div>
                    </tab>

                    <tab name="Finished Bookings">
                        <div class="geeks pt-5" v-if="geekBooked">
                            <!-- <h1>Your Finished meeting(s)</h1> -->
                            <div class="row pt-4">
                                <template  v-for="(booking , index) in geekBooked">
                                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" :key="index" v-if="booking.status === 'finished'">
                                        <div class="geek-box bookings">
                                            <div class="top-area pb-3">
                                                <div class="pro-img online">
                                                    <img :src="getUserByID(booking.user_id).avatar" v-if="getUserByID(booking.user_id).avatar && getUserByID(booking.user_id).avatar.includes('http')" alt="">
                                                    <img  :src="getUserByID(booking.user_id).avatar ? `${$imagePath}${getUserByID(booking.user_id).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                                </div>
                                                <div class="text-box">
                                                    <h1>{{ getUserByID(booking.user_id).name }}</h1>
                                                    <h3>{{ getUserByID(booking.user_id).title }}</h3>
                                                </div>
                                            </div>
                                            <div class="sec-area d-block my-1">
                                                <h3 class="pt-4">Email: {{ getUserByID(booking.user_id).email }}</h3>
                                                <h3 class="pb-4">Phone: {{ getUserByID(booking.user_id).phone }}</h3>
                                                <h3 class="text-gray-500">Client's preferred schedule was on <strong class="pt-3 text-primary">{{  new Date(booking.date).toLocaleDateString() }} at {{ booking.time }} on {{ booking.timezone }}</strong></h3>
                                                <h3 class="pt-3 text-gray-500">You have talked <strong class="text-info">{{booking.talk_time}} Minuite</strong></h3>

                                                <a v-if="loggedIn && isGeek"  @click.prevent="showModal(currentUser.geek_meetings.find(meeting => meeting.booking_id === booking.id).meetingId)"  class="btn btn-success confirm-booking w-100 ml-0 mt-4 text-white">Request Meeting Recodings</a>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <template v-if="geekBooked.filter(book => book.status === 'finished').length === 0">
                                    <span  class="nothing">No Meetings!</span>
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
                            </div>
                        </div>
                    </tab>
                </tabs>
            </div>

            <h1>Refund Request(s)</h1>
            <div class="col-md-12 mt-5 pt-5">
                <template  v-for="(booking , index) in geekBooked">
                    <div class="col-md-9 col-sm-12 col-xs-12" :key="index" v-if="booking.status === 'finished' && refundsBookingId.includes(String(booking.id)) && getRefundByBookingID(booking.id).status === 'pending'">
                        <div class="geek-box bookings">
                            <div class="top-area pb-3">
                                <div class="pro-img online">
                                    <img :src="getUserByID(booking.user_id).avatar" v-if="getUserByID(booking.user_id).avatar && getUserByID(booking.user_id).avatar.includes('http')" alt="">
                                    <img  :src="getUserByID(booking.user_id).avatar ? `${$imagePath}${getUserByID(booking.user_id).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                </div>
                                <div class="text-box">
                                    <h1>{{ getUserByID(booking.user_id).name }}</h1>
                                    <h3>{{ getUserByID(booking.user_id).title }}</h3>
                                </div>
                            </div>
                            <div class="sec-area d-block">
                                <h3 class="pt-4">Email: {{ getUserByID(booking.user_id).email }}</h3>
                                <h3 class="pb-4">Phone: {{ getUserByID(booking.user_id).phone }}</h3>
                                <h3>Client's preferred schedule is on <strong class="pt-3">{{  new Date(booking.date).toLocaleDateString() }} at {{ booking.time }} on {{ booking.timezone }}</strong></h3>
                                <h3 class="pt-3">Talk Time: <strong>{{booking.talk_time}} Minuite</strong></h3>
                                <h3 class="pt-3">User wants a refund on this meeting. Write a note then accept/reject it.</h3>
                                <h3 class="pt-3">Problem issued by user is: <strong>{{ getRefundByBookingID(booking.id).text.problem }}</strong></h3>


                                <div class="col-md-12 col-sm-12 col-xs-12 mt-5 no-padding">
                                    <div class="tm-box">
                                        <h3>Note: (*required)</h3>
                                        <textarea v-model="booking.replyText" id="" cols="30" rows="10" class="form-control mb-4"></textarea>
                                        <button class="btn btn-info bg-success confirm-booking" @click.prevent="confirmRefund(booking)">Confirm Refund</button>
                                        <button class="btn btn-warning bg-red pull-right confirm-booking" @click.prevent="rejectRefund(booking)">Reject Refund</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </template>
                <!-- <template v-if="refunds.map((refund) => refund.status !== 'pending')">
                    <span  class="nothing mb-5 pb-5 d-block">No Meetings!</span>
                </template> -->
            </div>

        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Datepicker from 'vuejs-datepicker'
import VueTimepicker from 'vue2-timepicker'
import TimezonePicker from '../../components/TimezonePicker.vue'
import EventService from '../../services/EventService.js';
import nProgress from 'nprogress'
import {Tabs, Tab} from 'vue-tabs-component';

import 'vue-tabs-component/docs/resources/tabs-component.css';
import 'vue2-timepicker/dist/VueTimepicker.css'
import Swal from 'sweetalert2'

    export default {
        computed: {
            ...mapGetters(['currentUser','loggedIn','isGeek','geekBooked','users','refundsBookingId','refunds']),
        },
        components: {
            Datepicker,VueTimepicker,TimezonePicker,Tabs, Tab
        },
        methods: {
            getUserByID(id){
                return this.users.find(user => user.id == id)
            },
            getRefundByBookingID(id){
                return this.refunds.find(refund => refund.booking_id == id)
            },
            updateBooking(id){
                let bookInfo = this.geekBooked.find(booked => booked.id == id);
                this.$store.dispatch('updateBooking', bookInfo);
            },
            showModal(id) {
                nProgress.start();
                EventService.getRecordings(id)
                .then(({data}) => {
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
            isToday(date){
                const today = new Date()
                return date.getDate() === today.getDate() &&
                    date.getMonth() === today.getMonth() &&
                    date.getFullYear() === today.getFullYear();
            },
            confirmRefund(booking){
                if(booking.replyText){
                    nProgress.start();
                    EventService.confirmRefund(booking)
                    .then(({data}) =>{
                        nProgress.done();
                        Swal.fire(
                            'Success!',
                            'You have refunded the money!',
                            'success'
                        )
                        this.$store.state.refunds = data
                    })
                }
            },
            rejectRefund(booking){
                if(booking.replyText){
                    nProgress.start();
                    EventService.rejectRefund(booking)
                    .then(({data}) =>{
                        nProgress.done();
                        Swal.fire(
                            'Done!',
                            'You have rejected refund!',
                            'success'
                        )
                        this.$store.state.refunds = data
                    })
                }
            }
        },
        data() {
            return {
                modalData: {
                    data : null
                },
                replyText: null
            }
        },
    }
</script>

<style lang="scss">
.form-control {
    height: 44px!important;
    font-size: 15px;
}
.timezone select{
    font-size: 15px!important;
}
.confirm-booking {
    color: #fff;
    background: #3245A2;
    font-size: 16px;
    border: none;
    padding: 11px 21px;
}
.options span {
    font-size: 16px;
    float: left;
    padding-top: 10px;
}
span.nothing {
    font-size: 20px;
    padding: 50px;
    padding-top: 0;
}
button.pull-right.closeModal {
    color: #222;
    font-size: 24px;
    background: transparent;
}
.marginer {
    margin-top: 100px;;
}

.tabs-component-panels{
    display: flex!important;
}

// @media screen and (max-width: 562px) {
//     .marginer {margin-top: 200px!important;}
// }
</style>

