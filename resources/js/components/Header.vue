<template>
    <section class="header-area">
        <div class="container">
            <div class="row">

    <div class="col-md-12 col-sm-12 col-12 lg:pt-8">
        <h2 class="nav-brand">
            <!-- <div class="logo"> -->
                <a href="/"><img src="/public/frontend/img/interface/logo.png" alt="1"></a>
            <!-- </div> -->
        </h2>
        <nav id="main-nav" role="navigation">
            <!-- Mobile menu toggle button (hamburger/x icon) -->
        <input id="main-menu-state" type="checkbox" />
        <label class="main-menu-btn mr-2 sm:mr-0  bg-transparent" for="main-menu-state">
            <span class="main-menu-btn-icon "></span> Toggle main menu visibility
        </label>

            <ul id="main-menu" class="sm sm-mint mt-3 absolute  lg:relative mx-auto" >



                <!-- <li class="w-30 searcher">
                    <form @submit.prevent="updateSearchValue">
                        <input type="text" class="w-100 pl-4" placeholder="Search.." name="search" v-model="searchText" >
                        <button type="submit"><i class="fa fa-search"></i></button>

                    </form>
                </li>
                <li>
                    <router-link :to="{name: 'geeks', params: {text:'all'}}" class=" HeaderButton">Geeks</router-link>
                </li> -->

                <li v-if="loggedIn && isGeek">
                    <a class="" href="" @click.prevent="">{{ currentUser.name.split(' ')[0] }}
                        <img :src="avatarImage">
                    </a> <span class="badge badge-secondary top-badge">{{ notifications }}</span>
                    <ul class="">
                        <li><router-link  :to="{name:'profile'}">Profile</router-link></li>
                        <li><router-link :to="{name:'settings'}">Settings</router-link></li>
                        <li><router-link :to="{name:'geekQuestions'}">Questions</router-link></li>
                        <li><router-link :to="{name:'bookings'}">Bookings</router-link></li>
                        <li><router-link :to="{name:'earnings'}">Earnings</router-link></li>
                        <li><router-link :to="{name:'notifications'}">Notifications
                            <span class="badge badge-secondary">{{ notifications }}</span>
                        </router-link></li>
                        <li><a href="#" @click.prevent="logout">Log Out</a></li>
                    </ul>
                </li>
                <li v-else-if="loggedIn && isUser">
                    <a  href="" @click.prevent="">{{ currentUser.name.split(' ')[0] }}
                        <img :src="avatarImage">
                    </a> <span class="badge badge-secondary top-badge">{{ notifications }}</span>
                    <ul class="">
                        <li><router-link :to="{name:'account'}">Account</router-link></li>
                        <li><router-link :to="{name:'userQuestions'}">Questions</router-link></li>
                        <li><router-link :to="{name:'notifications'}">Notifications
                            <span class="badge badge-secondary">{{ notifications }}</span>
                        </router-link></li>
                        <li><a href="#" @click.prevent="logout">Log Out</a></li>
                    </ul>
                </li>
                <template v-else>
                    <li><router-link :to="{name: 'registration'}" class="HeaderButton">Sign up</router-link></li>
                    <li><router-link :to="{name: 'login'}" class="HeaderButton">Login</router-link></li>
                </template>
            </ul>
        </nav>

            <!-- <div class="cat-menu col-md-4">
               <ul>
                <li>
                Categories
                <ul>
                <template v-for="(cat,key) in categories">
                    <li  v-if="cat.sub_cat && cat.sub_cat.length" :key="key">
                   <router-link :to="{name:'geeks' , params : {text : cat.name}}" class="v-router">{{  cat.name }} </router-link>
                        <ul>
                            <li class="link" v-for="(subCat,index) in cat.sub_cat" :key="index">
                                <router-link :to="{name:'geeks' , params : {text : subCat}}">{{  subCat }} </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="link" :key="key" v-else>
                        <router-link :to="{name:'geeks' , params : {text : cat.name}}" class="v-router">{{  cat.name }} </router-link>
                    </li>
                </template>
                </ul>
                </li>
              </ul>
            </div> -->

        </div>


            </div>
        </div>
</section>
</template>

