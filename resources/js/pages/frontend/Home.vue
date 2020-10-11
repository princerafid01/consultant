<template>
    <div class="home-wrapper " v-if="contents">
        <div class="header hero-area   ">
            <div class="container w-sm-80 mx-auto">
                <div class="row flex flex-wrap justify-between items-center justify-center">
                    <div class=" w-full md:w-1/2 tablet:w-1/2 lg:w-5/12 mt-5">
                    <div class="top-image-container">
                        <img :src="`/storage/app/public/${contents.top_area_image}`" class="header-right img-responsive avatar-400 object-contain" alt="">
                    </div>
                    </div>
                    <div class="w-full md:w-1/2 tablet:w-1/2 px-2 lg:w-5/12   sm:mt-5 sm:pt-5 ">
                        <h1 class="mb-2 pt-5 mt-2 text-4xl md:text-5xl text-6xl site-header" v-html="contents.top_area_title">
                        </h1>
                        <p class="mb-2 site-paragraph text-base tablet:text-lg md:text-lg " v-html="contents.top_area_paragraph"></p>
                        <!-- <router-link :to="{name: 'geeks', params: {text:'all'}}" class="btn btn-info px-5 py-3 cta">Book Now</router-link> -->


                        <router-link :to="{name: 'registration'}" class="btn btn-info px-5 py-3 cta">Register Now</router-link>
                    </div>


                </div>
            </div>

        </div>

        <!-- <div class="features text-center d-block mt-5 pt-5">
            <div class="container w-sm-80 mx-auto">
                <div class="row my-5">
                    <div class="col-lg-3 col-md-6 col-sm-6 mt-5">
                        <img class="d-block mb-5" src="/public/frontend/img/features/feature-1.png" alt="">
                        <h5>Learn</h5>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mt-5">
                        <img class="d-block mb-5" src="/public/frontend/img/features/feature-2.png" alt="">
                        <h5>Chat</h5>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mt-5">
                        <img class="d-block mb-5" src="/public/frontend/img/features/feature-3.png" alt="">
                        <h5>Grow</h5>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mt-5">
                        <img class="d-block mb-5" src="/public/frontend/img/features/feature-4.png" alt="">
                        <h5>Mentor</h5>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="header p-0 marginer   "  id="services">
            <div class="container mx-auto px-4 w-sm-80">
                <div class="row flex flex-wrap justify-between items-center justify-center">

                    <div class="col-xs-12 col-md-5 col-md-offset-1 text-head">
                        <h1 class="mb-5 site-header" v-html="contents.middle_area_title">
                        </h1>
                        <p class="mb-5 site-paragraph" v-html="contents.middle_area_paragraph"> </p>
                         <!-- <VueFaqAccordion  :items="services"/> -->
                    </div>

                    <div class="col-xs-12 col-md-5 col-md-offset-1 sm:mt-5 sm:pb-5 d-block">
                        <img :src="`/storage/app/public/${contents.middle_area_image}`" class="header-right img-responsive avatar-400 object-contain" alt="">
                    </div>

                </div>
            </div>
        </div>


        <div class="header pt-0 mt-0 marginer">
            <div class="container w-sm-80 mx-auto">
                <div class="row flex flex-col-reverse md:flex-row justify-center items-center">
                    <div class="w-full md:w-1/2 lg:w-5/12 col-md-offset-1">
                        <img :src="`/storage/app/public/${contents.last_area_image}`" class="header-right img-responsive avatar-400 object-contain" alt="">
                    </div>
                    <div class="w-full md:w-1/2 lg:w-5/12 col-md-offset-1 text-head">
                        <h1 class="mb-5 mt-5 site-header" v-html="contents.last_area_title">
                        </h1>
                        <p class="mb-5 site-paragraph" v-html="contents.last_area_paragraph"> </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="featured mt-0 pt-0 pb-5 marginer text-center pt-5"  id="news">
            <h1 class="mb-5 text-2xl sm:text-3xl md:text-4xl lg:text-5xl mt-4">Expense Geeks </h1>
            <div class="container mx-auto w-sm-80">
                <div class="row flex flex-col lg:flex-row">
                    <div class="w-full sm:w-7/12 mx-auto  lg:w-1/3 ">
                        <div class="feat mr-lg-5 mt-4 shadow-md">
                            <img class="h-64 w-64 object-contain" :src="`storage/app/public/${contents.box_one_image}`" alt="featured">
                            <h3 class="site-sub-header" v-html="contents.box_one_title"></h3>
                            <p v-html="contents.box_one_sub ">
                            </p>

                        </div>
                    </div>
                    <div class="w-full sm:w-7/12 mx-auto  lg:w-1/3">
                        <div class="feat mr-lg-5  mt-4 ">
                            <img class="h-64 w-64 object-contain" :src="`storage/app/public/${contents.box_two_image}`" alt="featured">
                            <h3 class="site-sub-header" v-html="contents.box_two_title"></h3>
                            <p v-html="contents.box_two_sub">
                            </p>

                        </div>
                    </div>
                    <div class="w-full sm:w-7/12 mx-auto  lg:w-1/3">
                        <div class="feat mr-lg-5  mt-4 shadow-md">
                            <img class="h-64 w-64 object-contain" :src="`storage/app/public/${contents.box_three_image}`" alt="featured">
                            <h3 class="site-sub-header"  v-html="contents.box_three_title"></h3>
                            <p v-html="contents.box_three_sub">
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div> -->
<!--
        <div class="header contact pt-0 mb-0 marginer pb-5 mt-5"  id="contact">
            <div class="container w-sm-80 mx-auto">
                <div class="row">

                    <div class="col-md-5 col-md-offset-1 text-head">
                        <h1 class="my-2 text-3xl md:text-5xl lg:text-5xl">
                            Questions? <br/> Get in touch
                        </h1>
                        <p class="mb-5  text-2xl">We'll be happy to help answer any of your questions. Send us an email and we'll get back to you shortly. </p>
                        <a href="#" class="btn btn-info px-5 py-3 cta">Send an Email</a>
                    </div>

                    <div class="col-md-6">
                        <img src="/public/frontend/img/contact.png" class="header-right w-100 img-responsive" alt="">
                    </div>
                </div>
            </div>
        </div> -->










        <!-- <div class="jobs my-5 border-none outline-none w-full">
            <div class="container w-sm-80 mx-auto ">
                <h5 class="py-5 class text-2xl text-5xl">Browse Jobs by Category</h5>
                <div class="row text-center flex flex-wrap">
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                        <div class="job-card hover:scale-50 bg-gray-100 hover:bg-white rounded">
                            <a href="">
                            <img src="/public/frontend/img/web.png" alt="">

                            <h6 class="py-5 py-5 text-primary font-semibold text-3xl text-left">Tech & Programming</h6>
                            <p>Web, Mobile App, Infrastructure,Data Analytics</p>
                            </a>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                        <div class="job-card hover:scale-50 bg-gray-100 hover:bg-white rounded">
                            <a href="">
                            <img src="/public/frontend/img/web.png" alt="">

                            <h6 class="py-5 text-primary font-semibold text-3xl text-left">Tech & Programming</h6>
                            <p class="text-gray-800">Web, Mobile App, Infrastructure,Data Analytics</p>
                            </a>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                        <div class="job-card hover:scale-50 bg-gray-100 hover:bg-white rounded">
                            <a href="">
                            <img src="/public/frontend/img/web.png" alt="">

                            <h6 class="py-5 py-5 text-primary font-semibold text-3xl text-left">Tech & Programming</h6>
                            <p>Web, Mobile App, Infrastructure,Data Analytics</p>
                            </a>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                        <div class="job-card hover:scale-50 bg-gray-100 hover:bg-white rounded">
                            <a href="">
                            <img src="/public/frontend/img/web.png" alt="">

                            <h6 class="py-5 py-5 text-primary font-semibold text-3xl text-left">Tech & Programming</h6>
                            <p>Web, Mobile App, Infrastructure,Data Analytics</p>
                            </a>
                        </div>
                    </div>


                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                        <div class="job-card hover:scale-50 bg-gray-100 hover:bg-white rounded">
                            <a href="">
                            <img src="/public/frontend/img/web.png" alt="">

                            <h6 class="py-5 py-5 text-primary font-semibold text-3xl text-left">Tech & Programming</h6>
                            <p>Web, Mobile App, Infrastructure,Data Analytics</p>
                            </a>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                        <div class="job-card hover:scale-50 bg-gray-100 hover:bg-white rounded">
                            <a href="">
                            <img src="/public/frontend/img/web.png" alt="">

                            <h6 class="py-5 py-5 text-primary font-semibold text-3xl text-left">Tech & Programming</h6>
                            <p>Web, Mobile App, Infrastructure,Data Analytics</p>
                            </a>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                        <div class="job-card hover:scale-50 bg-gray-100 hover:bg-white rounded">
                            <a href="">
                            <img src="/public/frontend/img/web.png" alt="">

                            <h6 class="py-5 py-5 text-primary font-semibold text-3xl text-left">Tech & Programming</h6>
                            <p>Web, Mobile App, Infrastructure,Data Analytics</p>
                            </a>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                        <div class="job-card hover:scale-50 bg-gray-100 hover:bg-white rounded">
                            <a href="">
                            <img src="/public/frontend/img/web.png" alt="">

                            <h6 class="py-5 py-5 text-primary font-semibold text-3xl text-left">Tech & Programming</h6>
                            <p>Web, Mobile App, Infrastructure,Data Analytics</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="hiw mt-5 pb-5">
            <div class="container w-sm-80 mx-auto">
                <h5 class="py-5">Hiring on Geeks: How it Works</h5>
                <div class="row text-center">
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-4 flex flex-col justify-center items-center">
                            <img src="/public/frontend/img/how-work/how-work-1.png" alt="">

                            <h6 class="py-3 px-0 mx-0 my-4 text-4xl font-bold text-teal-700 text-left">Job Listing or Offer</h6>
                            <p>Post a job and wait for  proposals, or send offers directly to suitable
