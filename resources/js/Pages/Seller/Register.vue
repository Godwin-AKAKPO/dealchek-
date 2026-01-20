<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({});

const submit = () => {
    form.post(route('seller.store'));
};
</script>

<template>
    <Head title="Devenir Vendeur" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Devenir Vendeur
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="card">
                    <div class="text-center mb-8">
                        <div class="mx-auto h-20 w-20 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                            Devenez vendeur sur DealChéké
                        </h3>
                        <p class="text-gray-600">
                            Commencez à vendre vos produits en toute sécurité
                        </p>
                    </div>

                    <!-- Avantages -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-blue-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-900">Paiement sécurisé</p>
                                <p class="text-sm text-gray-600">Système Escrow pour protéger vos transactions</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-primary-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-900">Gestion simplifiée</p>
                                <p class="text-sm text-gray-600">Interface intuitive pour gérer vos produits et commandes</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-primary-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-900">Communication directe</p>
                                <p class="text-sm text-gray-600">Messagerie intégrée avec vos clients</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-primary-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-900">Commission compétitive</p>
                                <p class="text-sm text-gray-600">Seulement 5-10% par transaction</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informations importantes -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
                        <h4 class="font-semibold text-gray-900 mb-2">Conditions pour devenir vendeur</h4>
                        <ul class="text-sm text-gray-700 space-y-1 list-disc list-inside">
                            <li>Avoir un compte vérifié</li>
                            <li>Respecter les conditions générales de vente</li>
                            <li>Fournir des produits authentiques</li>
                            <li>Assurer un service client de qualité</li>
                        </ul>
                    </div>

                    <!-- Bouton -->
                    <form @submit.prevent="submit">
                        <div class="flex justify-center">
                            <button
                                type="submit"
                                class="btn-primary py-3 px-8"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing">Activation...</span>
                                <span v-else>Activer mon compte vendeur</span>
                            </button>
                        </div>
                    </form>

                    <p class="text-center text-sm text-gray-500 mt-4">
                        En cliquant sur ce bouton, vous acceptez de devenir vendeur sur DealChéké
                    </p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>