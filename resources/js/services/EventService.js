import axios from 'axios'

const apiClient = axios.create({
  // baseURL: `${axios.defaults.baseURL}`,
  // withCredentials: false,
  headers: {
    Accept: 'application/json',
	'Content-Type': 'application/json'
  }
}
)


apiClient.interceptors.request.use(config => {
	const token = JSON.parse(localStorage.getItem('user_token'));
	if (token) {
		config.headers.common['Authorization'] = 'Bearer ' + token
	}
	return config
   })
// apiClient.interceptors.response.use(response => {
//   NProgress.done()
//   return response
// })

export default {
  // Geeks
  register(credentials) {
    return apiClient.post('/api/auth/register', credentials)
  },
  login(credentials) {
    return apiClient.post('/api/auth/login', credentials)
  },
  me(token){
    return apiClient.get('/api/auth/geek?token='+token, { headers: {Accept : "application/json"}})
  },
  // Users
  userRegister(credentials) {
    return apiClient.post('/api/auth/user/register', credentials)
  },
  userLogin(credentials) {
    return apiClient.post('/api/auth/user/login', credentials)
  },
  user(token){
    return apiClient.get('/api/auth/user?token='+token, { headers: {Accept : "application/json"}})
  },

  uploadAvatar(data){
    return apiClient.post('/api/auth/avatarUpload',data)
  },
  uploadImage(data){
    return apiClient.post('/api/auth/uploadImage',data)
  },
  saveUser(data,id){
    return apiClient.post(`/api/auth/geeks/${id}`,data)
  },
  fetchTags(){
    return apiClient.get('/api/auth/tags')
  },
  fetchCategory(){
    return apiClient.get('/api/auth/categories')
  },
  fetchGeeks(){
    return apiClient.get('/api/auth/geeks')
  },
  fetchUsers(){
    return apiClient.get('/api/auth/users')
  },
  fetchGeekByUsername(name){
    return apiClient.get(`/api/auth/geeks/${name}`)
  },
  savePost(data){
    return apiClient.post('/api/auth/posts',data)
  },
  saveCertification(data){
    return apiClient.post('/api/auth/certifications',data)
  },
  addToFavourite(data){
    return apiClient.post('/api/auth/addToFav',data)
  },
  makePayment(data){
    return apiClient.post('/api/auth/payment/makePayment',data)
  },
  updateBooking(data){
    return apiClient.post('/api/auth/update/booking',data)
  },
  answerQuestion(data){
    return apiClient.post('/api/auth/questionAnswer',data)
  },
  sendMessage(data){
    return apiClient.post('/api/auth/questionAsk',data)
  },
  deleteCertificate(id){
    return apiClient.get(`/api/auth/certificates/${id}`)
  },
  isMeetingReady(meetingId){
    return apiClient.get(`/api/auth/bbb/meetings/`, {meetingId})
  },
  getRecordings(meetingId){
    return apiClient.post(`/api/auth/bbb/meetings/recordings`, {id:meetingId})
  },
  setEarnings(data){
    return apiClient.post(`/api/auth/earningsSet`, {data})
  },
  submitReview(data){
    return apiClient.post(`/api/auth/reviews`, {data})
  },
  submitRefund(data){
    return apiClient.post(`/api/auth/request-refund`, {data})
  },
  withdrawRequest(data){
    return apiClient.post('/api/auth/withdraw_request',{data})
  },
  getWithdrawRequests(){
    return apiClient.get('/api/auth/get_withdraw_requests')
  },
  forgetPassword(data){
    return apiClient.post('/api/auth/forgot_password',data)
  },
  getNotificationNumber(){
    return apiClient.get('/api/auth/get_notification_number')
  },
  markRead(id){
    return apiClient.get(`/api/auth/mark_read/${id}`)
  },
  markReadAll(){
    return apiClient.get('/api/auth/mark_read_all')
  },
  getHomepageContent(){
    return apiClient.get('/api/auth/homepage/content')
  },
  fetchRefund(){
    return apiClient.get('/api/auth/refunds');
  },
  confirmRefund(data){
    return apiClient.post('/api/auth/refund',{data});
  },
  rejectRefund(data){
    return apiClient.post('/api/auth/refund/reject',{data});
  },
  deleteQuestion(id){
    return apiClient.get(`/api/auth/questions/delete/${id}`);
  },
  deleteNotification(id){
    return apiClient.get(`/api/auth/notifications/delete/${id}`);
  },
  setToken(userToken){
    apiClient.defaults.headers.common['Authorization'] = `Bearer ${userToken}`;
    axios.defaults.headers.common['Authorization'] = `Bearer ${userToken}`;
  },
  removeToken(){
    axios.defaults.headers.common['Authorization'] = null
  }
}
