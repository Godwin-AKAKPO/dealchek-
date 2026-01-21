<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    conversations: Object,
});
</script>

<template>
    <Head title="Messages" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Messages
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="conversations.data.length > 0" class="space-y-4">
                    <div v-for="conversation in conversations.data" :key="conversation.id" class="card cursor-pointer hover:border-blue-600 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ conversation.product.title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    Avec : {{ conversation.seller.name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aucun message -->
                <div v-else class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucun message</h3>
                    <p class="mt-2 text-gray-600">Vous n'avez pas encore de conversation.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>