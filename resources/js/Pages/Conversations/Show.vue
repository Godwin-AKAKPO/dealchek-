<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, nextTick } from 'vue';

const props = defineProps({
    conversation: Object,
    messages: Array,
});

const form = useForm({
    message: '',
});

const messagesContainer = ref(null);

const sendMessage = () => {
    form.post(`/conversations/${props.conversation.id}/messages`, {
        onSuccess: () => {
            form.reset('message');
            scrollToBottom();
        }
    });
};

const scrollToBottom = () => {
    nextTick(() => {
        if (messagesContainer.value) {
            messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
        }
    });
};
</script>

<template>
    <Head title="Conversation" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ conversation.product.title }}
                </h2>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm rounded-lg overflow-hidden" style="height: calc(100vh - 250px);">
                    <!-- Header conversation -->
                    <div class="bg-white border-b border-gray-200 px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ conversation.seller.name[0].toUpperCase() }}
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-900">{{ conversation.seller.name }}</p>
                                <p class="text-sm text-gray-600">{{ conversation.seller.email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div ref="messagesContainer" class="flex-1 overflow-y-auto p-6 space-y-4" style="height: calc(100% - 140px);">
                        <div
                            v-for="message in messages"
                            :key="message.id"
                            :class="[
                                'flex',
                                message.sender_id === $page.props.auth.user.id ? 'justify-end' : 'justify-start'
                            ]"
                        >
                            <div
                                :class="[
                                    'max-w-xs lg:max-w-md px-4 py-2 rounded-lg',
                                    message.sender_id === $page.props.auth.user.id
                                        ? 'bg-blue-600 text-white'
                                        : 'bg-gray-200 text-gray-900'
                                ]"
                            >
                                <p class="text-sm">{{ message.content }}</p>
                                <p
                                    :class="[
                                        'text-xs mt-1',
                                        message.sender_id === $page.props.auth.user.id
                                            ? 'text-blue-100'
                                            : 'text-gray-600'
                                    ]"
                                >
                                    {{ new Date(message.created_at).toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' }) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Input message -->
                    <div class="bg-white border-t border-gray-200 px-6 py-4">
                        <form @submit.prevent="sendMessage" class="flex space-x-3">
                            <input
                                v-model="form.message"
                                type="text"
                                placeholder="Tapez votre message..."
                                class="flex-1 input-field"
                                required
                            />
                            <button
                                type="submit"
                                :disabled="form.processing || !form.message"
                                class="btn-primary px-6"
                            >
                                <span v-if="form.processing">...</span>
                                <span v-else>Envoyer</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>