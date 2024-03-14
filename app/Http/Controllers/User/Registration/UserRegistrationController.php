<?php

namespace App\Http\Controllers\User\Registration;

//use App\Http\Controllers\Admin\UserManagement\String_;
use App\Http\Controllers\Controller;
use App\Models\CertificatePDF;
use App\Models\RegistrationType;
use App\Models\Session as ICDSSession;
use App\Models\User;
use App\Models\UserRegistration;
use App\Models\VoucherPDF;
use App\Models\VoucherPDFHead;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Response;


class UserRegistrationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user_registration_user-registration-list', ['only' => ['index', 'getIndex']]);
    }

    public function index()
    {
        //Data Array
        $data = array(
            'page_title' => 'Registration',
            'p_title' => 'Registration',
            'p_summary' => '',
            'p_description' => null,
            // 'data' => $uid->id,
        );

        return view('user.registration.userRegistration.index')->with($data);
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        # Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        // $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        // $columnIndex = $columnIndex_arr[0]['column']; // Column index
        // $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        // $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        //Add Filters
        $where = [];

        if (!empty($request->get('user_id'))) {
            $user = $request->get('user_id');
            $var = ['user_registrations.user_id', '=', $user];
            array_push($where, $var);
        } elseif (!empty($request->get('user_id'))) {
            $user = $request->get('user_id');
            $var = ['user_registrations.user_id', '=', $user];
            array_push($where, $var);
        }
        if (!empty($request->get('registration_type_id'))) {
            $registration_type = $request->get('registration_type_id');
            $var = ['user_registrations.registration_type_id', '=', $registration_type];
            array_push($where, $var);
        }

        if (!empty($request->get('module_id'))) {
            $module = $request->get('module_id');
            $var = ['user_registrations.module_id', '=', $module];
            array_push($where, $var);
        }

        if (!empty($request->get('session_id'))) {
            $session = $request->get('session_id');
            $var = ['user_registrations.session_id', '=', $session];
            array_push($where, $var);
        } elseif (!empty($request->get('sid'))) {
            // Use the 'sid' parameter to filter by session ID
            $session = $request->get('sid');
            $var = ['user_registrations.session_id', '=', $session];
            array_push($where, $var);
        }

        if (!empty($request->get('registration_status_id'))) {
            $registration_status = $request->get('registration_status_id');
            $var = ['user_registrations.registration_status_id', '=', $registration_status];
            array_push($where, $var);
        }

        // Total records
        $totalRecords = UserRegistration::select('user_registrations.*', 'users.name as name', 'users.email as email',
            'registration_types.name as registration_type_name', 'modules.name as module_name',
            'registration_statuses.name as registration_status_name', 'sessions.name as session_name')
            ->leftJoin('users', 'users.id', '=', 'user_registrations.user_id')
            ->leftJoin('sessions', 'sessions.id', '=', 'user_registrations.session_id')
            ->leftJoin('registration_types', 'registration_types.id', '=', 'user_registrations.registration_type_id')
            ->leftJoin('modules', 'modules.id', '=', 'users.module_id')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'user_registrations.registration_status_id')
            ->where($where)
            ->where('user_id', Auth::user()->id)
            ->count();

        // Total records with filter
        $totalRecordswithFilter = UserRegistration::select('user_registrations.*', 'users.name as name', 'users.email as email',
            'registration_types.name as registration_type_name', 'modules.name as module_name',
            'registration_statuses.name as registration_status_name', 'sessions.name as session_name')
            ->leftJoin('users', 'users.id', '=', 'user_registrations.user_id')
            ->leftJoin('sessions', 'sessions.id', '=', 'user_registrations.session_id')
            ->leftJoin('registration_types', 'registration_types.id', '=', 'user_registrations.registration_type_id')
            ->leftJoin('modules', 'modules.id', '=', 'users.module_id')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'user_registrations.registration_status_id')
            ->where($where)
            ->where('user_id', Auth::user()->id)
            ->where(function ($q) use ($searchValue) {
                $q->where('users.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.email', 'like', '%' . $searchValue . '%')
                    ->orWhere('modules.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('sessions.name', 'like', '%' . $searchValue . '%');
            })
            ->count();

        // Fetch records
        $records = UserRegistration::select('user_registrations.*', 'users.name as name', 'users.email as email',
            'registration_types.name as registration_type_name', 'modules.name as module_name',
            'registration_statuses.name as registration_status_name', 'sessions.name as session_name')
            ->leftJoin('users', 'users.id', '=', 'user_registrations.user_id')
            ->leftJoin('sessions', 'sessions.id', '=', 'user_registrations.session_id')
            ->leftJoin('registration_types', 'registration_types.id', '=', 'user_registrations.registration_type_id')
            ->leftJoin('modules', 'modules.id', '=', 'users.module_id')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'user_registrations.registration_status_id')
            ->where($where)
            ->where('user_id', Auth::user()->id)
            ->where(function ($q) use ($searchValue) {
                $q->where('users.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.email', 'like', '%' . $searchValue . '%')
                    ->orWhere('modules.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('sessions.name', 'like', '%' . $searchValue . '%');
            })
            // ->skip($start)
            // ->take($rowperpage)
            // ->orderBy($columnName, $columnSortOrder)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $name = $record->name;
            $email = $record->email;
            $session_name = $record->session_name;
            $module_name = $record->module_name;
            $registration_type_name = $record->registration_type_name;
            $voucher_upload = $record->voucher_upload;
            $registration_status_name = $record->registration_status_name;
            $attendee_status = $record->attendee_status;

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "session_name" => $session_name,
                "module_name" => $module_name,
                "registration_type_name" => $registration_type_name,
                "voucher_upload" => $voucher_upload,
                "registration_status_name" => $registration_status_name,
                "attendee_status" => $attendee_status,

            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );
        // dd($response);
        echo json_encode($response);
        exit;
    }

    public function editStatus(string $id)
    {
        $record = UserRegistration::select('user_registrations.*', 'registration_statuses.id as registration_status_id', 'registration_statuses.name as registration_status_name')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'user_registrations.registration_status_id')
            ->where('user_registrations.id', '=', $id)
            ->first();

        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }
        $data = array(
            'page_title' => 'Registration Status',
            'p_title' => 'Registration Status',
            'p_summary' => 'Edit Status',
            'p_description' => null,
            'method' => 'POST',
            'action' => route('user.get.user-registration-status', $record->id),
            'url' => route('user.user-registration'),
            'url_text' => 'View All',
            'data' => $record,
            // 'enctype' => 'multipart/form-data' // (Default)Without attachment
            'enctype' => 'application/x-www-form-urlencoded', // With attachment like file or images in form
        );
        return view('user.registration.userRegistration.status')->with($data);
    }

    public function voucher($id)
    {

        $user_registration = UserRegistration::where('id', $id)->first();
        $user = User::where('id', $user_registration->user_id)->first();
        $registration_types = RegistrationType::where('id', $user_registration->registration_type_id)
            ->orderBy('id', 'desc')
            ->first();
        $sessions = ICDSSession::where('id', $user_registration->session_id)->first();

        $voucher = VoucherPDF::where('user_registration_id', $id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();

        $voucherHead = VoucherPDFHead::select('voucher_pdf_fee_head.*')
            ->leftjoin('voucher_pdf', 'voucher_pdf.id', '=', 'voucher_pdf_fee_head.voucher_pdf_id')
            ->first();

//        if voucher record is not stored then store record and download voucher
        if (!isset($voucher)) {
            $arr = [
                'user_id' => $user->id,
                'session_id' => $sessions->id,
                'registration_type_id' => $registration_types->id,
                'user_registration_id' => $user_registration->id,
                'bank_name' => 'Habib Metropolitan Bank Limited',
                'branch_code' => '1208',
                'swift_code' => 'MPBLPKKA',
                'account_title' => 'The University of Faisalabad Main Account',
                'account_no' => '06-12-08-20311-714-100017',
                'iban_no' => ' PK22MPBL1208027140100017',
                'country_no' => 'Pakistan',
                'last_date' => '14/10/2023',
                'challan_no' => random_int(1000000000, 9999999999),
                'name' => $user->name,
                'email' => $user->email,
                'voucher_type' => 'cash'
            ];


            $voucherPdf = VoucherPDF::create($arr);

            if ($voucherPdf) {
                if ($user_registration->country_id == 167) {
                    $voucherHeadStore['voucher_pdf_id'] = $voucherPdf->id;
                    $voucherHeadStore['head'] = $registration_types->name;
                    $voucherHeadStore['amount'] = $registration_types->amount;
                    VoucherPDFHead::create($voucherHeadStore);
                } else {
                    $voucherHeadStore['voucher_pdf_id'] = $voucherPdf->id;
                    $voucherHeadStore['head'] = $registration_types->name;
                    $voucherHeadStore['amount'] = $registration_types->dollar_amount;
                    VoucherPDFHead::create($voucherHeadStore);
                }
            }

        } else {

            $arr = [
                'user_id' => $voucher->user_id,
                'session_id' => $voucher->session_id,
                'registration_type_id' => $registration_types->id,
                'user_registration_id' => $voucher->user_registration_id,
                'bank_name' => 'Habib Metropolitan Bank Limited',
                'branch_code' => '1208',
                'swift_code' => 'MPBLPKKA',
                'account_title' => 'The University of Faisalabad Main Account',
                'account_no' => '06-12-08-20311-714-100017',
                'iban_no' => ' PK22MPBL1208027140100017',
                'country_no' => 'Pakistan',
                'last_date' => '14/10/2023',
                'challan_no' => $voucher->challan_no,
                'name' => $voucher->name,
                'email' => $voucher->email,
                'voucher_type' => 'cash'
            ];

            $voucherPdf = $voucher->update($arr);

            if ($voucherPdf) {
                if ($user_registration->country_id == 167) {
                    $arr1 = [
                        'voucher_pdf_id' => $voucherHead->voucher_pdf_id,
                        'head' => $registration_types->name,
                        'amount' => $registration_types->amount
                    ];
                    $voucherHead->update($arr1);
                } else {
                    $arr1 = [
                        'voucher_pdf_id' => $voucherHead->voucher_pdf_id,
                        'head' => $registration_types->name,
                        'amount' => $registration_types->dollar_amount
                    ];
                    $voucherHead->update($arr1);
                }
            }
        }

        $voucher = VoucherPDF::where('user_registration_id', $id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();

        $voucherHead = VoucherPDFHead::select('voucher_pdf_fee_head.*')
            ->leftjoin('voucher_pdf', 'voucher_pdf.id', '=', 'voucher_pdf_fee_head.voucher_pdf_id')
            ->where('voucher_pdf.user_registration_id', $id)->get();


        $grand_total = 0;
        foreach ($voucherHead as $total_amount) {
            $grand_total += $total_amount->amount;
        }
        $amount_words = $this->numberToWord($grand_total);

        $pdf = PDF::loadView('pdf.voucher1', compact('voucher', 'voucherHead', 'grand_total', 'amount_words', 'user_registration'));
        $pdf->setPaper('A4', 'landscape');
        $name = $voucher->name;
        return $pdf->download("$name-" . $voucher->id . '.pdf');

    }

    public
    function numberToWord($num = '')
    {
        $num = ( string )(( int )$num);

        if (( int )($num) && ctype_digit($num)) {
            $words = array();

            $num = str_replace(array(',', ' '), '', trim($num));

            $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
                'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
                'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen');

            $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',
                'seventy', 'eighty', 'ninety', 'hundred');

            $list3 = array('', 'thousand', 'million', 'billion', 'trillion',
                'quadrillion', 'quintillion', 'sextillion', 'septillion',
                'octillion', 'nonillion', 'decillion', 'undecillion',
                'duodecillion', 'tredecillion', 'quattuordecillion',
                'quindecillion', 'sexdecillion', 'septendecillion',
                'octodecillion', 'novemdecillion', 'vigintillion');

            $num_length = strlen($num);
            $levels = ( int )(($num_length + 2) / 3);
            $max_length = $levels * 3;
            $num = substr('00' . $num, -$max_length);
            $num_levels = str_split($num, 3);

            foreach ($num_levels as $num_part) {
                $levels--;
                $hundreds = ( int )($num_part / 100);
                $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');
                $tens = ( int )($num_part % 100);
                $singles = '';

                if ($tens < 20) {
                    $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
                } else {
                    $tens = ( int )($tens / 10);
                    $tens = ' ' . $list2[$tens] . ' ';
                    $singles = ( int )($num_part % 10);
                    $singles = ' ' . $list1[$singles] . ' ';
                }
                $words[] = $hundreds . $tens . $singles . (($levels && ( int )($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
            }
            $commas = count($words);
            if ($commas > 1) {
                $commas = $commas - 1;
            }

            $words = implode(', ', $words);

            $words = trim(str_replace(' ,', ',', ucwords($words)), ', ');
            if ($commas) {
                $words = str_replace(',', ' and', $words);
            }

            return $words;
        } else if (!(( int )$num)) {
            return 'Zero';
        }
        return '';
    }

    public function upload(Request $request, $id)
    {
        $user_registration = UserRegistration::findOrFail($id);

        try {
            $this->validate($request, [
                'voucher_upload' => 'required|mimes:jpg,png,jpeg,pdf',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = [
                [
                    'message' => 'Only .pdf, .jpg, .png, .jpeg format are allowed.',
                    'message_type' => 'error'
                ]
            ];

            return redirect()->back()->with('messages', $messages);
        }

        $uploadedFile = $request->file('voucher_upload');
        $uploadedFileOriginalName = $uploadedFile->getClientOriginalName();
        $fileName = pathinfo($uploadedFileOriginalName, PATHINFO_FILENAME);
        $extension = $request->file('voucher_upload')->extension();
        $folderPath = 'user/voucher/';
        $filename = date('Y') . '/' . date('m') . '/' . date('d') . '/' . time() . '-' . rand(0, 999999) . $fileName . '.' . $extension;
        $file = $folderPath . $filename;
        Storage::disk('private')->put($file, file_get_contents($uploadedFile->getRealPath()));

        $arr = [
            'voucher_upload' => $filename,
            'updated_by' => Auth::user()->id,
        ];

        $user_registration['registration_status_id'] = 1;
        $user_registration->update($arr);
        $messages = [
            array(
                'message' => 'Voucher Uploaded successfully',
                'message_type' => 'success'
            ),
        ];
        Session::flash('messages', $messages);

        return redirect(url('user/user-registration'));

    }

    public function getImage($id)
    {
        $record = UserRegistration::where('id', '=', $id)->first();
        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }
        $path = Storage::disk('private')->path('user/voucher/' . $record->voucher_upload);
        if (File::exists($path)) {
            // dd($path);
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } else {
            abort(404, 'NOT FOUND');
        }

    }

    public function gatePass($id)
    {
        $user_registration = UserRegistration::where('id', $id)->first();
        $user = User::where('id', $user_registration->user_id)->first();
        $usersCount = User::where('id', $user_registration->user_id)->where('name', '!=', '')->count();
        $pdf = PDF::loadView('pdf.gate_pass', compact('user_registration', 'user', 'usersCount'));
        $pdf->setPaper('A4', 'landscape');
        $name = $user->name;
        return $pdf->download("$name-" . $user_registration->id . '.pdf');
    }

    public function certificate($id)
    {

        $user_registration = UserRegistration::where('id', $id)->first();
        $user = User::where('id', $user_registration->user_id)->first();

        $sessions = ICDSSession::where('id', $user_registration->session_id)->first();

        $certificate = CertificatePDF::where('user_registration_id', $id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();


//        if certificate record is not stored then store record and download certificate
        if (!isset($certificate)) {
            $arr = [
                'user_id' => $user->id,
                'user_registration_id' => $user_registration->id,
                'session_id' => $sessions->id,
                'issue_date' => '12/07/2023',
                'start_date' => '12/05/2023',
                'end_date' => '12/06/2023',
                'title' => $user_registration->title,
                'name' => $user->name,
                'event_name' => '3rd International Conference on Dermal Sciences',
                'venue' => 'The University of Faisalabad',
            ];

            CertificatePDF::create($arr);

        } else {

            $arr = [
                'user_id' => $user->id,
                'user_registration_id' => $user_registration->id,
                'session_id' => $sessions->id,
                'issue_date' => '12/07/2023',
                'start_date' => '12/05/2023',
                'end_date' => '12/06/2023',
                'title' => $user_registration->title,
                'name' => $user->name,
                'event_name' => '3rd International Conference on Dermal Sciences',
                'venue' => 'The University of Faisalabad',
            ];

            $certificate->update($arr);
        }

        $certificate = CertificatePDF::where('user_registration_id', $id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();


        $pdf = PDF::loadView('pdf.certificate', compact('certificate',  'user_registration'));
        $pdf->setPaper('A4', 'landscape');
        $name = $certificate->name;
        return $pdf->download("$name-" . $certificate->id . '.pdf');

    }
}
