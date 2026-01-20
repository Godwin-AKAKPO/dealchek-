<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_ref')->unique();
            $table->foreignId('buyer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            
            $table->decimal('product_price', 10, 2);
            $table->decimal('delivery_fee', 8, 2)->default(0);
            $table->decimal('platform_commission', 8, 2);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('seller_amount', 10, 2);
            
            $table->enum('status', [
                'pending',           // En attente de paiement
                'paid',             // Payé, argent bloqué
                'shipped',          // Expédié par le vendeur
                'delivered',        // Confirmé par l'acheteur
                'completed',        // Argent libéré au vendeur
                'disputed',         // Litige
                'cancelled',        // Annulé
                'refunded'          // Remboursé
            ])->default('pending');
            
            $table->enum('delivery_type', ['delivery', 'pickup']);
            $table->text('delivery_address')->nullable();
            
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            
            $table->timestamps();
            
            $table->index('transaction_ref');
            $table->index('buyer_id');
            $table->index('seller_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};