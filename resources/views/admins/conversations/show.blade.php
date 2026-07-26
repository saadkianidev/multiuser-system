@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <button onclick="window.history.back()" class="text-sm text-gray-500 mb-4">&larr; Back</button>

    <h1 class="text-xl font-bold mb-1">
        {{ $conversation->title ?? $conversation->participants->pluck('name')->join(', ') }}
    </h1>
    <p class="text-sm text-gray-500 mb-6">
        With: {{ $conversation->participants->pluck('name')->join(', ') }}
    </p>

    <div class="bg-white rounded shadow p-4 space-y-4 max-h-[500px] overflow-y-auto">
        @foreach ($conversation->messages as $message)
            <div class="{{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                <div class="inline-block px-3 py-2 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-100' }}">
                    <p class="text-xs font-semibold opacity-75">{{ $message->sender->name }}</p>
                    <p>{{ $message->body }}</p>
                </div>
                <p class="text-xs text-gray-400 mt-1">
                    {{ $message->created_at->diffForHumans() }}
                    @if ($message->sender_id === auth()->id())
                        · {{ $message->reads->count() }} read
                    @endif
                </p>
            </div>
        @endforeach
    </div>

    <form action="{{ route('admin.conversations.messages.store', $conversation) }}"
          method="POST" class="mt-4 flex gap-2">
        @csrf
        <input type="text" name="body" required placeholder="Type a message..."
               class="flex-1 border rounded px-3 py-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Send
        </button>
    </form>
</div>
@endsection