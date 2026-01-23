<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'message' => 'required|string|max:1000',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Vérifier qu'on ne s'envoie pas de message à soi-même
        if ($product->user_id === $request->user()->id) {
            return back()->with('error', 'Vous ne pouvez pas vous envoyer de message.');
        }

        // Chercher ou créer la conversation
        $conversation = Conversation::firstOrCreate([
            'product_id' => $product->id,
            'buyer_id' => $request->user()->id,
            'seller_id' => $product->user_id,
        ]);

        // Créer le message
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $request->user()->id,
            'content' => $validated['message'],
        ]);

        // Mettre à jour la date du dernier message
        $conversation->update([
            'last_message_at' => now(),
        ]);

        return redirect()->route('conversations.show', $conversation->id)
            ->with('success', 'Message envoyé avec succès.');
    }

    public function show($id)
    {
        $conversation = Conversation::with(['product', 'buyer', 'seller'])
            ->findOrFail($id);

        // Vérifier que l'utilisateur fait partie de la conversation
        if ($conversation->buyer_id !== auth()->id() && $conversation->seller_id !== auth()->id()) {
            abort(403);
        }

        // Récupérer les messages
        $messages = $conversation->messages()
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();

        // Marquer les messages comme lus
        $conversation->messages()
            ->where('sender_id', '!=', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return inertia('Conversations/Show', [
            'conversation' => $conversation,
            'messages' => $messages,
        ]);
    }

    public function sendMessage(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $conversation = Conversation::findOrFail($id);

        // Vérifier que l'utilisateur fait partie de la conversation
        if ($conversation->buyer_id !== $request->user()->id && $conversation->seller_id !== $request->user()->id) {
            abort(403);
        }

        // Créer le message
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $request->user()->id,
            'content' => $validated['message'],
        ]);

        // Mettre à jour la date du dernier message
        $conversation->update([
            'last_message_at' => now(),
        ]);

        return back();
    }
}