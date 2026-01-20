<?php

namespace App\Helpers;

class TransactionHelper
{
    /**
     * Calcule la commission de la plateforme
     */
    public static function calculateCommission(float $amount): float
    {
        $rate = config('dealcheke.commission_rate', 7.5);
        return round(($amount * $rate) / 100, 2);
    }

    /**
     * Calcule le montant que recevra le vendeur
     */
    public static function calculateSellerAmount(float $productPrice, float $deliveryFee = 0): array
    {
        $totalAmount = $productPrice + $deliveryFee;
        $commission = self::calculateCommission($productPrice);
        $sellerAmount = $totalAmount - $commission;

        return [
            'product_price' => $productPrice,
            'delivery_fee' => $deliveryFee,
            'total_amount' => $totalAmount,
            'platform_commission' => $commission,
            'seller_amount' => $sellerAmount,
        ];
    }

    /**
     * Génère une référence de transaction unique
     */
    public static function generateReference(): string
    {
        return 'TRX-' . strtoupper(uniqid() . bin2hex(random_bytes(4)));
    }

    /**
     * Formate un montant en FCFA
     */
    public static function formatAmount(float $amount): string
    {
        return number_format($amount, 0, ',', ' ') . ' FCFA';
    }
}