candidates.</p>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-4 flex flex-col justify-center items-center">
                            <img src="/public/frontend/img/how-work/how-work-2.png" alt="">

                            <h6 class="py-3 px-0 mx-0 my-4 text-4xl font-bold text-teal-700 text-left">Negotiation & Contract</h6>
                            <p>Negotiate terms such as scope, fee, and deadline. Contract with your
freelancer and pay the escrow deposit.</p>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-4 flex flex-col justify-center items-center">
                            <img src="/public/frontend/img/how-work/how-work-3.png" alt="">

                            <h6 class="py-3 px-0 mx-0 my-4 text-4xl font-bold text-teal-700 text-left">Work Starts</h6>
                            <p>The freelancer will commence working on your project. All communications are done through Geeks.</p>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-4 flex flex-col justify-center items-center">
                            <img src="/public/frontend/img/how-work/how-work-4.png" alt="">

                            <h6 class="py-3 px-0 mx-0 my-4 text-4xl font-bold text-teal-700 text-left">Submission / Approval</h6>
                            <p>The freelancer submits the work for your review. Once you approve, the freelancer will receive payment.</p>
                    </div>
                </div>
            </div>
        </div> -->

    <!-- <div class="experts my-5">
        <div class="container w-sm-80 mx-auto">
            <div class="row mt-5 flex flex-wrap justify-center items-center">
                <div class="col-md-6">
                    <img src="/public/frontend/img/interface/man.png" alt="" class="img-responsive">
                </div>
                <div class="col-md-6 mb-5">
                    <p class="pt-5 mt-5 pr-4">97% of experts with 6+ years of professional Freelancer</p>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="silder pt-5 ">
        <div class="container  mx-auto">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/public/frontend/img/apost.png" class="d-block mb-4"  alt="">
                        <br>
                        <span class="pt-4 text-dark-gray my-4 h4">“At Vero Eos Et Accusamus Et Iusto Odio Dignissimos Ducimus Qui Blanditiis Praesentium Voluptatum Deleniti Atque Corrupti Quos Dolores Et Quas Molestias Excepturi Sint Occaecati Cupiditate Non Provident, Similique Sunt In Culpa” </span>
                        <div class="media text-center middle mt-5">
                            <img class="mr-3" src="/public/frontend/img/client.png" alt="Generic placeholder image">
                            <div class="media-body text-left pt-3 pl-3">
                                <h5 class="mt-0">Graphics Designer</h5>
                                Samuel Smith
                            </div>
                            </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/public/frontend/img/apost.png" class="d-block mb-4"  alt="">
                        <br>
                        <span class="pt-4 text-dark-gray my-4 h4">“At Vero Eos Et Accusamus Et Iusto Odio Dignissimos Ducimus Qui Blanditiis Praesentium Voluptatum Deleniti Atque Corrupti Quos Dolores Et Quas Molestias Excepturi Sint Occaecati Cupiditate Non Provident, Similique Sunt In Culpa” </span>
                        <div class="media text-center middle mt-5">
                            <img class="mr-3" src="/public/frontend/img/client.png" alt="Generic placeholder image">
                            <div class="media-body text-left pt-3 pl-3">
                                <h5 class="mt-0">Graphics Designer</h5>
                                Samuel Smith
                            </div>
                            </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/public/frontend/img/apost.png" class="d-block mb-4"  alt="">
                        <br>
                        <span class="pt-4 text-dark-gray my-4 h4">“At Vero Eos Et Accusamus Et Iusto Odio Dignissimos Ducimus Qui Blanditiis Praesentium Voluptatum Deleniti Atque Corrupti Quos Dolores Et Quas Molestias Excepturi Sint Occaecati Cupiditate Non Provident, Similique Sunt In Culpa” </span>
                        <div class="media text-center middle mt-5">
                            <img class="mr-3" src="/public/frontend/img/client.png" alt="Generic placeholder image">
                            <div class="media-body text-left pt-3 pl-3">
                                <h5 class="mt-0">Graphics Designer</h5>
                                Samuel Smith
                            </div>
                            </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div> -->

