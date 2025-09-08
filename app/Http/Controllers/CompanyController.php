<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\UserActiveCompany;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Company::class, 'company');
    }

    public function index(Request $request)
    {
        $companies = $request->user()->companies;
        $current   = $request->user()->current_company;
        return view('companies.index', compact('companies', 'current'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'industry' => 'nullable|string',
        ]);

        $company = $request->user()->companies()->create($data);

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'industry' => 'nullable|string',
        ]);

        $company->update($data);

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    public function switch(Request $request, Company $company)
    {
        $this->authorize('view', $company);

        UserActiveCompany::updateOrCreate(
            ['user_id' => $request->user()->id],
            ['company_id' => $company->id]
        );

        return redirect()->route('companies.index')
            ->with('success', "Switched active company to {$company->name}.");
    }

}
