<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::select('*')->paginate(5);
        return view('companys.list', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = Company::where('id', $id)->first();
        if ($user == null) {
            Company::withTrashed()->where('id', $request->id)->forceDelete();
            return back();
        }
        Company::where('id', $id)->delete();
        return back();
    }
    public function onlyTrashed()
    {
        $company = Company::onlyTrashed()->paginate(5);
        return view('companys.list', compact('company'));
    }
    public function restore(Request $request)
    {
        $check = Company::where('id', $request->id)->first();
        if ($check == null) {
            Company::withTrashed()->where('id', $request->id)->restore();
            return redirect()->route('company.index');
        }
    }
}