<!-- <div class="spacer-y-10 h-10"></div>
    <div class="quotes mt-5 py-5 bg-primary">
        <div class="container w-sm-80 mx-auto">
            <div class="row">
                <div class="col-md-6">
                    <h1>
                        Get Quotes from Top Freelance Professionals for Free!
                    </h1>
                    <p>Free estimate • No obligation to hire • 100% risk-free</p>
                </div>
                <div class="col-md-5 col-lg-6 ">
                    <a href="" class="btn btn-info  md:float-right mt-5 px-5 py-3">Post a Job Now</a>
                </div>
            </div>
        </div>
    </div> -->
</div>


</template>

<script>
import VueFaqAccordion from 'vue-faq-accordion'
import EventService from '../../services/EventService'

    export default {
        components: {
            VueFaqAccordion
        },
        data() {
            return {
                services: [
                    {
                        title: 'Website Design',
                        value: 'Given a 24-hour day and 360 degrees of longitude around the Earth. Given a 24-hour day and 360 degrees of longitude around the Earth. Given a 24-hour day and 360 degrees of longitude around the Earth. Given a 24-hour day and 360 degrees of longitude around the Earth.',
                    },
                    {
                        title: 'Application Development',
                        value: 'Venus takes 224.7 Earth days to complete one orbit around the Sun. Given a 24-hour day and 360 degrees of longitude around the Earth. Venus takes 224.7 Earth days to complete one orbit around the Sun. Given a 24-hour day and 360 degrees of longitude around the Earth.Venus takes 224.7 Earth days to complete one orbit around the Sun. Given a 24-hour day and 360 degrees of longitude around the Earth.',
                    },
                ],
                contents: null
            }
        },
        created(){
            EventService.getHomepageContent()
            .then(({data}) => {
                this.contents = data
                $(".loader").hide();
            })
        }
    }
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');
.home-wrapper {
  background-color: #F4F4F4!important;
}
p{
    text-align: justify;
}

