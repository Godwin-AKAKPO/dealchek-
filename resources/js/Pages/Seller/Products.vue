<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    products: Object,
});

const deleteProduct = (productId) => {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
        router.delete(route('products.destroy', productId));
    }
};
</script>

<template>
    <Head title="Mes Produits" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mes Produits
                </h2>
                <Link :href="route('products.create')" class="btn-primary">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nouveau produit
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="products.data.length > 0" class="space-y-4">
                    <div
                        v-for="product in products.data"
                        :key="product.id"
                        class="card"
                    >
                        <div class="flex items-center">
                            <!-- Image -->
                            <div class="h-24 w-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                <img
                                    v-if="product.primary_image"
                                    :src="`/storage/${product.primary_image.path}`"
                                    :alt="product.title"
                                    class="w-full h-full object-cover"
                                />
                                <div v-else class="w-full h-full flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="ml-6 flex-grow">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ product.title }}
                                </h3>
                                <p class="text-blue-600 font-bold mt-1">
                                    {{ product.formatted_price }}
                                </p>
                                <div class="flex items-center gap-3 mt-2 text-sm text-gray-600">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        Stock: {{ product.quantity }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Ventes: {{ product.transactions_count }}
                                    </span>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="mr-6">
                                <span
                                    :class="[
                                        'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium',
                                        product.is_active
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-gray-100 text-gray-800'
                                    ]"
                                >
                                    {{ product.is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center space-x-2">
                                <Link
                                    :href="route('products.show', product.id)"
                                    class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition"
                                    title="Voir"
                                >
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </Link>

                                <Link
                                    :href="route('products.edit', product.id)"
                                    class="p-2 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition"
                                    title="Modifier"
                                >
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </Link>

                                <button
                                    @click="deleteProduct(product.id)"
                                    class="p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition"
                                    title="Supprimer"
                                >
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aucun produit -->
                <div v-else class="card text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucun produit</h3>
                    <p class="mt-2 text-gray-600">Commencez par créer votre premier produit.</p>
                    <Link :href="route('products.create')" class="mt-6 btn-primary inline-flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer mon premier produit
                    </Link>
                </div>

                <!-- Pagination -->
                <div v-if="products.data.length > 0" class="mt-8">
                    <div class="flex justify-between items-center">
                        <Link
                            v-if="products.prev_page_url"
                            :href="products.prev_page_url"
                            class="btn-secondary"
                        >
                            Précédent
                        </Link>
                        <div v-else></div>

                        <span class="text-sm text-gray-600">
                            Page {{ products.current_page }} sur {{ products.last_page }}
                        </span>

                        <Link
                            v-if="products.next_page_url"
                            :href="products.next_page_url"
                            class="btn-secondary"
                        >
                            Suivant
                        </Link>
                        <div v-else></div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>