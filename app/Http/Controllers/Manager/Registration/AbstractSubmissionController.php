<?php

namespace App\Http\Controllers\Manager\Registration;

//use App\Http\Controllers\Admin\UserManagement\String_;
use App\Http\Controllers\Controller;
use App\Models\AbstractSubmission;
use App\Models\RegistrationStatus;
use App\Models\User;
use App\Models\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class AbstractSubmissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:manager_registration_abstract-submission-list', ['only' => ['index', 'getIndex']]);
        $this->middleware('permission:manager_registration_abstract-submission-activity-log', ['only' => ['getActivity', 'getActivityLog']]);
        $this->middleware('permission:manager_registration_abstract-submission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:manager_registration_abstract-submission-show', ['only' => ['show']]);
        $this->middleware('permission:manager_registration_abstract-submission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:manager_registration_abstract-submission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index($sid, $uid)
    {
        $sid = \App\Models\Session::where('id', $sid)->first();
        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        $uid = UserRegistration::where('id', $uid)->first();
        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }

        $data = [
            'page_title' => 'Abstract Submission',
            'p_title' => 'Abstract Submission',
            'p_summary' => 'List of Abstract Submission',
            'p_description' => null,
            'url' => route('manager.session.user-registration.abstract-submission.create', [$sid->id, $uid->id]),
            'url_text' => 'Add New',
            'trash' => route('manager.get.abstract-submission-activity-trash', [$sid->id, $uid->id]),
            'trash_text' => 'View Trash',
            'sdata' => $sid->id,
            'udata' => $uid->id,
        ];
        return view('manager.registration.abstractSubmission.index')->with($data);
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        //Add Filters
        $where = [];
        if (!empty($request->get('user_id'))) {
            $user = $request->get('user_id');
            $var = ['abstract_submissions.user_id', '=', $user];
            array_push($where, $var);
        }

        if (!empty($request->get('user_registration_id'))) {
            $user_registration = $request->get('user_registration_id');
            $var = ['abstract_submissions.user_registration_id', '=', $user_registration];
            array_push($where, $var);
        }

        if (!empty($request->get('registration_status_id'))) {
            $registration_status = $request->get('registration_status_id');
            $var = ['abstract_submissions.registration_status_id', '=', $registration_status];
            array_push($where, $var);
        }

        // Add a condition to filter based on 'user_registration_id'
        if (!empty($request->get('uid'))) {
            $uid = $request->get('uid');
            $var = ['abstract_submissions.user_registration_id', '=', $uid];
            array_push($where, $var);
        }

        // Total records
        $totalRecords = AbstractSubmission::select('abstract_submissions.*', 'users.name as name', 'users.email as email',
            'user_registrations.contact_no as contact_no', 'registration_statuses.name as registration_status_name')
            ->leftJoin('users', 'users.id', '=', 'abstract_submissions.user_id')
            ->leftJoin('user_registrations', 'user_registrations.id', '=', 'abstract_submissions.user_registration_id')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'abstract_submissions.registration_status_id')
            ->where($where)
            ->count();

        // Total records with filter
        $totalRecordswithFilter = AbstractSubmission::select('abstract_submissions.*', 'users.name as name', 'users.email as email',
            'user_registrations.contact_no as contact_no', 'registration_statuses.name as registration_status_name')
            ->leftJoin('users', 'users.id', '=', 'abstract_submissions.user_id')
            ->leftJoin('user_registrations', 'user_registrations.id', '=', 'abstract_submissions.user_registration_id')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'abstract_submissions.registration_status_id')
            ->where($where)
            ->where(function ($q) use ($searchValue) {
                $q->where('users.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.email', 'like', '%' . $searchValue . '%');
            })
            ->count();

        // Fetch records
        $records = AbstractSubmission::select('abstract_submissions.*', 'users.name as name', 'users.email as email',
            'user_registrations.contact_no as contact_no', 'registration_statuses.name as registration_status_name')
            ->leftJoin('users', 'users.id', '=', 'abstract_submissions.user_id')
            ->leftJoin('user_registrations', 'user_registrations.id', '=', 'abstract_submissions.user_registration_id')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'abstract_submissions.registration_status_id')
            ->where($where)
            ->where(function ($q) use ($searchValue) {
                $q->where('users.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.email', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowperpage)
            ->orderBy($columnName, $columnSortOrder)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $name = $record->name;
            $email = $record->email;
            $contact_no = $record->contact_no;
            $registration_status_name = $record->registration_status_name;

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "contact_no" => $contact_no,
                "registration_status_name" => $registration_status_name,

            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );
        echo json_encode($response);
        exit;
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getIndexSelect(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = AbstractSubmission::select('abstract_submissions.id as id', 'abstract_submissions.name as name')
                ->where(function ($q) use ($search) {
                    $q->where('abstract_submissions.name', 'like', '%' . $search . '%');
                })
                ->get();
        }

        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($sid, $uid)
    {

        $sid = \App\Models\Session::where('id', $sid)->first();
        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        $uid = UserRegistration::where('id', $uid)->first();
        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }
        $data = array(
            'page_title' => 'Abstract Submission',
            'p_title' => 'Abstract Submission',
            'p_summary' => 'Add Abstract Submission',
            'p_description' => null,
            'method' => 'POST',
            'action' => route('manager.session.user-registration.abstract-submission.store', [$sid->id, $uid->id]),
            'url' => route('manager.session.user-registration.abstract-submission.index', [$sid->id, $uid->id]),
            'url_text' => 'View All',
            'enctype' => 'multipart/form-data' // (Default)Without attachment
//            'enctype' => 'application/x-www-form-urlencoded', // With attachment like file or images in form
        );
        return view('manager.registration.abstractSubmission.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $sid, $uid)
    {
        $sid = \App\Models\Session::where('id', $sid)->first();
        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        $uid = UserRegistration::where('id', $uid)->first();
        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }

        $userid = User::select('users.*')
            ->leftJoin('user_registrations', 'user_registrations.user_id', '=', 'users.id')
            ->where('users.id', $uid->user_id)->first();
        if (empty($userid)) {
            abort(404, 'NOT FOUND');
        }


        $this->validate($request, [
            'file' => 'required|mimes:pdf,docx|max:1024',
        ]);

        //Registration Status
        $registration_status = RegistrationStatus::where('registration_statuses.slug', 'pending')->first();
        if (empty($registration_status)) {
            abort(404, 'NOT FOUND');
        }

        $arr = [
            'user_id' => $userid->id,
            'user_registration_id' => $uid->id,
            'registration_status_id' => $registration_status->id,
            'created_by' => Auth::user()->id,
        ];

        $uploadedFile = $request->file('file');
        $fileOriginalName = $uploadedFile->getClientOriginalName();
        $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $extension = $request->file->extension();
        $folderPath = 'user/abstract/';
        $filename = date('Y') . '/' . date('m') . '/' . date('d') . '/' . time() . '-' . rand(0, 999999) . $fileName . '.' . $extension;
        $file = $folderPath . $filename;
        Storage::disk('private')->put($file, file_get_contents($uploadedFile->getRealPath()));
        $arr['file'] = $filename;
        AbstractSubmission::create($arr);


        $messages = [
            array(
                'message' => 'Record created successfully',
                'message_type' => 'success'
            ),
        ];
        Session::flash('messages', $messages);

        return redirect()->route('manager.session.user-registration.abstract-submission.index', [$sid->id, $uid->id]);
    }

    /**
     * Display the specified resource.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function show($sid, $uid, string $id)
    {
        $sid = \App\Models\Session::where('id', '=', $sid)
            ->first();

        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        $uid = UserRegistration::where('id', '=', $uid)
            ->first();

        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }

        $record = AbstractSubmission::select('abstract_submissions.*', 'users.name as name', 'users.email as email',
            'user_registrations.contact_no as contact_no', 'registration_statuses.id as registration_status_id', 'registration_statuses.name as registration_status_name')
            ->leftJoin('users', 'users.id', '=', 'abstract_submissions.user_id')
            ->leftJoin('user_registrations', 'user_registrations.id', '=', 'abstract_submissions.user_registration_id')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'abstract_submissions.registration_status_id')
            ->where('abstract_submissions.id', '=', $id)
            ->first();

        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }

        $userRecord = AbstractSubmission::select('abstract_submissions.*')
            ->where('id', '=', $id)
            ->first();

        if (empty($userRecord)) {
            abort(404, 'NOT FOUND');
        }

        // Add activity logs
        $user = Auth::user();
        activity('Abstract Submission')
            ->performedOn($record)
            ->causedBy($user)
            ->event('viewed')
            ->withProperties(['attributes' => ['name' => $record->name]])
            ->log('viewed');

        //Data Array
        $data = array(
            'page_title' => 'Abstract Submission',
            'p_title' => 'Abstract Submission',
            'p_summary' => 'Show Abstract Submission',
            'p_description' => null,
            'method' => 'POST',
            'action' => route('manager.session.user-registration.abstract-submission.update', [$sid->id, $uid->id, $record->id]),
            'url' => route('manager.session.user-registration.abstract-submission.index', [$sid->id, $uid->id]),
            'url_text' => 'View All',
            'data' => $record,
            'sdata' => $sid->id,
            'udata' => $uid->id,
            // 'enctype' => 'multipart/form-data' // (Default)Without attachment
            'enctype' => 'application/x-www-form-urlencoded', // With attachment like file or images in form
        );

        return view('manager.registration.abstractSubmission.show')->with($data);
    }

    public function getImage($id)
    {
        $record = AbstractSubmission::where('id', '=', $id)->first();
        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }

        if (File::exists(Storage::disk('private')->path('user/abstract/' . $record->file))) {
            $path = Storage::disk('private')->path('user/abstract/' . $record->file);
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } else {
            abort(404, 'NOT FOUND');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $sid, string $uid, string $id)
    {

        $sid = \App\Models\Session::where('id', '=', $sid)
            ->first();

        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        $uid = UserRegistration::where('id', '=', $uid)
            ->first();

        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }

        $record = AbstractSubmission::select('abstract_submissions.*', 'users.name as name', 'users.email as email',
            'user_registrations.contact_no as contact_no', 'registration_statuses.id as registration_status_id', 'registration_statuses.name as registration_status_name')
            ->leftJoin('users', 'users.id', '=', 'abstract_submissions.user_id')
            ->leftJoin('user_registrations', 'user_registrations.id', '=', 'abstract_submissions.user_registration_id')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'abstract_submissions.registration_status_id')
            ->where('abstract_submissions.id', '=', $id)
            ->first();

        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }
        $data = array(
            'page_title' => 'Abstract Submission',
            'p_title' => 'Abstract Submission',
            'p_summary' => 'Edit Abstract Submission',
            'p_description' => null,
            'method' => 'POST',
            'action' => route('manager.session.user-registration.abstract-submission.update', [$sid->id, $uid->id, $record->id]),
            'url' => route('manager.session.user-registration.abstract-submission.index', [$sid->id, $uid->id]),
            'url_text' => 'View All',
            'data' => $record,
            'enctype' => 'multipart/form-data' // (Default)Without attachment
//            'enctype' => 'application/x-www-form-urlencoded', // With attachment like file or images in form
        );
        return view('manager.registration.abstractSubmission.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param String_ $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sid, $uid, string $id)
    {
        $sid = Session::where('id', $sid)->first();
        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        $uid = UserRegistration::where('id', $uid)->first();
        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }

        $userid = User::select('users.*')
            ->leftJoin('user_registrations', 'user_registrations.user_id', '=', 'users.id')
            ->where('users.id', $uid->user_id)->first();
        if (empty($userid)) {
            abort(404, 'NOT FOUND');
        }

        // Find the abstract-submission record by $id
        $record = AbstractSubmission::where('id', '=', $id)
            ->first();

        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }


        //Registration Status
        $registration_status = RegistrationStatus::where('registration_statuses.slug', 'pending')->first();
        if (empty($registration_status)) {
            abort(404, 'NOT FOUND');
        }

        $arr = [
            'user_id' => $userid->id,
            'user_registration_id' => $uid->id,
            'registration_status_id' => $registration_status->id,
            'updated_by' => Auth::user()->id,
        ];

        if (isset($record) && $record->file) {
            $prevImage = Storage::disk('private')->path('user/abstract/' . $record->file);
            if (File::exists($prevImage)) { // unlink or remove previous image from folder
                File::delete($prevImage);
            }
        }

        $uploadedFile = $request->file('file');
        $fileOriginalName = $uploadedFile->getClientOriginalName();
        $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $extension = $request->file->extension();
        $folderPath = 'user/abstract/';
        $filename = date('Y') . '/' . date('m') . '/' . date('d') . '/' . time() . '-' . rand(0, 999999) . $fileName . '.' . $extension;
        $file = $folderPath . $filename;
        Storage::disk('private')->put($file, file_get_contents($uploadedFile->getRealPath()));
        $arr['file'] = $filename;


//        Update User
        $record->update($arr);

        $messages = [
            array(
                'message' => 'Record updated successfully',
                'message_type' => 'success'
            ),
        ];
        Session::flash('messages', $messages);

        return redirect()->route('manager.session.user-registration.abstract-submission.index', [$sid->id, $uid->id]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function editStatus($sid, $uid, string $id)
    {
        $sid = \App\Models\Session::where('id', $sid)->first();
        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        $uid = UserRegistration::where('id', $uid)->first();
        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }

        $record = AbstractSubmission::select('abstract_submissions.*', 'users.name as name', 'users.email as email',
            'user_registrations.contact_no as contact_no', 'registration_statuses.id as registration_status_id', 'registration_statuses.name as registration_status_name')
            ->leftJoin('users', 'users.id', '=', 'abstract_submissions.user_id')
            ->leftJoin('user_registrations', 'user_registrations.id', '=', 'abstract_submissions.user_registration_id')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'abstract_submissions.registration_status_id')
            ->where('abstract_submissions.id', '=', $id)
            ->first();

        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }
        $data = array(
            'page_title' => 'Abstract Submission Status',
            'p_title' => 'Abstract Submission Status',
            'p_summary' => 'Edit Status',
            'p_description' => null,
            'method' => 'POST',
            'action' => route('manager.get.abstract-submission-update-status', [$sid->id, $uid->id, $record->id]),
            'url' => route('manager.session.user-registration.abstract-submission.index', [$sid->id, $uid->id]),
            'url_text' => 'View All',
            'data' => $record,
            // 'enctype' => 'multipart/form-data' // (Default)Without attachment
            'enctype' => 'application/x-www-form-urlencoded', // With attachment like file or images in form
        );
        return view('manager.registration.abstractSubmission.status')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param String_ $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $sid, $uid, string $id)
    {
        // get session record
        $sid = \App\Models\Session::where('id', $sid)->first();
        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        // get user-registration record
        $uid = UserRegistration::where('id', $uid)->first();
        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }

        // get user-registration record
        $record = AbstractSubmission::select('abstract_submissions.*', 'users.name as name', 'users.email as email',
            'user_registrations.contact_no as contact_no', 'registration_statuses.id as registration_status_id', 'registration_statuses.name as registration_status_name')
            ->leftJoin('users', 'users.id', '=', 'abstract_submissions.user_id')
            ->leftJoin('user_registrations', 'user_registrations.id', '=', 'abstract_submissions.user_registration_id')
            ->leftJoin('registration_statuses', 'registration_statuses.id', '=', 'abstract_submissions.registration_status_id')
            ->where('abstract_submissions.id', '=', $id)
            ->first();

        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }

        // get user record based on user-registration
        $user = User::where('id', $record->user_id)->first();

        if (empty($user)) {
            abort(404, 'NOT FOUND');
        }


        $this->validate($request, [
            'registration-status' => 'required',
        ]);

        $arr = [
            'registration_status_id' => $request->input('registration-status'),
        ];

        if ($record && $request->input('registration-status') == 2) {
            $items = [];
            $creator = $user['email'];
            array_push($items, $creator);
            Mail::send('emails.approval_email', array(
                'name' => $user->name,
            ), function ($message) use ($items, $creator) {
                $message->from($creator)->to($items)->subject('Abstract Approved');
            });

            $record->update($arr);

            $messages = [
                array(
                    'message' => 'Email Send to the Candidate',
                    'message_type' => 'success'
                ),
            ];
        } else if ($record && $request->input('registration-status') == 3) {
            $items = [];
            $creator = $user['email'];
            array_push($items, $creator);
            Mail::send('emails.rejected_email', array(
                'name' => $user->name,
            ), function ($message) use ($items, $creator) {
                $message->from($creator)->to($items)->subject('Abstract Rejected');
            });

            $record->update($arr);

            $messages = [
                array(
                    'message' => 'Email Send to the Candidate',
                    'message_type' => 'success'
                ),
            ];
        } else {
            $record->update($arr);

            $messages = [
                array(
                    'message' => 'Record updated successfully',
                    'message_type' => 'success'
                ),
            ];
        }

        Session::flash('messages', $messages);
        return redirect()->route('manager.session.user-registration.abstract-submission.index', [$sid->id, $uid->id]);
    }


    /**
     * Remove the specified resource from storage.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sid, $uid, string $id,)
    {

        $sid = \App\Models\Session::where('id', $sid)->first();
        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        $uid = UserRegistration::where('id', $uid)->first();
        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }

        $record = AbstractSubmission::select('abstract_submissions.*')
            ->where('id', '=', $id)
            ->first();

        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }
        $record->delete();

        $messages = [
            array(
                'message' => 'Record deleted successfully',
                'message_type' => 'success'
            ),
        ];
        Session::flash('messages', $messages);

        return redirect()->route('manager.session.user-registration.abstract-submission.index', [$sid->id, $uid->id]);
    }

    /**
     * Display the specified resource Activity.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function getActivity($sid, $uid, string $id)
    {
        $sid = \App\Models\Session::where('id', $sid)->first();
        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        $uid = UserRegistration::where('id', $uid)->first();
        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }

        //Data Array
        $data = array(
            'page_title' => 'Abstract Submission Activity',
            'p_title' => 'Abstract Submission Activity',
            'p_summary' => 'Show Abstract Submission Activity',
            'p_description' => null,
            'url' => route('manager.session.user-registration.abstract-submission.index', [$sid->id, $uid->id]),
            'url_text' => 'View All',
            'id' => $id,
        );
        return view('manager.registration.abstractSubmission.activity')->with($data);
    }

    /**
     * Display the specified resource Activity Logs.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function getActivityLog(Request $request, string $id)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Activity::select('activity_log.*', 'users.name as causer')
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->leftJoin('user_registrations', 'user_registrations.id', 'activity_log.subject_id')
            ->where('activity_log.subject_type', AbstractSubmission::class)
            ->where('activity_log.subject_id', $id)
            ->count();

        // Total records with filter
        $totalRecordswithFilter = Activity::select('activity_log.*', 'users.name as causer')
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->leftJoin('user_registrations', 'user_registrations.id', 'activity_log.subject_id')
            ->where('activity_log.subject_id', $id)
            ->where('activity_log.subject_type', AbstractSubmission::class)
            ->where(function ($q) use ($searchValue) {
                $q->where('activity_log.description', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.name', 'like', '%' . $searchValue . '%');
            })
            ->count();

        // Fetch records
        $records = Activity::select('activity_log.*', 'users.name as causer')
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->leftJoin('user_registrations', 'user_registrations.id', 'activity_log.subject_id')
            ->where('activity_log.subject_id', $id)
            ->where('activity_log.subject_type', AbstractSubmission::class)
            ->where(function ($q) use ($searchValue) {
                $q->where('activity_log.description', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.name', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowperpage)
            ->orderBy($columnName, $columnSortOrder)
            ->get();


        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $attributes = (!empty($record->properties['attributes']) ? $record->properties['attributes'] : '');
            $old = (!empty($record->properties['old']) ? $record->properties['old'] : '');
            $current = '<ul class="list-unstyled">';
            //Current
            if (!empty($attributes)) {
                foreach ($attributes as $key => $value) {
                    if (is_array($value)) {
                        $current .= '<li>';
                        $current .= '<i class="fas fa-angle-right"></i> <em></em>' . $key . ': <mark>' . $value . '</mark>';
                        $current .= '</li>';
                    } else {
                        $current .= '<li>';
                        $current .= '<i class="fas fa-angle-right"></i> <em></em>' . $key . ': <mark>' . $value . '</mark>';
                        $current .= '</li>';
                    }
                }
            }
            $current .= '</ul>';
            //Old
            $oldValue = '<ul class="list-unstyled">';
            if (!empty($old)) {
                foreach ($old as $key => $value) {
                    if (is_array($value)) {
                        $oldValue .= '<li>';
                        $oldValue .= '<i class="fas fa-angle-right"></i> <em></em>' . $key . ': <mark>' . $value . '</mark>';
                        $oldValue .= '</li>';
                    } else {
                        $oldValue .= '<li>';
                        $oldValue .= '<i class="fas fa-angle-right"></i> <em></em>' . $key . ': <mark>' . $value . '</mark>';
                        $oldValue .= '</li>';
                    }
                }
            }
            //updated at
            $updated = 'Updated:' . $record->updated_at->diffForHumans() . '<br> At:' . $record->updated_at->isoFormat('llll');
            $oldValue .= '</ul>';
            //Causer
            $causer = isset($record->causer) ? $record->causer : '';
            $type = $record->description;
            $data_arr[] = array(
                "id" => $id,
                "current" => $current,
                "old" => $oldValue,
                "updated" => $updated,
                "causer" => $causer,
                "type" => $type,
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }

    /**
     * Display the trash resource Activity.
     * @return \Illuminate\Http\Response
     */
    public function getTrashActivity($sid, $uid)
    {
        $sid = \App\Models\Session::where('id', $sid)->first();
        if (empty($sid)) {
            abort(404, 'NOT FOUND');
        }

        $uid = UserRegistration::where('id', $uid)->first();
        if (empty($uid)) {
            abort(404, 'NOT FOUND');
        }

        //Data Array
        $data = array(
            'page_title' => 'Abstract Submission Activity',
            'p_title' => 'Abstract Submission Activity',
            'p_summary' => 'Show Abstract Submission Trashed Activity',
            'p_description' => null,
            'url' => route('manager.session.user-registration.abstract-submission.index', [$sid->id, $uid->id]),
            'url_text' => 'View All',
        );
        return view('manager.registration.abstractSubmission.trash')->with($data);
    }

    /**
     * Display the trash resource Activity Logs.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function getTrashActivityLog(Request $request)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Activity::select('activity_log.*', 'users.name as causer')
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->leftJoin('user_registrations', 'user_registrations.id', 'activity_log.subject_id')
            ->where('activity_log.subject_type', AbstractSubmission::class)
            ->where('activity_log.event', 'deleted')
            ->count();

        // Total records with filter
        $totalRecordswithFilter = Activity::select('activity_log.*', 'users.name as causer')
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->leftJoin('user_registrations', 'user_registrations.id', 'activity_log.subject_id')
            ->where('activity_log.subject_type', AbstractSubmission::class)
            ->where('activity_log.event', 'deleted')
            ->where(function ($q) use ($searchValue) {
                $q->where('activity_log.description', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.name', 'like', '%' . $searchValue . '%');
            })
            ->count();

        // Fetch records
        $records = Activity::select('activity_log.*', 'users.name as causer')
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->leftJoin('user_registrations', 'user_registrations.id', 'activity_log.subject_id')
            ->where('activity_log.subject_type', AbstractSubmission::class)
            ->where('activity_log.event', 'deleted')
            ->where(function ($q) use ($searchValue) {
                $q->where('activity_log.description', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.name', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowperpage)
            ->orderBy($columnName, $columnSortOrder)
            ->get();


        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $attributes = (!empty($record->properties['attributes']) ? $record->properties['attributes'] : '');
            $old = (!empty($record->properties['old']) ? $record->properties['old'] : '');
            $current = '<ul class="list-unstyled">';
            //Current
            if (!empty($attributes)) {
                foreach ($attributes as $key => $value) {
                    if (is_array($value)) {
                        $current .= '<li>';
                        $current .= '<i class="fas fa-angle-right"></i> <em></em>' . $key . ': <mark>' . $value . '</mark>';
                        $current .= '</li>';
                    } else {
                        $current .= '<li>';
                        $current .= '<i class="fas fa-angle-right"></i> <em></em>' . $key . ': <mark>' . $value . '</mark>';
                        $current .= '</li>';
                    }
                }
            }
            $current .= '</ul>';
            //Old
            $oldValue = '<ul class="list-unstyled">';
            if (!empty($old)) {
                foreach ($old as $key => $value) {
                    if (is_array($value)) {
                        $oldValue .= '<li>';
                        $oldValue .= '<i class="fas fa-angle-right"></i> <em></em>' . $key . ': <mark>' . $value . '</mark>';
                        $oldValue .= '</li>';
                    } else {
                        $oldValue .= '<li>';
                        $oldValue .= '<i class="fas fa-angle-right"></i> <em></em>' . $key . ': <mark>' . $value . '</mark>';
                        $oldValue .= '</li>';
                    }
                }
            }
            //updated at
            $updated = 'Updated:' . $record->updated_at->diffForHumans() . '<br> At:' . $record->updated_at->isoFormat('llll');
            $oldValue .= '</ul>';
            //Causer
            $causer = isset($record->causer) ? $record->causer : '';
            $type = $record->description;
            $data_arr[] = array(
                "id" => $id,
                "current" => $current,
                "old" => $oldValue,
                "updated" => $updated,
                "causer" => $causer,
                "type" => $type,
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
}