.header {
    padding-top: 100px;
    // background: url('/public/frontend/img/header_bg.png') no-repeat;
    background-size: cover;
}
.marginer {margin-top: 40px!important;}
img.header-right {
    width: 100%;
}


.header a.cta {
    // color: #ffffff;
    font-size: 16px;
    border: none;
    // border-radius: 10px;
    font-family: Poppins;
    font-weight: 600;
    background: #009dff !important;
    padding: 12px 40px !important;
    border-radius: 100px;
    color: #fff;
}
.header a.cta:hover {
    background: #455CC7 !important;
}
.text-head {
    margin-top: 5%;
}
.img-head {
    margin-top: 5%;
}
.container {
    width: 100%;
    display: block;
    max-width: 1700px;
    margin: 0 auto;
    padding-left: 100px;
    padding-right: 80px;
}
.features h5{
    font-size: 35px;
    font-family: Montserrat;
    font-weight: 800;
    color: #303669;
    margin-top: 10px;
    margin-bottom: 10px;
}
.features  img{margin: 0 auto;}
.features  p{
    font-size: 16px;
    color: #151D23;
    padding: 0 30px;
    max-width: 350px;
    margin: 0 auto;
}
.jobs  h5 , .hiw  h5{
    font-size: 35px;
    color: #151D23;
    font-weight: bold;
}
.jobs  h6  , .hiw  h6{
    font-size: 16px;
    color: #151D23;
    font-weight: bold;
}
.jobs  p , .hiw p  {
    font-size: 18px;
    color: #151D23;
}
.experts p {
    font-size: 33px;
    color: #151D23;
    font-weight: bold;
}


