<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\Admin\StoreCompaniesRequest;
use App\Http\Requests\Admin\UpdateCompaniesRequest;
use Yajra\DataTables\DataTables;


class CompaniesController extends Controller
{
    public function index()
    {
        return view('backend.companies.index');
    }

    public function getData(Request $request)
    {
        $has_view = false;
        $has_delete = false;
        $has_edit = false;
        $companies = "";

        if (request('show_deleted') == 1) {
            // $companies = Company::all()->onlyTrashed()->orderBy('created_at', 'desc');
        } else {
            $companies = Company::orderBy('created_at', 'desc')->get();
        }
        if (auth()->user()->isAdmin()) {
            $has_view = true;
            $has_edit = true;
            $has_delete = true;
        }

        return DataTables::of($companies)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($has_view, $has_edit, $has_delete, $request) {
                $view = "";
                $edit = "";
                $delete = "";
                $allow_delete = false;

                if ($request->show_deleted == 1) {
                    return view('backend.datatable.action-trashed')->with(['route_label' => 'admin.companies', 'label' => 'id', 'value' => $q->id]);
                }
                if ($has_view) {
                    $view = view('backend.datatable.action-view')
                        ->with(['route' => route('admin.companies.show', ['company' => $q->id])])->render();
                }
                if ($has_edit) {
                    $edit = view('backend.datatable.action-edit')
                        ->with(['route' => route('admin.companies.edit', ['company' => $q->id])])
                        ->render();
                    $view .= $edit;
                }

                if ($has_delete) {
                    $delete = view('backend.datatable.action-delete')
                        ->with(['route' => route('admin.companies.destroy', ['company' => $q->id])])
                        ->render();
                    $view .= $delete;
                }

                // $view .= '<a class="btn btn-warning mb-1" href="' . route('admin.courses.index', ['cat_id' => $q->id]) . '">' . trans('labels.backend.courses.title') . '</a>';


                return $view;
            })
            ->addColumn('status', function ($q) {
                $html = html()->label(html()->checkbox('')->id($q->id)
                ->checked(($q->active == 1) ? true : false)->class('switch-input')->attribute('data-id', $q->id)->value(($q->active == 1) ? 1 : 0).'<span class="switch-label"></span><span class="switch-handle"></span>')->class('switch switch-lg switch-3d switch-primary');
                return $html;
            })
            ->rawColumns(['actions', 'icon'])
            ->make();
    }

    public function create()
    {
        return view('backend.companies.create');
    }

    public function store(StoreCompaniesRequest $request)
    {
        $company = Company::create($request->all());

        return redirect()->route('admin.companies.index')->withFlashSuccess(trans('alerts.backend.general.created'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('backend.companies.edit', compact('company'));
    }

    public function update(UpdateCompaniesRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->except('email'));
        $company->active = isset($request->active)?1:0;
        $company->save();

        return redirect()->route('admin.companies.index')->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view('backend.companies.show', compact('company'));
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();

        return redirect()->route('admin.companies.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    public function updateStatus()
    {
        $company = Company::find(request('id'));
        $company->active = $company->active == 1? 0 : 1;
        $company->save();
    }
}
