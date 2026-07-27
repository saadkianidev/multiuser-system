<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\CompanyTheme;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin — no company_id, no created_by
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('super_admin');

        // 2. Admin — owns a company
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        $company = Company::firstOrCreate(
            ['owner_id' => $admin->id],
            [
                'name' => 'Acme Textiles',
                'description' => 'A sample seeded company for testing.',
            ]
        );

        CompanyProfile::firstOrCreate(
            ['company_id' => $company->id],
            [
                'address' => '123 Raja Bazaar Road',
                'city' => 'Rawalpindi',
                'country' => 'Pakistan',
                'phone' => '+92-300-1234567',
                'website' => 'https://acmetextiles.test',
            ]
        );

        CompanyTheme::firstOrCreate(
            ['company_id' => $company->id],
            [
                'primary_color' => '#0d6efd',
                'secondary_color' => '#6c757d',
                'logo_path' => null,
                'font' => 'Inter',
            ]
        );

        // Admin belongs to their own company too (so company_id scoping works)
        $admin->update(['company_id' => $company->id]);

        // 3. Employee — belongs to the admin's company, created_by = admin
        $employee = User::firstOrCreate(
            ['email' => 'employee@example.com'],
            [
                'name' => 'Employee',
                'password' => Hash::make('password'),
                'company_id' => $company->id,
                'created_by' => $admin->id,
                'email_verified_at' => now(),
            ]
        );
        $employee->assignRole('employee');

        // 4. Guest — belongs to the same company, created_by = admin
        $guest = User::firstOrCreate(
            ['email' => 'guest@example.com'],
            [
                'name' => 'Guest',
                'password' => Hash::make('password'),
                'company_id' => $company->id,
                'created_by' => $admin->id,
                'email_verified_at' => now(),
            ]
        );
        $guest->assignRole('guest');
    }
}