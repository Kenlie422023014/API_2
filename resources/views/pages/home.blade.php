@extends('layouts.app-public')
@section('title','home')
@section('content')
    <div class="site-wrapper-reveal">
        <div class="hero-box-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Hero Slider Area Start -->
                        <div class="hero-area" id="product-preview">
                        </div>
                        <!-- Hero Slider Area End -->
                    </div>
                </div>
            </div>
        </div>
    
        <div class="about-us-area section-space--ptb_120">
            <div class="container">
                <div class="row">
                    <div class="about-us-content_6 text-center">
                    <div class="col-lg-12">
                        <h2>Pandora Interior.&nbsp;&nbsp;Store</h2>
                        <p>
                            <small>
                            Welcome to Pandora Interior, your premier destination for all your elegant and functional home interior needs. 
                            We offer a wide range of high-quality products, from modern furniture to unique decor items that will transform every room into your dream space. With a collection that always follows the latest trends and is designed by experts, we ensure that every item you choose not only enhances the aesthetics but also adds comfort to your home. Explore our extensive catalog and find inspiration to create a captivating and charming atmosphere in every corner of your home. 
                            Shop easily, securely, and satisfyingly only at Pandora Interior.
                            </small>
                        </p>
                        <p class="mt-5">Find more about us!
                            <span class="text-color-primary"> Our other website.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner Video Area Start -->
        <div class="banner-video-area overflow hidden">
            <div class="container">
                <div class="row">
                    <div class="banner-video-box">
                        <img src="https://www.magd.ox.ac.uk/wp-content/uploads/2022/07/3027-052-2000x1000.jpg" alt="">
                        <div class="video-icon">
                            <a href="https://www.youtu.be/Na5KPnx0uS8?" class="popup-youtube">
                            <i class="linear-ic-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <!-- Banner Video Area end -->

        <!--our member area start -->
        <div class="our member-area section-space--pb_120">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="member--box">
                            <div class="row align-items-center">
                                <div class= "col-lg-5 col-md-4">
                                    <div class="section-title small-mb__40 
                                    tablet -mb__40">
                                        <h4 class="section title"> Join our membership </h4>
                                        <p>Get Special Discount</p>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-8">
                                    <div class="member-wrap">
                                        <form action="#" class= "member--two">
                                            <input class="input-box" type="text"
                                            placeholder="Your email address">
                                            <button class="submit-btn"><i 
                                            class="icon-arrow-right"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--our member area End -->

 <!-- Our Brand Area Start -->
 <div class="our-brand-area section-space--pb_90">
            <div class="container">_
                <div class="brand-slider-active">
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb1.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb2.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb3.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb4.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb5.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb6.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb7.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb8.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Brand Area End -->

</div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('pages/js/home.js')}}"></script>
@endsection
