<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('/register', {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12">
        <Head title="Inscription - DealChéké" />
        
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

        <!-- Formulaire d'inscription -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-12 px-6 shadow-sm rounded-2xl border border-gray-200">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">
                        Créer votre compte
                    </h2>
                    <p class="text-gray-600">
                        Rejoignez DealChéké et commencez à vendre
                    </p>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <InputLabel for="name" value="Nom complet" class="text-gray-700 font-medium" />
                        
                        <TextInput
                            id="name"
                            type="text"
                            class="input-field mt-2"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Jean Dupont"
                        />
                        
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div>
                        <InputLabel for="email" value="Adresse email" class="text-gray-700 font-medium" />
                        
                        <TextInput
                            id="email"
                            type="email"
                            class="input-field mt-2"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="jean@exemple.com"
                        />
                        
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div>
                        <InputLabel for="phone" value="Numéro de téléphone" class="text-gray-700 font-medium" />
                        
                        <TextInput
                            id="phone"
                            type="tel"
                            class="input-field mt-2"
                            v-model="form.phone"
                            required
                            autocomplete="tel"
                            placeholder="+229 XX XX XX XX"
                        />
                        
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>

                    <div>
                        <InputLabel for="password" value="Mot de passe" class="text-gray-700 font-medium" />
                        
                        <TextInput
                            id="password"
                            type="password"
                            class="input-field mt-2"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                        />
                        
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div>
                        <InputLabel
                            for="password_confirmation"
                            value="Confirmer le mot de passe"
                            class="text-gray-700 font-medium"
                        />
                        
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="input-field mt-2"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                        />
                        
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <div class="space-y-4">
                        <button
                            type="submit"
                            class="w-full btn-primary py-3"
                            :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">Création du compte...</span>
                            <span v-else>Créer mon compte</span>
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-center text-sm text-gray-600">
                        Déjà un compte ?
                        <Link
                            href="/login"
                            class="font-medium text-blue-600 hover:text-blue-700 ml-1"
                        >
                            Se connecter
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

                <!-- Mentions légales -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-gray-400">
                        En créant un compte, vous acceptez nos conditions d'utilisation et notre politique de confidentialité.
                    </p>
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