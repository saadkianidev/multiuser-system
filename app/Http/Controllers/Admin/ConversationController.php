<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Company;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\MessageRead;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $companyIds = $user->hasRole('super_admin')
            ? Company::pluck('id')
            : $user->companies()->pluck('companies.id');

        $conversations = Conversation::with(['company', 'latestMessage', 'participants'])
            ->whereIn('company_id', $companyIds)
            ->orderByDesc(
                Message::select('created_at')
                    ->whereColumn('conversation_id', 'conversations.id')
                    ->latest()
                    ->limit(1)
            )
            ->paginate(15);

        return view('admin.conversations.index', compact('conversations'));
    }

    public function create()
    {
        $user = Auth::user();

        $companies = $user->hasRole('super_admin')
            ? Company::all()
            : $user->companies;

        return view('admin.conversations.create', compact('companies'));
    }

    public function usersForCompany(Company $company)
    {
        $this->authorizeCompany($company);

        $users = $company->users()
            ->role(['employee', 'guest'])
            ->select('users.id', 'users.name', 'users.email')
            ->get();

        return response()->json($users);
    }

    public function store(StoreConversationRequest $request)
    {
        $company = Company::findOrFail($request->company_id);
        $this->authorizeCompany($company);

        $conversation = DB::transaction(function () use ($request, $company) {
            $conversation = Conversation::create([
                'company_id' => $company->id,
                'title' => $request->title,
                'created_by' => Auth::id(),
            ]);

            $participantIds = array_unique(array_merge(
                $request->participant_ids,
                [Auth::id()]
            ));

            $conversation->participants()->attach($participantIds);

            $message = $conversation->messages()->create([
                'sender_id' => Auth::id(),
                'body' => $request->body,
            ]);

            MessageRead::create([
                'message_id' => $message->id,
                'user_id' => Auth::id(),
                'read_at' => now(),
            ]);

            return $conversation;
        });

        return redirect()
            ->route('admin.conversations.show', $conversation)
            ->with('success', 'Conversation started.');
    }

    public function show(Conversation $conversation)
    {
        $this->authorizeParticipant($conversation);

        $conversation->load(['participants', 'messages.sender', 'messages.reads']);

        // mark all unread messages (not sent by me) as read
        $unreadMessageIds = $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->whereDoesntHave('reads', fn ($q) => $q->where('user_id', Auth::id()))
            ->pluck('id');

        foreach ($unreadMessageIds as $messageId) {
            MessageRead::create([
                'message_id' => $messageId,
                'user_id' => Auth::id(),
                'read_at' => now(),
            ]);
        }

        return view('admin.conversations.show', compact('conversation'));
    }

    public function storeMessage(StoreMessageRequest $request, Conversation $conversation)
    {
        $this->authorizeParticipant($conversation);

        $message = $conversation->messages()->create([
            'sender_id' => Auth::id(),
            'body' => $request->body,
        ]);

        MessageRead::create([
            'message_id' => $message->id,
            'user_id' => Auth::id(),
            'read_at' => now(),
        ]);

        return back();
    }

    private function authorizeCompany(Company $company): void
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            return;
        }

        abort_unless(
            $user->companies()->where('companies.id', $company->id)->exists(),
            403
        );
    }

    private function authorizeParticipant(Conversation $conversation): void
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            return;
        }

        abort_unless(
            $conversation->participants()->where('users.id', $user->id)->exists(),
            403
        );
    }
}