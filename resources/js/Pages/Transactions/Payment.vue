<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    transaction: Object,
});

const form = useForm({});

const confirmPayment = () => {
    if (confirm('Confirmer le paiement de ' + new Intl.NumberFormat('fr-FR').format(props.transaction.total_amount) + ' FCFA ?')) {
        form.post(`/transactions/${props.transaction.id}/confirm-payment`);
    }
};
</script>

<template>
    <Head title="Paiement" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Paiement sécurisé
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="card">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Résumé de la commande</h3>
                        <p class="text-sm text-gray-600">Référence : {{ transaction.transaction_ref }}</p>
                    </div>

                    <!-- Détails du produit -->
                    <div class="border-b pb-6 mb-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Produit</h4>
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">{{ transaction.product.title }}</p>
                                <p class="text-sm text-gray-600 mt-1">Vendu par : {{ transaction.seller.name }}</p>
                            </div>
                            <p class="text-xl font-bold text-gray-900">
                                {{ new Intl.NumberFormat('fr-FR').format(transaction.product_price) }} FCFA
                            </p>
                        </div>
                    </div>

                    <!-- Livraison -->
                    <div class="border-b pb-6 mb-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Livraison</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">
                                    {{ transaction.delivery_type === 'delivery' ? 'Livraison à domicile' : 'Retrait sur place' }}
                                </span>
                                <span class="font-semibold">
                                    {{ new Intl.NumberFormat('fr-FR').format(transaction.delivery_fee) }} FCFA
                                </span>
                            </div>
                            <p v-if="transaction.delivery_address" class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">
                                <strong>Adresse :</strong> {{ transaction.delivery_address }}
                            </p>
                        </div>
                    </div>

                    <!-- Montants -->
                    <div class="border-b pb-6 mb-6">
                        <div class="space-y-2">
                            <div class="flex justify-between text-gray-700">
                                <span>Prix du produit</span>
                                <span>{{ new Intl.NumberFormat('fr-FR').format(transaction.product_price) }} FCFA</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>Frais de livraison</span>
                                <span>{{ new Intl.NumberFormat('fr-FR').format(transaction.delivery_fee) }} FCFA</span>
                            </div>
                            <div class="flex justify-between text-xl font-bold text-gray-900 pt-2 border-t">
                                <span>Total à payer</span>
                                <span class="text-blue-600">{{ new Intl.NumberFormat('fr-FR').format(transaction.total_amount) }} FCFA</span>
                            </div>
                        </div>
                    </div>

                    <!-- Info Escrow -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <svg class="h-5 w-5 text-blue-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="ml-3">
                                <h4 class="text-sm font-semibold text-blue-900">Paiement sécurisé (Escrow)</h4>
                                <p class="text-sm text-blue-800 mt-1">
                                    Votre argent sera bloqué jusqu'à confirmation de réception du produit. 
                                    Si le vendeur ne livre pas, vous serez automatiquement remboursé.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton paiement -->
                    <div>
                        <button
                            @click="confirmPayment"
                            :disabled="form.processing"
                            class="w-full btn-primary py-4 text-lg"
                        >
                            <span v-if="form.processing">Traitement...</span>
                            <span v-else>Payer {{ new Intl.NumberFormat('fr-FR').format(transaction.total_amount) }} FCFA</span>
                        </button>
                        <p class="text-xs text-gray-500 text-center mt-3">
                            En confirmant, vous acceptez nos conditions générales de vente
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>