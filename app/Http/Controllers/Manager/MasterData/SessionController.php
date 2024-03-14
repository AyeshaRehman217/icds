<?php

namespace App\Http\Controllers\Manager\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class SessionController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:manager_master-data_session-list', ['only' => ['index', 'getIndex']]);
        $this->middleware('permission:manager_master-data_session-activity-log', ['only' => ['getActivity', 'getActivityLog']]);
        $this->middleware('permission:manager_master-data_session-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:manager_master-data_session-show', ['only' => ['show']]);
        $this->middleware('permission:manager_master-data_session-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:manager_master-data_session-status-edit', ['only' => ['editStatus', 'updateStatus']]);
        $this->middleware('permission:manager_master-data_session-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'page_title' => 'Session',
            'p_title' => 'Session',
            'p_summary' => 'List of Session',
            'p_description' => null,
            'url' => route('manager.session.create'),
            'url_text' => 'Add New',
            'trash' => route('manager.get.session-activity-trash'),
            'trash_text' => 'View Trash',
        ];
        return view('manager.masterData.session.index')->with($data);
    }

    /**
     * Display the specified resource.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function sessionRegistrations($sid)
    {
        $record = Session::where('id', '=', $sid)
            ->first();

        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }

        //Data Array
        $data = array(

            'page_title' => 'User Registration',
            'p_title' => 'User Registration',
            'p_summary' => 'List of User Registration',
            'p_description' => null,
            'url' => route('manager.user-registration.create', $record->id),
            'url_text' => 'Add New',
            'trash' => route('manager.get.user-registration-activity-trash'),
            'trash_text' => 'View Trash',
            'data' => $record,
            // 'enctype' => 'multipart/form-data' // (Default)Without attachment
            'enctype' => 'application/x-www-form-urlencoded', // With attachment like file or images in form
        );

        return view('manager.registration.userRegistration.index')->with($data);
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

        // Total records
        $totalRecords = Session::select('sessions.*')->count();
        // Total records with filter
        $totalRecordswithFilter = Session::select('sessions.*')
            ->where(function ($q) use ($searchValue) {
                $q->where('sessions.name', 'like', '%' . $searchValue . '%');
            })
            ->count();
        // Fetch records
        $records = Session::select('sessions.*')
            ->where(function ($q) use ($searchValue) {
                $q->where('sessions.name', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowperpage)
            ->orderBy($columnName, $columnSortOrder)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $name = $record->name;
            $year = $record->year;
            $status = $record->status;

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "year" => $year,
                "status" => $status,
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
    public function getIndexSelectSession(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Session::with('user_registrations', 'users')
                ->where('sessions.name', 'like', '%' . $search . '%')
                ->get();
        }

        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array(
            'page_title' => 'Session',
            'p_title' => 'Session',
            'p_summary' => 'Add Session',
            'p_description' => null,
            'method' => 'POST',
            'action' => route('manager.session.store'),
            'url' => route('manager.session.index'),
            'url_text' => 'View All',
            // 'enctype' => 'multipart/form-data' // (Default)Without attachment
            'enctype' => 'application/x-www-form-urlencoded', // With attachment like file or images in form
        );
        return view('manager.masterData.session.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sessions,name',
            'year' => 'required|unique:sessions,year',
        ]);
        //
        $arr = [
            'name' => $request->input('name'),
            'year' => $request->input('year'),
            'created_by' => Auth::user()->id,
        ];
        $record = Session::create($arr);
        $messages = [
            array(
                'message' => 'Record created successfully',
                'message_type' => 'success'
            ),
        ];
        \Illuminate\Support\Facades\Session::flash('messages', $messages);

        return redirect()->route('manager.session.index');
    }

    /**
     * Display the specified resource.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $record = Session::select('sessions.*')
            ->where('id', '=', $id)
            ->first();
        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }
        // Add activity logs
        $user = Auth::user();
        activity('Session')
            ->performedOn($record)
            ->causedBy($user)
            ->event('viewed')
            ->withProperties(['attributes' => ['name' => $record->name]])
            ->log('viewed');
        //Data Array
        $data = array(
            'page_title' => 'Session',
            'p_title' => 'Session',
            'p_summary' => 'Show Session',
            'p_description' => null,
            'method' => 'POST',
            'action' => route('manager.session.update', $record->id),
            'url' => route('manager.session.index'),
            'url_text' => 'View All',
            'data' => $record,
            // 'enctype' => 'multipart/form-data' // (Default)Without attachment
            'enctype' => 'application/x-www-form-urlencoded', // With attachment like file or images in form
        );
        return view('manager.masterData.session.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $record = Session::select('sessions.*')
            ->where('id', '=', $id)
            ->first();
        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }
        $data = array(
            'page_title' => 'Session',
            'p_title' => 'Session',
            'p_summary' => 'Edit Session',
            'p_description' => null,
            'method' => 'POST',
            'action' => route('manager.session.update', $record->id),
            'url' => route('manager.session.index'),
            'url_text' => 'View All',
            'data' => $record,
            // 'enctype' => 'multipart/form-data' // (Default)Without attachment
            'enctype' => 'application/x-www-form-urlencoded', // With attachment like file or images in form
        );
        return view('manager.masterData.session.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param String_ $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $record = Session::select('sessions.*')
            ->where('id', '=', $id)
            ->first();
        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }
        $this->validate($request, [
            'name' => 'required|unique:sessions,name,' . $record->id,
            'year' => 'required|unique:sessions,year,' . $record->id,
        ]);
        //
        $arr = [
            'name' => $request->input('name'),
            'year' => $request->input('year'),
            'updated_by' => Auth::user()->id,
        ];
        $record->update($arr);
        $messages = [
            array(
                'message' => 'Record updated successfully',
                'message_type' => 'success'
            ),
        ];
        \Illuminate\Support\Facades\Session::flash('messages', $messages);

        return redirect()->route('manager.session.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function editStatus(string $id)
    {
        $record = Session::select('sessions.*')
            ->where('id', '=', $id)
            ->first();
        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }
        $data = array(
            'page_title' => 'Session Status',
            'p_title' => 'Session Status',
            'p_summary' => 'Edit Status',
            'p_description' => null,
            'method' => 'POST',
            'action' => route('manager.get.session-update-status', $record->id),
            'url' => route('manager.session.index'),
            'url_text' => 'View All',
            'data' => $record,
            // 'enctype' => 'multipart/form-data' // (Default)Without attachment
            'enctype' => 'application/x-www-form-urlencoded', // With attachment like file or images in form
        );
        return view('manager.masterData.session.status')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param String_ $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, string $id)
    {
        $record = Session::select('sessions.*')
            ->where('id', '=', $id)
            ->first();

        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }


        $this->validate($request, [
            'status' => 'required',
        ]);

        // Get the new status from the request
        $newStatus = $request->input('status');

        // Check if the new status is different from the existing status
        if ($newStatus !== $record->status) {
            // Check if there is another open session with the same status
            $existingOpenSession = Session::where('status', $newStatus)
                ->where('id', '!=', $id) // Exclude the current session
                ->where('status', 1)
                ->first();

            if ($existingOpenSession) {
                // Another open session with the same status exists

                $messages = [
                    array(
                        'message' => 'Only one session can be open with the same status.',
                        'message_type' => 'warning'
                    ),
                ];
            } else {
                // Perform the update
                $arr = [
                    'status' => $newStatus,
                ];

                $record->update($arr);

                $messages = [
                    array(
                        'message' => 'Status updated successfully',
                        'message_type' => 'success'
                    ),
                ];
            }
        }

        \Illuminate\Support\Facades\Session::flash('messages', $messages);

        return redirect()->route('manager.session.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $record = Session::select('sessions.*')
            ->where('id', '=', $id)
            ->first();
        if (empty($record)) {
            abort(404, 'NOT FOUND');
        }

        $users = User::select('users.*')
            ->leftjoin('user_registrations', 'user_registrations.user_id', '=', 'users.id')
            ->where('user_registrations.session_id','=',$record->id)
            ->get();


        $record->delete();
        foreach ($users as $user) {
            $user->delete();
        }

        $messages = [
            array(
                'message' => 'Record deleted successfully',
                'message_type' => 'success'
            ),
        ];
        \Illuminate\Support\Facades\Session::flash('messages', $messages);

        return redirect()->route('manager.session.index');
    }

    /**
     * Display the specified resource Activity.
     * @param String_ $id
     * @return \Illuminate\Http\Response
     */
    public function getActivity(string $id)
    {
        //Data Array
        $data = array(
            'page_title' => 'Session Activity',
            'p_title' => 'Session Activity',
            'p_summary' => 'Show Session Activity',
            'p_description' => null,
            'url' => route('manager.session.index'),
            'url_text' => 'View All',
            'id' => $id,
        );
        return view('manager.masterData.session.activity')->with($data);
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
            ->leftJoin('sessions', 'sessions.id', 'activity_log.subject_id')
            ->where('activity_log.subject_type', Session::class)
            ->where('activity_log.subject_id', $id)
            ->count();

        // Total records with filter
        $totalRecordswithFilter = Activity::select('activity_log.*', 'users.name as causer')
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->leftJoin('sessions', 'sessions.id', 'activity_log.subject_id')
            ->where('activity_log.subject_id', $id)
            ->where('activity_log.subject_type', Session::class)
            ->where(function ($q) use ($searchValue) {
                $q->where('activity_log.description', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.name', 'like', '%' . $searchValue . '%');
            })
            ->count();

        // Fetch records
        $records = Activity::select('activity_log.*', 'users.name as causer')
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->leftJoin('sessions', 'sessions.id', 'activity_log.subject_id')
            ->where('activity_log.subject_id', $id)
            ->where('activity_log.subject_type', Session::class)
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
    public function getTrashActivity()
    {
        //Data Array
        $data = array(
            'page_title' => 'Session Activity',
            'p_title' => 'Session Activity',
            'p_summary' => 'Show Session Trashed Activity',
            'p_description' => null,
            'url' => route('manager.session.index'),
            'url_text' => 'View All',
        );
        return view('manager.masterData.session.trash')->with($data);
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
            ->leftJoin('sessions', 'sessions.id', 'activity_log.subject_id')
            ->where('activity_log.subject_type', Session::class)
            ->where('activity_log.event', 'deleted')
            ->count();

        // Total records with filter
        $totalRecordswithFilter = Activity::select('activity_log.*', 'users.name as causer')
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->leftJoin('sessions', 'sessions.id', 'activity_log.subject_id')
            ->where('activity_log.subject_type', Session::class)
            ->where('activity_log.event', 'deleted')
            ->where(function ($q) use ($searchValue) {
                $q->where('activity_log.description', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.name', 'like', '%' . $searchValue . '%');
            })
            ->count();

        // Fetch records
        $records = Activity::select('activity_log.*', 'users.name as causer')
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->leftJoin('sessions', 'sessions.id', 'activity_log.subject_id')
            ->where('activity_log.subject_type', Session::class)
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
