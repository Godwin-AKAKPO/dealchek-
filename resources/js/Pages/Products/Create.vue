<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

const form = useForm({
    title: '',
    description: '',
    price: '',
    quantity: 1,
    delivery_mode: 'both',
    delivery_fee: '',
    images: [],
});

const imagePreviews = ref([]);

const handleImageUpload = (event) => {
    const files = Array.from(event.target.files);
    
    if (files.length + form.images.length > 5) {
        alert('Vous ne pouvez ajouter que 5 images maximum');
        return;
    }

    files.forEach(file => {
        form.images.push(file);
        
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreviews.value.push(e.target.result);
        };
        reader.readAsDataURL(file);
    });
};

const removeImage = (index) => {
    form.images.splice(index, 1);
    imagePreviews.value.splice(index, 1);
};

const submit = () => {
    form.post(route('products.store'));
};
</script>

<template>
    <Head title="Créer un produit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Créer un nouveau produit
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="card">
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Titre -->
                        <div>
                            <InputLabel for="title" value="Titre du produit *" class="text-gray-700 font-medium" />
                            <TextInput
                                id="title"
                                v-model="form.title"
                                type="text"
                                class="input-field mt-2"
                                placeholder="Ex: iPhone 13 Pro Max 256GB"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <!-- Description -->
                        <div>
                            <InputLabel for="description" value="Description *" class="text-gray-700 font-medium" />
                            <textarea
                                id="description"
                                v-model="form.description"
                                rows="5"
                                class="input-field mt-2"
                                placeholder="Décrivez votre produit en détail..."
                                required
                            ></textarea>
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <!-- Prix et Quantité -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel for="price" value="Prix (FCFA) *" class="text-gray-700 font-medium" />
                                <TextInput
                                    id="price"
                                    v-model="form.price"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    class="input-field mt-2"
                                    placeholder="0"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>

                            <div>
                                <InputLabel for="quantity" value="Quantité *" class="text-gray-700 font-medium" />
                                <TextInput
                                    id="quantity"
                                    v-model="form.quantity"
                                    type="number"
                                    min="1"
                                    class="input-field mt-2"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.quantity" />
                            </div>
                        </div>

                        <!-- Mode de livraison -->
                        <div>
                            <InputLabel value="Mode de livraison *" />
                            <div class="mt-2 space-y-2">
                                <label class="flex items-center">
                                    <input
                                        type="radio"
                                        v-model="form.delivery_mode"
                                        value="delivery"
                                        class="h-4 w-4 text-primary-600 focus:ring-primary-500"
                                    />
                                    <span class="ml-2 text-sm text-gray-700">Livraison à domicile uniquement</span>
                                </label>
                                <label class="flex items-center">
                                    <input
                                        type="radio"
                                        v-model="form.delivery_mode"
                                        value="pickup"
                                        class="h-4 w-4 text-primary-600 focus:ring-primary-500"
                                    />
                                    <span class="ml-2 text-sm text-gray-700">Retrait uniquement</span>
                                </label>
                                <label class="flex items-center">
                                    <input
                                        type="radio"
                                        v-model="form.delivery_mode"
                                        value="both"
                                        class="h-4 w-4 text-primary-600 focus:ring-primary-500"
                                    />
                                    <span class="ml-2 text-sm text-gray-700">Les deux options</span>
                                </label>
                            </div>
                            <InputError class="mt-2" :message="form.errors.delivery_mode" />
                        </div>

                        <!-- Frais de livraison -->
                        <div v-if="form.delivery_mode !== 'pickup'">
                            <InputLabel for="delivery_fee" value="Frais de livraison (FCFA)" class="text-gray-700 font-medium" />
                            <TextInput
                                id="delivery_fee"
                                v-model="form.delivery_fee"
                                type="number"
                                step="0.01"
                                min="0"
                                class="input-field mt-2"
                                placeholder="0"
                            />
                            <InputError class="mt-2" :message="form.errors.delivery_fee" />
                        </div>

                        <!-- Images -->
                        <div>
                            <InputLabel value="Photos du produit * (Max 5)" class="text-gray-700 font-medium" />
                            
                            <div class="mt-2">
                                <label class="flex justify-center w-full h-32 px-4 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-400 transition-colors">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <span class="font-medium text-gray-600">
                                            Cliquez pour ajouter des images
                                        </span>
                                    </span>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        multiple
                                        class="hidden"
                                        @change="handleImageUpload"
                                        :disabled="form.images.length >= 5"
                                    />
                                </label>
                            </div>

                            <!-- Preview images -->
                            <div v-if="imagePreviews.length > 0" class="mt-4 grid grid-cols-3 gap-4">
                                <div v-for="(preview, index) in imagePreviews" :key="index" class="relative group">
                                    <img :src="preview" class="w-full h-32 object-cover rounded-lg" />
                                    <button
                                        type="button"
                                        @click="removeImage(index)"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <span v-if="index === 0" class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                        Principal
                                    </span>
                                </div>
                            </div>

                            <InputError class="mt-2" :message="form.errors.images" />
                        </div>

                        <!-- Boutons -->
                        <div class="flex justify-end space-x-4 pt-4">
                            <button
                                type="button"
                                @click="$inertia.visit(route('seller.products'))"
                                class="btn-secondary"
                            >
                                Annuler
                            </button>
                            <button
                                type="submit"
                                class="btn-primary"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing">Création...</span>
                                <span v-else>Créer le produit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>