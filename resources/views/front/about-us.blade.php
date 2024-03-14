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
                    <span>The Conference will start from 13<sup>th</sup> October until 14<sup>th</sup> October.</span>
                </div>
                <div class="col-lg-6 col-sm-6">
                    {{-- <div class="text-button">
                        <a href="{{route('registration')}}">Register Now! <i class="fa fa-arrow-right"></i></a>
                    </div> --}}
                    <div class="text-button">
                        @guest
                            @if (Route::has('registration'))
                                <a href="{{route('login')}}">Login</a>
                                <a class='vr mx-2' style="border-right: 2px solid  #333;"></a>
                                <a href="{{route('registration')}}">Register</i></a>
                            @endif
                        @else
                            <a href="{{Auth::user()->role_status == '1' ? url('admin/dashboard') : route('dashboard')}}">Dashboard</a>
                            <a class='vr mx-2' style="border-right: 2px solid  #333;"></a>
                            <a aria-haspopup="true" aria-expanded="false" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout')}}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- *** Amazing Venus ***-->
    <div class="amazing-venues">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="left-content">
                        <h4>About ICDS:</h4>
                        <p>
                            Department of Dermatology, The University of Faisalabad, is pleased to invite you to
                            participate in the 3rd Edition of the International Conference on Dermal Sciences (ICDS
                            2023) which is scheduled for October
                            13th-14th, 2023, in Faisalabad, Pakistan.
                            <br/>
                            <br/>
                            ICDS aims for an interprofessional approach to develop innovative solutions for skin related
                            problems and to create awareness among health professionals and in the general public
                            regarding skin issues and their
                            psychosocial impact.
                            <br/>
                            <br/>
                            ICDS intends to provide a premier interdisciplinary forum for researchers, scholars,
                            practitioners and academicians from different disciplines interested in skin-related issues.
                            This includes dermatologists, Allied
                            health professionals, cosmetic scientists, skincare experts, psychologists and all others
                            who can contribute to bringing up a solution.
                        </p>
                        <br/>
                        <h5>Organizing Committee</h5>
                        <br/>
                        <br/>
                        <br/>
                        <div class="show-events-carousel">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="owl-show-events owl-carousel">
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; width: 100%; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/secretary.png')}}" alt=""/>
                                                <h5 style="text-align: center; padding: 10px;">
                                                    Chair Person
                                                </h5>
                                                <p style="text-align: center;">
                                                    Prof. Dr. Tanzeela Khalid
                                                </p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/chairScience.png')}}" alt=""/>
                                                <h5 style="text-align: center; padding: 10px;">
                                                    Secretary
                                                </h5>
                                                <p style="text-align: center;">Dr. Rabia Mahmood</p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/coordinator.png')}}" alt=""/>
                                                <h5 style="text-align: center; padding: 10px;">
                                                    Conference Coordinator - International Linkages
                                                </h5>
                                                <p style="text-align: center;">Sana Arshad</p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/sundas-tariq.png')}}" alt=""/>
                                                <h5 style="text-align: center; padding: 10px;">
                                                    Chair Scientific Committee
                                                </h5>
                                                <p style="text-align: center;">Prof Dr Sundas Tariq</p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/naila-riaz.png')}}" alt=""/>
                                                <h5 style="text-align: center; padding: 10px;">
                                                    Publications Committee Chair
                                                </h5>
                                                <p style="text-align: center;">Dr Nailah Riaz</p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/dr-azeem.jpg')}}" alt=""/>

                                                <h5 style="text-align: center; padding: 10px;">
                                                    Member Editorial Board
                                                </h5>
                                                <p style="text-align: center;">Dr Muhammed Azeem</p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/same-ur-rehman.png')}}" alt=""/>

                                                <h5 style="text-align: center; padding: 10px;">
                                                    Member Editorial Board
                                                </h5>
                                                <p style="text-align: center;">Mr Same Ur Rahman</p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/dr-arif-maan.jpg')}}" alt=""/>

                                                <h5 style="text-align: center; padding: 10px;">
                                                    Member Editorial Board
                                                </h5>
                                                <p style="text-align: center;">Prof Dr Arif Maan</p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/sir_ghulam.jpg')}}" alt=""/>

                                                <h5 style="text-align: center; padding: 10px;">
                                                    Member Editorial Board
                                                </h5>
                                                <p style="text-align: center;">Dr Ghulam Abbas</p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/huda-shami.png')}}" alt=""/>

                                                <h5 style="text-align: center; padding: 10px;">
                                                    Conference Coordinator 
                                                </h5>
                                                <p style="text-align: center;">Ms Huda Shami</p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/hira-sultan.jpg')}}" alt=""/>

                                                <h5 style="text-align: center; padding: 10px;">
                                                    Chair Marketing Committee
                                                </h5>
                                                <p style="text-align: center;">Ms Hira Sultan</p>
                                                <p style="color: rgb(252, 249, 249);">.</p>
                                                <br/>
                                            </div>
                                            <div class="item"
                                            style="background-color: rgb(252, 249, 249); height: 620px;">
                                           <img
                                               style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                               src="{{asset('front/images/highlight/organize/omar_farooq.jpg')}}" alt=""/>

                                           <h5 style="text-align: center; padding: 10px;">
                                            Manager Placement Bureau - TUF
                                           </h5>
                                           <p style="text-align: center;">Omer Farooq Qureshi</p>
                                           <p style="color: rgb(252, 249, 249);">.</p>
                                           <br/>
                                       </div>
                                       <div class="item"
                                            style="background-color: rgb(252, 249, 249); height: 620px;">
                                           <img
                                               style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                               src="{{asset('front/images/highlight/organize/aman_malik.jpg')}}" alt=""/>

                                           <h5 style="text-align: center; padding: 10px;">
                                            Director ORIC
                                           </h5>
                                           <p style="text-align: center;">Prof. Dr Aman Ullah Malik</p>
                                           <p style="color: rgb(252, 249, 249);">.</p>
                                           <br/>
                                       </div>

                                       <div class="item"
                                            style="background-color: rgb(252, 249, 249); height: 620px;">
                                           <img
                                               style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                               src="{{asset('front/images/highlight/organize/it_head_farid.jpeg')}}" alt=""/>

                                           <h5 style="text-align: center; padding: 10px;">
                                            IT Head
                                           </h5>
                                           <p style="text-align: center;">Ghulam Farid</p>
                                           <p style="color: rgb(252, 249, 249);">.</p>
                                           <br/>
                                       </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br/>
                        <h5>ADVISORY BOARD</h5>
                        <br/>
                        <hr/>
                        <br/>
                        <div class="show-events-carousel">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="owl-show-events owl-carousel">
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/patron.png')}}" alt=""/>

                                                <h5 style="text-align: center; padding: 10px;">
                                                    Patron in Chief
                                                </h5>
                                                <p style="text-align: center;">Muhammad Haider Amin</p>
                                                <p style="text-align: center;">
                                                    Chairman board of Governors
                                                </p>
                                                <br/>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); height: 620px;!important">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/copatron.png')}}" alt=""/>

                                                <h5 style="text-align: center; padding: 10px;">
                                                    Co-Patron
                                                </h5>
                                                <p style="text-align: center;">
                                                    Prof. (Meritorious and Tenured)
                                                </p>
                                                <p style="text-align: center;">
                                                    Dr. Muhammad Khaleeq-ur-Rahman
                                                </p>
                                                <br/>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249);height: 620px;!important">
                                                <img
                                                    style="height: 500px; object-fit: cover; width: 100%; object-position: 50% 50%;"
                                                    src="{{asset('front/images/highlight/organize/chairperson.jpg')}}"
                                                    alt=""/>

                                                <h5 style="text-align: center; padding: 10px;">
                                                    Ms. Zahida Maqbool
                                                </h5>
                                                <p style="text-align: center;"></p>
                                                <p style="text-align: center;">Additional Registrar</p>
                                                <br/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <hr/>
                        <br/>
                        <h4>About Us:</h4>

                        <p>
                            We are a team of dermatologists, allied health professionals, skin care experts, dermal
                            scientists and researchers. The Department of Dermatology, The University of Faisalabad,
                            started in 2006 as the first teaching
                            Dermatology department in private sector in Faisalabad. In the past 15 years the department
                            has contributed in undergraduate medical, postgraduate and allied health education along
                            with patientcare and research. The
                            department is well reputed for its social outreach program.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer-scripts')

@endpush
