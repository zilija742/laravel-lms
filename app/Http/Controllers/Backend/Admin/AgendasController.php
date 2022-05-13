<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAgendasRequest;
use App\Http\Requests\Admin\UpdateAgendasRequest;
use App\Models\Agenda;
use App\Models\Company;
use App\Models\Course;
use App\Models\Location;
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

        $agendas = Agenda::query()
            ->whereHas('course')
            ->whereHas('teacher')
            ->whereHas('location')
            ->whereHas('company')
            ->orderBy('created_at', 'desc');

        return DataTables::of($agendas)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request) {
                $view = "";
                $edit = "";
                $delete = "";
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
    public function create()
    {
        if (!Gate::allows('course_create')) {
            return abort(401);
        }



        $teachers = \App\Models\Auth\User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get()->pluck('name', 'id');
        $companies = Company::all()->pluck('name', 'id');
        $courses = Course::all()->pluck('title', 'id');
        $locations = Location::all()->pluck('location_name', 'id');

        return view('backend.agendas.create', compact('teachers', 'companies', 'courses', 'locations'));
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
}
