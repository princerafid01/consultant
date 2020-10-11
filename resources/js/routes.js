import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './pages/frontend/Home.vue';
import Registration from './pages/frontend/Registration.vue';
import UserRegistration from './pages/frontend/UserRegistration.vue';
import Login from './pages/frontend/Login.vue';
import Profile from './pages/frontend/Profile.vue';
import Settings from './pages/frontend/Settings.vue';
import Geeks from './pages/frontend/Geeks.vue';
import GeekShow from './pages/frontend/GeekShow.vue';
import Account from './pages/frontend/Account.vue';
import Booking from './pages/frontend/Booking.vue';
import Payment from './pages/frontend/Payment.vue';
import GeekQuestion from './pages/frontend/GeekQuestion.vue';
import UserQuestion from './pages/frontend/UserQuestion.vue';
import GeekBookings from './pages/frontend/GeekBookings.vue';
import Earnings from './pages/frontend/Earnings.vue';
import Notification from './pages/frontend/Notification.vue';
import NProgress from 'nprogress'
import store from './store/index.js'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: '',
    component: Home,
    meta: {requiresAuth: false}
  },
  {
	path: '/registration',
	component: Registration,
	name: 'registration',
  },
  {
	path: '/user/sign-in',
	component: UserRegistration,
  name: 'user-registration',
  props:true
  },
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/profile',
    name: 'profile',
    component: Profile,
    // beforeEnter(routeTo,routeFrom,next){
    //   EventService.me().then(() => next())
    // },
    meta: {
      requiresAuth: true,
      isGeek: true,
      redirectOnUnAuth: 'account'
    }
  },
  {
    path: '/bookings',
    name: 'bookings',
    component: GeekBookings,
    meta: {
      requiresAuth: true,
      isGeek: true,
      redirectOnUnAuth: 'account'
    }
  },
  {
    path: '/earnings',
    name: 'earnings',
    component: Earnings,
    meta: {
      requiresAuth: true,
      isGeek: true,
      redirectOnUnAuth: 'account'
    }
  },
  {
    path: '/geek-questions',
    name: 'geekQuestions',
    component: GeekQuestion,
    meta: {
      requiresAuth: true,
      isGeek: true,
      redirectOnUnAuth: 'account'
    }
  },
  {
    path: '/notifications',
    name: 'notifications',
    component: Notification,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/user-questions',
    name: 'userQuestions',
    component: UserQuestion,
    meta: {
      requiresAuth: true,
      isUser: true,
      redirectOnUnAuth: 'profile'
    }
  },
  {
    path: '/settings',
    name: 'settings',
    component: Settings,
    meta: {
		requiresAuth: true,
		isGeek: true,
	  	redirectOnUnAuth: 'account'
	}
  },
  {
    path: '/account',
    name: 'account',
    component: Account,
    meta: {
      requiresAuth: true,
      isUser: true,
      redirectOnUnAuth: 'profile'
    }
  },
  {
    path: '/geeks/:text',
    name: 'geeks',
    component: Geeks,
    props: true
  },
  {
    path: '/geeks',
    redirect: { name: 'geeks' , params: {text: 'all'}}
  },
  {
    path: '/payment',
    name: 'payment',
    component: Payment,
    props: true,
    meta: {
      requiresAuth: true,
      isUser: true,
      redirectOnUnAuth: '/'
    }
  },
  {
    path: '/geek/:username',
    name: 'geek-show',
    component: GeekShow,
    props: true
  },
  {
    path: '/booking/:username',
    name: 'booking',
    component: Booking,
    props: true,
    // meta: {
    //   requiresAuth: true,
	  // isGeek: true,
	  // redirectOnUnAuth: 'account'
    // }
  },
  {
    path: '/auth/:provider/callback',
    component: {
      template: '<div class="auth-component"></div>'
    }
  },


];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

router.beforeEach((routeTo,routeFrom,next) => {
	const roadToAuth =['login', 'registration','user-registration'];
  const loggedIn  = localStorage.getItem('user_token')
  NProgress.start()
  if(routeTo.matched.some(record => record.meta.requiresAuth) && !loggedIn){
	next({name: 'login'})
  } else if(routeTo.matched.some(record => record.meta.requiresAuth && record.meta.isUser)){
		let routeToGo = ''
		routeTo.matched.some(record => {
			routeToGo = record.meta.redirectOnUnAuth
		})

      store.watch(
        (state) => state.user,
        (value) => {
          if(store.getters.isUser){
            next()
          } else {
              next({name: routeToGo})
          }
        }
      )
  } else if(routeTo.matched.some(record => record.meta.requiresAuth && record.meta.isGeek)){
		let routeToGo = ''
		routeTo.matched.some(record => {
			routeToGo = record.meta.redirectOnUnAuth
		})
		store.watch(
			(state) => state.user,
			(value) => {
				if(store.getters.isGeek){
					next()
				} else {
					next({name: routeToGo})
				}
			}
		)
  } else if(roadToAuth.includes(routeTo.name) &&  loggedIn ){
	next('/')
  }
  next()

});

router.afterEach((routeTo,routeFrom) => {
  NProgress.done()

});

export default router
