<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupCommand extends Command
{
    protected $signature = 'dealcheke:setup {--fresh : Recréer la base de données}';
    protected $description = 'Configuration rapide de DealChéké';

    public function handle()
    {
        $this->info('🚀 Configuration de DealChéké...');
        $this->newLine();

        // Storage link
        $this->info('📁 Création du lien symbolique pour le stockage...');
        Artisan::call('storage:link');
        $this->info('✅ Lien créé');
        $this->newLine();

        // Migrations
        if ($this->option('fresh')) {
            $this->warn('⚠️  Suppression de toutes les données existantes...');
            if ($this->confirm('Êtes-vous sûr de vouloir tout supprimer ?', false)) {
                $this->info('🗄️  Migration fresh...');
                Artisan::call('migrate:fresh --seed');
                $this->info('✅ Base de données recréée avec données de test');
            } else {
                $this->error('❌ Opération annulée');
                return 1;
            }
        } else {
            $this->info('🗄️  Exécution des migrations...');
            Artisan::call('migrate');
            $this->info('✅ Migrations effectuées');
        }

        $this->newLine();
        $this->info('🎉 Configuration terminée !');
        $this->newLine();
        
        $this->table(
            ['Rôle', 'Email', 'Mot de passe'],
            [
                ['Admin', 'admin@dealcheke.com', 'password'],
                ['Vendeur', 'jean@example.com', 'password'],
                ['Vendeur', 'marie@example.com', 'password'],
                ['Acheteur', 'paul@example.com', 'password'],
            ]
        );

        $this->newLine();
        $this->info('🌐 Lancez maintenant :');
        $this->comment('   Terminal 1: php artisan serve');
        $this->comment('   Terminal 2: npm run dev');
        $this->newLine();

        return 0;
    }
}