.jobs .job-card {
    padding: 25px 30px;
    -webkit-box-shadow: -1px 4px 15px -7px rgba(0,41,222,0.65);
    -moz-box-shadow: -1px 4px 15px -7px rgba(0,41,222,0.65);
    box-shadow: -1px 4px 15px -7px rgba(0,41,222,0.65);
    // margin-right: 25px;
    margin-bottom: 25px;
    // max-width: 270px;
}
.home-wrapper{
    background: #fff;
}
.features img {
    max-width: 150px;
}
.job-card img {
    max-width: 100px;
}
.hiw img {
    max-width: 100px;
}
.quotes {
    // background: url('/public/frontend/img/quote-bg.png') no-repeat;
    background-size: cover;
    background-position: center;
    color: #fff!important;
    display: block;
}
.quotes h1{
    font-size: 30px;
    font-weight: bold;
}

.quotes p {
    font-size: 16px;
    color: #fff!important;
}

.quotes a.btn {
    color: #3C3FA3;
    background: #fff;
    font-size: 17px;
    border: none;
}
.silder {
    font-size: 16px;
    text-align: center;
    line-height: 1.5;
    margin-top: 100px;
}
.silder h5 {
    color: #969CA1;
}
.silder .media-body {
    border-left: 1px solid #969CA1;
}
.silder img.mb-4 {
    margin: 0 auto;
}
.middle {
    margin: 0 auto;
    max-width: 250px;
}

</style>

<style lang="scss">

.header-area {border: none!important;}
.carousel-item {
    padding: 0 20%;
    margin: 0 auto;
}
.carousel-control-next,
.carousel-control-prev {
    filter: invert(100%);
}
// .header-area li a {
//     background: #009DFF;
//     border: 2px solid #009DFF;
//     font-weight: bold;
// }
// .header-area li a:hover{
//     color: #009DFF;
//     background: #fff;
// }
.router-link-active.HeaderButton {
    color: #009DFF!important;
}





