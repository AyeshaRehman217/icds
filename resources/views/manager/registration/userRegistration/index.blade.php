@extends('manager.layouts.app')
@section('page_title')
    {{(!empty($page_title) && isset($page_title)) ? $page_title : ''}}
@endsection
@push('head-scripts')
    <link rel="stylesheet" href="{{ asset('manager/datatable/datatables.min.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    <div class="card mt-3">
        <div class="card-body">
            {{-- Start: Page Content --}}
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title mb-0">{{(!empty($p_title) && isset($p_title)) ? $p_title : ''}}</h4>
                    <div
                        class="small text-medium-emphasis">{{(!empty($p_summary) && isset($p_summary)) ? $p_summary : ''}}</div>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    @can('manager_registration_user-registration-create')
                        <a href="{{(!empty($url) && isset($url)) ? $url : ''}}"
                           class="btn btn-sm btn-primary">{{(!empty($url_text) && isset($url_text)) ? $url_text : ''}}</a>
                    @endcan
                    @can('manager_registration_user-registration-activity-log-trash')
                        <a href="{{(!empty($trash) && isset($trash)) ? $trash : ''}}"
                           class="btn btn-sm btn-danger">{{(!empty($trash_text) && isset($trash_text)) ? $trash_text : ''}}</a>
                    @endcan
                </div>
            </div>
            <hr>
            {{-- Datatatble : Start --}}
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="indextable"
                               class="table table-bordered table-striped table-hover table-responsive w-100 pt-1">
                            <thead class="table-dark">
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Session</th>
                            <th>Registration Type</th>
                            <th>Payment Type</th>
                            {{--                            <th>Module</th>--}}
                            <th>Registration Status</th>
                            <th>Voucher</th>
                            <th>Gate Pass</th>
                           <th>Generate Certificate</th>
                            <th>Certificate</th>
                            <th>Actions</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Datatatble : End --}}
            {{-- Page Description : Start --}}
            @if(!empty($p_description) && isset($p_description))
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 mb-sm-2 mb-0">
                            <p>{{(!empty($p_description) && isset($p_description)) ? $p_description : ''}}</p>
                        </div>
                    </div>
                </div>
            @endif
            {{-- Page Description : End --}}

            {{-- Delete Confirmation Model : Start --}}
            <div class="del-model-wrapper">
                <div class="modal fade" id="del-model-delete" tabindex="-1" aria-labelledby="del-model-delete"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close shadow-none" data-coreui-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p>
                                <p class="text-muted "> This item will be deleted immediately. You can't undo this
                                    action.</p>
                            </div>
                            <div class="modal-footer">
                                <form method="POST" id="del-form">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="button" class="btn btn-light" data-coreui-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Delete Confirmation Model : End --}}

            {{-- Upload Voucher Model : Start --}}
            <div class="upload-model-wrapper">
                <div class="modal fade" id="upload-model" tabindex="-1" aria-labelledby="upload-model"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close shadow-none" data-coreui-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 class="font-weight-bold text-center">Upload Voucher</h5>
                            </div>
                            <div class="my-2">
                                <form method="POST" id="upload-form" enctype="multipart/form-data">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <div class="row px-3">
                                        <div class="col-md-12">
                                            <input type="file" name="voucher_upload" class="form-control" id=""
                                                   value="voucher_upload">
                                        </div>
                                        <p class="text-danger ms-1" style="font-size: small">Only .pdf, .jpg, .png,
                                            .jpeg format are allowed.</p>
                                        <div class="col-md-12 mt-3 text-center">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                {{ __('Submit') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Voucher Upload Model : End --}}
            {{-- End: Page Content --}}
        </div>
    </div>

