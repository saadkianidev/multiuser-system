<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\CompanyTheme;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SuperAdminCompanyController extends Controller
{
    public function index()
    
    {
        $companies = Company::with(['owner', 'profile'])->get();

        return view('super_admin.companies.index', ['companies' => $companies]);
    }

    public function create(): View
    {
        $admins = User::role('admin')->get();

        return view('super_admin.companies.create', compact('admins'));
    }

    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $company = Company::create([
            'owner_id' => $request->owner_id,
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

        return redirect()->route('super_admin.companies.index')->with('status', 'Company created.');
    }

    public function edit(Company $company): View
    {
        $company->load(['profile', 'theme']);
        $admins = User::role('admin')->get();

        return view('super_admin.companies.edit', compact('company', 'admins'));
    }

    public function update(StoreCompanyRequest $request, Company $company): RedirectResponse
    {
        $company->update([
            'owner_id' => $request->owner_id,
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

        return redirect()->route('super_admin.companies.index')->with('status', 'Company updated.');
    }

    public function destroy(Company $company): RedirectResponse
    {
        if ($company->users()->exists()) {
            return back()->with('error', 'Remove or reassign employees before deleting this company.');
        }

        $company->delete();

        return redirect()->route('super_admin.companies.index')->with('status', 'Company deleted.');
    }
}
