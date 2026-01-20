<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center">
        <Head title="Connexion - DealChéké" />
        
        <!-- Header avec logo -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md mb-8">
            <div class="flex justify-center items-center space-x-3">
                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-blue-600 text-white font-bold text-xl">
                    DC
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">DealChéké</h1>
                    <p class="text-sm text-gray-600">Marketplace Sécurisée</p>
                </div>
            </div>
        </div>

        <!-- Formulaire de connexion -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-12 px-6 shadow-sm rounded-2xl border border-gray-200">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">
                        Bienvenue !
                    </h2>
                    <p class="text-gray-600">
                        Connectez-vous à votre compte DealChéké
                    </p>
                </div>

                <div v-if="status" class="mb-6 p-4 text-sm font-medium text-blue-800 bg-blue-50 rounded-lg border border-blue-200">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <InputLabel for="email" value="Adresse email" class="text-gray-700 font-medium" />
                        
                        <TextInput
                            id="email"
                            type="email"
                            class="input-field mt-2"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="votre@email.com"
                        />
                        
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div>
                        <InputLabel for="password" value="Mot de passe" class="text-gray-700 font-medium" />
                        
                        <TextInput
                            id="password"
                            type="password"
                            class="input-field mt-2"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                        />
                        
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <Checkbox 
                                name="remember" 
                                v-model:checked="form.remember"
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                            />
                            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>

                        <Link
                            v-if="canResetPassword"
                            href="/forgot-password"
                            class="text-sm text-blue-600 hover:text-blue-700 font-medium"
                        >
                            Mot de passe oublié ?
                        </Link>
                    </div>

                    <div class="space-y-4">
                        <button
                            type="submit"
                            class="w-full btn-primary py-3"
                            :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">Connexion...</span>
                            <span v-else>Se connecter</span>
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-center text-sm text-gray-600">
                        Pas encore de compte ?
                        <Link
                            href="/register"
                            class="font-medium text-blue-600 hover:text-blue-700 ml-1"
                        >
                            Créer un compte gratuitement
                        </Link>
                    </p>
                </div>

                <!-- Retour à l'accueil -->
                <div class="mt-4 text-center">
                    <Link
                        href="/"
                        class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700"
                    >
                        <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retour à l'accueil
                    </Link>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-12 text-center">
            <p class="text-sm text-gray-500">
                © 2025 DealChéké. Tous droits réservés.
            </p>
        </div>
    </div>
</template>