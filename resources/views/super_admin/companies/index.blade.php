<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <button onclick="window.history.back()" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4">
                &larr; Back
            </button>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Companies</h3>
                        <a href="{{ route('super_admin.companies.create') }}"
                           class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                            + Add Company
                        </a>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-sm">{{ session('status') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded text-sm">{{ session('error') }}</div>
                    @endif

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 pr-4">Name</th>
                                <th class="py-2 pr-4">Owner (Admin)</th>
                                <th class="py-2 pr-4">City</th>
                                <th class="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                                <tr class="border-b">
                                    <td class="py-2 pr-4">{{ $company->name }}</td>
                                    <td class="py-2 pr-4">{{ $company->owner?->name ?? '—' }}</td>
                                    <td class="py-2 pr-4">{{ $company->profile?->city ?? '—' }}</td>
                                    <td class="py-2 space-x-3">
                                        <a href="{{ route('super_admin.companies.edit', $company) }}"
                                           class="text-indigo-600 hover:underline text-sm">Edit</a>

                                        <form action="{{ route('super_admin.companies.destroy', $company) }}"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Delete this company?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="py-4 text-gray-400">No companies found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>