.accordion {
  border: none !important;
}
.accordion__item {
  font-size: 16px;
  border: none !important;
  font-size: 18px;
}
.accordion__title {
  font-family: Poppins;
  font-weight: 600;
  color: #fff !important;
  background-color: #3a88ec;
  border-radius: 50px;
  padding: 10px 35px !important;
  display: block;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px!important;
}

.accordion__value{padding: 25px!important;}
.accordion__title-text {
  font-size: 20px;
  color: #fff;
  font-weight: bolder;
}
.accordion__value {
  color: #a5a5a5;
  font-family: Poppins;
  font-size: 14px;
  font-weight: 300;
  line-height: 1.5;
  margin-top: 10px;
}

.accordion__toggle-button {
  color: #fff!important;
}

.accordion__toggle-button::before , .accordion__toggle-button::after {
  background: #fff!important;
}

.featured h1 {
  font-family: Montserrat;
  font-weight: 800;
  font-size: 45px;
  line-height: 1;
  color: #303669;
  margin-bottom: 0;

}

.featured .feat {
  background-color: #fff!important;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  border-radius: 50px;
  padding: 55px 40px;
}
.featured .feat img {
  margin-top: 10px;
  margin-bottom: 25px;
  display: flex;
  justify-content: center;
}

.featured .feat p {
  font-size: 14px;
  color: #000;
  font-family: Poppins;
  font-weight: 300;
  line-height: 1.5;
  text-align: center;
  margin-top: 10px;
  margin-bottom: 10px;
  padding: 0 10px;
}
.featured .feat a {
  font-size: 18px;
  font-family: Montserrat;
  font-weight: 700;
  line-height: 1;
  margin-top: 10px;
}
.featured .feat a:hover {
  color: #ff3e81;
  text-decoration: none;
}
.featured .feat:hover {
  box-shadow: 0 3px 17px rgba(0,0,0,.15);
  cursor: pointer;
  background-color: #fff;
}

.dropdown-menu li a {
    color: #282E63 !important;
}
.dropdown-menu {
    left: -66px!important;
}
.dropdown.profile-m.card {
    border: none;
}


// .featured .feat  {
//     height: 500px;
// }
// .contact img {
//     max-width: 70%!important;
//     margin: 20px auto!important;
// }


.site-header {

    font-family: Montserrat;
    font-weight: 800;
     font-size: 40px;
    line-height: 1;
    padding-bottom: 25px;
    color: #303669;
}
.site-paragraph {
    color: #212529;
    font-family: Poppins;
    font-size: 18px;
    font-weight: 300;
    line-height: 1.5;
    padding-bottom: 15px;
}

.site-sub-header {
  font-size: 24px;
  color: #303669;
  font-family: Montserrat;
  font-weight: 700;
  line-height: 2;
}


@media screen and (max-width: 768px) {
    // .site-header {

    // }
}


</style>

<style scoped>

@media screen and (max-width: 1050px) {
    /* .site-header {

    } */
    .header h1 {
        padding-top: 0!important;
        padding-bottom: 5px!important;
        margin-top: 0;
    }
    .site-paragraph {
        font-size: 14px;
    }
    .site-sub-header {
        font-size: 20px;
    }
    .col-lg-5 img , .col-lg-6 img , .col-lg-4 img {
        max-width: 300px!important;
        margin: 0 auto!important;
    }
    .dropdown-menu {
        left: 0px!important;
    }
    .header-area .dropdown-menu li {
        width: 100%;
    }
    .container {
        padding-left: 10px!important;
        padding-right: 10px!important;
    }
}


</style>




<style scoped>
.w-sm-80 {
    width: 90%;
}


@media (min-width: 361px) and (max-width: 768px) {
.w-sm-80 {
    width: 80%;
}
}
</style>