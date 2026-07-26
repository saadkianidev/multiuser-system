@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Conversations</h1>
        <a href="{{ route('admin.conversations.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + New Conversation
        </a>
    </div>

    <div class="bg-white rounded shadow divide-y">
        @forelse ($conversations as $conversation)
            <a href="{{ route('admin.conversations.show', $conversation) }}"
               class="block p-4 hover:bg-gray-50">
                <div class="flex justify-between">
                    <div>
                        <p class="font-semibold">
                            {{ $conversation->title ?? $conversation->participants->pluck('name')->join(', ') }}
                        </p>
                        <p class="text-sm text-gray-500">{{ $conversation->company->name }}</p>
                    </div>
                    @if ($conversation->latestMessage)
                        <p class="text-xs text-gray-400">
                            {{ $conversation->latestMessage->created_at->diffForHumans() }}
                        </p>
                    @endif
                </div>
                @if ($conversation->latestMessage)
                    <p class="text-sm text-gray-600 mt-1 truncate">
                        {{ $conversation->latestMessage->body }}
                    </p>
                @endif
            </a>
        @empty
            <p class="p-4 text-gray-500">No conversations yet.</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $conversations->links() }}</div>
</div>
@endsection