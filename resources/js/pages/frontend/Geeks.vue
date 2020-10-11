<template>
    <div class="limiter" style="background:#fff;">
        <div class="category-wrapper">
            <div class="container">
                <router-link :to="{name:'geeks' , params : {text : category.name}}" v-for="(category , index) in sortedCategories" :key="index" class="px-3 py-3 d-inline-block">{{category.name}}</router-link>

            </div>
        </div>
        <section class="filter-area">
    <div class="container">
        <h2>Results for “{{ text }}”</h2>
        <div class="col-md-9 col-sm-12 col-xs-12 no-padding">

            <div class="dropdown">
                <button class="dropbtn">Category <i class="fa fa-angle-down"></i></button>
                <div class="dropdown-content">
                    <router-link :to="{name: 'geeks', params: {text:'all'}}" >All</router-link>

                    <router-link :to="{name:'geeks' , params : {text : category.name}}" v-for="(category , index) in categories" :key="index">{{category.name}}</router-link>
                </div>
            </div>

            <div class="dropdown" v-if="categories.find(cat => cat.name.toLowerCase() === text.toLowerCase())">
                <button class="dropbtn">Sub Category <i class="fa fa-angle-down"></i></button>
                <div class="dropdown-content">
                    <template  v-for="category in categories">
                        <template v-if="category.name.toLowerCase() === text.toLowerCase()">
                            <router-link :to="{name:'geeks' , params : {text : cat}}"  :key="index" v-for="(cat ,index) in category.sub_cat">
                                {{ cat }}
                            </router-link>
                        </template>
                    </template>
                </div>
            </div>
            <!-- <div class="dropdown">
                <button class="dropbtn">Location <i class="fa fa-angle-down"></i></button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Popularity <i class="fa fa-angle-down"></i></button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Cert <i class="fa fa-angle-down"></i></button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Earn <i class="fa fa-angle-down"></i></button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div> -->
        </div>
        <!-- <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="example">
                <button type="button" class="btn btn-lg btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off">
                    <div class="handle"></div>
                </button>
            </div>
        </div> -->
    </div>
</section>


<section class="geeks-area">
    <div class="container">
        <div class="col-md-6 col-sm-6 col-xs-12 no-padding">
            <h3>{{ allGeeks.length }} Results found</h3>
        </div>
        <!-- <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="dropdown sort">
                <button class="dropbtn">Sort by <b>Relevance</b><i class="fa fa-angle-down"></i></button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
        </div> -->
        <div class="geeks">
            <div class="row  flex flex-wrap">
                <div class=" w-full sm:w-1/2 lg:w-1/3   px-2" v-for="(geek , index) in geeks" :key="index" >
                    <div class="geek-box rounded-lg shadow-lg p-4 lg:p-8 m-2 " style="background:#fff">
                        <router-link :to="{ name: 'geek-show', params: { username: geek.username }}" class="top-area">
                            <div class="pro-img online shadow-sm my-1">
                                <img :src="geek.avatar" v-if="geek.avatar && geek.avatar.includes('http')" alt="">
                                <img  :src="geek.avatar ? `${$imagePath}${geek.avatar}` : '/public/frontend/img/interface/avatar.png'" v-else>
                            </div>
                            <div class="text-box my-1">
                                <h1>{{ geek.name.split(' ')[0] }}</h1>
                                <h3>{{ geek.title }}</h3>
                            </div>
                            <h5 class="rate my-2">${{ geek.hourly_rate }}/minute</h5>
                        </router-link >
                        <div class="sec-area my-1">
                            <h5>{{ geek.geek_reviews && geek.geek_reviews.length ?  Number(geek.geek_reviews.map(review => parseInt(review.star)).reduce((a, b) => a + b, 0) / geek.geek_reviews.length).toFixed(2) : 0 }} Rating</h5>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" :style="`width:${ (Number(geek.geek_reviews.map(review => parseInt(review.star)).reduce((a, b) => a + b, 0) / geek.geek_reviews.length).toFixed(2) / 5) * 100}%`">
                                    <span class="sr-only">70% Complete</span>
                                </div>
                            </div>
                            <a id="myDIV" v-if="loggedIn && isUser">
                                <i type="btn" class="fa fa-heart fav"  :class="favouriteGeeks.includes(String(geek.id)) ? 'loved':''" @click.prevent="addToFavourite(geek.id)"></i>
                            </a>
                            <router-link :to="{name : 'user-registration'}" id="myDIV" v-if="!loggedIn">
                                <i type="btn" class="fa fa-heart fav"></i>
                            </router-link>
                        </div>
                        <p class="text-gray-500 my-1">{{ geek.bio ? geek.bio.substring(0,220)+ '...' : '' }}</p>
                        <ul class="options my-1">
                            <template v-for="(tag, index) in geek.tags">
                            <li  :key="index" v-if="index < 2 "><router-link :to="{name:'geeks' , params : {text : tag.name}}" class="btn btn-opt">{{ tag.name }}</router-link></li>
                            </template>
                            <!-- <li><a href="#" class="btn btn-opt">+ 5 More</a></li> -->
                        </ul>
                        <ul class="main-btn my-1  flex justify-between w-full">
                            <li v-if="!loggedIn" class="w-100"><router-link :to="{name: 'user-registration' , params: {user_name: geek.username}}"  class="btn btn-m-btn extra py-3 px-4 rounded-xl shadow-lg hover:bg-primary hover:text-white w-100 " >Book</router-link></li>

                            <li v-if="loggedIn && isUser" class="w-100"><router-link :to="{name: 'booking', params: {username : geek.username}}"  class="btn btn-m-btn extra py-3 px-4 rounded-xl shadow-lg hover:bg-primary hover:text-white w-100 " >Book</router-link></li>

                            <!-- <li :class="{ w100 : loggedIn && isGeek }"><router-link :to="{ name: 'geek-show', params: { username: geek.username }}" style="margin-left:10px; padding: 4px 30px;"  :class="{ w100 : loggedIn &&  isGeek}" class="btn btn-m-btn py-3 px-4 rounded-xl shadow-lg mx-1">Profile</router-link></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="news-inner-1">
                        <div class="number-page">

                            <a href="#" @click.prevent="movePagination(page_number - 1)" v-if="page_number !== 1"><p><i class="fa fa-angle-left" aria-hidden="true"></i></p></a>

                            <template v-if="paginate_numbers !== 1">
                                <a href="#" class="text-primary border-primary" v-for="(n,index) in paginate_numbers" :key="index" @click.prevent="movePagination(n)" :class="(page_number === n) ? 'active' : ''" ><p>{{ n }}</p></a>
                            </template>

                            <a href="#" @click.prevent="movePagination(page_number + 1)" v-if="page_number !== paginate_numbers && allGeeks.length"><p><i class="fa fa-angle-right" aria-hidden="true"></i></p></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    </div>
