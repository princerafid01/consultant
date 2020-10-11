<template>
    <div v-if="loggedIn && isGeek" class="earnings">
        <div class="container marginer">
            <div class="geeks pt-5 pb-4" v-if="geekBooked">
                <div class="row py-5 earnings-wrapper" v-if="loggedIn && isGeek">
                    <div class="col-md-4">
                        <div class="earnings-box text-center">
                            <h1>Total earnings  <br class="my-4" style="color:green">${{ earnings }}</h1>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="earnings-box text-center">
                            <h1>Total withdrawn amount <br class="my-4" style="color:green">${{ geekEarnings.withdraw_earnings }}</h1>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="earnings-box text-center">
                            <h1>Total remaining balance  <br class="my-4" style="color:green"> ${{ (earnings - geekEarnings.withdraw_earnings) ? (earnings - geekEarnings.withdraw_earnings) : earnings }}</h1>
                        </div>
                    </div>
                </div>
                <button @click="showModal" class="btn btn-success confirm-booking mt-4 d-block mx-auto" :disabled="(earnings - geekEarnings.withdraw_earnings) <= 0">Withdraw Earnings</button>

                <h1 class="mt-5">Your Finished meeting(s)</h1>

                <div class="row pt-4" v-if="loggedIn && isGeek">
                    <template  v-for="(booking , index) in geekBooked">
                        <div class="w-full md:w-2/5 lg:w-1/3" :key="index" v-if="booking.status == 'finished'">
                            <div class="geek-box bookings my-3" style="background:white !important">
                                <div class="top-area pb-3 mb-3">
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
                                    <h3 class="mb-4">Meetings was on <strong class="pt-3 text-gray-500">{{  new Date(booking.date).toLocaleDateString() }} at {{ booking.time }} on GMT {{ booking.timezone }}</strong></h3>
                                    <h3 class="pt-3">You have talked <strong class="text-info">{{booking.talk_time}} Minuite</strong> and earned <strong class="text-green-500 font-bold text-4xl">${{ booking.talk_time * booking.hourly_rate  }}</strong></h3>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-if="geekBooked.filter(book => book.status == 'finished').length == 0">
                        <span  class="alert alert-danger">No Meetings!</span>
                    </template>
                </div>

                </div>

                    <h1 class="py-4 text-center">Withdraw Timeline</h1>
                    <div class="col-md-12">
                        <table-component :data="withdrawRequests">
                            <table-column show="id" label="Request Id"></table-column>
                            <table-column show="amount" label="Withdraw Amount"></table-column>
                            <table-column show="bank" label="Bank"></table-column>
                            <table-column show="status" label="Withdraw Request Status"></table-column>
                            <!-- <table-column show="attachment" label="Attachment"></table-column> -->
                            <!-- <table-column label="Attachment" :sortable="false" :filterable="false">
                                <template slot-scope="row">
                                    <img :src="`${row}`">
                                </template>
                            </table-column> -->
                            <table-column show="attachment" label="Attachment" :formatter="formatter"></table-column>
                        </table-component>
                    </div>





                    <modal name="withdrawModal">
                        <div class="withdraw p-3">
                            <div class="row">
                                <div class="container">
                                    <div class="col-md-12">
                                        <button class="pull-right closeModal" @click="hideModal"><i class="fa fa-close"></i></button>

                                        <h3 class="pull-left pb-2">Withdraw Amount: </h3> <input type="number"  class="form-control pull-right" v-model="withdraw_amount">
                                        <h3 class="pull-left pb-3 pt-4">Please Give your Paypal account Email Address: (*) </h3>
                                        <input type="email" class="form-control pull-right" v-model="paypal_email">
                                        <!-- <select name="" class="form-control pb-2" v-model="bank">
                                            <option value="Bank of America">Bank of America</option>
                                            <option value="Bank of London">Bank of London</option>
                                            <option value="Bank of Asia">Bank of Asia</option>
                                        </select> -->
                                    </div>
                                    <div class="col-md-12 pt-2 pb-2">
                                        <h3>Service charge (18%): ${{ Math.floor(withdraw_amount * 0.18) }}</h3>
                                    </div>
                                    <div class="col-md-12 pt-2">
                                        <h3>You will be getting: ${{ withdraw_amount - Math.floor((withdraw_amount * 0.18)) }}</h3>
                                        <h3 class="pt-3 pb-2">Addtional Account Details(i.e. Bank Account number etc): </h3>
                                        <textarea name="" :class="`border-1 form-control w-100 ${error ? '':'mb-5'}`" v-model="details" cols="300" rows="10"></textarea>

                                        <span v-if="error" class="alert alert-danger mt-4 mb-4 d-block" style="font-size:16px">{{error}}</span>
                                    </div>

                                    <button @click="withdraw"  class="btn btn-success confirm-booking d-block w-100">Give a Withdraw Request</button>


                                </div>
                            </div>
                        </div>
                    </modal>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import EventService from '../../services/EventService'
