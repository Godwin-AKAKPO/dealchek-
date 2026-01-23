<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    product: Object,
});

const currentImageIndex = ref(0);
const showCheckoutModal = ref(false);
const showMessageModal = ref(false);

const setCurrentImage = (index) => {
    currentImageIndex.value = index;
};

// Formulaire d'achat
const checkoutForm = useForm({
    product_id: props.product.id,
    delivery_type: 'delivery',
    delivery_address: '',
});

// Formulaire de message
const messageForm = useForm({
    product_id: props.product.id,
    message: '',
});

const openCheckout = () => {
    if (props.product.quantity === 0) {
        alert('Ce produit est épuisé');
        return;
    }
    showCheckoutModal.value = true;
};

const submitCheckout = () => {
    checkoutForm.post('/checkout', {
        onSuccess: () => {
            showCheckoutModal.value = false;
        }
    });
};

const openMessage = () => {
    showMessageModal.value = true;
};

const sendMessage = () => {
    messageForm.post('/conversations', {
        onSuccess: () => {
            showMessageModal.value = false;
            messageForm.reset('message');
        }
    });
};
</script>

<template>
    <Head :title="product.title" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <Link :href="route('products.index')" class="text-gray-600 hover:text-gray-900 mr-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </Link>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Détail du produit
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Images -->
                    <div>
                        <!-- Image principale -->
                        <div class="card mb-4">
                            <div class="aspect-square bg-gray-200 rounded-xl overflow-hidden">
                                <img
                                    v-if="product.images && product.images.length > 0"
                                    :src="`/storage/${product.images[currentImageIndex].path}`"
                                    :alt="product.title"
                                    class="w-full h-full object-cover"
                                />
                                <div v-else class="w-full h-full flex items-center justify-center">
                                    <svg class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Miniatures -->
                        <div v-if="product.images && product.images.length > 1" class="grid grid-cols-5 gap-2">
                            <button
                                v-for="(image, index) in product.images"
                                :key="image.id"
                                @click="setCurrentImage(index)"
                                :class="[
                                    'aspect-square rounded-lg overflow-hidden border-2 transition',
                                    currentImageIndex === index
                                        ? 'border-primary-600'
                                        : 'border-gray-200 hover:border-gray-300'
                                ]"
                            >
                                <img
                                    :src="`/storage/${image.path}`"
                                    :alt="`Image ${index + 1}`"
                                    class="w-full h-full object-cover"
                                />
                            </button>
                        </div>
                    </div>

                    <!-- Informations -->
                    <div>
                        <div class="card">
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                                {{ product.title }}
                            </h1>

                            <div class="flex items-center gap-2 mb-6">
                                <span
                                    v-if="product.quantity > 0"
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800"
                                >
                                    En stock ({{ product.quantity }})
                                </span>
                                <span
                                    v-else
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800"
                                >
                                    Épuisé
                                </span>
                            </div>

                            <div class="mb-6">
                                <p class="text-4xl font-bold text-blue-600">
                                    {{ product.formatted_price }}
                                </p>
                                <p v-if="product.delivery_fee > 0" class="text-sm text-gray-600 mt-1">
                                    + {{ new Intl.NumberFormat('fr-FR').format(product.delivery_fee) }} FCFA de livraison
                                </p>
                            </div>

                            <!-- Vendeur -->
                            <div class="border-t border-gray-200 pt-6 mb-6">
                                <h3 class="text-sm font-medium text-gray-900 mb-3">Vendu par</h3>
                                <div class="flex items-center">
                                    <div class="h-12 w-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-semibold">
                                        {{ product.user.name[0].toUpperCase() }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-semibold text-gray-900">{{ product.user.name }}</p>
                                        <p class="text-sm text-gray-600">{{ product.user.email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="border-t border-gray-200 pt-6 mb-6">
                                <h3 class="text-sm font-medium text-gray-900 mb-3">Description</h3>
                                <p class="text-gray-700 whitespace-pre-wrap">{{ product.description }}</p>
                            </div>

                            <!-- Mode de livraison -->
                            <div class="border-t border-gray-200 pt-6 mb-6">
                                <h3 class="text-sm font-medium text-gray-900 mb-3">Options de livraison</h3>
                                <div class="space-y-2">
                                    <div v-if="product.delivery_mode === 'delivery' || product.delivery_mode === 'both'" class="flex items-center text-sm text-gray-700">
                                        <svg class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                        </svg>
                                        Livraison à domicile disponible
                                    </div>
                                    <div v-if="product.delivery_mode === 'pickup' || product.delivery_mode === 'both'" class="flex items-center text-sm text-gray-700">
                                        <svg class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Retrait disponible
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="border-t border-gray-200 pt-6">
                                <div class="space-y-3">
                                    <button
                                        v-if="product.quantity > 0 && $page.props.auth.user.id !== product.user_id"
                                        @click="openCheckout"
                                        class="w-full btn-primary py-3"
                                    >
                                        Acheter maintenant
                                    </button>

                                    <button
                                        v-if="$page.props.auth.user.id !== product.user_id"
                                        @click="openMessage"
                                        class="w-full btn-secondary py-3"
                                    >
                                        <svg class="h-5 w-5 mr-2 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        Discuter avec le vendeur
                                    </button>

                                    <Link
                                        v-if="$page.props.auth.user.id === product.user_id"
                                        :href="`/products/${product.id}/edit`"
                                        class="w-full btn-primary py-3 text-center block"
                                    >
                                        Modifier le produit
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Checkout -->
                <div v-if="showCheckoutModal" class="fixed inset-0 z-50 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showCheckoutModal = false"></div>

                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                    Finaliser l'achat
                                </h3>

                                <div class="space-y-4">
                                    <!-- Résumé produit -->
                                    <div class="border-b pb-4">
                                        <p class="font-semibold text-gray-900">{{ product.title }}</p>
                                        <p class="text-2xl font-bold text-blue-600 mt-2">{{ product.formatted_price }}</p>
                                    </div>

                                    <!-- Type de livraison -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Mode de récupération
                                        </label>
                                        <div class="space-y-2">
                                            <label v-if="product.delivery_mode === 'delivery' || product.delivery_mode === 'both'" class="flex items-center">
                                                <input
                                                    type="radio"
                                                    v-model="checkoutForm.delivery_type"
                                                    value="delivery"
                                                    class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                />
                                                <span class="ml-2 text-sm text-gray-700">
                                                    Livraison à domicile 
                                                    <span v-if="product.delivery_fee > 0" class="text-gray-500">
                                                        (+ {{ new Intl.NumberFormat('fr-FR').format(product.delivery_fee) }} FCFA)
                                                    </span>
                                                </span>
                                            </label>
                                            <label v-if="product.delivery_mode === 'pickup' || product.delivery_mode === 'both'" class="flex items-center">
                                                <input
                                                    type="radio"
                                                    v-model="checkoutForm.delivery_type"
                                                    value="pickup"
                                                    class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                />
                                                <span class="ml-2 text-sm text-gray-700">Retrait sur place</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Adresse de livraison -->
                                    <div v-if="checkoutForm.delivery_type === 'delivery'">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Adresse de livraison
                                        </label>
                                        <textarea
                                            v-model="checkoutForm.delivery_address"
                                            rows="3"
                                            class="input-field"
                                            placeholder="Entrez votre adresse complète..."
                                            required
                                        ></textarea>
                                    </div>

                                    <!-- Total -->
                                    <div class="border-t pt-4">
                                        <div class="flex justify-between text-lg font-bold">
                                            <span>Total à payer</span>
                                            <span class="text-blue-600">
                                                {{ new Intl.NumberFormat('fr-FR').format(
                                                    parseFloat(product.price) + (checkoutForm.delivery_type === 'delivery' ? parseFloat(product.delivery_fee || 0) : 0)
                                                ) }} FCFA
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button
                                    @click="submitCheckout"
                                    :disabled="checkoutForm.processing || (checkoutForm.delivery_type === 'delivery' && !checkoutForm.delivery_address)"
                                    class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span v-if="checkoutForm.processing">Traitement...</span>
                                    <span v-else>Confirmer et payer</span>
                                </button>
                                <button
                                    @click="showCheckoutModal = false"
                                    class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                >
                                    Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Message -->
                <div v-if="showMessageModal" class="fixed inset-0 z-50 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showMessageModal = false"></div>

                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                    Message au vendeur
                                </h3>

                                <div class="space-y-4">
                                    <!-- Info vendeur -->
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="h-10 w-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ product.user.name[0].toUpperCase() }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-semibold text-gray-900">{{ product.user.name }}</p>
                                            <p class="text-sm text-gray-600">{{ product.user.email }}</p>
                                        </div>
                                    </div>

                                    <!-- Message -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Votre message
                                        </label>
                                        <textarea
                                            v-model="messageForm.message"
                                            rows="4"
                                            class="input-field"
                                            placeholder="Posez vos questions sur le produit..."
                                            required
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button
                                    @click="sendMessage"
                                    :disabled="messageForm.processing || !messageForm.message"
                                    class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span v-if="messageForm.processing">Envoi...</span>
                                    <span v-else>Envoyer</span>
                                </button>
                                <button
                                    @click="showMessageModal = false"
                                    class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                >
                                    Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>