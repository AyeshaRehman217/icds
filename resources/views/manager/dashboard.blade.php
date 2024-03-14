@extends('manager.layouts.app')
@section('page_title')
    {{(!empty($page_title) && isset($page_title)) ? $page_title : ''}}
@endsection
@push('head-scripts')

@endpush
@section('content')
{{--    <div class="card mt-3">--}}
{{--        <div class="card-body">--}}
            {{-- Start: Page Content --}}
{{--            <div class="d-flex justify-content-between">--}}
{{--                <div>--}}
{{--                    <h4 class="card-title mb-0">{{(!empty($p_title) && isset($p_title)) ? $p_title : ''}}</h4>--}}
{{--                    <div class="small text-medium-emphasis">{{(!empty($p_summary) && isset($p_summary)) ? $p_summary : ''}}</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <hr>--}}
{{--            <div class="card-footer">--}}
{{--            <div class="row justify-content-center">--}}
{{--                        <div class="col-sm-6 mb-sm-2 my-3 ">--}}
{{--                            <div class="justify-content-center d-flex">--}}
{{--                            <div class="image"><i class="fa-regular fa-address-card" style="font-size: 3.5rem"></i></div>--}}
{{--                            <div class="d-inline text-center mx-4">--}}
{{--                            <div class="text-medium-emphasis"><strong>Registrations</strong></div>--}}
{{--                            <div class="fw-semibold" style="font-size:1.25rem">{{$userCount}}</div>--}}
{{--                            </div> --}}
{{--                            </div>--}}
{{--                            --}}{{-- <div class="progress progress-thin mt-2">--}}
{{--                                <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div> --}}
{{--                        </div>--}}
{{--                        <div class="col-sm-1 mt-2">--}}
{{--                        <div class="vr" style="border-right: 3px solid #3c4b64;border-radius:20%;height:70px;opacity:1"></div></div>--}}
{{--                        <div class="col-sm-5 mb-sm-2 my-3">--}}
{{--                            <div class="justify-content-center d-flex">--}}
{{--                                <div class="image"><i class="fa-solid fa-paperclip" style="font-size: 3.5rem"></i></div>--}}
{{--                                <div class="d-inline text-center mx-4">--}}
{{--                                <div class="text-medium-emphasis"><strong>Abstract Submissions</strong></div>--}}
{{--                                <div class="fw-semibold" style="font-size:1.25rem">{{$userCount}}</div>--}}
{{--                                </div> --}}
{{--                                </div>--}}
{{--                        </div>--}}
{{--                    --}}
{{--                </div>--}}

{{--                <!-- /.col-->--}}
{{--            </div>--}}

            <!-- /.row-->
{{--        </div>--}}
{{--    </div>--}}


    {{-- ...................................... --}}

@endsection
@push('footer-scripts')

@endpush
