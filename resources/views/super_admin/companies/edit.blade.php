<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Company') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <button onclick="window.history.back()" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4">
                &larr; Back
            </button>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('super_admin.companies.update', $company) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="owner_id" :value="__('Admin (Owner)')" />
                            <select id="owner_id" name="owner_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}" {{ old('owner_id', $company->owner_id) == $admin->id ? 'selected' : '' }}>
                                        {{ $admin->name }} ({{ $admin->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('owner_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Company Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $company->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $company->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $company->profile?->address)" />
                            </div>
                            <div>
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $company->profile?->city)" />
                            </div>
                            <div>
                                <x-input-label for="country" :value="__('Country')" />
                                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $company->profile?->country)" />
                            </div>
                            <div>
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $company->profile?->phone)" />
                            </div>
                            <div class="col-span-2">
                                <x-input-label for="website" :value="__('Website')" />
                                <x-text-input id="website" name="website" type="text" class="mt-1 block w-full" :value="old('website', $company->profile?->website)" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>