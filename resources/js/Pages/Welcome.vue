<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="DealChéké - Marketplace Sécurisée" />
    
    <div class="min-h-screen bg-white">
        <!-- Navigation Header Fixed -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-4 lg:py-6">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center h-10 w-10 lg:h-12 lg:w-12 rounded-xl bg-blue-600 text-white font-bold text-lg lg:text-xl">
                            DC
                        </div>
                        <div>
                            <h1 class="text-xl lg:text-2xl font-bold text-gray-900">DealChéké</h1>
                            <p class="text-xs lg:text-sm text-gray-600">Marketplace Sécurisée</p>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav v-if="canLogin" class="flex items-center space-x-4">
                        <Link v-if="$page.props.auth.user" href="/dashboard" class="btn-primary">
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link href="/login" class="btn-secondary">
                                Se connecter
                            </Link>

                            <Link v-if="canRegister" href="/register" class="btn-primary">
                                S'inscrire
                            </Link>
                        </template>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="relative pt-20 lg:pt-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:gap-16 py-12 lg:py-20">
                    <!-- Contenu principal -->
                    <div class="flex flex-col justify-center">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                            Achetez et vendez en 
                            <span class="text-blue-600">toute sécurité</span>
                        </h1>
                        
                        <p class="mt-6 text-lg leading-8 text-gray-600">
                            DealChéké est la première plateforme de marketplace qui protège vos transactions. 
                            Paiement sécurisé avec système Escrow, messagerie intégrée et garantie complète.
                        </p>

                        <div class="mt-10 flex flex-col sm:flex-row gap-4">
                            <Link
                                v-if="!$page.props.auth.user"
                                href="/register"
                                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-3 text-base font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                Commencer gratuitement
                                <svg class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </Link>
                            
                            <a href="#features" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-8 py-3 text-base font-semibold text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none">
                                En savoir plus
                            </a>
                        </div>

                        <!-- Stats -->
                        <div class="mt-12 grid grid-cols-3 gap-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-600">2000+</div>
                                <div class="text-sm text-gray-600 font-medium">Utilisateurs actifs</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-600">5000+</div>
                                <div class="text-sm text-gray-600 font-medium">Transactions</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-600">99.8%</div>
                                <div class="text-sm text-gray-600 font-medium">Satisfaits</div>
                            </div>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="relative flex items-center justify-center">
                        <div class="relative bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
                            <div class="aspect-square bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="h-64 w-64 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div id="features" class="bg-gray-50 py-24">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">
                            Tout ce dont vous avez besoin
                        </h2>
                        <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            Des fonctionnalités puissantes pour acheter et vendre en toute sécurité
                        </p>
                    </div>

                    <div class="grid gap-8 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="card">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="mt-6 text-xl font-bold text-gray-900">
                                Paiement Sécurisé (Escrow)
                            </h3>
                            <p class="mt-3 text-gray-600 leading-relaxed">
                                Votre argent est bloqué jusqu'à confirmation de réception. Protection totale contre les arnaques.
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="card">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h3 class="mt-6 text-xl font-bold text-gray-900">
                                Messagerie Intégrée
                            </h3>
                            <p class="mt-3 text-gray-600 leading-relaxed">
                                Discutez avec les vendeurs en temps réel. Historique complet et notifications par email.
                            </p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="card">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <h3 class="mt-6 text-xl font-bold text-gray-900">
                                Livraison Flexible
                            </h3>
                            <p class="mt-3 text-gray-600 leading-relaxed">
                                Choisissez entre livraison à domicile ou retrait. Suivi complet de votre commande.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="py-20">
                <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Prêt à vendre ou acheter en 
                        <span class="text-blue-600">toute sécurité</span> ?
                    </h2>
                    <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                        Rejoignez des milliers d'utilisateurs qui font confiance à DealChéké
                    </p>
                    <Link
                        v-if="!$page.props.auth.user"
                        href="/register"
                        class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-10 py-4 text-lg font-bold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Créer mon compte gratuitement
                        <svg class="ml-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </Link>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-gray-200 bg-white py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="text-lg font-semibold text-gray-700 mb-2">DealChéké</p>
                    <p class="text-sm text-gray-500">
                        © 2025 DealChéké. Tous droits réservés.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>