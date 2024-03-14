@extends('front.layouts.app')

@section('page_title')
    {{(!empty($page_title) && isset($page_title)) ? $page_title : ''}}
@endsection
@push('head-scripts')
    <link rel="stylesheet" href="{{ asset('manager/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('manager/select2/dist/css/select2-bootstrap5.min.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    <!-- ***** Pre Header ***** -->

    <div class="pre-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
        <span>The Conference will start from 13<sup>th</sup> October until
            14<sup>th</sup> October.</span>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="text-button">
                        @guest
                            @if (Route::has('registration'))
                                <a href="{{route('login')}}">Login <i class="fa fa-arrow-right"></i></a>
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
    <div class="amazing-venues" style="margin-top: 40px;">
        <div class="container">
            <div class="row justify-content-center">
                <!-- <div class="col-sm-1" style="display: flex; flex-direction:column; align-items:center;">
                  <p></p>
                  <p>&</p>
                </div> -->

                <div class="col-sm-5" style="display: flex; flex-direction:column; align-items:center;">
                    <a href="{{asset('front/downloads/icds-2023-abstract-submission-guidelines.pdf')}}"
                       class="btn btn-primary my-1" target="_blank"><i class="fa fa-book mx-2"></i>Download Now</a>
                    <p style="text-align: center;">Conference Abstract submission guidelines</p>
                </div>

                <div class="col-sm-5" style="display: flex; flex-direction:column; align-items:center;">
                    <a href="{{asset('front/downloads/international-dermal-conference-2023-user-register-1.0.pdf')}}"
                       class="btn btn-primary my-1" target="_blank"><i class="fa fa-book mx-2"></i>Download Now</a>
                    <p style="text-align: center;">Conference User Registration guidelines</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="registration-form">
                        <br>
                        <h4>Register Now</h4>
                        <ul class="py-4" style="color: #495057; font-size: 15px; font-weight: 400;">
                            <li>• Kindly enter your personal information.</li>
                            <li>• Select your preferred registration type.</li>
                            <li>• Upload a scanned copy of the registration receipt.</li>
                        </ul>


                        <form class="mt-5" action="{{ route('registration-store') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row {{ isset($registered) ? 'disables-from-fields' : '' }}">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title">Title *</label>
                                        <select class="form-control" id="title" name="title">
                                            <option value="Mr">Mr.</option>
                                            <option value="Ms">Ms.</option>
                                            <option value="Dr">Dr.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" placeholder="Enter Name"
                                               value="{{(isset($registered->name))?$registered->name:old('name')}}">
                                        @error('name')
                                        <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                               name="email"
                                               placeholder="Enter Email"
                                               value="{{(isset($registered->email))?$registered->email:old('email')}}">
                                        @error('email')
                                        <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password *</label>
                                        <input type="password"  placeholder="Enter Password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password">
                                        @error('password')
                                        <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_no" class="form-label">Contact No *</label>
                                        <input type="text"
                                               class="form-control @error('contact_no') is-invalid @enderror"
                                               name="contact_no"
                                               placeholder="Enter Contact No"
                                               value="{{(isset($registered->contact_no))?$registered->contact_no:old('contact_no')}}">
                                        @error('contact_no')
                                        <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="qualification">Qualification *</label>
                                    <input type="text" class="form-control" id="qualification"
                                           aria-describedby="emailHelp" placeholder="Enter qualification"
                                           name="qualification">
                                </div>

                                {{-- <div class="mb-3">
                                    <label for="country" class="form-label">Country *</label>
                                    @if(isset($registered))
                                        <input type="text" class="form-control rounded-0"
                                               value="{{$registered->countryID->name}}">
                                    @else

                                                    <select class="form-control" id="country_id" name="country_id" >
                                                        <option value="0">Please Select</option>
                                                        <option value="1">Afghanistan</option>
                                                        <option value="2">Albania</option>
                                                        <option value="3">Algeria</option>
                                                        <option value="4">American Samoa</option>
                                                        <option value="5">Andorra</option>
                                    </select>
                                    @endif
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="country">Country *</label>
                                        <select
                                            class="form-control select2-options-country-id  @error('country') is-invalid @enderror"
                                            name="country"></select>
                                        @error('country')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="state">State *</label>
                                        <select
                                            class="form-control select2-options-state-id  @error('state') is-invalid @enderror"
                                            name="state"></select>
                                        @error('state')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="city">City *</label>
                                        <select
                                            class="form-control select2-options-city-id  @error('city') is-invalid @enderror"
                                            name="city"></select>
                                        @error('city')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="payment">Payment Type *</label>
                                        <select
                                            class="form-control select2-options-payment-id  @error('payment') is-invalid @enderror"
                                            name="payment" id="payment"></select>
                                        @error('payment')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                        <!-- <label for="registration_type_id" class="form-label">Payment Option *</label>
                                        @if(isset($registered))
                                            <input type="text" class="form-control rounded-0"
                                                   value="Bank Payment">




                                        @else
                                            <select name="payment_option" class="form-control form-select" id="payment_option">
                                                <option value="">Select</option>
                                                <option value="bank_pay">Bank Payment</option>
                                                <option value="on_site">On site Payment</option>
                                            </select>




                                        @endif -->
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="registration">Registration Type *</label>
                                        <select
                                            class="form-control select2-options-registration-id  @error('registration') is-invalid @enderror"
                                            name="registration"></select>
                                        @error('registration')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="my-4 py-2">
                                        @if(!isset($registered))
                                            <button type="submit" class="btn btn-primary float-end submit-info-btn">
                                                Register Now
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- popup 2 -->
                        <div class="modal fade" id="popup-modal-2" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background: #d8c9c9 ">
                                        {{--  <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>--}}
                                    </div>
                                    <div class="modal-body" style="padding: 0px">
                                        <div id="carouselExampleSlidesOnly" class="carousel Model_slide"
                                             data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active py-5 px-3">
                                                    <p><b class="text-danger">Note:</b> You can register as a Walk-in
                                                        candidate on Conference
                                                        day.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- *** Registration Types ***-->
    <div class="amazing-venues">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="left-content">
                        <h4>Registration Types:</h4>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Applicant</th>
                                <th scope="col">Before Date</th>
                                <th scope="col">After Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <th scope="row">Student</th>
                                <td>2000 PKR (early bird)</td>
                                <td>after 31st August 3000 PKR</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <th scope="row">Faculty</th>
                                <td>3000 PKR (early bird)</td>
                                <td>after 31st August 4000 PKR</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <th scope="row">International Student</th>
                                <td>$50 (early bird)</td>
                                <td>after 31st August $100</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <th scope="row">International Faculty</th>
                                <td>$100 (early bird)</td>
                                <td>after 31st August $200</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


        </div>
        <div class="bank-info pt-4 ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="py-3">Bank Detail</h4>
                        <table class=" table table-bordered">
                            <tbody>
                            <tr>
                                <th>Bank Name</th>
                                <td>Habib Metropolitan Bank Limited</td>
                            </tr>
                            <tr>
                                <th>Branch Name</th>
                                <td>University Branch Faisalabad</td>
                            </tr>
                            <tr>
                                <th>Account #</th>
                                <td>06-12-08-20311-714-100017</td>
                            </tr>
                            <tr>
                                <th>Account Title</th>
                                <td>The University of Faisalabad Main Account</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <span style="color: #495057; font-size: 14px; font-weight: 400;">If you have any questions, feel free to contact our conference support team at <b>icds.pk@gmail.com</b></span>
            </div>
        </div>
    </div>

@endsection
@push('footer-scripts')

    <script src="{{ asset('manager/select2/dist/js/select2.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('.select2-options-title').select2({
                theme: "bootstrap5",
                placeholder: 'Select Title',
            });


            //Select Registration Type
            $('.select2-options-registration-id').select2({
                theme: "bootstrap5",
                placeholder: 'Select Registration Type',
                allowClear: true,
                ajax: {
                    url: '{{route('get.registration-type-select')}}',
                    dataType: 'json',
                    delay: 250,
                    type: 'GET',
                    data: function (params) {
                        var query = {
                            q: params.term,
                            type: 'public',
                            _token: '{{csrf_token()}}'
                        }
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        };
                    },
                    cache: true
                }
            }).trigger('change.select2')

            //Select Payment Type
            $('.select2-options-payment-id').select2({
                theme: "bootstrap5",
                placeholder: 'Select Payment Type',
                allowClear: true,
                ajax: {
                    url: '{{route('get.payment-type-select')}}',
                    dataType: 'json',
                    delay: 250,
                    type: 'GET',
                    data: function (params) {
                        var query = {
                            q: params.term,
                            type: 'public',
                            _token: '{{csrf_token()}}'
                        }
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name,

                                }
                            })
                        };
                    },
                    cache: true
                }
            }).trigger('change.select2')

            //Select Country
            $('.select2-options-country-id').select2({
                theme: "bootstrap5",
                placeholder: 'Select Country',
                allowClear: true,
                ajax: {
                    url: '{{route('get.countries-select')}}',
                    dataType: 'json',
                    delay: 250,
                    type: 'GET',
                    data: function (params) {
                        var query = {
                            q: params.term,
                            type: 'public',
                            _token: '{{csrf_token()}}'
                        }
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        };
                    },
                    cache: true
                }
            }).trigger('change.select2')

            //By Default Shows Select States
            $('.select2-options-state-id').select2({
                theme: "bootstrap5",
                placeholder: 'Select States',
            });

            //On Changing Country Populates States
            $('.select2-options-country-id').change(function () {
                let countryId = $(this).val();
                $('.select2-options-state-id').empty()
                //Select States
                $('.select2-options-state-id').select2({
                    theme: "bootstrap5",
                    placeholder: 'Select States',
                    allowClear: true,
                    ajax: {
                        url: '{{route('get.states-select')}}',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            var query = {
                                q: params.term,
                                type: 'public',
                                _token: '{{csrf_token()}}',
                                countryId: countryId,
                            }
                            return query;
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.name
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                }).trigger('change.select2');

                // $(".select2-options-state-id").on("select2:unselecting", function (e) {
                //     selectRange()
                // })
            });

            //By Default Shows Select Cities
            $('.select2-options-city-id').select2({
                theme: "bootstrap5",
                placeholder: 'Select City',
            });

            //On Changing Country and States Populates Cities
            $('.select2-options-country-id,.select2-options-state-id').change(function () {
                let countryId = $('.select2-options-country-id').val();
                let stateId = $('.select2-options-state-id').val();


                $('.select2-options-city-id').empty()

                //Select States
                $('.select2-options-city-id').select2({
                    theme: "bootstrap5",
                    placeholder: 'Select City',
                    allowClear: true,
                    ajax: {
                        url: '{{route('get.cities-select')}}',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            var query = {
                                q: params.term,
                                type: 'public',
                                _token: '{{csrf_token()}}',
                                countryId: countryId,
                                stateId: stateId,
                            }


                            return query;
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.name
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                }).trigger('change.select2');

                // $(".select2-options-city-id").on("select2:unselecting", function (e) {
                //     selectRange()
                // })
            });


            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#payment').change(function () {
                let data = $(this).val();
                if (data === "2") {
                    $(document).ready(function () {
                        $("#popup-modal-2").modal('show');
                        $('.submit-info-btn').addClass('d-none')
                    });
                } else {
                    $('.submit-info-btn').removeClass('d-none')
                }

            });
        });
    </script>
    {{-- Toastr : Script : Start --}}
    @if(Session::has('messages'))
        <script>
            noti({!! json_encode((Session::get('messages'))) !!});
        </script>
    @endif

    {{-- Toastr : Script : End --}}
@endpush