<script>
import {authComputed , user} from '../store/helpers.js'
import {mapGetters} from 'vuex'
import EventService from '../services/EventService';
    export default {
        computed: {
            ...authComputed,
            // ...user,
            ...mapGetters(['categories','isGeek','isUser','loggedIn','currentUser']),
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
            },
        },
        watch: {
            loggedIn(newValue, oldValue) {
                $(function() {
                    $('#main-menu').smartmenus({
                        subMenusSubOffsetX: 1,
                        subMenusSubOffsetY: -8
                    });
                        // SmartMenus mobile menu toggle button
                    $(function() {
                    var $mainMenuState = $('#main-menu-state');
                    if ($mainMenuState.length) {
                        // animate mobile menu
                        $mainMenuState.change(function(e) {
                        var $menu = $('#main-menu');
                        if (this.checked) {
                            $menu.hide().slideDown(250, function() { $menu.css('display', ''); });
                        } else {
                            $menu.show().slideUp(250, function() { $menu.css('display', ''); });
                        }
                        });
                        // hide mobile menu beforeunload
                        $(window).bind('beforeunload unload', function() {
                        if ($mainMenuState[0].checked) {
                            $mainMenuState[0].click();
                        }
                        });
                    }
                    });
                });
            }
        },
        methods: {
            logout(){
                this.$store.dispatch('logout')
            },
            cssFix(event){
              	$('.dropdown-menu').toggle();
                event.stopPropagation();
			},
			updateSearchValue(event) {
          if(this.searchText !== null){
            this.$router.push({name: 'geeks' , params: {text: this.searchText}})
            this.searchText = null
          }
      }
		},
		data() {
			return {
				searchText: null,
                notifications: null,
                kutta: true
			}
        },


        mounted(){
            setTimeout(() => {
                $(".loader").hide();
            }, 3000);

            setInterval(() => {
                if(this.loggedIn) {
                    EventService.getNotificationNumber()
                    .then(({data}) => {
                        this.notifications = data;
                    });
                }
            }, 2000);
        },
    }


</script>



<style lang="scss" scoped>
.header-area .logo {
    padding-left: 10px!important;
}
.card {
    background-color: transparent!important;
}
// on active
// .header-area li a:hover.v-router  , .header-area li a.v-router {
//     color: #364baa!important;
//     background: #fff!important;
//     border: none!important;
// }
.header-area {
  max-width: 1700px;
  margin: 0 auto;
}
.card {border:0;}
// .router-link-active.HeaderButton {
//   color: #5B5ACA;
//   background: #fff;
//   text-decoration: none;
// }
// .header-area .log-menu li .profile {
//   box-shadow: none!important;
// }
// .header-area .log-menu li a{
//   margin:0!important;
// }
// .header-area .logo img {
//     width: 100%!important;
//     float: left;
//     padding: 20px 0;
//     display: block;
// }
  .nav-link {
    font-family: Poppins;
    font-weight: 600 !important;
    font-size: 16px !important;
    color: #303669 !important;
    line-height: 1 !important;
    background: transparent !important;
    border: none !important;
    padding-right: 50px !important;
    padding-top: 12px !important;
  }
