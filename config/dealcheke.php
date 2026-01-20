<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Commission de la plateforme
    |--------------------------------------------------------------------------
    |
    | Pourcentage prélevé sur chaque vente (entre 0 et 100)
    | Par défaut: 7.5% (7.5)
    |
    */

    'commission_rate' => env('DEALCHEKE_COMMISSION_RATE', 7.5),

    /*
    |--------------------------------------------------------------------------
    | Délai de confirmation automatique (en jours)
    |--------------------------------------------------------------------------
    |
    | Si l'acheteur ne confirme pas la réception du produit après ce délai,
    | la transaction est automatiquement validée et l'argent libéré au vendeur.
    |
    */

    'auto_confirm_days' => env('DEALCHEKE_AUTO_CONFIRM_DAYS', 7),

    /*
    |--------------------------------------------------------------------------
    | Délai de remboursement automatique (en jours)
    |--------------------------------------------------------------------------
    |
    | Si le vendeur ne confirme pas l'envoi après ce délai depuis le paiement,
    | l'acheteur est automatiquement remboursé.
    |
    */

    'auto_refund_days' => env('DEALCHEKE_AUTO_REFUND_DAYS', 3),

    /*
    |--------------------------------------------------------------------------
    | Nombre maximum d'images par produit
    |--------------------------------------------------------------------------
    */

    'max_product_images' => 5,

    /*
    |--------------------------------------------------------------------------
    | Taille maximale d'une image (en Ko)
    |--------------------------------------------------------------------------
    */

    'max_image_size' => 2048, // 2MB

    /*
    |--------------------------------------------------------------------------
    | Formats d'images autorisés
    |--------------------------------------------------------------------------
    */

    'allowed_image_formats' => ['jpeg', 'jpg', 'png', 'webp'],

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */

    'notifications' => [
        'email' => env('DEALCHEKE_EMAIL_NOTIFICATIONS', true),
        'sms' => env('DEALCHEKE_SMS_NOTIFICATIONS', false),
    ],

];