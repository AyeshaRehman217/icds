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
            <span
            >The Conference will start from 18<sup>th</sup> November until
              19<sup>th</sup> November.</span
            >
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

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content">
                        <h5 style="color: white">1st Edition</h5>
                        <h2>International Conference on Dermal Sciences</h2>
                        <br/>
                        <br/>
                        <h5 style="color: white">
                            Organized By Department of Dermatology. <br/>
                            ORIC and Society for Skin Care
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- *** Amazing Venus ***-->
    <div class="amazing-venues">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="left-content">
                        <h4>ICDS 2021:</h4>
                        <p>
                            This report outlines the outcomes of the 1st international
                            conference on Dermal Sciences, for the year 2021, which was
                            organized by Department of Dermatology, ORIC and Society for
                            skin care. It was a one-day Hybrid Conference. The Theme of the
                            conference was “Psychosocial Impact of Colorism”. ICDS 2021
                            hosted 5 international competitions with the theme “Beauty
                            Beyond Color: Celebrating 7 billion shades of skin. This was the
                            first conference in Pakistan regarding this topic and First
                            Hybrid conference in The University of Faisalabad. Experts from
                            around the globe participated and appreciated the conference.
                        </p>
                        <br/>
                        <hr/>
                        <br/>
                        <h4>Program Overview:</h4>
                        <ul>
                            <li>
                                <h5>EVENT DETAILS</h5>
                                <ul>
                                    <li>
                                        On November 20th, 2021, Department of Dermatology
                                        organized the 1st International conference on Dermal
                                        Sciences to provide an interdisciplinary forum for
                                        discussion regarding different aspects of “Psychosocial
                                        Impact of Colorism”. The event was held at Ali Auditorium.
                                        The University of Faisalabad.
                                    </li>
                                </ul>
                            </li>
                            <br/>
                            <li>
                                <h5>OBJECTIVES</h5>
                                <ul>
                                    <li>
                                        Raise awareness regarding negative impact of colorism at
                                        an individual, societal and cultural level. Provide
                                        international exposure to students. Provide an
                                        interdisciplinary forum for discussions.
                                    </li>
                                </ul>
                            </li>
                            <br/>
                            <li>
                                <h5>METHODOLOGY</h5>
                                <ul>
                                    <li>
                                        This was a Hybrid Conference. Participants joined from
                                        around the globe through zoom and physically. This was the
                                        first hybrid conference in The University of Faisalabad.
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <!-- ...... Cut ....... -->

                        <br/>
                        <hr/>
                        <br/>

                        <h4>ATTENDEES:</h4>
                        <ul>
                            <li>• 350 Registered Participants</li>
                            <li>• 60-Virtual audience</li>
                            <li>
                                • Distinguished guests, faculty and keynote speakers from 7
                                countries
                            </li>
                        </ul>

                        <br/>
                        <hr/>
                        <br/>

                        <h4>SPEAKERS:</h4>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Speakers</th>
                                <th scope="col">Title of Talk</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <b> Dr. Ronald Hall, </b>
                                    Professor Social work, Michigan state university
                                </td>
                                <td>The Bleaching Syndrome</td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Nikki Khanna, </b>
                                    Associate Professor of Sociology, University of Vermont
                                </td>
                                <td>Whiter: Asian American Women and Colorism</td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Dr. Neha Mishra, </b>
                                    Associate professor of Law and Associate Dean (OP Jandal
                                    global university, India)
                                </td>
                                <td>
                                    Analyzing colorism from the lens of caste, color and
                                    gender perceptions
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Dr. P. Ravi Shankar, </b>
                                    Career Researcher, Faculty IMU centre for education
                                    (International Medical University, Malaysia)
                                </td>
                                <td>
                                    The billion-dollar quest for fairness in South and
                                    Southeast Asia
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Dr. Mohammed T. Bolori, </b>
                                    Public Health professional (Northern Eastern Part of
                                    Nigeria)
                                </td>
                                <td>
                                    Knowledge, Attitude and Practice of Skin Whitening among
                                    Female University Students in Nigeria
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Kavitha Emmanuel, </b>
                                    Founder/Director Women of Worth & Dark is Beautiful
                                </td>
                                <td>The Battle of the Unfair Mindsets</td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Dr. Sarah L. Webb, </b>
                                    Founder of Colorism Healing
                                </td>
                                <td>
                                    A Salve for Your Soul: Healing from the Cumulative Trauma
                                    of Colorism
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Brig ® Rehan-ud-Din, </b>
                                    Professor and Head of Dermatology Department in CMH
                                    Lahore.
                                </td>
                                <td>Skin color and self esteem</td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Hisham Dzakiria, PhD, </b>
                                    Certified NLP Master Trainer (ANLPM), Current Position:
                                    Dean of Awang Had Salleh Graduate School, College of Arts
                                    and Sciences, Universiti Utara Malaysia (UUM) MALAYSIA
                                </td>
                                <td>The impact of colorism and quality of life</td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Ms. NICY BAI (Chairman of ICCCM)</b> Ambassador of
                                    Malaysia-China Friendship Excellent member of China
                                    Association for the Promotion of Democracy Vice president
                                    for MAKER Club of China Science and Technology city
                                </td>

                                <td>The Impact of Skin Color on Career Development</td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Fatima Lodhi </b>
                                    Founder of Dark is Divine
                                </td>

                                <td>Fighting the color war</td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Dr. Ghulam Abbas </b>
                                    Professor of Pharmaceutical Sciences, Government College
                                    University Faisalabad, GCUF
                                </td>
                                <td>The whitening complex in pharmaceutical industry</td>
                            </tr>
                            <tr>
                                <td>
                                    <b> Dr. Sohail Jabbar </b>
                                    Acting Director, ORIC, The University of Faisalabad.
                                </td>
                                <td>Islam and Colorism</td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Dr. Fatima Inam </b>
                                    Post Graduate Trainee Madinah Teaching Hospital
                                </td>
                                <td>Trends of whitening in patients</td>
                            </tr>
                            <tr>
                                <td>
                                    <b> Dr. Rooha Tariq </b>
                                    Post Graduate Trainee Madinah Teaching Hospital
                                </td>
                                <td>
                                    Relationship between social anxiety and pigmentary
                                    disorders
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Sana Arshad </b>
                                    Student of Department of Dermal Sciences- The University
                                    of Faisalabad
                                </td>
                                <td>Beauty standards in Pakistan</td>
                            </tr>

                            <tr>
                                <td>
                                    <b> Tasbiha Ramzan </b>
                                    Student of Department of Dermal Sciences (The University
                                    of Faisalabad)
                                </td>
                                <td>
                                    Effect of Colorism- Dissatisfaction with skin color as an
                                    outcome of childhood traumatic experiences
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <br/>
                        <br/>
                        <br/>
                        <div class="show-events-carousel">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="owl-show-events owl-carousel">
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                                                <img
                                                    style="height: 340px"
                                                    src="{{asset('front/images/highlight/speaker/Picture1.png')}}"
                                                    alt=""
                                                />
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                                                <img
                                                    style="height: 340px"
                                                    src="{{asset('front/images/highlight/speaker/Picture2.png')}}"
                                                    alt=""
                                                />
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                                                <img
                                                    style="height: 340px"
                                                    src="{{asset('front/images/highlight/speaker/Picture3.png')}}"
                                                    alt=""
                                                />
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                                                <img
                                                    style="height: 340px"
                                                    src="{{asset('front/images/highlight/speaker/Picture4.png')}}"
                                                    alt=""
                                                />
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                                                <img
                                                    style="height: 340px"
                                                    src="{{asset('front/images/highlight/speaker/Picture5.png')}}"
                                                    alt=""
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br/>
                        <hr/>
                        <br/>

                        <h4>Conference Proceedings:</h4>
                        <ul>
                            <li>
                                • ICDS 2021 introduced “Colorism” (for the very first time in
                                Pakistan) as a topic of discussion in a scientific forum
                            </li>

                            <li>• We had 17 speakers out of which 9 were international.</li>
                            <li>
                                • It was a one-day hybrid conference. ICDS 2021 introduced
                                hybrid system at the University of Faisalabad for the very
                                first time
                            </li>

                            <li>
                                • ICDS 2021 is commended nationally and internationally on its
                                interdisciplinary nature.
                            </li>
                        </ul>

                        <br/>
                        <hr/>
                        <br/>

                        <h4>Sponsors:</h4>
                        <ul>
                            <li>
                                • ICDS 2021 hosted 5 international competitions with
                                participants from 7 countries.
                            </li>
                            <li>
                                • The competitions were sponsored by International Cultural
                                Communication Center Malaysia (I.C.C.C.M)
                            </li>
                        </ul>

                        <br/>
                        <hr/>
                        <br/>

                        <h4>Student Involvement:</h4>
                        <ul>
                            <li>
                                • The organizational committee comprised of student of Dermal
                                sciences. They not only had an international exposure but were
                                also trained as head & co-heads of different committees; to
                                enhance their confidence, leadership and
                                management/organizational skills.
                            </li>
                        </ul>

                        <br/>
                        <hr/>
                        <br/>

                        <h4>PRESS AND PUBLICATIONS:</h4>
                        <ul>
                            <li>
                                • <b> GO GREEN: </b> ICDS 2021 aimed and attained the goal of
                                minimizing printing of paper for abstract book and used least
                                amount of printable to preserve nature. The money benefitted
                                from this and from ICDS 2021 will be donated to orphanages. It
                                will be used to host free skin care camps in underdeveloped
                                areas and SOS villages.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer-scripts')

@endpush
