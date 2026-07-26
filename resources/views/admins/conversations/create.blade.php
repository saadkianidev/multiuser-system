@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">New Conversation</h1>

    <form action="{{ route('admin.conversations.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-1">Company</label>
            <select name="company_id" id="company_id" required
                    class="w-full border rounded px-3 py-2">
                <option value="">-- Select company --</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Title (optional)</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Participants</label>
            <select name="participant_ids[]" id="participant_ids" multiple required
                    class="w-full border rounded px-3 py-2 h-40">
            </select>
            <p class="text-xs text-gray-500 mt-1">Select a company first to load employees/guests.</p>
        </div>

        <div>
            <label class="block font-medium mb-1">First message</label>
            <textarea name="body" required rows="3" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Start Conversation
        </button>
        <button type="button" onclick="window.history.back()" class="px-4 py-2 text-gray-600">
            Cancel
        </button>
    </form>
</div>

<script>
document.getElementById('company_id').addEventListener('change', async function () {
    const companyId = this.value;
    const select = document.getElementById('participant_ids');
    select.innerHTML = '';

    if (!companyId) return;

    const res = await fetch(`/admin/conversations/companies/${companyId}/users`);
    const users = await res.json();

    users.forEach(user => {
        const opt = document.createElement('option');
        opt.value = user.id;
        opt.textContent = `${user.name} (${user.email})`;
        select.appendChild(opt);
    });
});
</script>
@endsection