@endsection
@push('footer-scripts')
    <script type="text/javascript" src="{{ asset('manager/datatable/datatables.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var sid = {{$sdata}};
            //Datatable
            $('#indextable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                order: [[0, "desc"]],
                ajax: {
                    "type": "GET",
                    "url": "{{route('manager.get.user-registration')}}",
                    "data": function (d) {
                        d.sid = sid;
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'session_name'},
                    {data: 'registration_type_name'},
                    {data: 'payment_type_name'},
                    {data: 'registration_status_name'},
                    {data: null},
                    {data: null},
                    {data: null},
                    // {data: 'attendee_status'},
                    {data: null},
                    {data: null},
                ],
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                        searchable: false,
                        width: '30px',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        targets: 6,
                        orderable: true,
                        className: 'perm_col',

                        // defaultContent: '<span class="badge bg-info text-dark">group</span>'
                        render: function (data, type, row, meta) {

                            let URL = "{{ route('manager.get.user-registration-status', [':sid',':id']) }}";
                            URL = URL.replace(':id', row.id);
                            URL = URL.replace(':sid', {{$sdata}});
                            var output = "";
                            @can('manager_master-data_registration-status-status-edit')
                            // Check if data is approved or rejected and set the badge color accordingly
                            if (data === 'Approved') {
                                output += '<a href="' + URL + '"><span class="badge bg-success">' + data + '</span></a>';
                            } else if (data === 'Rejected') {
                                output += '<a href="' + URL + '"><span class="badge bg-danger">' + data + '</span></a>';
                            } else {
                                output += '<a href="' + URL + '"><span class="badge bg-secondary">' + data + '</span></a>';
                            }
                            @endcan

                                return output;
                        }

                    },
                    {
                        targets: 7,
                        searchable: false,
                        orderable: false,
                        render: function (data, type, row, meta) {

                            var voucher = '{{ route("manager.download-voucher", ":id") }}';
                            voucher = voucher.replace(':id', data.id);

                            var upload = '{{ route("manager.upload-voucher", [":sid",":id"]) }}';
                            upload = upload.replace(':sid', {{$sdata}});
                            upload = upload.replace(':id', data.id);

                            var view = '{{ route("manager.get.voucher-image", ":id") }}';
                            view = view.replace(':id', data.id);
                            if (data.payment_type_name != 'Onsite Payment'){
                            if (data.voucher_upload == null) {

                                if ((data.registration_type_name == 'Student' || 'Faculty')) {

                                    if (data.voucher_upload == null) {
                                        return '<div class="d-flex">' +
                                            @can('manager_registration_user-registration-voucher-download')
                                                '<a href="' + voucher + '" class="btn btn-sm btn-primary mx-2"><i class="fa fa-download text-white"></i></a>' +
                                            @endcan
                                                @can('manager_registration_user-registration-voucher-upload')
                                                '<a class="me-1" href="javascript:void(0)"><span type="button" class="btn btn-sm btn-success" data-url="' + upload + '" data-coreui-toggle="modal" data-coreui-target="#upload-model"><i class="fa fa-upload text-white"></i></span></a>' +
                                            @endcan
                                                '</div>';
                                    } else {
                                        return '<div class="d-flex">' +
                                            @can('manager_registration_user-registration-voucher-view')
                                                '<a href="' + view + '" class="btn btn-sm btn-primary mx-2" target="_blank"><i class="fa fa-eye text-white"></i></a>' +
                                            @endcan
                                                '</div>';
                                    }
                                }
                                if (data.registration_status_name == 'Approved') {
                                    return '<div class="d-flex">' +
                                        '<p>No Voucher</p>' +
                                        '</div>';
                                } else {
                                    return '<div class="d-flex">' +
                                        @can('manager_registration_user-registration-voucher-download')
                                            '<a href="' + voucher + '" class="btn btn-sm btn-primary mx-2" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Download Voucher"><i class="fa fa-download text-white"></i></a>' +
                                        @endcan
                                            @can('manager_registration_user-registration-voucher-upload')
                                            '<a class="me-1" href="javascript:void(0)"><span type="button" class="btn btn-sm btn-success" data-url="' + upload + '" data-coreui-toggle="modal" data-coreui-target="#upload-model" title="Upload Voucher"><i class="fa fa-upload text-white"></i></span></a>' +
                                        @endcan
                                            '</div>';
                                }

                            } else if (data.registration_status_name == 'Rejected') {
                                return '<div class="d-flex">' +
                                    @can('manager_registration_user-registration-voucher-download')
                                        '<a href="' + voucher + '" class="btn btn-sm btn-primary mx-2" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Download Voucher"><i class="fa fa-download text-white"></i></a>' +
                                    @endcan
                                        @can('manager_registration_user-registration-voucher-upload')
                                        '<a class="me-1" href="javascript:void(0)"><span type="button" class="btn btn-sm btn-success" data-url="' + upload + '" data-coreui-toggle="modal" data-coreui-target="#upload-model" title="Upload Voucher"><i class="fa fa-upload text-white"></i></span></a>' +
                                    @endcan
                                        '</div>';
                            } else {
                                return '<div class="d-flex">' +
                                    @can('manager_registration_user-registration-voucher-view')
                                        '<a href="' + view + '" class="btn btn-sm btn-primary mx-2" target="_blank"><i class="fa fa-eye text-white"></i></a>' +
                                    @endcan
                                        '</div>';
                            }
                        } else{
                            return '<div class="d-flex">' +  '</div>';
                        }
                        },

                    },
                    {
                        targets: 8,
                        orderable: false,
                        className: 'perm_col',
                        render: function (data, type, row, meta) {

                            var gatePass = '{{ route("manager.download-gate-pass", ":id") }}';
                            gatePass = gatePass.replace(':id', data.id);

                            @can('manager_registration_user-registration-gate-pass-download')
                            if (data.registration_status_name == 'Pending') {
                                return '<div class="d-flex">' +
                                    // '<span class="badge bg-secondary mx-2">Pending</span>' +
                                    '</div>';
                            } else if (data.registration_status_name == 'Approved') {
                                return '<div class="d-flex">' +
                                    '<a href="' + gatePass + '"><span class="btn btn-sm btn-warning mx-2"><i class="fa fa-download text-white"></i></span></a>'
                                '</div>';
                            } else if (data.registration_status_name == 'Rejected') {
                                return '<div class="d-flex">' +
                                    // '<span class="badge bg-secondary mx-2">Pending</span>' +
                                    '</div>';
                            }
                            @endcan

                        }
                    },
                    {
                        targets: 9,
                        orderable: false,
                        className: 'perm_col',
                        // defaultContent: '<span class="badge bg-info text-dark">group</span>'
                        render: function (data, type, row, meta) {
                        let URL = "{{ route('manager.get.user-registration-certificate-status', [':sid',':id']) }}"
                        URL = URL.replace(':id', row.id);
                        URL = URL.replace(':sid', {{$sdata}});
                        var output = "";

                        // Check if data is approved or rejected and set the badge color accordingly
                        if (data.attendee_status == 1) {
                            output += '<a href="' + URL + '"><span class="badge bg-success">Issue Certificate</span></a>';
                        } else {
                            // Display "None" button and link to the status change page
                            output += '<a href="' + URL + '"><span class="badge bg-danger">Not Issue Certificate</span></a>';
                        }

                        return output;
                    }
                    },
                    {
                        targets: 10,
                        orderable: false,
                        className: 'perm_col',
                        render: function (data, type, row, meta) {

                            var certificate = '{{ route("manager.download-certificate", ":id") }}';
                            certificate = certificate.replace(':id', data.id);

                            {{--                            @can('manager_registration_user-registration-gate-pass-download')--}}
                            if (data.attendee_status == 0) {
                                return '<div class="d-flex">' +'</div>';
                            } else if (data.attendee_status == 1) {
                                return '<div class="d-flex">' +
                                    '<a href="' + certificate + '"><span class="btn btn-sm btn-dark mx-2"><i class="fa fa-download text-white"></i></span></a>'
                                '</div>';
                            }
                            {{--@endcan--}}

                        }
                    },
                    {
                        targets: -1,
                        searchable: false,
                        orderable: false,
                        render: function (data, type, row, meta) {

                            let ABSTRACT_SUBMISSION = "{{ route('manager.session.user-registration.abstract-submission.index',[':sid',':uid']) }}";
                            ABSTRACT_SUBMISSION = ABSTRACT_SUBMISSION.replace(':uid', row.id);
                            ABSTRACT_SUBMISSION = ABSTRACT_SUBMISSION.replace(':sid', {{$sdata}});

                            let URL = "{{route('manager.session.user-registration.show',[':sid',':id'] )}}";
                            URL = URL.replace(':id', row.id);
                            URL = URL.replace(':sid', {{$sdata}});

                            let ACTIVITY = "{{ route('manager.get.user-registration-activity', [':sid',':id']) }}";
                            ACTIVITY = ACTIVITY.replace(':id', row.id);
                            ACTIVITY = ACTIVITY.replace(':sid', {{$sdata}});

                            return '<div class="d-flex">' +
                                @can('manager_registration_user-registration-show')
                                    '<a class="me-1" href="' + URL + '"><span class="badge bg-success text-dark">Show</span>' +
                                @endcan
                                    @can('manager_registration_user-registration-edit')
                                    '<a class="me-1" href="' + URL + '/edit"><span class="badge bg-info text-dark">Edit</span></a>' +
                                @endcan
                                    @can('manager_registration_user-registration-activity-log')
                                    '<a class="me-1" href="' + ACTIVITY + '"><span class="badge bg-warning text-dark">Activity</span></a>' +
                                @endcan
                                    @can('manager_registration_user-registration-delete')
                                    '<a class="me-2" href="javascript:void(0)"><span type="button" class="badge bg-danger" data-url="' + URL + '" data-coreui-toggle="modal" data-coreui-target="#del-model-delete">Delete</span></a>' +
                                @endcan
                                    '| ' +
                                @can('manager_registration_abstract-submission-list')
                                    '<a class="mx-2" href="' + ABSTRACT_SUBMISSION + '"><span class="badge bg-dark text-light">Abstract</span>' +
                                @endcan
                                    '</div>'

                        }
                    }
                ]
            });
        });

        function selectRange() {
            $('.dataTable').DataTable().ajax.reload()
        }
    </script>
    {{-- Delete Confirmation Model : Script : Start --}}
    <script>
        $("#upload-model").on('show.coreui.modal', function (event) {
            var triggerLink = $(event.relatedTarget);
            var url = triggerLink.data("url");
            $("#upload-form").attr('action', url);
        })
    </script>
    <script>
        $("#del-model-delete").on('show.coreui.modal', function (event) {
            var triggerLink = $(event.relatedTarget);
            var url = triggerLink.data("url");
            $("#del-form").attr('action', url);
        })
    </script>

    {{-- Delete Confirmation Model : Script : Start --}}
    {{-- Toastr : Script : Start --}}
    @if(Session::has('messages'))
        <script>
            noti({!! json_encode((Session::get('messages'))) !!});
        </script>
    @endif
    {{-- Toastr : Script : End --}}
@endpush
