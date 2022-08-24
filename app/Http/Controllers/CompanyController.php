<?php

namespace App\Http\Controllers;

use App\Components\SearchQueryComponent;
use App\Http\Controllers\api\BaseController;
use App\Models\Company;
use App\Repositories\Company\CompanyInterface;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $CompanyInterface;
    public function __construct(CompanyInterface $CompanyInterface)
    {
        $this->CompanyInterface = $CompanyInterface;
    }
    public function index(Request $request)
    {
        $list = SearchQueryComponent::alterQuery($request);
        $company = $this->CompanyInterface->getCompany($request);
        return view('company.list', [
            'company' => $company,
            'list' => $list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //   return $request;
        $mode = new Company();
        $mode->fill([
            'code' => $request->code,
            'name' => $request->name,
            'telephone' => $request->telephone,
            'address' => $request->address
        ])->save();
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getid($id)
    {
        $company = $this->CompanyInterface->getById($id);
        return response()->json($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->CompanyInterface->getById($id);
        return view('company.edit',compact('company'));
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
        $Company = Company::find($id)->update([
            'code' => $request->code,
            'name' => $request->name,
            'telephone' => $request->telephone,
            'address' => $request->address
        ]);
        return response()->json($Company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::where('id', $id)->delete();
        return back();
    }
    public function onlyTrashed()
    {
        $company = Company::onlyTrashed()->paginate(5);
        return view('company.list', compact('company'));
    }
    public function restore(Request $request)
    {
        $check = Company::where('id', $request->id)->first();
        if ($check == null) {
            Company::withTrashed()->where('id', $request->id)->restore();
            return redirect()->route('company.index');
        }
    }
    public function sort(Request $request)
    {
        $company = Company::Orderby('name', 'DESC')->paginate(5);
        return response()->json($company);
    }
    public function updateall(Request $request, $id)
    {
        $Company = Company::find($id)->update([
            'code' => $request->code,
            'name' => $request->name,
            'telephone' => $request->telephone,
            'address' => $request->address
        ]);
        return response()->json($Company);
    }
}
