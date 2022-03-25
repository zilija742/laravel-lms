<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Company;

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
            $companies = Company::all()->onlyTrashed()->orderBy('created_at', 'desc');
        } else {
            $companies = Company::all()->orderBy('created_at', 'desc');
        }

        if (auth()->user()->isAdmin()) {
            $has_view = true;
            $has_edit = true;
            $has_delete = true;
        }
    }

    public function create()
    {
        return view('backend.companies.create');
    }
}
