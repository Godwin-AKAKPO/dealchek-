<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_ref',
        'buyer_id',
        'seller_id',
        'product_id',
        'product_price',
        'delivery_fee',
        'platform_commission',
        'total_amount',
        'seller_amount',
        'status',
        'delivery_type',
        'delivery_address',
        'paid_at',
        'shipped_at',
        'delivered_at',
        'completed_at',
        'refunded_at',
    ];

    protected function casts(): array
    {
        return [
            'product_price' => 'decimal:2',
            'delivery_fee' => 'decimal:2',
            'platform_commission' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'seller_amount' => 'decimal:2',
            'paid_at' => 'datetime',
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
            'completed_at' => 'datetime',
            'refunded_at' => 'datetime',
        ];
    }

    // Relations
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function dispute()
    {
        return $this->hasOne(Dispute::class);
    }

    // Boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->transaction_ref)) {
                $transaction->transaction_ref = 'TRX-' . strtoupper(Str::random(12));
            }
        });
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Methods
    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'paid']);
    }

    public function canBeShipped()
    {
        return $this->status === 'paid';
    }

    public function canBeDelivered()
    {
        return $this->status === 'shipped';
    }
}