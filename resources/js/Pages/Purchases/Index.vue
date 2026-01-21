<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    purchases: Object,
});
</script>

<template>
    <Head title="Mes Achats" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mes Achats
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="purchases.data.length > 0" class="space-y-4">
                    <div v-for="purchase in purchases.data" :key="purchase.id" class="card">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ purchase.product.title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    Vendeur : {{ purchase.seller.name }}
                                </p>
                                <p class="text-lg font-bold text-blue-600 mt-2">
                                    {{ new Intl.NumberFormat('fr-FR').format(purchase.total_amount) }} FCFA
                                </p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ purchase.status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aucun achat -->
                <div v-else class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucun achat</h3>
                    <p class="mt-2 text-gray-600">Vous n'avez pas encore effectué d'achat.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>