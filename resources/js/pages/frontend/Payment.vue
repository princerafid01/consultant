<template>
    <section class="marginer-top">
        <div class="container">
            <div class="row p-5">
                <div class="col-md-8 col-sm-12 col-xs-12 mt-5">
                    <div class="bg-white mr-3 p-5" v-if="BookingInfo">
                        <h1>Payment Method</h1>

                        <div class="r-card-wrapper my-3" v-if="!donePayment">
                            <!-- <card class='stripe-card form-control'
                                :class='{ complete }'
                                :stripe='key'
                                :options='stripeOptions'
                                @change='complete = $event.complete'
                                /> -->
                                <button id="paypal-button" class="mt-5"></button>

                                <img src="/public/frontend/img/loading.svg" alt="loading" v-if="loading">

                        </div>
                        <div class="alert alert-success mt-4" v-else>
                            You have successfully paid and booked {{BookingInfo.name}} . Go to <router-link :to="{name : 'account'}"> account</router-link> now.
                        </div>
                    </div>



                </div>
                <div class="col-md-4 bg-white p-5 col-sm-12 col-xs-12 mt-5">
                    <h1>Summary</h1>
                    <img :src="BookingInfo.image">

                    <h3 class="pt-3">Geek Name: <strong>{{BookingInfo.name}}</strong></h3>
                    <h3 class="pt-3">Your preferred schedule is on <strong>{{BookingInfo.date.toDateString()}} at {{ BookingInfo.time }} on  {{ BookingInfo.timezone }}</strong></h3>
                    <h3 class="pt-3">You will be charged <strong>${{BookingInfo.charge}}</strong></h3>

                </div>
            </div>
        </div>
    </section>
</template>

<script>
import EventService from '../../services/EventService.js'
import {mapGetters} from 'vuex'
import axios from 'axios'


    export default {
        props: {
            BookingInfo: {
                type: Object
            },
        },
        computed: {
            ...mapGetters(['currentUser']),
        },
        data() {
            return {
                complete: false,
                loading: false,
                donePayment: false,
                receipt_url: null,
            }
        },

        methods: {
            // pay () {
            //     this.loading = true;
            //     createToken().then(data => {
            //         EventService.makePayment({token: data.token.id , bookingInfo:  this.BookingInfo,user: this.currentUser })
            //         .then(({data}) => {
            //             this.loading = false;
            //             this.donePayment = true;
            //             this.receipt_url = data.receipt_url
            //             this.$store.dispatch('updateUserBooking' , data.booking)
            //         }).catch((err) => {
            //             this.loading = false;
            //             console.log(err)
            //         });
            //     })
            // }
        },
        mounted () {
            console.log( typeof this.BookingInfo)
            if(this.BookingInfo === undefined){
                let prev_username = localStorage.getItem('booking_username')
                this.$router.push({name: 'booking' , params: {username: prev_username}})
            } else {

                    paypal.Button.render({
                        env: 'production', // Optional: specify 'sandbox'  environment
                        client: {
                            sandbox: 'AUPSpo2TOe00tn38UT8XPTeXI80HDrU2je7kGn8EefmRp5PCoa4ut7yn1RUt6vfopevPGv65QAjLKjuu',
                            production: 'ARY1Kk_QCYVLdWq3ZzzJipZW3usBKaahLzQNsRcKziuI_5rtHaIwHxS3gWMwyRlRTMLburheXl9pAPSW' ,
                        },
                        locale: 'en_US',
                        style: {
                            size: 'large',
                            color: 'blue',
                            shape: 'pill',
                            label: 'checkout',
                            tagline: 'true'
                            },
                        commit: true, // Optional: show a 'Pay Now' button in  the checkout flow


                payment: (resolve, reject) => {
                        // Set up the payment here, when the buyer clicks   on the button

                        let returnUrl = "https://expensegeeks.com";
                        let amount = this.BookingInfo.charge

                        //Here call your own API server
                return new Promise((resolve, reject) => {
                    this.loading = true
                    axios.post('/api/auth/checkout-paypal', {
                            return_url: returnUrl,
                            amount:amount
                                })
                            .then(res => {
                                resolve(res.data.id)
                            })
                            .catch(error => {
                                reject(error)
                            })
                    })

                        },



                onAuthorize: (data) => {
                // Execute the payment here, when the buyer approves the transaction

                    return new Promise((resolve, reject) => {
                        axios.post('/api/auth/execute-paypal',  {
                            payer_id: data.payerID,
                            payment_id: data.paymentID,
                            bookingInfo: this.BookingInfo
                        })
                                    .then(res => {
                                    this.loading = false
                                    this.donePayment = true

                                        resolve(res)
                                    })
                                    .catch(error => {
                                        reject(error)
                                    })
                            })

                }
            }, '#paypal-button');

            }


        },


    }
</script>

<style scoped>
.marginer-top {
    margin-top: 100px;
    margin-bottom: 100px;
}
.alert {
    font-size: 16px;
}

table tr th , table tr td  {
    padding: 10px 20px;
}
table {
    font-size: 18px;
}

</style>

<style>

.bg-white {
    background: #fff!important;
    border: 1px solid #ddd;
}
body  iframe .paypal-button-container , .zoid-component-frame.zoid-visible {
    background: #fff!important;
}
.bg-white img {
    width: 50px;
    height: 50px;
    float: right;
}
</style>