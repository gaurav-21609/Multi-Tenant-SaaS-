<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\UserActiveCompany;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json([
            'companies' => $request->user()->companies,
            'active'    => $request->user()->current_company,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'industry' => 'nullable|string',
        ]);

        $company = $request->user()->companies()->create($data);

        return response()->json($company, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Company $company)
    {
        $this->authorize('view', $company);
        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, company $company)
    {
        $this->authorize('update', $company);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'industry' => 'nullable|string',
        ]);

        $company->update($data);

        return response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();
        return response()->json(['message' => 'Company deleted']);
    }

    public function switch(Request $request, Company $company)
    {
        $this->authorize('view', $company);

        UserActiveCompany::updateOrCreate(
            ['user_id' => $request->user()->id],
            ['company_id' => $company->id]
        );

        return response()->json([
            'message' => "Active company switched to {$company->name}",
            'company' => $company
        ]);
    }
}