.HeaderButton {
  background-color: #3a88ec !important;
  font-size: 15px !important;
  font-family: Poppins;
  font-weight: 600 !important;
  color: #fff;
  padding: 12px 40px !important;
  border-radius: 100px !important;
  border: none !important;
}
.HeaderButton:hover , .HeaderButton.router-link-exact-active {
  color: #fff !important;
  background-color: #009dff !important;
}
.main-nav {
  border-bottom: 2px solid #8db863;
  background: #fff;
}
.main-nav:after {
  clear: both;
  content: "\00a0";
  display: block;
  height: 0;
  font: 0px/0 serif;
  overflow: hidden;
}
.nav-brand {
  float: left;
  margin: 0;
}
.nav-brand a {
  display: block;
  padding: 11px 11px 11px 20px;
  color: #333;
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 22px;
  font-weight: normal;
  line-height: 17px;
  text-decoration: none;
}
#main-menu {
  clear: both;
  border-bottom: 0;
  top:50px !important;
  left:30%;
}
@media (min-width: 992px) {
  #main-menu {
    float: right;
    clear: none;
    left:0px;
    top:0px !important;
  }
}
/* Mobile menu toggle button */
.main-menu-btn {
  float: right;
  margin: 6px 10px;
  position: relative;
  display: inline-block;
  width: 45px;
  height: 45px;
  text-indent: 50px;
  white-space: nowrap;
  overflow: hidden;
  cursor: pointer;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
/* hamburger icon */
.main-menu-btn-icon,
.main-menu-btn-icon:before,
.main-menu-btn-icon:after {
  position: absolute;
  top: 50%;
  left: 0px;
  height: 2px;
  width: 15px;
  background: #77c8fa;
  -webkit-transition: all 0.25s;
  transition: all 0.25s;
  padding-left: 46px;
}
.main-menu-btn-icon:before {
  content: '';
  top: -10px;
  left: 0;
}
.main-menu-btn-icon:after {
  content: '';
  top: 10px;
  left: 0;
}
/* x icon */
#main-menu-state:checked ~ .main-menu-btn .main-menu-btn-icon {
  height: 0;
  background: transparent;
}
#main-menu-state:checked ~ .main-menu-btn .main-menu-btn-icon:before {
  top: 0;
  -webkit-transform: rotate(-45deg);
  transform: rotate(-45deg);
}
#main-menu-state:checked ~ .main-menu-btn .main-menu-btn-icon:after {
  top: 0;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
}
/* hide menu state checkbox (keep it visible to screen readers) */
#main-menu-state {
  position: absolute;
  width: 1px;
  height: 1px;
  margin: -1px;
  border: 0;
  padding: 0;
  overflow: hidden;
  clip: rect(1px, 1px, 1px, 1px);
}
/* hide the menu in mobile view */
#main-menu-state:not(:checked) ~ #main-menu {
  display: none;
}
#main-menu-state:checked ~ #main-menu {
  display: block;
}
@media (min-width: 992px) {
  /* hide the button in desktop view */
  .main-menu-btn {
    position: absolute;
    top: -99999px;
  }
  /* always show the menu in desktop view */
  #main-menu-state:not(:checked) ~ #main-menu {
    display: block;
  }
}
.header-area  img {
    width: 120px;
}
@media (min-width: 992px) {
    .header-area  img {
        width: 120px;
    }
}
@media (min-width: 562px) and (max-width: 992px) {
    .w-30.searcher {
        width: 25%!important;
    }
    .header-area .logo img {
        width: 80px!important;
    }
    #main-menu li {
        margin-right: 6px !important;
    }
    .HeaderButton {
        text-align: center!important;
    }
    .header-area .logo img {
        float: left;
    }
}
@media screen and (max-width: 768px) {
    .w-30.searcher {
        width: 80%!important;
    }
    .searcher input{
        border-radius: 0!important;
    }
    .header-area .logo img {
        width: 100px;
        float: left;
        padding: 20px 0;
        display: block;
    }
}
@media screen and (max-width: 992px) {
    .header-area .logo {
        width: 120px !important;
        height: 100px;
    }
    .main-menu-btn {
        margin-top: 20px !important;
    }
    #main-menu li {
        border: 0;
        width: 100% !important;
        border-radius: 0 !important;
        margin-top: 20px;
    }
    .sm-mint{
        background: #fff!important;
        padding:15px;
    }
    .HeaderButton {
        border-radius: 0 !important;
    }
}
a.nav-link:hover{
    color: #ff3e81!important;
    font-weight: bold!important;
    font-size: 16px!important;
}
.sm-mint {
    border-bottom: none!important;
    border-top: none!important;
}
.sm-mint a.has-submenu img{
    width: 20px
 }
.sm-mint a.has-submenu {
    box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.3);
}
.main-menu-btn {
    background: #ddd;
}
.w-30 {
    width: 30%!important;
}
#main-menu li {
    margin-right: 25px;
}
#main-menu ul li {
    margin-right: 0!important;
}
.fa.fa-search {
    float: right;
    background: transparent;
    font-size: 26px;
    border: none;
    cursor: pointer;
    position: absolute;
    right: 14px;
    color: #a7acc0;
    top: 8px;
}
.sm-mint ul a:hover, .sm-mint ul a:focus, .sm-mint ul a:active, .sm-mint ul a.highlighted {
    background: #009dff;
    color:#fff;
}
.sm-mint a:hover, .sm-mint a:focus, .sm-mint a:active {
    background: #009dff;
    color:#fff;
}
</style>

<style>
.sm-mint a .sub-arrow {
    border-color: #0044c8 transparent transparent transparent!important;
}
.badge.badge-secondary.top-badge {
    position: absolute;
    top: -15px;
    right: -20px;
    font-size: 18px;
    border-radius: 9px;
    z-index: -1;
}
.has-submenu {
    z-index: 1111111111111111;
    position: relative;
}
</style>