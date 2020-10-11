<template>
    <section class="profile-area" v-if="loggedIn && isGeek">
    <div class="container">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="profile-img shadow-md">
               <img :src="avatarImage">

                <h3 v-if="Boolean(Number(currentUser.is_approved))">Approved</h3>
                <h3 v-else>Not Approved</h3>
            </div>
            <router-link :to="{name: 'settings'}" class="btn btn-request">Edit Profile <i class="fa fa-angle-right"></i></router-link>
            <div class="profile-info">
                <div class="count">
                    <h2>
                        {{ geekBooked ? geekBooked.filter(book => book.status === 'finished').length : 0 }}
                        <br><span>Calls</span></h2>
                    <h2 style="border-left:1px solid #d1d1d1;">{{ currentUser.geek_reviews && currentUser.geek_reviews.length ?  currentUser.geek_reviews.length : 0}}<br><span>Reviews</span></h2>
                </div>
                <!-- <div class="verify-share">
                    <h3>Verified By:</h3>
                    <ul>
                        <li><a target="blank" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a target="blank" href="#"><i class="fa fa-twitter inactive" aria-hidden="true"></i></a></li>
                        <li><a target="blank" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        <li><a target="blank" href="#"><i class="fa fa-instagram inactive" aria-hidden="true"></i></a></li>
                    </ul>
                </div> -->
                <ul class="options">
                    <!-- <h3>Skills:</h3> -->
                    <li v-for="tag in currentUser.tags" :key="tag.id"><router-link :to="{name:'geeks' , params : {text : tag.name}}" class="btn btn-opt">{{ tag.name }}</router-link></li>
                </ul>
                <!-- <div class="verify-share">
                    <h3>Share on:</h3>
                    <ul>
                        <li><a target="blank" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a target="blank" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a target="blank" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        <li><a target="blank" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                </div> -->
                <h5>Member since {{ currentUser.created_at }}</h5>
            </div>
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="about-area">
                    <div class="col-md-9 col-sm-7 col-xs-12 no-padding">
                        <h1>{{ currentUser.name  }}<span><i class="fa fa-map-marker"></i>{{ currentUser.address }}</span></h1>
                        <h3>{{ currentUser.title }}</h3>
                        <h2>{{ currentUser.geek_reviews && currentUser.geek_reviews.length ?  Number(currentUser.geek_reviews.map(review => parseInt(review.star)).reduce((a, b) => a + b, 0) / currentUser.geek_reviews.length).toFixed(2) : 0 }}</h2>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" :style="`width:${ (Number(currentUser.geek_reviews.map(review => parseInt(review.star)).reduce((a, b) => a + b, 0) / currentUser.geek_reviews.length).toFixed(2) / 5) * 100}%`">
                                <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                        <h4>Rating</h4>
                    </div>
                    <div id="myDIV" class="col-md-3 col-sm-5 col-xs-12 no-padding" v-if="currentUser.hourly_rate">
                        <a class="btn btn-min">${{ currentUser.hourly_rate }} / Minute</a>
                    </div>
                    <div v-else>
                        <a class="btn btn-min">Your profile is awaiting approval.</a>
                    </div>
                </div>




                <div class="tab-area">
                    <div class="tab">
                        <button class="tablinks active" onclick="openCity(event, 'London')"><i class="fa fa-user"></i> About</button>
                        <button class="tablinks" onclick="openCity(event, 'Paris')"><i class="fa fa-file"></i> Certificates</button>
                    </div>
                    <div id="London" class="tabcontent" style="display:block">
                        <p>{{currentUser.bio}}</p>
                        <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-play-circle"></i>Play Video</a>
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Profile Intro Video</h4>
                                    </div>
                                    <div class="modal-body">
                                        <iframe width="100%" height="300" :src="currentUser.video_profile" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="Paris" class="tabcontent">
                        <div class="blog-area">
                            <div class="blog-line" v-for="certification in currentUser.certifications" :key="certification.id">
                                <div class="col-md-4 col-sm-4 col-xs-12 no-padding">
                                    <div class="blog-img ">
                                        <a href=""><img :src="`${$imagePath}${certification.image}`" class="object-contain"></a>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12 no-padding">
                                    <div class="blog-text ">
                                        <a href="" class="blog-head font-bold text-primary"><h4>{{ certification.title }}</h4></a>
                                        <p class="my-2">{{ certification.description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="see-more"><i class="fa fa-plus"></i> See More</a>
                    </div>
                </div>
                <div class="second-content">
                    <div class="tabs">
                        <div role="tablist" aria-label="Programming Languages">
                            <button role="tab" aria-selected="true" id="tab1"><span>{{ currentUser.geek_reviews ? currentUser.geek_reviews.length : 0 }}</span>Review</button>
                            <!-- <button role="tab" aria-selected="false" id="tab2"><span>370</span>Answers</button> -->
                        </div>
                        <div role="tabpanel" aria-labelledby="tab1 ">
                            <template v-if="currentUser.geek_reviews">
                                <div class="review-line" v-for="(review , index) in currentUser.geek_reviews" :key="index">
                                    <div class="review-img">
                                        <img :src="getUserByID(review.user_id).avatar" v-if="getUserByID(review.user_id).avatar && getUserByID(review.user_id).avatar.includes('http')" alt="">
                                        <img  :src="getUserByID(review.user_id).avatar ? `${$imagePath}${getUserByID(review.user_id).avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                                    </div>
                                    <div class="review-text">
                                        <h4>{{ getUserByID(review.user_id).name }}</h4>
                                        <p>{{ review.text }}</p>
                                    </div>
                                    <div class="review-extra pr-3">
                                        <ul>
                                            <li><h6>{{review.star}}</h6></li>

                                            <li v-for="n in parseInt(review.star)"><i class="fa fa-star mark"></i></li>
                                            <li v-for="n in parseInt(5 - review.star)"><i class="fa fa-star"></i></li>
                                        </ul>
                                        <p>{{ new Date(review.created_at).toString().split(' ')[1] }} {{ new Date(review.created_at).getDate() }}, {{ new Date(review.created_at).getFullYear() }}</p>
                                    </div>
                                </div>
                            </template>
                            <a href="#" class="see-more"><i class="fa fa-plus"></i> See More</a>
                        </div>
                        <div role="tabpanel" aria-labelledby="tab2" hidden>
                            <h3>Social Media Strategy: On which platforms can I find a reputable Growth Hacker for hire?</h3>
                            <div class="review-line">
                                <div class="review-img">
                                    <img src="/public/frontend/img/review/r-5.png">
                                </div>
                                <div class="review-text full py-2">
                                    <h5>Adrian Salamunovic, Co-founder CanvasPop, DNA11 and PopKey answered: </h5>
                                    <p>The reality is "reputable" growth hackers - aren't sitting around on freelance sites waiting for you to hire them. If they are good, they are either (very) gainfully employed at a reputable company making very good salaries or more likely using our super powers to create multimillion dollar companies. So the bad news is there is no platform where you can hire reputable growth hackers BUT here is what you can do:

                                    You can borrow some of their time on here for just a few dollars a minute and learn what you need to learn to do it yourself (or at least get started) or find courses to learn "growth hacking" yourself. Get the tips, learn the techniques, tons of free resources and sites too.

                                    Unfortunately there are no silver bullets and very seldom magic hires that will suddenly get you growth. It's a painful, iterative long process.</p>
                                    <div class="btn-re">
                                        <a href="book.php" class="talk">Talk Now</a>
                                        <a href="upvote.php" class="up-sh">Upvote</a>
                                        <a href="share.php" class="up-sh">Share</a>
                                    </div>
                                    <div class="btn-re-2">
                                        <a href="report.php" class="repo">Report</a>
                                    </div>
                                </div>
                            </div>
                            <h3>Social Media Strategy: On which platforms can I find a reputable Growth Hacker for hire?</h3>
                            <div class="review-line">
                                <div class="review-img">
                                    <img src="/public/frontend/img/review/r-5.png">
                                </div>
                                <div class="review-text full">
                                    <h5>Adrian Salamunovic, Co-founder CanvasPop, DNA11 and PopKey answered: </h5>
                                    <p>The reality is "reputable" growth hackers - aren't sitting around on freelance sites waiting for you to hire them. If they are good, they are either (very) gainfully employed at a reputable company making very good salaries or more likely using our super powers to create multimillion dollar companies. So the bad news is there is no platform where you can hire reputable growth hackers BUT here is what you can do:

                                    You can borrow some of their time on here for just a few dollars a minute and learn what you need to learn to do it yourself (or at least get started) or find courses to learn "growth hacking" yourself. Get the tips, learn the techniques, tons of free resources and sites too.

                                    Unfortunately there are no silver bullets and very seldom magic hires that will suddenly get you growth. It's a painful, iterative long process.</p>
                                    <div class="btn-re">
                                        <a href="book.php" class="talk">Talk Now</a>
                                        <a href="upvote.php" class="up-sh">Upvote</a>
                                        <a href="share.php" class="up-sh">Share</a>
                                    </div>
                                    <div class="btn-re-2">
                                        <a href="report.php" class="repo">Report</a>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="see-more"><i class="fa fa-plus"></i> See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>

import { mapGetters } from 'vuex'
import EventService from '../../services/EventService.js';
import nProgress from 'nprogress'


    export default {
        computed: {
            ...mapGetters(['currentUser','loggedIn','isGeek','geekBooked','users']),
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
        methods: {
            getUserByID(id){
                return this.users.find(user => Number(user.id) === Number(id))
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
</style>

