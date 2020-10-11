<template>
    <section class="profile-area" v-if="loggedIn && isUser">
    <div class="container">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="profile-img">
                <img :src="avatarImage">
                <!-- <h3>Online</h3> -->
            </div>
            <div class="short-info">
                <h1>{{ currentUser.name }}<br>
                <!-- <span><i class="fa fa-map-marker"></i>{{ currentUser.address }}</span> -->
                </h1>
                <a class="btn btn-min">${{ currentUser.hourly_rate }} / Minute</a>
            </div>
            <!-- <label class="btn btn-request text-white"> -->
                <router-link :to="{ name: 'geek-show', params: { username: currentUser.username }}" class="text-white btn btn-request text-white">
                    <i class="fa fa-arrow-left"></i>Back to profile
                </router-link>
            <!-- </label> -->
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="field-area">
                    <div class="head-line">
                        <h3><i class="fa fa-phone"></i> Provide Call Information </h3>

                    </div>
                    <!-- <div class="input-group">
                        <span class="input-group-addon">Message to {{ currentUser.name.split(" ")[0] }}
                        </span>
                        <textarea class="form-control" rows="4" id="comment" style="height:65px !important; width:100%;" placeholder="Please enter a reason for the call" spellcheck="false" v-model="BookingInfo.message"></textarea>
                    </div> -->
                    <br>
                    <div class="input-group mb-5">
                        <span class="input-group-addon">Set Estimated Length</span>
                        <select class="minimal " v-model="BookingInfo.charge">
                            <option :value="currentUser.hourly_rate * 10 ">10 minutes (${{ currentUser.hourly_rate * 10 }}.00)</option>
                            <option :value="currentUser.hourly_rate * 20">20 minutes (${{ currentUser.hourly_rate * 20 }}.00)</option>
                            <option :value="currentUser.hourly_rate * 30">30 minutes (${{ currentUser.hourly_rate * 30 }}.00)</option>
                            <option :value="currentUser.hourly_rate * 40">40 minutes (${{ currentUser.hourly_rate * 40 }}.00)</option>
                            <option :value="currentUser.hourly_rate * 50">50 minutes (${{ currentUser.hourly_rate * 50 }}.00)</option>
                            <option :value="currentUser.hourly_rate * 60">60 minutes (${{ currentUser.hourly_rate * 60 }}.00)</option>
                        </select>
                    </div>
                    <!-- <p>You will be charged $125.00 for the current scheduled call length. If the call goes over the scheduled time, you
                    will be charged the balance at a rate of $8.33/min. If the call goes less than the scheduled time, you will be
                    refunded the balance.</p> -->
                    <!-- <div class="input-group">
                        <span class="input-group-addon">Full Name*</span>
                        <input type="text" class="form-control" placeholder="John Doe">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Email Address*</span>
                        <input type="text" class="form-control" placeholder="johndoe@gmail.com">
                    </div> -->
                    <!-- <a class="mem" href="#">Already a Member?</a> -->
                    <div class="input-group">
                        <span class="input-group-addon">Cell Phone*</span>
                        <div class="intl-phone-input">
                            <div class="input-wrap">
                                <input class="phone-input" type="text" placeholder="(123) 456-78910" v-model="BookingInfo.phone">
                            </div>
                            <div class="hint-text"></div>
                        </div>
                    </div>
                    <p> Cell phone is only used for notifications.</p>
                        <!-- <a href="#">Learn more about how geeks works.</a>  -->
                </div>
                <div class="field-area">
                    <div class="head-line">
                        <h3><i class="fa fa-calendar"></i> Suggest Times When You’re Free to Talk </h3>
                    </div>
                    <div class="date-time mb-5">
                        <div class="col-md-8 col-sm-12 col-xs-12 no-padding">
                            <datepicker input-class="form-control left" placeholder="MM/DD/YYYY" v-model="BookingInfo.date" :disabledDates="disabledDates"></datepicker>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 no-padding">
                            <div class="tm-box">
                                <vue-timepicker input-class="form-control tm-form right" format="HH:mm A" v-model="BookingInfo.time"></vue-timepicker>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- <p>Please note that the times you choose will be 10 hours earlier for Adrian (EDT)</p> -->
                    <div class="input-group">
                        <span class="input-group-addon">Your Timezone</span>
                        <TimezonePicker v-model="BookingInfo.timezone"></TimezonePicker>
                    </div>
                </div>
                <div class="field-area">
                    <div class="col-md-8">
                        <p class="pull-left pt-5">By scheduling a call you agree with our <a href="#">Terms of Service.</a></p>
                        <span class="error-tip visible" v-if="err">Please Fill all the field</span>

                    </div>
                    <div class="col-md-4">
                          <a class="btn pull-right btn-booking w-100" @click.prevent="book">Book Now</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
