<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const showSellerAlert = ref(false);

const handleAddProduct = (isSeller) => {
    if (!isSeller) {
        showSellerAlert.value = true;
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Alert Modal pour non-vendeurs -->
                <div v-if="showSellerAlert" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Background overlay -->
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showSellerAlert = false"></div>

                        <!-- Modal panel -->
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                            Compte vendeur requis
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                Vous devez avoir un compte vendeur pour ajouter des produits. Souhaitez-vous devenir vendeur maintenant ?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <Link
                                    href="/seller/register"
                                    class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm"
                                >
                                    Devenir vendeur
                                </Link>
                                <button
                                    type="button"
                                    @click="showSellerAlert = false"
                                    class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                >
                                    Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Mes Produits -->
                    <div class="card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Mes Produits</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">0</p>
                            </div>
                            <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Mes Achats -->
                    <div class="card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Mes Achats</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">0</p>
                            </div>
                            <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Messages</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">0</p>
                            </div>
                            <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="card mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Actions rapides</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <component
                            :is="$page.props.auth.user.is_seller ? Link : 'button'"
                            :href="$page.props.auth.user.is_seller ? '/products/create' : undefined"
                            @click="!$page.props.auth.user.is_seller ? handleAddProduct(false) : null"
                            class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-blue-600 hover:bg-blue-50 transition-colors"
                        >
                            <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="ml-4 text-left">
                                <p class="font-semibold text-gray-900">Ajouter un produit</p>
                                <p class="text-sm text-gray-600">Publiez un nouveau produit</p>
                            </div>
                        </component>

                        <Link
                            href="/products"
                            class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-blue-600 hover:bg-blue-50 transition-colors"
                        >
                            <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Parcourir les produits</p>
                                <p class="text-sm text-gray-600">Découvrez les offres</p>
                            </div>
                        </Link>
                    </div>
                </div>

                <!-- Devenir vendeur -->
                <div v-if="!$page.props.auth.user.is_seller" class="card bg-blue-50 border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Devenez vendeur</h3>
                            <p class="text-gray-600 mb-4">Commencez à vendre vos produits sur DealChéké</p>
                            <Link href="/seller/register" class="btn-primary">
                                Devenir vendeur
                            </Link>
                        </div>
                        <svg class="h-24 w-24 text-blue-600 opacity-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>