@extends('front.layouts.app')
@section('page_title')
    {{(!empty($page_title) && isset($page_title)) ? $page_title : ''}}
@endsection
@push('head-scripts')

@endpush
@section('content')
    <!-- ***** Pre HEader ***** -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
          <span>The Conference will start from 13<sup>th</sup> October until
            14<sup>th</sup> October.</span>
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
    <div class="main-banner">
        <div class="counter-content counter">
            <!-- <p id="days"></p> -->
            <ul>
                <li>Days<span class="ss-days"></span></li>
                <li>Hours<span class="ss-hours"></span></li>
                <li>Minutes<span class="ss-minutes"></span></li>
                <li>Seconds<span class="ss-seconds"></span></li>
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
                            <!-- <b>Skin and Cosmeceuticals:</b> Production, Practice and
                            Regulations -->
                            <b>Emerging Trends in Dermal Sciences</b>
                        </h4>
                        <br/>
                        <h5 style="color: white">ICDS 2023</h5>
                        <h2>3 <sup>rd</sup> International Conference on Dermal Sciences</h2>
                        <div class="main-white-button">
                            <!-- <a href="./book.pdf">Download the Abstract Book</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
  <!-- ***** Event Carousel ***** -->
  <div class="show-events-carousel mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-show-events owl-carousel">
                    <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                        <img style="height: 100%" src="{{asset('front/images/workshop/workshop_0.jpg')}}" alt="" />
                    </div>

                    <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                        <img style="height: 100%" src="{{asset('front/images/workshop/workshop_1.jpg')}}" alt="" />
                    </div>

                    <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                        <img style="height: 100%" src="{{asset('front/images/workshop/workshop_2.jpg')}}" alt="" />
                    </div>

                    <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                        <img style="height: 100%" src="{{asset('front/images/workshop/workshop_3.jpg')}}" alt="" />
                    </div>

                    <div class="item" style="background-color: rgb(252, 249, 249);border-radius: 2px;">
                        <img style="height: 100%" src="{{asset('front/images/workshop/workshop_4.jpg')}}" alt="" />
                    </div>

                    <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                        <img style="height: 100%" src="{{asset('front/images/workshop/workshop_5.jpg')}}" alt="" />
                    </div>

                    <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                        <img style="height: 100%" src="{{asset('front/images/workshop/workshop_6.jpg')}}" alt="" />
                    </div>

                    <div class="item" style="background-color: rgb(252, 249, 249); border-radius: 2px;">
                        <img style="height: 100%" src="{{asset('front/images/workshop/workshop_7.jpg')}}" alt="" />
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




    {{-- Speaker Section --}}
    <!-- ***** Event Carousel ***** -->
    <div class="show-events-carousel">
        <div class="container">
            <div class="row">
                <div class="left-content">

                    <h4 class="speaker ms-4">Speakers for ICDS 2023:</h4></div>
                <div class="col-lg-12">
                    <div class="owl-show-events-speakers owl-carousel">
                       <div class="item"
                                                 style=" background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img style="height: 290px" src="{{asset('front/images/speakers/ronald-s.jpg')}}" alt=""/>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Prof. Dr. Ronald Hall
                                                </h5>
                                               
                                                <p style="padding: 10px; min-height: 270px">
                                                    With a distinguished academic background, Dr RONALD EDWARD HALL has
                                                    excelled in the field of social work. Holding a Ph.D. from Atlanta
                                                    University, his expertise encompasses various facets of social work,
                                                    from policy and planning to correctional science. Driven by a deep
                                                    interest in issues such as mental health and colorism litigation,
                                                    his professional journey includes roles as a professor, legal
                                                    consultant, and expert witness. His extensive experience and
                                                    research contribute significantly to the field of social work and
                                                    human behavior.
                                                </p>
                                                <!-- <div style="position: relative;top:50px"> -->
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Thinking outside of the box: Global Manifestations of the Bleaching
                                                    Syndrome.
                                                </p>
                                                <!-- </div> -->
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/neha-mishra-new.png')}}"
                                                    alt=""
                                                />

                                                <h5 style="text-align: center; padding: 10px">
                                                    Dr. Neha Mishra
                                                </h5>
                                                <p style="padding: 10px; min-height: 270px">
                                                    <!-- Associate professor of Law and Associate Dean (OP
                                                    Jandal global university, India) -->
                                                    Dr Neha Mishra is an Associate Professor of law at O.P. Jindal
                                                    Global University, India with over 13 years of work experience. Her
                                                    research area focuses on Human rights law, colorism and postcolonial
                                                    feminist studies. Her opinions and contributions on the mentioned
                                                    areas can be seen in TIME magazine, BBC, Asia times, Huff Post,
                                                    Times of India as well as many international academic journals.
                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Global Colorism and its Manifestations.
                                                </p>

                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); border-radius: 2px; position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/bolori-s.png')}}"
                                                    alt=""/>

                                                <h5 style="text-align: center; padding: 10px">
                                                    Dr. Mohammed T. Bolori
                                                </h5>
                                                <p style="padding: 10px; min-height: 270px">
                                                    <!-- CEO/ MD & principal consultant at diamond care
                                                    resources <br />
                                                    <br />
                                                    Public Health professional (Northern Eastern Part
                                                    of Nigeria) -->
                                                    Dr Mohammed T. Bolori, a seasoned 52-year-old Public Health
                                                    Specialist from Nigeria, boasts a remarkable journey in healthcare.
                                                    Armed with an MBBS from the University of Maiduguri and a Master of
                                                    Public Health from Ahmadu Bello University Zaria, he transitioned
                                                    from intensive Internal Medicine training to his passion for Public
                                                    Health. Dr Bolori holds esteemed fellowships, including FAIPH, FIMS,
                                                    and FRSPH UK. Currently pursuing a Ph.D. in Epidemiology, he's a
                                                    prolific author and reviewer for both local and international
                                                    journals. His expertise guided WHO initiatives, notably in polio
                                                    eradication and neglected tropical diseases. His contributions
                                                    earned accolades, including recognition from the WHO AFRO Region for
                                                    his role in interrupting Wild Polio Virus in Nigeria. Dr Bolori's
                                                    career melds clinical practice, academia, and impactful public
                                                    health leadership.
                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Awareness of Cosmetic Dermatology Procedures among Health Workers in
                                                    a Tertiary Care Hospital.
                                                </p>

                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/ravi-s.png')}}"
                                                    alt=""
                                                />

                                                <h5 style="text-align: center; padding: 10px">
                                                    Dr. P. Ravi Shankar
                                                </h5>
                                                <p style="padding: 10px; min-height: 270px">
                                                    <!-- MBBS, MD, FAIMER Fellow, MAoME <br />
                                                    2020 career researcher rank 238,920 <br />

                                                    Member ORCID Researcher Advisory Council (ORAC)
                                                    <br />
                                                    Member TLM Global Counterspace program <br />
                                                    Member, World Association of Medical Editors
                                                    (WAME) <br />
                                                    Academic Editor PLoS One
                                                    <br />
                                                    Member Editorial Board BMC Medical Education -->
                                                    Dr P Ravi Shankar is a faculty member at the International Medical
                                                    University, Kuala Lumpur, Malaysia. He has 767 publications in
                                                    various journals. He has written 14 books
                                                    chapters in eight books. He was among the top 2% of scientists
                                                    globally for the years 2019, 2020, and 2021. He has reviewed over
                                                    840 research papers for various journals. He has been an invited
                                                    speaker at several fora and has facilitated workshops in different
                                                    disciplines. He is a member of the ORCID Research Advisory Council
                                                    (ORAC). He is a member of the World Association of Medical Editors
                                                    (WAME). He is an academic editor of PLoS One and an editorial board
                                                    member of BMC Medical Education and the Journal of Asthma and
                                                    Allergy. His areas of research interest are the health humanities,
                                                    rational use of medicines, pharmacovigilance, and small-group
                                                    learning.


                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    The quest for fair skin in Nepal.
                                                </p>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); border-radius: 2px;position: relative; height:800px;overflow: auto;  ">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/shoukat-parvez-s.png')}}"
                                                    alt=""/>

                                                <h5 style="text-align: center; padding: 10px">
                                                    Prof Dr Shoukat Parvez
                                                </h5>
                                                <h6 style="text-align: center; padding: 10px">PhD Biological Sciences, Pakistan</h6>
                                                <p style="padding: 10px; min-height: 270px">
                                                    With a distinguished career spanning academia, research, and
                                                    leadership roles, Prof Dr Shoukat Parvez is a seasoned professional
                                                    known for their exceptional contributions. As the former
                                                    Rector/Vice-Chancellor of The University of Faisalabad, Pakistan,
                                                    they oversaw academic administration, policy formulation, and
                                                    research management. In previous positions, as Managing Director at
                                                    the Pakistan Atomic Energy Commission and Chairman of the Pakistan
                                                    Council for Scientific and Industrial Research (PCSIR), their
                                                    visionary leadership bridged the gap between science and industry,
                                                    initiating vital R&D projects. His academic background includes a
                                                    wealth of experience in biotechnology, genetic engineering, and
                                                    oriental medicine.
                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Application of Probiotics/microbiome on skin health and Immune
                                                    mechanism.
                                                </p>
                                            </div>

                                            <div class="item"
                                                 style=" background-color: rgb(252, 249, 249); border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/ikram-s.png')}}"
                                                    alt=""/>

                                                <h5 style="text-align: center; padding: 10px">
                                                    Dr Ikram Ullah Khan
                                                </h5>
                                                <h6 style="text-align: center; padding: 10px">Associate Professor of Pharmaceutics,
                                                    Government College and University, Faisalabad
                                                </h6>
                                                <p style="padding: 10px; min-height: 270px">
                                                    <!-- Doctor of Philosophy <br />
                                                    PhD Student at Henan University -->
                                                    Dr Ikram Ullah Khan is an esteemed figure in the realm of
                                                    pharmaceutics, serving as a prominent faculty member in the
                                                    Department of Pharmaceutics at the Faculty of Pharmaceutical
                                                    Sciences, Government College University Faisalabad (GCUF), Pakistan.
                                                    With over 16 years of experience in teaching, research, and
                                                    professional practice, he has garnered substantial recognition, with
                                                    an impact factor of 393, as calculated per JCR 2021. His influence
                                                    extends beyond the academic sphere, with 1856 citations, an H-index
                                                    of 21, and an i10 Index of 42, highlighting the impact of their
                                                    research.
                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Polymeric films supplemented with natural therapeutic agents for
                                                    improved biological performance.
                                                </p>
                                            </div>

                                            <div class="item"
                                                 style=" background-color: rgb(252, 249, 249); border-radius: 2px;position: relative; height:800px;  overflow: auto;;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/saleem-gauri-s.png')}}"
                                                    alt=""
                                                />
                                                <!-- <div class="div"> -->
                                                <h5 style="text-align: center; padding: 10px">
                                                    Dr Muhammad Saleem Ghauri
                                                </h5>
                                                <h6 style="text-align: center; padding: 10px">Consultant Dermatologist.
                                                    DermatoSurgery, Ahmad Polyclinic                        
                                                    </h6>
                                                <p style="padding: 10px; min-height: 270px">
                                                    <!-- M.Pharm., Ph. D <br>
                                                      Professor & Head, Department of PRA,  <br>
                                                      Pulla Reddy Institute of Pharmacy -->
                                                    Presently, a leading Consultant Clinical & Aesthetic Dermatologist
                                                    at The DermatoSurgery in Faisalabad, Pakistan, Dr Muhammad Saleem
                                                    Ghauri brings a wealth of experience. His journey began with an MBBS
                                                    from King Edward Medical College, followed by MCPS in Dermatology.
                                                    He holds a Certificate in Teaching & Learning (HPE) and one in
                                                    Professionalism & Ethics in Healthcare. With extensive experience in
                                                    dermatology, including establishing and heading departments, he has
                                                    made remarkable contributions to the field, trained medical
                                                    professionals, conducted scientific studies, and presented findings
                                                    at national and international conferences.

                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Ethical solutions to emerging professional issues in aesthetics.
                                                </p>
                                                <!-- </div> -->
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/futry-s.png')}}"
                                                    alt=""/>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Fitry Oktavia Fatmi
                                                </h5>
                                               
                                                <p style="padding: 10px; min-height: 270px">
                                                    <!-- Master in Halal Industry ManagementHalal Consultant at IHATEC -->
                                                    With a diverse career spanning pharmaceutical production, training,
                                                    and a strong focus on Halal industry management, Fitry Oktavia Fatmi
                                                    is a dedicated professional. Currently a Halal Trainer and
                                                    Consultant, she also holds a Master's in Halal Industry Management
                                                    from the International Islamic University Malaysia. Her expertise
                                                    bridges pharmaceutical processes, GMP, and Halal certification,
                                                    making her a valuable asset in the industry.
                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Factors influencing Muslims’ purchase intention of halal-Certified
                                                    over-the-counter Medicines in Bekasi, Indonesia.
                                                </p>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249); border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/amjad-islam-s.png')}}"
                                                    alt=""
                                                />

                                                <h5 style="text-align: center; padding: 10px">
                                                    Dr Amjad Islam Aqib
                                                </h5>
                                                <h6 style="text-align: center; padding: 10px">Assistant Professor, Cholistan University of Veterinary & Animal Sciences                        
                                                    </h6>
                                                <p style="padding: 10px; min-height: 270px">
                                                    <!-- Head and Professor of Dermatology <br>
                                                    The University of Faisalabad -->
                                                    Dr Amjad Islam Aqib is a highly accomplished veterinary expert,
                                                    holding a PhD in Veterinary Medicine and a distinguished academic
                                                    background. His academic journey includes significant accolades and
                                                    recognitions, showcasing their commitment to research and
                                                    development in the field. Dr Amjad Islam Aqib excels in vaccine
                                                    development against infectious agents and antimicrobial resistance
                                                    strategies, with a proven track record of success and innovation.

                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Advent of nanotechnology in dermal therapeutics.
                                                </p>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/farrukh-nisar-s.png')}}"
                                                    alt=""/>

                                                <h5 style="text-align: center; padding: 10px">
                                                    Dr Muhammad Farrukh Nisar
                                                </h5>
                                                <h6 style="text-align: center; padding: 10px">Head of Department / Assistant Professor Department of Physiology and Biochemistry,
                                                    Cholistan University of Veterinary and Animal Sciences     
                                                    </h6>
                                                <p style="padding: 10px; min-height: 270px">
                                                    <!-- Consultant and aesthetic Dermatologist -->
                                                    With an extensive educational background in Biomedical Engineering
                                                    and Cell and Molecular Biology, Dr Muhammad Farrukh Nisar possesses
                                                    a rich academic foundation. His research interests span various
                                                    facets of photomedicine, cellular processes in cancer, biochemical
                                                    pathways, and the study of skin-related conditions. With over seven
                                                    years of university teaching and research experience, He currently
                                                    serves as the Head of the Department of Physiology and Biochemistry
                                                    at Cholistan University of Veterinary and Animal Sciences. His
                                                    Academic journey reflects a profound commitment to advancing
                                                    knowledge in the field of biomedical sciences.
                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Research Progress of Small-Molecule Drugs Targeting Telomerase in
                                                    Human Cancer and Aging.
                                                </p>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/sir_ghulam.jpg')}}"
                                                    alt=""/>

                                                <h5 style="text-align: center; padding: 10px">
                                                    Dr Ghulam Abbas
                                                </h5>
                                                <h6 style="text-align: center; padding: 10px">Assistant Professor, Government College and University, Faisalabad     
                                                    </h6>
                                                <p style="padding: 10px; min-height: 270px">
                                                    <!-- Professor of Pharmacy -->
                                                    Dr Ghulam Abbas is an assistant professor (OPS) in the Department of
                                                    Pharmaceutics, Faculty of Pharmaceutical Sciences, Government
                                                    College University Faisalabad. He has received Pharm. D degree from
                                                    Bahauddin Zakariya University Multan
                                                    Pakistan in 2009 with the award of the Gold Medal. He has received
                                                    MPhil in Pharmaceutics from
                                                    Government College University Faisalabad. He obtained PhD degree in
                                                    Pharmaceutics from
                                                    Bahauddin Zakariya University Multan in July 2019. He has published
                                                    52 peer-reviewed
                                                    articles with a cumulative impact factor of over 225 and with over
                                                    2500 citations. He is a reviewer
                                                    of several well-reputed international journals.
                                                </p>
                                            </div>

                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/yasir-ali-s.png')}}"
                                                    alt=""/>

                                                <h5 style="text-align: center; padding: 10px">
                                                    Muhammad Yasir Ali
                                                </h5>
                                                <h6 style="text-align: center; padding: 10px">Assistant Professor, Government College and University, Faisalabad   
                                                    </h6>
                                                <p style="padding: 10px; min-height: 270px">
                                                    An accomplished academic, Muhammad Yasir Ali has made significant
                                                    contributions to the field of pharmaceutical sciences. With a Ph.D.
                                                    in Pharmaceutical Technology from Philipps University Marburg,
                                                    Germany, their expertise spans academia and professional training.
                                                    Currently, he serves as an Assistant Professor at Govt. College
                                                    University, Faisalabad, reflecting a commitment to advancing
                                                    pharmaceutical knowledge.

                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Photodynamic Therapy for Skin Disorders.
                                                </p>
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/shahid-shah-s.jpg')}}"
                                                    alt=""
                                                />

                                                <h5 style="text-align: center; padding: 10px">
                                                    Dr SHAHID SHAH
                                                </h5>
                                                <h6 style="text-align: center; padding: 10px">Assistant Professor, Government College and University, Faisalabad  
                                                    </h6>
                                                <p style="padding: 10px; min-height: 270px">
                                                    Dr Shahid Shah is an esteemed Assistant Professor in the Department
                                                    of Pharmacy Practice at Government College University, Faisalabad,
                                                    Pakistan. With a PhD in Clinical Pharmacy from Sorbonne Paris Cité
                                                    University, France, he is a recipient of the prestigious "Overseas
                                                    Scholarship" from the Higher Education Commission of Pakistan. Their
                                                    academic journey reflects a commitment to excellence in
                                                    pharmaceutical education and research.
                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Cosmetovigilence survey: Are cosmetics considered safe by college
                                                    students?.
                                                </p>
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/sumera-badar-s.png')}}"
                                                    alt=""/>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Dr Sumera Badar Ehsan
                                                </h5>
                                                <h6 style="text-align: center; padding: 10px">Associate Professor /Head of the Department Of Medical Education, Punjab Medical College, Faisalabad Medical University  
                                                    </h6>
                                                <p style="padding: 10px; min-height: 270px">
                                                    A dedicated scholar and medical educator, Dr Sumera Badar Ehsan
                                                    brings a wealth of academic achievements. Holding a recent IGME-PhD
                                                    in Medical Education from Ambrosiana University, Italy, she also
                                                    possesses a Master's in Health Professions Education (MHPE) and
                                                    MPhil in Social & Preventive Medicine. Her commitment to teaching is
                                                    evident through a Certificate in Medical Teaching (CMT) and an MBBS
                                                    degree from the University of Health Sciences, Lahore, Pakistan.

                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Choosing a career path: emerging trends in global professions.
                                                </p>
                                            </div>
                                            <div class="item"
                                                 style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                                <img
                                                    style="height: 290px"
                                                    src="{{asset('front/images/speakers/musarrat-s.jpg')}}"
                                                    alt=""/>

                                                <h5 style="text-align: center; padding: 10px">
                                                    Prof Dr Musarrat ul Hasnain
                                                </h5>
                                                <h6 style="text-align: center; padding: 10px">HOD Medical Education, Rai Medical College Sargodha  
                                                    </h6>
                                                <p style="padding: 10px; min-height: 270px">
                                                    With a diverse and extensive academic background, Prof Dr Musarrat
                                                    ul Hasnain is a dedicated scholar and educator. Currently pursuing a
                                                    Ph.D. in Medical Education at IGME-Ambrosiana University, he holds a
                                                    Master's in Health Professions Education (MHPE) from Aga Khan
                                                    University and various certifications in cognitive psychology and
                                                    change management. His vast work experience includes roles as
                                                    Director of Medical Education and HOD in medical colleges, as well
                                                    as service as a surgeon. His commitment to education and healthcare
                                                    is evident through their impressive academic journey and
                                                    professional roles.

                                                </p>
                                                <h5 style="text-align: center; padding: 10px">
                                                    Title of Talk
                                                </h5>
                                                <p style="padding: 10px; min-height: 80px">
                                                    Community health cover: Role of Allied Health professionals.
                                                </p>
                                            </div>

                                        {{-- New Speakers --}}
                                        <div class="item"
                                        style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                       <img
                                           style="height: 290px"
                                           src="{{asset('front/images/speakers/hafiz_aziz.jpg')}}"
                                           alt=""/>

                                       <h5 style="text-align: center; padding: 10px">
                                           Prof Dr Hafiz Aziz ur Rehman 
                                       </h5>
                                       <h6 style="text-align: center; padding: 10px">Professor of Law
                                        Quaid-i-Azam University Islamabad
                                        </h6>
                                       <p style="padding: 10px; min-height: 270px">
                                        Dr Aziz ur Rehman is Professor of Law & Director at the School of Law, Quaid-i-Azam University, Islamabad. He worked as Legal & Policy Advisor with Médecins Sans Frontières (MSF), Geneva (2011-2013). Dr. Aziz has also worked with the Faculty of Shariah & Law of International Islamic University Islamabad where he had taught several undergraduate and postgraduate (LLM & PhD) courses. He is an HEC approved supervisor who has supervised more than five PhD theses. Dr. Aziz also served on the Board of Islamabad Healthcare Regulatory Authority.
                                       </p>
                                       <h5 style="text-align: center; padding: 10px">
                                           Title of Talk
                                       </h5>
                                       <p style="padding: 10px; min-height: 80px">
                                        Comparative Legal Analysis of Skin Care Product Regulations in Pakistan.
                                       </p>
                                   </div>

                                   <div class="item"
                                   style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                                  <img
                                      style="height: 290px"
                                      src="{{asset('front/images/speakers/mohsin_ali.jpg')}}"
                                      alt=""/>

                                  <h5 style="text-align: center; padding: 10px">
                                    Mohsin Ali Turk 
                                  </h5>
                                  <h6 style="text-align: center; padding: 10px">Director Legal Affairs, Khyber Pakhtunkhwa Health Care Commission
                                    </h6>
                                  <p style="padding: 10px; min-height: 270px">
                                    Mr. Mohsin Turk is the Director Legal Affairs, KP Health Care Commission, Government of KP. He worked as a Legal Consultant with GIZ Pakistan. Mr. Mohsin has also worked with CODE Pakistan and Qanoon Daan Associates. He had the privilege to remain Additional District & Sessions Judge, Senior Civil Judge and Civil Judge cum Judicial Magistrate in KP Judicial Services. He is a PhD Law candidate at the Department of Law, Bahria University Islamabad.
                                  </p>
                                  <h5 style="text-align: center; padding: 10px">
                                      Title of Talk
                                  </h5>
                                  <p style="padding: 10px; min-height: 80px">
                                    Legal Framework on Regulation of Cosmetics in Pakistan.
                                  </p>
                              </div>

                              <div class="item"
                              style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                             <img
                                 style="height: 290px"
                                 src="{{asset('front/images/speakers/shaheena_ayub.jpg')}}"
                                 alt=""/>

                             <h5 style="text-align: center; padding: 10px">
                                Prof. Dr. Shaheena Ayub Bhatti
                             </h5>
                             <h6 style="text-align: center; padding: 10px">Professor|Director WRRC
                                (Women Research and Resource Centre)
                                
                            </h6>
                             <p style="padding: 10px; min-height: 270px">
                                Dr. Shaheena, a distinguished academic, holds the position of Professor of English at Fatima Jinnah Women University, The Mall, Rawalpindi.  She has done a Fulbright Postdoctoral Fellowship at the University of Arizona, Tucson, Arizona, where she specializes in American Indian Literature. Dr. Shaheena is a recognized expert, contributing significantly to her field through extensive research and publications. As the Editor of the Journal of Gender & Social Issues, a publication acknowledged by the Higher Education Commission (HEC), she plays a crucial role in fostering academic discourse on gender studies. Her impactful leadership and commitment to advancing knowledge make her a notable figure in both national and international academic circles, influencing the fields of American Indian Literature, English studies, and gender studies.
                             </p>
                             <h5 style="text-align: center; padding: 10px">
                                 Title of Talk
                             </h5>
                             <p style="padding: 10px; min-height: 80px">
                                The Bold and the Beautiful: Beauty and the Perception of Beauty.
                             </p>
                         </div>

                         <div class="item"
                              style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                             <img
                                 style="height: 290px"
                                 src="{{asset('front/images/speakers/syed_haroon.png')}}"
                                 alt=""/>

                             <h5 style="text-align: center; padding: 10px">
                                Dr Syed Haroon Khalid
                             </h5>
                             <h6 style="text-align: center; padding: 10px">Assistant Professor,
                                Government College and University, Faisalabad                                
                                
                            </h6>
                             <p style="padding: 10px; min-height: 270px">
                                Dr. Syed Haroon Khalid is an accomplished academic serving as an Assistant Professor in Pharmaceutics at Government College University Faisalabad. With a strong foundation in the field, Dr. Khalid holds a prominent role in shaping the education and research landscape within the domain of pharmaceutics. His academic journey is marked by expertise in various aspects of pharmaceutical sciences, contributing significantly to the field's development. As an Assistant Professor, he likely engages in imparting knowledge to students, conducting research, and staying abreast of the latest advancements in pharmaceutics. Dr. Syed Haroon Khalid's role at Government College University Faisalabad underscores his commitment to education, research, and the overall advancement of pharmaceutical sciences within the academic setting.
                             </p>
                             <h5 style="text-align: center; padding: 10px">
                                 Title of Talk
                             </h5>
                             <p style="padding: 10px; min-height: 80px">
                                Glimepiride Nanoemulgel: An innovative carrier with improved antidiabetic effect.
                             </p>
                         </div>

                        <div class="item"
                         style="background-color: rgb(252, 249, 249);border-radius: 2px;position: relative; height:800px;  overflow: auto;">
                        <img
                            style="height: 290px"
                            src="{{asset('front/images/speakers/ahsan_sethi.png')}}"
                            alt=""/>

                        <h5 style="text-align: center; padding: 10px">
                            Dr Ahsan Sethi
                        </h5>
                        <h6 style="text-align: center; padding: 10px">Associate Professor & Program Coordinator                              
                            
                        </h6>
                        <p style="padding: 10px; min-height: 270px">
                            Ahsan Sethi, a highly accomplished academic, is a Post-Doc Fellow based in Philadelphia, USA, with a diverse educational background spanning across the UK and Pakistan. Holding a Ph.D. in Medical Education and an MMedEd from the University of Dundee, UK, he also earned distinctions such as FDTFEd (Fellow of Dental Trainers for Education), FHEA (Fellow of the Higher Education Academy), and MAcadMEd (Master of Academic Medicine). Dr. Sethi's qualifications extend to his BDS from Pakistan and MPH (Master of Public Health) from a reputable institution in Pakistan. His research and expertise are centered around medical education, reflecting a commitment to advancing pedagogical practices in the healthcare domain. Dr. Sethi's international academic journey showcases a holistic approach to education, encompassing both clinical dentistry and public health, making him a valuable contributor to the field.
                        </p>
                        <h5 style="text-align: center; padding: 10px">
                            Title of Talk
                        </h5>
                        <p style="padding: 10px; min-height: 80px">
                            Interprofessional learning and collaboration.
                        </p>
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
                        <h4>About ICDS 2023:</h4>
                        <p>
                            International Conference on Dermal Sciences is a platform organized by The University of
                            Faisalabad to provide an inter-professional and interdisciplinary approach to the challenges
                            of health, psychology, and education.
                        </p>
                        <br/>
                        <p>
                            ICDS 2023 is the third conference of this series, scheduled to take place on the 13th and
                            14th of October at The University of Faisalabad. The success of the conferences in 2021 & 22
                            has proved ICDS to be a dynamic platform for experts, researchers, and professionals from
                            around the world interested in the field of dermal sciences. The theme for this year's
                            conference is "Emerging Trends in Dermal Sciences," aiming to explore cutting-edge
                            developments and discoveries that are shaping the future of this rapidly evolving
                            discipline.
                        </p>
                        <br/>
                        <p>
                            Attendees of ICDS 2023 will have the opportunity to engage in insightful discussions,
                            exchange groundbreaking research findings, and establish collaborative networks with
                            like-minded individuals. Distinguished speakers, renowned for their contributions to the
                            field, will lead captivating keynote lectures, informative hands-on workshops, and
                            interactive panel discussions.
                        </p>
                        <br/>
                        <p>
                            We believe that Solutions to complex issues require integrated efforts by positive minds.
                            The conference welcomes a diverse range of participants, including cosmetic scientists,
                            dermatologists, allied health professionals, environmentalists, pharmacists, psychologists,
                            journalists, cosmetic industrialists, legal experts, social scientists, educationists and
                            anyone with an interest in dermal sciences.
                        </p>
                        <br/>
                        <p>
                            This conference promises to be an exceptional opportunity for professionals and researchers
                            to expand their knowledge, network with peers, and contribute to the progress of dermal
                            sciences. Join us at ICDS 2023 as we collectively shape the future of this exciting field
                            and explore the emerging trends that are revolutionizing the world of dermatology.
                        </p>
                        </ul>
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

                        <h4>Who can attend:</h4>
                        <ul>
                            <li>• Cosmetic Scientists</li>
                            <li>• Cosmetic Researchers</li>
                            <li>• Clinical Cosmetologists</li>
                            <li>• Dermatologists</li>
                            <li>• Environmentalists</li>
                            <li>• Pharmacists</li>
                            <li>• Journalists</li>
                            <li>• Lawyers</li>
                            <li>• Anyone who is interested in the topic</li>
                        </ul>
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
                        <h4>Topics of Submission:</h4></br>
                        <ul style="list-style-type:none;">
                            <li>We invite original research papers, case studies, and review articles on emerging trends
                                and recent advancements in dermal sciences, including but not limited to:
                            </li>
                        </ul>
                        <ul>
                            <li>• Pharmaceutic Sciences and topical formulations</li>
                            <li>• Psychosocial Impact of skin diseases</li>
                            <li>• Pediatric & Geriatric Skin Care</li>
                            <li>• Management of chronic skin conditions</li>
                            <li>• Dermal Therapeutics</li>
                            <li>• Stem cell therapy</li>
                            <li>• Skin Immunology and Microbiome</li>
                            <li>• Ethics and Regulations</li>
                            <li>• Skin Imaging and Diagnostics</li>
                            <li>• Marketing of Cosmetic formulations</li>
                            <li>• Role of media and literature in shaping consumerism</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Paste The Cut from 2021 -->
    <br/>
    <br/>
    <!-- <hr /> -->
    <!-- Cut the ORGANIZING SECRETERIAT -->
    </div>


    <!-- Advisory Board & Organizing Committee -->

    <!-- <h5>Organizing Committee</h5> -->
    <div class="container">
        <div class="advisory">
            <div class="left-content">
                <h4 style="  font-size: 30px;font-weight: 800; color: #2a2a2a; margin-bottom: 20px; margin-top: 60px">Advisory Board & Organizing Committee</h4>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <br/>

    <div class="show-events-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-show-events owl-carousel">
                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                            height: 620px;
                          ">
                            <img style="height:500px; object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/patron.png')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Patron in Chief</h5>
                            <p style="text-align: center">Muhammad Haider Amin</p>
                            <p style="text-align: center">Chairman board of Governors
                            </p>
                            <br/>
                        </div>

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                            height: 620px;!important
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/copatron.png')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Co-Patron</h5>
                            <p style="text-align: center">Prof. (Meritorious and Tenured)</p>
                            <p style="text-align: center">Dr. Muhammad Khaleeq-ur-Rahman</p>
                            <br/>
                        </div>

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                           height: 620px;!important
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/chairperson.jpg')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Ms. Zahida Maqbool</h5>
                            <p style="text-align: center"></p>
                            <p style="text-align: center">Additional Registrar</p>
                            <br/>
                        </div>

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);

                            height: 620px;">
                            <img style="height:500px;width:100%;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/secretary.png')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Chair Person</h5>
                            <p style="text-align: center">Prof. Dr. Tanzeela Khalid</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
                            <br/>
                        </div>


                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                            height: 620px;
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/chairScience.png')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Secretary</h5>
                            <p style="text-align: center">Dr. Rabia Mahmood</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
                            <br/>
                        </div>

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                            height: 620px;
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/coordinator.png')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Conference Coordinator - International Linkages</h5>
                            <p style="text-align: center">Sana Arshad</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
                            <br/>
                        </div>

                        <!-- <div
                          class="item"
                          style="
                            background-color: rgb(252, 249, 249);
                            border-radius: 2px;
                          "
                        >
                          <img
                            style="height: 460px;width:100%;object-fit:cover;"
                            src="./{{asset('front/images/highlight/organize/sidra.png')}}"
                            alt=""
                          />

                          <h5 style="text-align: center; padding: 10px">
                            Chair Scientific Committee
                          </h5>
                          <p style="text-align: center">Dr. Sidra Meer</p>
                          <p style="color: rgb(252, 249, 249)">.</p>
                          <br />
                        </div> -->

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                           height: 620px;
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/sundas-tariq.png')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Chair Scientific Committee</h5>
                            <p style="text-align: center">Prof Dr Sundas Tariq</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
                            <br/>
                        </div>

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                            height: 620px;
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/naila-riaz.png')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Publications Committee Chair</h5>
                            <p style="text-align: center">Dr Nailah Riaz</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
                            <br/>
                        </div>

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                            height: 620px;
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/dr-azeem.jpg')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Member Editorial Board</h5>
                            <p style="text-align: center">Dr Muhammed Azeem</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
                            <br/>
                        </div>

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                            height: 620px;
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/same-ur-rehman.png')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Member Editorial Board</h5>
                            <p style="text-align: center">Mr Same Ur Rahman</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
                            <br/>
                        </div>

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                            height: 620px;
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/dr-arif-maan.jpg')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Member Editorial Board</h5>
                            <p style="text-align: center">Prof Dr Arif Maan</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
                            <br/>
                        </div>

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                            height: 620px;
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/sir_ghulam.jpg')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Member Editorial Board</h5>
                            <p style="text-align: center">Dr Ghulam Abbas</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
                            <br/>
                        </div>


                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                            height: 620px;
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/huda-shami.png')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Conference Coordinator</h5>
                            <p style="text-align: center">Ms Huda Shami</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
                            <br/>
                        </div>

                        <div class="item" style="
                            background-color: rgb(252, 249, 249);
                           height: 620px;
                          ">
                            <img style="height: 500px;object-fit: cover;
   width: 100%;object-position: 50% 50%;" src="{{asset('front/images/highlight/organize/hira-sultan.jpg')}}" alt=""/>
                            <h5 style="text-align: center; padding: 10px">Chair Marketing Committee</h5>
                            <p style="text-align: center">Ms Hira Sultan</p>
                            <p style="color: rgb(252, 249, 249)">.</p>
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
    <br>
    <hr/>
    <h4 style="text-align: center;">Sponsors</h4>
    <br>

    <div class="container">
        <div class="item" style="
                            border-radius: 2px;
                          ">
            <img style="height: 240px; margin-bottom: 30px; width:100%; object-fit:contain;" src="{{asset('front/images/sponsor/news92.jpg')}}" alt=""/>
        </div>
    </div>

@endsection
@push('footer-scripts')

@endpush
