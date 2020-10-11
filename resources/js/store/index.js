import Vue from 'vue'
import Vuex from 'vuex'
import EventService from '../services/EventService'
import nProgress from 'nprogress'
import swal from 'sweetalert';


Vue.use(Vuex)

export default new Vuex.Store({
    state:{
        user: null,
        tags: [],
        categories: [],
        geeks: [],
        users: [],
        refunds: [],
    },
    mutations:{
        SET_USER_DATA(state,userData){
            state.user = userData.user
            localStorage.setItem('user_token',JSON.stringify(userData.access_token))
            EventService.setToken(userData.access_token)
        },
        SET_USER_DATA_ON_REFRESH(state,user){
            state.user = user
        },
        SET_NEW_USER_DATA(state,user){
            state.user = user
        },
        CLEAR_USER_DATA(state){
            // state.user = null
            localStorage.removeItem('user_token')
            // EventService.removeToken()
            location.reload()
        },
        SET_AVATAR(state,avatarPath){
            state.user.avatar = `${avatarPath}`
        },
        SET_REFUND(state,data){
            state.refunds = data
        },
        DELETE_MESSAGE(state,id){
            state.user.geek_question = state.user.geek_question.filter(ques =>  ques.id !== id)
            state.user.user_question = state.user.user_question.filter(ques =>  ques.id !== id)
        },
        DELETE_NOTIFICATION(state,id){
            state.user.notifications = state.user.notifications.filter(notification =>  notification.id !== id)
        },
        ADD_POST_TO_USER(state,data){
            state.user.posts.push(data)
        },
        ADD_CERTIFICATION_TO_USER(state,data){
            state.user.certifications.push(data)
        },
        SET_CERTIFICATION_TO_USER(state,data){
            state.user.certifications  = data
        },
        SET_CATEGORIES(state,data){
            data.map(cat => {
                let name = cat.name;
                if(cat.sub_categories && cat.sub_categories.length){
                    let sub_cat= cat.sub_categories.split(',');

                    state.categories.push({
                        name : name,
                        sub_cat : sub_cat,
                        [name] : sub_cat
                    });

                } else {
                    let sub_cat= [];
                    state.categories.push({name: name, sub_cat: sub_cat})

                }
            });

        },
        SET_TAGS(state,data){
            state.tags.push(...data);
        },
        SET_USERS(state,data){
            state.users.push(...data);
        },
        SET_GEEKS(state , data){
            state.geeks.push(...data)
        },
        ADD_FAVOURITE(state,data){
            state.user.favourites = data.favourites
        },
        UPDATE_BOOKING(state, data){
            state.user.booked = data
        },
        UPDATE_USER_BOOKING(state, data){
            state.user.bookings.push(data)
        },
        UPDATE_ANSWER(state, data){
            const question = state.user.geek_question.find(ques => ques.id === data.id);
            Object.assign(question, data);
        },
        SEND_MESSAGE(state  , data){
            state.user.user_question.push(data)
        }
    },
    actions:{
        register({commit} , userCredentials){
            return EventService.register(userCredentials).then(({data}) => {
                commit('SET_USER_DATA',data)
            })
        },
        userRegister({commit} , userCredentials){
            nProgress.start()
            return EventService.userRegister(userCredentials).then(({data}) => {
                commit('SET_USER_DATA',data)
                nProgress.done()
            })
        },
        login({commit} , userCredentials){
            nProgress.start()
            return EventService.login(userCredentials).then(({data}) => {
                commit('SET_USER_DATA',data)
                nProgress.done()
            })
        },
        userLogin({commit} , userCredentials){
            nProgress.start()
            return EventService.userLogin(userCredentials).then(({data}) => {
                commit('SET_USER_DATA',data)
                nProgress.done()
            })
        },
        logout({commit}){
            commit('CLEAR_USER_DATA')
        },
        socialLogin({commit},user){
            commit('SET_USER_DATA',user)
        },
        dataOnRefresh({commit},user){

            commit('SET_USER_DATA_ON_REFRESH',user)
        },
        uploadAvatar({commit},data){
            nProgress.start()
            return EventService.uploadAvatar(data)
                .then(({data}) => {
                    commit('SET_AVATAR',data);
                    nProgress.done()
                }).catch((err) => {
                    return 'Image was not Uploaded'
                });
        },
        settingsSave({commit},user){
            nProgress.start()
            return EventService.saveUser(user,user.user.id)
                    .then(({data}) => {
                        commit('SET_NEW_USER_DATA',data)
                        swal("Success!", 'Settings Updated', "success");
                        nProgress.done()
                    }).catch((err) => {
                        if(err.response.status === 444){
                            swal("Opps!", `${err.response.data}`, "error");
                        }
                        nProgress.done()
                    });
        },
        addPost({commit}, data){
            commit('ADD_POST_TO_USER',data);
        },
        addCertification({commit}, data){
            commit('ADD_CERTIFICATION_TO_USER',data);
        },
        setCategories({commit}, data){
            commit('SET_CATEGORIES', data)
        },
        setUsers({commit}, data){
            commit('SET_USERS', data)
        },
        setTags({commit}, data){
            commit('SET_TAGS', data)
        },
        setGeeks({commit} , data){
            commit('SET_GEEKS', data)
        },
        addToFavourite({commit , state},geekId){
            let data = {
                'user_id' : state.user.id,
                'favourite_id' : geekId
            }
            nProgress.start();
            return EventService.addToFavourite(data)
                .then(({data}) => {
                    nProgress.done();
                    commit('ADD_FAVOURITE',data);
                });
        },
        updateBooking({commit},bookInfo){
            nProgress.start();
            EventService.updateBooking(bookInfo)
                .then(({data}) => {
                    console.log(data)
                    commit('UPDATE_BOOKING',data)
                    swal("Success!", 'Booking Confirmed!', "success");
                    nProgress.done();
                    location.reload();

                }).catch((err) => {
                    nProgress.done();
                    console.log(err)
                });
        },
        updateUserBooking({commit},data){
            commit('UPDATE_USER_BOOKING', data);
        },
        answerQuestion({commit}, question){
            nProgress.start();
            EventService.answerQuestion(question)
            .then(({data}) => {
                commit('UPDATE_ANSWER', data);
                nProgress.done();
                swal("Success!", 'Question Replied', "success");
            }).catch((err) => {
                nProgress.done();
            });
        },
        sendMessage({commit, state} , data){
            nProgress.start();
            let newData = {user_id  : state.user.id}
            let allData = Object.assign(data,newData)
            return EventService.sendMessage(allData)
            .then(({data}) => {
                nProgress.done();
                commit('SEND_MESSAGE',data);
            }).catch((err) => {
                console.log(err)
            });
        },
        deleteCertificate({commit, state},id){
            nProgress.start()
            return EventService.deleteCertificate(id)
                .then(({data}) => {
                    commit('SET_CERTIFICATION_TO_USER', data);
                    nProgress.done();
                });
        },
        withdrawRequest({commit},data){
            nProgress.start();
            return EventService.withdrawRequest(data)
                .then(({data}) => {
                    swal("Success!", 'Your Withdraw Request has been sent!', "success");
                    nProgress.done();
                });
        },
        setRefund({commit},data){
            commit('SET_REFUND', data);
        },
        deleteQuestion({commit},id){
            return EventService.deleteQuestion(id)
            .then(({data}) => {
                commit('DELETE_MESSAGE', data.id);
            });
        },
        deleteNotification({commit},id){
            return EventService.deleteNotification(id)
            .then(({data}) => {
                commit('DELETE_NOTIFICATION', data.id);
            });
        }
    },
    getters:{
        loggedIn(state){
            return !!state.user;
        },
        isUser(state){
            return (state.user.role === 'user') ? true:false;
        },
        isGeek(state){
            return (state.user.role === 'expert') ? true:false;
        },
        currentUser(state){
            return state.user;
        },
        refundsBookingId(state){
            return state.refunds.map((refund) => refund.booking_id);
        },
        refunds(state){
            return state.refunds;
        },
        userBookings(state){
            if(state.user.role === 'user'){
                return state.user.bookings;
            }
        },
        userQuestions(state){
            if(state.user.role === 'user'){
                return state.user.user_question.reverse();
            }
        },
        geekBooked(state){
            // if(state.user.role === 'expert'){
                return state.user.booked;
            // }
        },
        geekQuestions(state){
            if(state.user.role === 'expert'){
                return state.user.geek_question.reverse();
            }
        },
        tags(state){
            return state.tags;
        },
        categories(state){
            return state.categories;
        },
        geeks(state){
            return state.geeks;
        },
        users(state){
            return state.users;
        },
        getGeekByUsername(state){
            return function(username) {
                return state.geeks.find(geek => geek.username === username)
            }
        },
        favouriteGeeks(state){
            return  state.user.favourites.map((fav) => fav.favourite_id)
        },
        getGeekByID(id){
            return function(id) {
                return state.geeks.find(geek => geek.id === id)
            }
        },
        getGeekBySearch(state){
            return function(text) {
                if(text === 'all'){
                    return state.geeks
                }

                text  = text.toLowerCase()
                return state.geeks.filter(geek => {
                    if(geek.main_service || geek.sub_cat || geek.tags.length){
                        return ((geek.main_service ? geek.main_service.toLowerCase().includes(text): false) || (geek.sub_cat ? geek.sub_cat.toLowerCase().includes(text) : false) ||
                        (geek.tags.length ? geek.tags.map(tag => tag.name).join(",").toLowerCase().includes(text) : false)
                        )
                    }
                })
            }
        },
    },
})