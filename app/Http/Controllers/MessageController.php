<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $conversations = $request->user()
            ->buyerConversations()
            ->with(['product', 'seller', 'latestMessage'])
            ->orWhere(function ($query) use ($request) {
                $query->where('seller_id', $request->user()->id);
            })
            ->latest('last_message_at')
            ->paginate(20);

        return Inertia::render('Messages/Index', [
            'conversations' => $conversations,
        ]);
    }
}