<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\CompanyTheme;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(): View
    {
        $companies = auth()->user()->ownedCompanies()->with(['profile', 'theme'])->get();

        return view('company.index', compact('companies'));
    }

  public function create(): View
{
    return view('company.create', ['company' => null]);
}

    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $company = Company::create([
            'owner_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        CompanyProfile::create([
            'company_id' => $company->id,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'phone' => $request->phone,
            'website' => $request->website,
        ]);

        CompanyTheme::create([
            'company_id' => $company->id,
            'primary_color' => $request->primary_color ?? '#0d6efd',
            'secondary_color' => $request->secondary_color ?? '#6c757d',
            'font' => $request->font ?? 'Inter',
        ]);

        return redirect()->route('admin.companies.index')->with('status', 'Company created.');
    }

    public function edit(Company $company): View
    {
        abort_unless($company->owner_id === auth()->id(), 403);

        $company->load(['profile', 'theme']);

        return view('company.edit', compact('company'));
    }

    public function update(StoreCompanyRequest $request, Company $company): RedirectResponse
    {
        abort_unless($company->owner_id === auth()->id(), 403);

        $company->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        CompanyProfile::updateOrCreate(
            ['company_id' => $company->id],
            [
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'phone' => $request->phone,
                'website' => $request->website,
            ]
        );

        CompanyTheme::updateOrCreate(
            ['company_id' => $company->id],
            [
                'primary_color' => $request->primary_color ?? '#0d6efd',
                'secondary_color' => $request->secondary_color ?? '#6c757d',
                'font' => $request->font ?? 'Inter',
            ]
        );

        return redirect()->route('admin.companies.index')->with('status', 'Company updated.');
    }

    public function destroy(Company $company): RedirectResponse
    {
        abort_unless($company->owner_id === auth()->id(), 403);

        // Guard: don't allow deleting a company that still has employees attached
        if ($company->users()->exists()) {
            return back()->with('error', 'Remove or reassign employees before deleting this company.');
        }

        $company->delete();

        return redirect()->route('admin.companies.index')->with('status', 'Company deleted.');
    }
}