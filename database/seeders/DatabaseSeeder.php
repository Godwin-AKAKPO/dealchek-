<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un admin
        $admin = User::create([
            'name' => 'Admin DealChéké',
            'email' => 'admin@dealcheke.com',
            'phone' => '+22997000000',
            'password' => Hash::make('password'),
            'is_seller' => true,
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        // Créer des vendeurs
        $seller1 = User::create([
            'name' => 'Jean Vendeur',
            'email' => 'jean@example.com',
            'phone' => '+22997111111',
            'password' => Hash::make('password'),
            'is_seller' => true,
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        $seller2 = User::create([
            'name' => 'Marie Commerce',
            'email' => 'marie@example.com',
            'phone' => '+22997222222',
            'password' => Hash::make('password'),
            'is_seller' => true,
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        // Créer un acheteur
        $buyer = User::create([
            'name' => 'Paul Acheteur',
            'email' => 'paul@example.com',
            'phone' => '+22997333333',
            'password' => Hash::make('password'),
            'is_seller' => false,
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        // Créer des produits
        $products = [
            [
                'user_id' => $seller1->id,
                'title' => 'iPhone 14 Pro Max 256GB',
                'description' => "iPhone 14 Pro Max en excellent état, 256GB de stockage.\n\nCaractéristiques :\n- Écran Super Retina XDR 6.7 pouces\n- Puce A16 Bionic\n- Appareil photo principal 48 Mpx\n- Autonomie jusqu'à 29h\n\nLivré avec chargeur et écouteurs d'origine.",
                'price' => 850000,
                'quantity' => 2,
                'delivery_mode' => 'both',
                'delivery_fee' => 2000,
                'is_active' => true,
            ],
            [
                'user_id' => $seller1->id,
                'title' => 'MacBook Air M2 2023',
                'description' => "MacBook Air avec puce M2, parfait pour le travail et les études.\n\nSpécifications :\n- Écran Retina 13.6 pouces\n- Puce M2 avec GPU 8 cœurs\n- 8 Go de RAM\n- SSD 256 Go\n\nComme neuf, utilisé 3 mois seulement.",
                'price' => 1200000,
                'quantity' => 1,
                'delivery_mode' => 'delivery',
                'delivery_fee' => 5000,
                'is_active' => true,
            ],
            [
                'user_id' => $seller2->id,
                'title' => 'Samsung Galaxy S23 Ultra',
                'description' => "Samsung S23 Ultra en parfait état.\n\n- Écran Dynamic AMOLED 6.8 pouces\n- 12 Go RAM / 512 Go\n- S Pen inclus\n- Appareil photo 200 Mpx\n\nGarantie 6 mois restants.",
                'price' => 750000,
                'quantity' => 3,
                'delivery_mode' => 'both',
                'delivery_fee' => 2500,
                'is_active' => true,
            ],
            [
                'user_id' => $seller2->id,
                'title' => 'PlayStation 5 + 2 manettes',
                'description' => "Console PS5 (édition standard) avec 2 manettes DualSense.\n\nInclus :\n- Console PS5\n- 2 manettes\n- Tous les câbles\n- 3 jeux (FIFA 23, Spider-Man, God of War)\n\nÉtat impeccable.",
                'price' => 450000,
                'quantity' => 1,
                'delivery_mode' => 'pickup',
                'delivery_fee' => 0,
                'is_active' => true,
            ],
            [
                'user_id' => $seller1->id,
                'title' => 'iPad Pro 11 pouces',
                'description' => "iPad Pro 11 pouces avec Apple Pencil 2.\n\n- Puce M1\n- 128 Go\n- Wi-Fi + Cellular\n- Apple Pencil 2 inclus\n\nIdéal pour le dessin et la productivité.",
                'price' => 550000,
                'quantity' => 0,
                'delivery_mode' => 'both',
                'delivery_fee' => 3000,
                'is_active' => true,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        $this->command->info('Données de test créées avec succès !');
        $this->command->info(' Email Admin: admin@dealcheke.com');
        $this->command->info(' Email Vendeur 1: jean@example.com');
        $this->command->info(' Email Vendeur 2: marie@example.com');
        $this->command->info(' Email Acheteur: paul@example.com');
        $this->command->info(' Mot de passe pour tous: password');
    }
}