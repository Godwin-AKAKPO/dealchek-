<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    products: Object,
    filters: Object,
});

const search = ref(props.filters.search || '');

const searchProducts = () => {
    router.get('/products', { search: search.value }, {
        preserveState: true,
        replace: true,
    });
};
</script>

<template>
    <Head title="Produits" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Tous les produits
                </h2>
                <Link
                    v-if="$page.props.auth.user.is_seller"
                    href="/products/create"
                    class="btn-primary"
                >
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Ajouter un produit
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Barre de recherche -->
                <div class="mb-8">
                    <div class="relative">
                        <input
                            v-model="search"
                            @keyup.enter="searchProducts"
                            type="text"
                            placeholder="Rechercher un produit..."
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        <svg class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Liste des produits -->
                <div v-if="products.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <Link
                        v-for="product in products.data"
                        :key="product.id"
                        :href="`/products/${product.id}`"
                        class="card cursor-pointer hover:border-blue-600 transition-colors"
                    >
                        <!-- Image -->
                        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden mb-4">
                            <img
                                v-if="product.primary_image"
                                :src="`/storage/${product.primary_image.path}`"
                                :alt="product.title"
                                class="w-full h-full object-cover"
                            />
                            <div v-else class="w-full h-full flex items-center justify-center">
                                <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Info -->
                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                            {{ product.title }}
                        </h3>
                        
                        <p class="text-2xl font-bold text-blue-600 mb-2">
                            {{ product.formatted_price }}
                        </p>

                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ product.user.name }}
                        </div>

                        <!-- Badges -->
                        <div class="mt-3 flex gap-2">
                            <span v-if="product.quantity > 0" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                En stock
                            </span>
                            <span v-else class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Épuisé
                            </span>
                        </div>
                    </Link>
                </div>

                <!-- Aucun produit -->
                <div v-else class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucun produit trouvé</h3>
                    <p class="mt-2 text-gray-600">Essayez une autre recherche ou créez votre premier produit.</p>
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