<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Admins') }}
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
                        <h3 class="text-lg font-semibold">Admins</h3>
                        <a href="{{ route('super_admin.admins.create') }}"
                           class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                            + Add Admin
                        </a>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 pr-4">Name</th>
                                <th class="py-2 pr-4">Email</th>
                                <th class="py-2 pr-4">Companies</th>
                                <th class="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins as $admin)
                                <tr class="border-b">
                                    <td class="py-2 pr-4">{{ $admin->name }}</td>
                                    <td class="py-2 pr-4">{{ $admin->email }}</td>
                                    <td class="py-2 pr-4">
                                        @forelse ($admin->ownedCompanies as $company)
                                            <span class="inline-block bg-gray-100 rounded px-2 py-1 text-sm mr-1">
                                                {{ $company->name }}
                                            </span>
                                        @empty
                                            <span class="text-gray-400 text-sm">No companies</span>
                                        @endforelse
                                    </td>
                                    <td class="py-2 space-x-3">
                                        <a href="{{ route('super_admin.admins.edit', $admin) }}"
                                           class="text-indigo-600 hover:underline text-sm">Edit</a>

                                        <form action="{{ route('super_admin.admins.destroy', $admin) }}"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Delete this admin?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-gray-400">No admins found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>