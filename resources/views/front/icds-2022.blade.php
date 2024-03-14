@extends('front.layouts.app')
@section('page_title')
    {{(!empty($page_title) && isset($page_title)) ? $page_title : ''}}
@endsection
@push('head-scripts')

@endpush
@section('content')

    <!-- ***** Pre Header ***** -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
          <span>The Conference will start from 18<sup>th</sup> November until
            19<sup>th</sup> November.</span>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="text-button">
                        <a href="{{asset('front/downloads/book.pdf')}}" download>Download the Abstract book <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner">
        <div class="counter-content">
            <ul>
                <li>Days<span id="days"></span></li>
                <li>Hours<span id="hours"></span></li>
                <li>Minutes<span id="minutes"></span></li>
                <li>Seconds<span id="seconds"></span></li>
            </ul>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content">
                        <div class="next-show">
                            <i class="fa fa-arrow-up"></i>
                            <span>Time left</span>
                        </div>
                        <h4 style="color: white">
                            <b>Skin and Cosmeceuticals:</b> Production, Practice and
                            Regulations
                        </h4>
                        <br />
                        <h5 style="color: white">ICDS 2022</h5>
                        <h2>2 <sup>nd</sup> International Conference on Dermal Sciences</h2>
                        <div class="main-white-button">
                            <a href="{{asset('front/downloads/book.pdf')}}">Download the Abstract Book</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Event Carousel ***** -->
    <div class="show-events-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-show-events owl-carousel">
                        <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-1.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-2.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-3.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-4.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-5.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-6.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-7.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-8.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-9.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-10.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-11.jpg')}}" alt="" />
                        </div>
                        <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-12.jpg')}}" alt="" />
                        </div>
                        <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-13.jpg')}}" alt="" />
                        </div>
                        <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                            <img style="height: 100%" src="{{asset('front/images/workshop/workshop-14.jpg')}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- *** Amazing Venus ***-->
    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="left-content">
                        <h4>About ICDS 2022:</h4>
                        <p>
                            2nd Edition of International Conference on Dermal Sciences aims
                            to bring together leading cosmetic scientists,
                            environmentalists, democrats, authors, researchers, scholars,
                            activists and practitioners to share and exchange their
                            experiences and research results about all aspects of
                            <b style="font-weight: 550">
                                "Skin & Cosmeceuticals: Production, Practice and Regulations" </b>.
                        </p>
                        <br />
                        <p>
                            Pakistanis spend about 4% of household expenditures on cosmetics
                            and personal care product but most of these products are
                            produced by harmful and unauthorized material. These products
                            are made without following any standard protocol or regulation
                            causing side effect from mild irritation to skin ruptures to
                            cancer. Despite being prevalent, the issue is rarely being
                            discussed especially in Pakistan. This conference will help
                            confront this issue by creating awareness regarding its impact
                            at individual, environmental, national and international level.
                        </p>
                        <br />
                        <p>
                            The Conference will be a 2-day hybrid event. It will be both
                            exciting and ground-breaking in its wide-ranging and
                            multidisciplinary content. In addition to keynote lectures and
                            research presentations by world renowned invited speakers, we
                            will be offering distinguished hands-on workshops and
                            interactive sessions.
                        </p>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- *** Amazing Venus ***-->
    <div class="pt-3" style="border-bottom:2px solid #d1c0c0;">
        <br>
        <div class="container">
            <h4 style="text-align: start;">ICDS 2022 Report</h4>
        </div>
        <br>
        <br>
        <br>
        <div class="show-events-carousel">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="owl-show-events owl-carousel">
                            <div class="item">
                                <img style="height: 240px" src="{{asset('front/images/report/sym-1.jpg')}}" alt="" />
                            </div>

                            <div class="item">
                                <img style="height: 240px" src="{{asset('front/images/report/sym-2.jpg')}}" alt="" />
                            </div>

                            <div class="item">
                                <img style="height: 240px" src="{{asset('front/images/report/sym-3.jpg')}}" alt="" />
                            </div>
                            <div class="item">
                                <img style="height: 240px" src="{{asset('front/images/report/sym-4.jpg')}}" alt="" />
                            </div>
                            <div class="item">
                                <img style="height: 240px" src="{{asset('front/images/report/sym-5.jpg')}}" alt="" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-button text-center py-3">
            <a href="{{asset('front/downloads/icds-2022-report.pdf')}}" target="_blank">Download the ICDS 2022 Report<i
                    class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    <br>
    <h4 style="text-align: center;">Sponsors</h4>
    <br>
    <br>
    <br>

    <div class="show-events-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-show-events owl-carousel">
                        <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                            <img style="height: 240px" src="{{asset('front/images/sponsor/forever.jpg')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                            <img style="height: 240px" src="{{asset('front/images/sponsor/lark.png')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                            <img style="height: 240px" src="{{asset('front/images/sponsor/mazton.png')}}" alt="" />
                        </div>

                        <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                            <img style="height: 240px" src="{{asset('front/images/sponsor/news92.jpg')}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer-scripts')

@endpush
