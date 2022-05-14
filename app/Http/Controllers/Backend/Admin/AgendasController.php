<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAgendasRequest;
use App\Http\Requests\Admin\UpdateAgendasRequest;
use App\Models\Agenda;
use App\Models\Auth\User;
use App\Models\Company;
use App\Models\Course;
use App\Models\Location;
use App\Models\Review;
use Arcanedev\Html\Elements\A;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;


class AgendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.agendas.index');
    }

    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $agendas = "";

        if (auth()->user()->isAdmin()) {
            $has_view = true;
            $has_delete = true;
            $has_edit = true;
        }

        if (auth()->user()->isAdmin()) {

            $agendas = Agenda::query()
                ->whereHas('course')
                ->whereHas('teacher')
                ->whereHas('location')
                ->whereHas('company')
                ->orderBy('created_at', 'desc');
        }

        if (auth()->user()->hasRole('company admin')) {
            $agendas = Agenda::query()
                ->where('company_id', auth()->user()->teacherProfile->company_id)
                ->whereHas('course')
                ->whereHas('teacher')
                ->whereHas('location')
                ->whereHas('company')
                ->orderBy('created_at', 'desc');
        }


        return DataTables::of($agendas)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request) {
                $view = "";
                $edit = "";
                $delete = "";

                if (auth()->user()->isAdmin()) {

                    if ($has_view) {
                        $view = view('backend.datatable.action-view')
                            ->with(['route' => route('admin.agendas.show', ['agenda' => $q->id])])->render();
                    }
                    if ($has_edit) {
                        $edit = view('backend.datatable.action-edit')
                            ->with(['route' => route('admin.agendas.edit', ['agenda' => $q->id])])
                            ->render();
                        $view .= $edit;
                    }

                    if ($has_delete) {
                        $delete = view('backend.datatable.action-delete')
                            ->with(['route' => route('admin.agendas.destroy', ['agenda' => $q->id])])
                            ->render();
                        $view .= $delete;
                    }
                    $view .= '<a href="' . route('admin.agendas.get_presence_list', ['id' => $q->id]) . '" class="btn btn-success mb-1">' . trans('labels.backend.agendas.presence_list') .  '</a> ';
                    if (!isset($q->completed_at)) {
                        $view .= '<form action="' . route('admin.agendas.complete', [$q->id]) . '" method="POST" style="display: inline;">'.csrf_field().'<button class="btn btn-info ml-1 mb-1" href="">' . trans('labels.backend.agendas.complete') . '</button></form>';
                    }
                }

                if (auth()->user()->hasRole('company admin')) {
                    $view .= '<a href="' . route('admin.agendas.get_presence_list', ['id' => $q->id]) . '" class="btn btn-success mb-1">' . trans('labels.backend.agendas.presence_list') .  '</a> ';

                    if (isset($q->completed_at) && !$q->is_rated) {
                        $view .= '<a href="' . route('admin.agendas.rating', ['id' => $q->id]) . '" class="btn btn-success mb-1">' . trans('labels.backend.agendas.rating') .  '</a> ';
                    }
                }
                return $view;
            })
            ->editColumn('course', function ($q) {
                return $q->course->title;
            })
            ->editColumn('company', function ($q) {
                return $q->company->name;
            })
            ->editColumn('teacher', function ($q) {
                return $q->teacher->first_name . ' ' . $q->teacher->last_name;
            })
            ->rawColumns(['course', 'company', 'actions'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Gate::allows('course_create')) {
            return abort(401);
        }

        $course_id = $request->course_id;


        if($course_id != '') {
            $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
                $q->where('role_id', 2);
            })->whereHas('certifications', function ($q) use ($course_id) {
                $q->where('course_id', $course_id);
            })->get()->pluck('name', 'id');
        } else {

            $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
                $q->where('role_id', 2);
            })->get()->pluck('name', 'id');
        }
        $companies = Company::all()->pluck('name', 'id');
        $courses = Course::all()->pluck('title', 'id')->prepend('Please select', '');
        $locations = Location::all()->pluck('location_name', 'id');

        return view('backend.agendas.create', compact('teachers', 'companies', 'courses', 'locations', 'course_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgendasRequest $request)
    {
        $agenda = Agenda::create($request->all());
        $agenda->save();

        return redirect()->route('admin.agendas.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);

        return view('backend.agendas.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get()->pluck('name', 'id');
        $companies = Company::all()->pluck('name', 'id');
        $courses = Course::all()->pluck('title', 'id');
        $locations = Location::all()->pluck('location_name', 'id');

        $agenda = Agenda::findOrFail($id);

        return view('backend.agendas.edit', compact('agenda', 'teachers', 'companies', 'courses', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgendasRequest $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->update($request->all());

        return redirect()->route('admin.agendas.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        $agenda->delete();
        return redirect()->route('admin.agendas.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    public function getPresenceList($id)
    {
        if (auth()->user()->hasRole('company admin')) {

            $agenda = Agenda::findOrFail($id);

            $students = User::query()->whereHas('studentProfile', function($q) use ($agenda) {
                return $q->where('company_id', $agenda->company_id);
            })->get()->pluck('name', 'id');

            return view('backend.agendas.view_students', compact('agenda', 'students'));
        } else {
             return view('backend.agendas.presence_list', compact('id'));
        }
    }

    public function getPresenceListData(Request $request, $id) {
        $agenda = Agenda::findOrFail($id);
        $students = $agenda->students;

        return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request, $agenda) {
                $view = "";
                $edit = "";
                $delete = "";

                if (isset($agenda->completed_at)) {
                    $view .= '<a class="btn btn-warning mb-1" href="' . route('admin.agendas.get_evaluate', ['agenda_id' => $agenda->id, 'user_id' => $q->id]) . '" style="color: white;">' . trans('labels.backend.agendas.evaluate') . '</a>';
                }

                return $view;
            })
            ->rawColumns(['actions'])
            ->make();
    }

    public function add_students(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        if (count($request->students) > $agenda->student_quantity) {
            return back()->withFlashSuccess(trans('labels.backend.agendas.alerts.student_quantity'));
        }

        $agenda->students()->sync($request->students);
        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    public function getEvaluate($agenda_id, $user_id)
    {
        $agenda = Agenda::findOrFail($agenda_id);
        $agenda_student = $agenda->students->find($user_id);


        $student = User::findOrFail($user_id);

        return view('backend.agendas.get_evaluate', compact('student', 'agenda_student', 'agenda_id', 'user_id'));
    }

    public function evaluate(Request $request)
    {
        $agenda = Agenda::findOrFail($request->agenda_id);
             $agenda->students()->updateExistingPivot(
                    $request->user_id,
                    [
                        'is_approved' => $request->is_approved,
                        'comment' => $request->comment
                    ]
        );
        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    public function completeAgenda(Request $request, $id) {
        $agenda = Agenda::findOrFail($id);

        $agenda->completed_at = Carbon::now();
        $agenda->save();

        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    public function rating(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        return view('backend.agendas.rating', compact('agenda'));
    }

    public function storeRating(Request $request)
    {
        $teacher_review = new Review();
        $teacher_review->user_id = auth()->user()->id;
        $teacher_review->reviewable_id = $request->user_id;
        $teacher_review->reviewable_type = User::class;
        $teacher_review->rating = $request->teacher_rating;
        $teacher_review->content = $request->teacher_comment;
        $teacher_review->agenda_id = $request->agenda_id;
        $teacher_review->save();

        $course_review = new Review();
        $course_review->user_id = auth()->user()->id;
        $course_review->reviewable_id = $request->course_id;
        $course_review->reviewable_type = Course::class;
        $course_review->rating = $request->course_rating;
        $course_review->content = $request->course_comment;
        $course_review->agenda_id = $request->agenda_id;
        $course_review->save();

        $agenda = Agenda::findOrFail($request->agenda_id);
        $agenda->is_rated = 1;
        $agenda->save();

        return redirect()->route('admin.agendas.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    public function trainingResult(Request $request)
    {
        $agendas = Agenda::whereNotNull('completed_at')->get()->pluck('text', 'id')->prepend('Please select', '');

        if (auth()->user()->hasRole('company admin')) {
            $agendas = Agenda::whereNotNull('completed_at')
                ->where('company_id', auth()->user()->teacherProfile->company_id)->get()->pluck('text', 'id')->prepend('Please select', '');
        }

        if ($request->agenda_id != '') {
            $agenda = Agenda::findOrFail($request->agenda_id);
        } else {
            $agenda = Agenda::first();
        }
        return view('backend.agendas.training_result', compact('agendas', 'agenda'));
    }
}
