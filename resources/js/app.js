require('./bootstrap');
window.Vue = require('vue');
import router from './routes'
import store from './store/index.js';
import './globalComponents'
import 'nprogress/nprogress.css'
import EventService from './services/EventService'
import VueAxios from 'vue-axios'
import VueSocialauth from 'vue-social-auth'
import axios from 'axios';

Vue.use(VueAxios, axios)

Vue.use(VueSocialauth, {
    providers: {
        google: {
        clientId: '124613989619-95iuj10ovn59rb6ns2d0nncn1jo803pg.apps.googleusercontent.com',
        redirectUri: 'https://expensegeeks.com/auth/google/callback' // Your client app URL
        },
        linkedin: {
            clientId: '86b5cnabw9xz71',
            redirectUri: 'https://expensegeeks.com/auth/linkedin/callback',
            scope: 'r_liteprofile%20r_emailaddress'
        }
  }
})

Vue.prototype.$imagePath = window.imagePath;

const app = new Vue({
    el: '#app',
    data:{
        initialLoading:true
    },
    router,
    store,
    beforeCreate () {
        this.initialLoading=true;
    },
    created(){
        EventService.fetchCategory().then(({data}) => {
            this.$store.dispatch('setCategories',data)
        }).catch((err) => {
            console.log(err);
        });

        EventService.fetchUsers().then(({data}) => {
            this.$store.dispatch('setUsers',data)
        }).catch((err) => {
            console.log(err);
        });

        EventService.fetchRefund().then(({data}) => {
            this.$store.dispatch('setRefund',data)
        }).catch((err) => {
            console.log(err);
        });

        EventService.fetchGeeks().then(({data}) => {
            this.$store.dispatch('setGeeks',data)
        }).catch((err) => {
            console.log(err);
        })


        EventService.fetchTags()
                .then(({data}) => {
                    this.$store.dispatch('setTags',data)
                }).catch((err) => {
                    console.log(err)
                });

        const userToken = JSON.parse(localStorage.getItem('user_token'));

        if(userToken){
            EventService.fetchRefund().then(({data}) => {
                this.$store.dispatch('setRefund',data)
            })

            const userData = EventService.me(userToken).then(({data}) => {
                EventService.setToken(userToken)
                this.$store.dispatch('dataOnRefresh',data)
            }).catch((err) => {
                localStorage.removeItem('user_token')
                this.$router.push({name: 'login'});
            })
        }

    },
    mounted () {
        // this.initialLoading = false;

    },
});
