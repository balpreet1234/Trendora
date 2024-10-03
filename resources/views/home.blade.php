@extends('layouts.app')
@section('content')

    <section class="home_banner_tendora">
        <div class="container">
            <div class="row">
                <div class="col-md-6 display_none_mobile">

                </div>
                <div class="col-md-6">
                    <div class="under_home_banner">
                        <div class="txt_home">
                            <h1> TRENDS STOCK</h1>
                            <p>There are many variations of passages of Lorem Ipsum available majority have suffered
                                alteration</p>
                            <div class="btn_home_banner">
                                <a href="{{route('trendora.shop')}}">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ornaments_main_accessors">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="under_main_accessories">
                        <ul>
                            <li>
                                <div class="under_main_div">
                                    <div class="main_under_img">
                                        <img src="{{ asset('front_assets/img/Jewellery_1.jpg')}}" alt="">
                                        <div class="text_position">
                                            <h2>Ornaments</h2>
                                            <div class="btn_shop">
                                                <a href="#">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="under_main_div">
                                    <div class="main_under_img">
                                        <img src="{{ asset('front_assets/img/jewellery_2.jpg')}}" alt="">
                                        <div class="text_positions">
                                            <h2>Summer Sale</h2>
                                            <h3>Upto 50% Off</h3>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                <div class=" under_main_accessories">
                    <ul class="bottom_none">
                        <li>
                            <div class="under_main_div">
                                <div class="main_under_img">
                                    <img src="{{ asset('front_assets/img/jewellery_3.jpg')}}" alt="" class="main_img_he">
                                    <div class="text_position">
                                        <h2>Dress</h2>
                                        <div class="btn_shop">
                                            <a href="#">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-12">
                <div class="under_main_accessories">
                    <ul>
                        <li>
                            <div class="under_main_div">
                                <div class="main_under_img">
                                    <img src="{{ asset('front_assets/img/jewellery_4.jpg')}}" alt="">
                                    <div class="text_position">
                                        <h2>Accessories</h2>
                                        <div class="btn_shop">
                                            <a href="#">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="under_main_div">
                                <div class="main_under_img">
                                    <img src="{{ asset('front_assets/img/jewellery_5.jpg')}}
                                   " alt="">
                                    <div class="text_position">
                                        <h2>Bag & Watches</h2>
                                        <div class="btn_shop">
                                            <a href="#">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="best_feature_collectio">
        <div class="container">
            <div class="heading_summer_Collection">
                <span>Summer Collection</span>
                <h2>Best Featured Collection</h2>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-5 col-6">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_1.jpg')}}" class="img-fluid" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_2.jpg')}}" class="img-fluid" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>
                                    <span class="onsale"> Sale</span>
                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Western Dress With Jacket</h2>
                            <p>$109.00 <span>$119.00</span></p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-5 col-6">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_3.jpg')}}" class="img-fluid" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_33.jpg')}}" class="img-fluid" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Women Dot Print Dress</h2>
                            <p>$129.00</p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-5 col-6">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_4.jpg')}}" class="img-fluid" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_44.jpg')}}" class="img-fluid" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Ladies Frock</h2>
                            <p>$120.00 </p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-5 col-6">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_5.jpg')}}" class="img-fluid" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_55.jpg')}}" class="img-fluid" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Full Sleeve Long Dress</h2>
                            <p>$21.00 – $31.00</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="stylish_cloth_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-12">

                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="under_stylish_main">
                        <div class="main_stylish">
                            <span>Summer Collection</span>
                            <h2>Summer Stylish Cloth & Accessories</h2>
                            <p>There are many variations of passages of Lorem Ipsum available majority have suffered
                                alteration</p>
                            <div class="btn_home_banner">
                                <a href="#">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="best_feature_collectio top_spacing pb-0">
        <div class="container">
            <div class="heading_summer_Collection">
                <span>Summer Collection</span>
                <h2>Best Featured Collection</h2>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-5 col-6 mb-4">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_6.jpg')}}" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_66.jpg')}}" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>
                                    <span class="onsale"> Sale</span>
                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Western Dress With Jacket</h2>
                            <p>$109.00 <span>$119.00</span></p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-5 col-6">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_7.jpg')}}" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_77.jpg')}}" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Women Dot Print Dress</h2>
                            <p>$129.00</p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-5 col-6">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_8.jpg')}}" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_88.jpg')}}" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Ladies Frock</h2>
                            <p>$120.00 </p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-5 col-6">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_9.jpg')}}" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_99.jpg')}}" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Full Sleeve Long Dress</h2>
                            <p>$21.00 – $31.00</p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-5 col-6 mb-4">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_6.jpg')}}" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_66.jpg')}}" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>
                                    <span class="onsale"> Sale</span>
                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Western Dress With Jacket</h2>
                            <p>$109.00 <span>$119.00</span></p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-5 col-6">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_7.jpg')}}" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_77.jpg')}}" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Women Dot Print Dress</h2>
                            <p>$129.00</p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-5 col-6">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_8.jpg')}}" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_88.jpg')}}" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Ladies Frock</h2>
                            <p>$120.00 </p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-5 col-6">
                    <div class="under_main_summer">
                        <div class="summer_insight">
                            <div class="imageBox">
                                <div class="box">
                                    <img class="img1" src="{{ asset('front_assets/img/summer_demo_9.jpg')}}" alt="">
                                    <img class="hover_img" src="{{ asset('front_assets/img/summer_demo_99.jpg')}}" alt="">
                                </div>

                                <div class="icon_main_under">
                                    <div class="flx_main_icon">
                                        <i class="fa-solid fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="txt_under_bottom">
                            <h2>Full Sleeve Long Dress</h2>
                            <p>$21.00 – $31.00</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="special_offer_sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-12">
                    <div class="under_special_offer">
                        <div class="special_bg_img">
                            <img src="{{ asset('front_assets/img/special_offer_1.jpg')}}" alt="">
                            <div class="special_cntnt">
                                <span>Special Offer</span>
                                <h2>Upto 60% off</h2>
                                <h3>On Exclusive Branded Clothing</h3>
                                <p>Lorem ipsum dolor sit amet, eu pro summo time recteque, euismod adversarium ne usu.
                                    Vel in numquam democritum.</p>
                                <div class="btn_home_banner">
                                    <a href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-12">
                    <div class="main_spacial_offering">
                        <ul>
                            <li>
                                <div class="ul_li_flexing">
                                    <div class="main_img_ul">
                                        <img src="{{ asset('front_assets/img/special_offer_2.jpg')}}" alt="">
                                    </div>
                                    <div class="text_flx_ul">
                                        <div class="img_company_logo">
                                            <img src="{{ asset('front_assets/img/company-offer-logo-1.png')}}" alt="">
                                            <div class="contnt_fll">
                                                <h3>Min 40% off <br>On Stylish Kurti</h3>
                                                <div class="btn_flx_special">
                                                    <a href="#">Shop Now</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="ul_li_flexing">
                                    <div class="main_img_ul">
                                        <img src="{{ asset('front_assets/img/special_offer_3.jpg')}}" alt="">
                                    </div>
                                    <div class="text_flx_ul">
                                        <div class="img_company_logo">
                                            <img src="{{ asset('front_assets/img/company-offer-logo-2.png')}}" alt="">
                                            <div class="contnt_fll">
                                                <h3>Min 40% off <br>On Stylish Kurti</h3>
                                                <div class="btn_flx_special">
                                                    <a href="#">Shop Now</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="ul_li_flexing">
                                    <div class="main_img_ul">
                                        <img src="{{ asset('front_assets/img/special_offer_4.jpg')}}" alt="">
                                    </div>
                                    <div class="text_flx_ul">
                                        <div class="img_company_logo">
                                            <img src="{{ asset('front_assets/img/company-offer-logo-3.png')}}" alt="">
                                            <div class="contnt_fll">
                                                <h3>Min 40% off <br>On Stylish Kurti</h3>
                                                <div class="btn_flx_special">
                                                    <a href="#">Shop Now</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inspired_image_gallery">
        <div class="container">
            <div class="row g-0">
                <div class="col">
                    <div class="main_under_inspired">
                        <div class="img_gallery">
                            <img src="{{ asset('front_assets/img/gallery_1.jpg')}}" alt="">
                            <div class="main_span_plus">
                                <p>+</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="main_under_inspired">
                        <div class="img_gallery">
                            <img src="{{ asset('front_assets/img/gallery_2.jpg')}}" alt="">
                            <div class="main_span_plus">
                                <p>+</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="main_under_inspired">
                        <div class="img_gallery">
                            <img src="{{ asset('front_assets/img/gallery_3.jpg')}}" alt="">
                            <div class="main_span_plus">
                                <p>+</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="main_under_inspired">
                        <div class="img_gallery">
                            <img src="{{ asset('front_assets/img/gallery_4.jpg')}}" alt="">
                            <div class="main_span_plus">
                                <p>+</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="main_under_inspired">
                        <div class="img_gallery">
                            <img src="{{ asset('front_assets/img/gallery_5.jpg')}}" alt="">
                            <div class="main_span_plus">
                                <p>+</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="online_support_main">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="online_support_flx">
                        <div class="online_img">
                            <img src="{{ asset('front_assets/img/globe-2.svg')}}" alt="">
                        </div>
                        <div class="txt_online_sup">
                            <h2>Online Support</h2>
                            <p>Anetus et malea fames</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="online_support_flx">

                        <div class="online_img">
                            <img src="{{ asset('front_assets/img/shopping-bag-2-1.svg')}}" alt="">
                        </div>
                        <div class="txt_online_sup">
                            <h2>Online Support</h2>
                            <p>Anetus et malea fames</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="online_support_flx">
                        <div class="online_img">
                            <img src="{{ asset('front_assets/img/truck-1.svg')}}" alt="">
                        </div>
                        <div class="txt_online_sup">
                            <h2>Online Support</h2>
                            <p>Anetus et malea fames</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="online_support_flx end_none">
                        <div class="online_img">
                            <img src="{{ asset('front_assets/img/shopping-cart-1.svg')}}" alt="">
                        </div>
                        <div class="txt_online_sup">
                            <h2>Online Support</h2>
                            <p>Anetus et malea fames</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="dont_we_available">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 py-1">
                    <div class="avialable_txt">
                        <p>We are available : 9:00 am – 18:00 pm </p>
                    </div>
                </div>
                <div class="col-md-4 py-1">
                    <div class="avialable_txt">
                        <a href="#"><i class="fa-solid fa-phone"></i> 888 123 4567</a>
                    </div>
                </div>
                <div class="col-md-4 py-1">
                    <div class="avialable_txt">
                        <div class="vailable_flx">
                            <i class="fa-brands fa-facebook-f"></i>
                            <i class="fa-brands fa-twitter"></i>
                            <i class="fa-brands fa-linkedin-in"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



   @endsection
