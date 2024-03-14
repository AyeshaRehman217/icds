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
    <!-- *** Amazing Venus ***-->
    <div class="amazing-venues">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="left-content">
                        <h4>Important Dates:</h4>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Event</th>
                                <th scope="col">Last Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Paper Submission Deadline</td>
                                <td>September 30th, 2023</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Notification of Acceptance</td>
                                <td>October 7th, 2023</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Early Bird Registration Deadline</td>
                                <td>September 15th, 2023</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <th>Conference Dates</th>
                                <th>13th - 14th October, 2023</th>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('footer-scripts')
@endpush