</template>

<script>
import {mapGetters , mapState} from 'vuex'
import Swal from 'sweetalert2'

    export default {
        props: {
            text: {
                type: [String , Number],
                default: ''
            },
        },
        computed: {
            ...mapGetters(['categories','favouriteGeeks','isUser','isGeek','loggedIn']),
            allGeeks(){
                return this.$store.getters.getGeekBySearch(this.text)
            },
            paginate_numbers(){
                return Math.ceil(this.allGeeks.length / this.items_per_page)
            },
            sortedCategories(){
                function compare(a, b) {
                    if (a.name.toLowerCase() < b.name.toLowerCase())
                        return -1;
                    if (a.name.toLowerCase() > b.name.toLowerCase())
                        return 1;
                    return 0;
                }
                return this.categories.sort(compare)
            }

        },
        data() {
            return {
                geeks: null,
                items_per_page: 9,
                page_number: 1,
            }
        },
        methods: {
            paginate(array, items_per_page , page_number) {
                // human-readable page numbers usually start with 1, so we reduce 1 in the first argument
                return array.slice((page_number - 1) * items_per_page, page_number * items_per_page);
            },
            movePagination(number){
                this.page_number = number
                this.geeks =  this.paginate(this.allGeeks , this.items_per_page , number )
            },
            addToFavourite(geekId){
                geekId =  String(geekId)
                let status = this.favouriteGeeks.includes(geekId) ? 'Removed': 'Added'

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
                        title: `${status} as Favourite!`
                    })
                })
            }
        },
        watch: {
            allGeeks(newValue, oldValue) {
                this.geeks = this.paginate(newValue ,this.items_per_page , this.page_number )
            },

        },
        created() {
            this.geeks = this.paginate(this.allGeeks ,this.items_per_page , this.page_number )
            console.log(this.geeks)
        },
        mounted(){
            // support@expensegeeks.com
            console.log('kire')
            console.log(this.geeks)
        }
    }
</script>

<style lang="scss" scoped>
.limiter {
    margin-top: 85px;
}
.container {
    max-width: 1150px;
    margin: 0 auto;
}
.category-wrapper {
    border-bottom: 1px solid #d9d9d9;
}
.category-wrapper a {
    color: #7E8088;
    font-size: 21px;
}
.result-text {
    font-size: 31px;
    font-weight: bold;
}
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    background: #fff url("/public/frontend/img/arrow.png");
    background-repeat: no-repeat;
    background-position-x: 93%;
    background-position-y: 50%;
    color: #455CC7;
    font-size: 20px;
    border-radius: 10px;
    border:none;
    text-align: left;
}
select.sort {
    background: transparent url("/public/frontend/img/arrow_black.png");
    color:black;
    background-repeat: no-repeat;
    background-position-x: 100%;
    background-position-y: 50%;
    font-size: 18px;
    font-weight: bold;

}


select.first-select {
    -webkit-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
    -moz-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
    box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
}
select.first-select:focus {
    border: 1px solid #455CC7!important;
    -webkit-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
    -moz-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
    box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
}
.sorted h5{
    font-size: 18px;
}
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
.geek-box {min-height: 350px;}
.loved { color: red!important;}

.geek-box p {
    // height: 130px;
    text-align: justify!important;
}
.geek-box .options {
    min-height: 40px;
}

</style>
<style>
.swal2-popup.swal2-toast .swal2-title {
    font-size: 2em!important;
}
@media screen and (max-width: 768px) {
    .limiter{margin-top: 0!important;}
}
.geeks-area {
    min-height: 100vh;
}
.w100{
    width: 100%!important;
}
</style>