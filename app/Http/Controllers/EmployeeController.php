<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $companyIds = auth()->user()->ownedCompanies()->pluck('id');

        $employees = User::whereIn('company_id', $companyIds)
            ->with('company')
            ->get();

        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        $companies = auth()->user()->ownedCompanies;

        return view('employees.create', compact('companies'));
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {

        // dd($request);
        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => $request->company_id,
            'created_by' => auth()->id(),
            'email_verified_at' => now(),
        ]);

        // dd($employee);

        $employee->assignRole($request->role);

        return redirect()->route('admin.employees.index')->with('status', 'Employee created.');
    }

    public function edit(User $employee): View
    {
        $companyIds = auth()->user()->ownedCompanies()->pluck('id');
        abort_unless($companyIds->contains($employee->company_id), 403);

        $companies = auth()->user()->ownedCompanies;

        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(StoreEmployeeRequest $request, User $employee): RedirectResponse
    {
        $companyIds = auth()->user()->ownedCompanies()->pluck('id');
        abort_unless($companyIds->contains($employee->company_id), 403);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $employee->password,
            'company_id' => $request->company_id,
        ]);

        $employee->syncRoles([$request->role]);

        return redirect()->route('admin.employees.index')->with('status', 'Employee updated.');
    }

    public function destroy(User $employee): RedirectResponse
    {
        $companyIds = auth()->user()->ownedCompanies()->pluck('id');
        abort_unless($companyIds->contains($employee->company_id), 403);

        $employee->delete();

        return redirect()->route('admin.employees.index')->with('status', 'Employee removed.');
    }
}
