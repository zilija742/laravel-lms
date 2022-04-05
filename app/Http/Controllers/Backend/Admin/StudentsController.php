<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentsRequest;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Models\Company;
use Yajra\DataTables\DataTables;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.students.index');
    }

    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $students = "";

        if (auth()->user()->hasRole('company admin') || auth()->user()->isAdmin()) {

            if (request('company_id') != '') {
                if (request('show_deleted') == 1) {
                    $students = User::query()->role('student')->onlyTrashed()
                        ->whereHas('studentProfile', function ($q) {
                            $q->where('company_id', '=', request('company_id'));
                        })->orderBy('created_at', 'desc');
                } else {
                    $students = User::query()->role('student')
                        ->whereHas('studentProfile', function ($q) {
                            $q->where('company_id', '=', request('company_id'));
                        })->orderBy('created_at', 'desc');
                }
            } else {
                $id = auth()->user()->teacherProfile->company_id;
                if (request('show_deleted') == 1) {
                    $students = User::query()->role('student')->onlyTrashed()
                        ->whereHas('studentProfile', function ($q) use ($id) {
                            $q->where('company_id', '=', $id);
                        })->orderBy('created_at', 'desc');
                } else {
                    $students = User::query()->role('student')
                        ->whereHas('studentProfile', function ($q) use ($id) {
                            $q->where('company_id', '=', $id);
                        })->orderBy('created_at', 'desc');
                }
            }
        }

        if (auth()->user()->isAdmin() || auth()->user()->hasRole('company admin')) {
            $has_view = true;
            $has_edit = true;
            $has_delete = true;
        }

        return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.students', 'label' => 'id', 'value' => $q->id]);
                }

                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.students.show', ['student' => $q->id])])->render();
                }

                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.students.edit', ['student' => $q->id])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.students.destroy', ['student' => $q->id])])
                        ->render();
                    $view .= $delete;
                }

//                $view .= '<a class="btn btn-warning mb-1" href="' . route('admin.courses.index', ['teacher_id' => $q->id]) . '">' . trans('labels.backend.courses.title') . '</a>';

                return $view;
            })
            ->addColumn('status', function ($q) {
                $html = html()->label(html()->checkbox('')->id($q->id)
                ->checked(($q->active == 1) ? true : false)->class('switch-input')->attribute('data-id', $q->id)->value(($q->active == 1) ? 1 : 0).'<span class="switch-label"></span><span class="switch-handle"></span>')->class('switch switch-lg switch-3d switch-primary');
                return $html;
                // return ($q->active == 1) ? "Enabled" : "Disabled";
            })
            ->rawColumns(['actions', 'image', 'status'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::where('active', '=', 1)->pluck('name', 'id');
        return view('backend.students.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentsRequest $request)
    {
        $student = User::create($request->all());
        $student->confirmed = 1;
        if ($request->image) {
            $student->avatar_type = 'storage';
            $student->avatar_location = $request->image->store('/avatars', 'public');
        }
        $student->active = isset($request->active)?1:0;
        $student->save();
        $student->assignRole('student');

        $data = [
            'user_id'           => $student->id,
            'baptism_name'      => $request->baptism_name,
            'birthday'          => $request->birthday,
            'birth_place'       => $request->birth_place,
            'candidate_number'  => $request->candidate_number,
            'driver_license_number'     => $request->driver_license_number,
            'driver_license_category'   => $request->driver_license_category,
            'driver_card_expire'        => $request->driver_card_expire,
            'code95_expire'     => $request->code95_expire,
            'vca_number'        => $request->vca_number,
            'personal_number'   => $request->personal_number,
            'company_id'        => auth()->user()->teacherProfile->company_id,
        ];
        StudentProfile::create($data);


        return redirect()->route('admin.students.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = User::findOrFail($id);

        return view('backend.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('backend.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);
        $student->update($request->except('email'));
        if ($request->has('image')) {
            $student->avatar_type = 'storage';
            $student->avatar_location = $request->image->store('/avatars', 'public');
        }
        $student->active = isset($request->active)?1:0;
        $student->save();

        $data = [
            'baptism_name'      => $request->baptism_name,
            'birthday'          => $request->birthday,
            'birth_place'       => $request->birth_place,
            'candidate_number'  => $request->candidate_number,
            'driver_license_number'     => $request->driver_license_number,
            'driver_license_category'   => $request->driver_license_category,
            'driver_card_expire'        => $request->driver_card_expire,
            'code95_expire'     => $request->code95_expire,
            'vca_number'        => $request->vca_number,
            'personal_number'   => $request->personal_number,
            'company_id'        => auth()->user()->teacherProfile->company_id,
//        ];
        ];
        $student->studentProfile->update($data);


        return redirect()->route('admin.students.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