import { createToken, Card } from 'vue-stripe-elements-plus'
import { TableComponent, TableColumn } from 'vue-table-component';
import nProgress from 'nprogress'



    export default {
        computed: {
            ...mapGetters(['currentUser','loggedIn','isGeek','geekBooked','users','geeks']),

        },
        components: {
            Card,TableComponent, TableColumn
        },
        methods: {
            getUserByID(id){
                return this.users.find(user => Number(user.id) == Number(id))
            },
            getGeekByID(id){
                return this.geeks.find(geek => Number(geek.id) == Number(id))
            },
            showModal(id) {
                this.$modal.show('withdrawModal');
            },
            hideModal() {
                this.error = null
                this.withdraw_amount = 0
                this.paypal_email = null
                this.bank = null
                this.details = null
                this.$modal.hide('withdrawModal');
            },
            formatter(value, rowProperties) {
                    return rowProperties.attachment ? `<a href="/public/storage/${value}" target="_blank"><img src="/storage/app/public/storage/${value}" /></a>` : '';
            },
            async withdraw(){
                if((this.earnings - (this.geekEarnings.withdraw_earnings ? this.geekEarnings.withdraw_earnings : 0)) > this.withdraw_amount && this.withdraw_amount  && this.paypal_email){
                    nProgress.start();

                    EventService.withdrawRequest({
                        'geek_id' : this.currentUser.id,
                        'amount' : this.withdraw_amount,
                        'status' : 'pending',
                        'details' : this.details,
                        'bank' : this.bank,
                        'paypal_email' : this.paypal_email
                    })
                    .then(({data}) => {

                        this.$modal.hide('withdrawModal');
                        this.withdrawRequests.push(data)

                        swal("Success!", 'Your Withdraw Request has been sent!', "success");
                        nProgress.done();
                    });
                    this.error = null
                    this.withdraw_amount = 0
                    this.bank = null
                    this.details = null
                    this.paypal_email = null

                } else if(!this.withdraw_amount  || !this.paypal_email){
                    this.error = 'Please fill all the field.'
                }
                else {
                    this.error = 'You can withdraw money more than you have in the Balance.'
                }
            }
        },
        data() {
            return {
                earnings: 0,
                withdraw_amount: 0,
                paypal_email: null,
                bank: null,
                details: null,
                error: null,
                withdrawRequests: [],
                geekEarnings: 0
            }
        },
        watch: {
            loggedIn(newValue, oldValue) {
                this.geekBooked.map((booking) => {
                    if(booking.status == 'finished'){
                        this.earnings += booking.talk_time * booking.hourly_rate
                    }
                })



                EventService.getWithdrawRequests()
                .then(({data}) => {

                    this.withdrawRequests =  data


                    EventService.setEarnings({
                        geek_id : this.currentUser.id,
                        earnings : this.earnings
                    })
                    .then(({data}) => {
                        this.geekEarnings = data
                    });
                })
            }
        },
        mounted(){
            this.geekBooked.map((booking) => {
                if(booking.status == 'finished'){
                    this.earnings += booking.talk_time * booking.hourly_rate
                }
            })

                EventService.getWithdrawRequests()
                .then(({data}) => {

                    this.withdrawRequests =  data


                        EventService.setEarnings({
                            geek_id : this.currentUser.id,
                            earnings : this.earnings
                        })
                        .then(({data}) => {
                            this.geekEarnings = data
                        });
                })

        }
    }
