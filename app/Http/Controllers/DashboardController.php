<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Central redirect based on role
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('super_admin')) {
            $admins = \App\Models\User::role('admin')
                ->with('ownedCompanies')
                ->get();

            return view('dashboard', ['admins' => $admins]);
        }

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        return view('dashboard');
    }

    public function superAdmin()
    {
        $admins = \App\Models\User::role('admin')->with('ownedCompanies')->get();

        return view('dashboard', ['admins' => $admins]);
    }



public function admin()
{
    $companies = auth()->user()->ownedCompanies()->with(['profile', 'theme'])->get();
    $companyIds = $companies->pluck('id');
    $users = \App\Models\User::whereIn('company_id', $companyIds)->get();

    return view('dashboards.admin', compact('companies', 'users'));
}

    public function employee()
    {
        return view('dashboards.employee');
    }

    public function guest()
    {
        return view('dashboards.guest');
    }
}