import { mapGetters } from 'vuex'
import Datepicker from 'vuejs-datepicker';
import VueTimepicker from 'vue2-timepicker'
import TimezonePicker from '../../components/TimezonePicker.vue';

import 'vue2-timepicker/dist/VueTimepicker.css'


    export default {
        props: {
            username: {
                type: String
            },
        },
        components: {
            Datepicker,VueTimepicker,TimezonePicker
        },
        computed: {
            ...mapGetters(['isUser','loggedIn']),
            currentUser(){
                return this.$store.getters.getGeekByUsername(this.username)
            },
            avatarImage(){
                if( this.currentUser && this.currentUser.avatar){
                    if(this.currentUser.avatar.includes('http')){
                        return this.currentUser.avatar;
                    } else {
                        return `${this.$imagePath}${this.currentUser.avatar}`
                    }
                } else{
                    return '/public/frontend/img/interface/avatar.png';
                }
            }
        },
        watch: {
            currentUser(newValue, oldValue) {
                this.BookingInfo.name = newValue.name
                this.BookingInfo.id = newValue.id
                this.BookingInfo.hourly_rate = newValue.hourly_rate
                this.BookingInfo.image = this.avatarImage
            },

        },
        data() {
            return {
                BookingInfo: {
                    id: '',
                    name: '',
                    charge: '',
                    phone: '',
                    date: '',
                    time: '',
                    timezone: '',
                    hourly_rate: '',
                    image: null
                },
                err: false,
                disabledDates: {
                    to: new Date(Date.now() - 8640000)
                }
            }
        },
        methods: {
            book() {

                if(this.BookingInfo.charge && this.BookingInfo.phone && this.BookingInfo.time && this.BookingInfo.timezone && this.BookingInfo.date){

                localStorage.setItem('booking_username' , this.username)

                    this.$router.push(
                        {
                            name: 'payment',
                            params: {
                                BookingInfo : this.BookingInfo
                            }
                        });
                } else {
                    this.err = true
                }
            }
        },
        mounted() {
            this.BookingInfo.name = this.currentUser.name
            this.BookingInfo.id = this.currentUser.id
            this.BookingInfo.hourly_rate = this.currentUser.hourly_rate
            this.BookingInfo.image = this.avatarImage
        },
    }
</script>

<style scoped>
a.btn-booking {
    display: block;
    background: #455cc7;
    border: 1px solid #263b9d;
    color: #fff !important;
    text-transform: uppercase;
    font-size: 23px;
    font-weight: 900;
    letter-spacing: 0.4px;
    padding: 13px 6%!important;
    margin-top: 18px;
    transition: all 0.5s;
}
</style>


<style lang="scss">
.vdp-datepicker__calendar {
    font-size: 16px!important;
}
.field-area input.left {
    font-size: 16px!important;
}
.display-time.form-control.tm-form.right.is-empty {
    font-size: 20px;
}

.vue__time-picker {
    font-size: 2em;
}
.visible {
    visibility: visible;
    color: red;
}
#comment {
    font-size: 16px;
}
.field-area .intl-phone-input .phone-input:focus {
    border: 1px solid #d9d9d9 !important;
}

</style>