</script>

<style lang="scss" scoped>
.marginer {
    margin-top: 100px;
}
.confirm-booking {
    color: #fff;
    background: #3245A2;
    font-size: 16px;
    border: none;
    padding: 11px 21px;
}
.border-1 {
    border: 1px solid;
}
</style>
<style>
.vm--modal {
    height: auto !important;
    top: 50px !important;
}
textarea {
    min-height: 90px;
    font-size: 16px;
}
.table-component {
    font-size: 18px;
    margin: 0!important;
}

.table-component__filter__clear {
    top: 11px!important;
    right: 15px!important;
    align-items: flex-start!important;
}
/* -- Table style */

.table-component {
  display: flex;
  flex-direction: column;
  margin: 4em 0;
}

.table-component__filter {
  align-self: flex-end;
}

.table-component__filter__field {
  padding: 0 1.25em 0 .75em;
  height: 2.5em;
  border: solid 2px #e0e0e0;
  border-radius: 2em;
  font-size: inherit;
}

.table-component__filter__clear {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 2em;
  color: #007593;
  font-weight: bold;
  cursor: pointer;
}

.table-component__filter__field:focus {
  outline: 0;
  border-color: #007593;
}

.table-component__table-wrapper {
  overflow-x: auto;
  margin: 1em 0;
  width: 100%;
  border: solid 1px #ddd;
  border-bottom: none;
}

.table-component__table {
  min-width: 100%;
  border-collapse: collapse;
  border-bottom: solid 1px #ddd;
  table-layout: fixed;
}

.table-component__table__caption {
  position: absolute;
  top: auto;
  left: -10000px;
  overflow: hidden;
  width: 1px;
  height: 1px;
}

.table-component__table th,
.table-component__table td {
  padding: .75em 1.25em;
  vertical-align: top;
  text-align: left;
}

.table-component__table th {
  background-color: #e0e0e0;
  color: #999;
  text-transform: uppercase;
  white-space: nowrap;
  font-size: .85em;
}

.table-component__table tbody tr:nth-child(even) {
  background-color: #f0f0f0;
}

.table-component__table a {
  color: #007593;
}

.table-component__message {
  color: #999;
  font-style: italic;
}

.table-component__th--sort,
.table-component__th--sort-asc,
.table-component__th--sort-desc {
  text-decoration: underline;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.table-component__th--sort-asc:after,
.table-component__th--sort-desc:after {
  position: absolute;
  left: .25em;
  display: inline-block;
  color: #bbb;
}

.table-component__th--sort-asc:after {
  content: '↑';
}

.table-component__th--sort-desc:after {
  content: '↓';
}

@media screen and (max-width: 767px) {
    .container {
        margin: 0 auto !important;
    }

    .earnings-wrapper  .earnings-box{
        border-right: none!important;
        border-bottom: 1px solid #ccc;
        padding-top: 35px;
        padding-bottom: 35px;
    }
    .earnings-wrapper .col-md-4:last-child  .earnings-box{
        border-bottom: none!important;
    }

}

.earnings-wrapper {
    border: 1px solid #ccc;
    background: #fff;
    color: #303669;
}
.earnings-wrapper .earnings-box {
    border-right: 1px solid #ccc;
}
.earnings-wrapper .col-md-4:last-child  .earnings-box{
    border-right: none;
}
.geeks .row {
    max-width: 100%;
    margin: 0 auto;
}
.vm--container {
    z-index: 999999999999999999999999999!important;
}
</style>