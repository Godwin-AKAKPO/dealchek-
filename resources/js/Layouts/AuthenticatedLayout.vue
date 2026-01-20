<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-50">
            <nav class="bg-white border-b border-gray-200 fixed w-full z-50 top-0">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link href="/dashboard" class="flex items-center space-x-2">
                                    <div class="h-10 w-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                                        DC
                                    </div>
                                    <span class="text-xl font-bold text-gray-900">DealChéké</span>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <Link
                                    href="/dashboard"
                                    :class="[
                                        $page.url === '/dashboard'
                                            ? 'border-blue-600 text-gray-900'
                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                        'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition'
                                    ]"
                                >
                                    Dashboard
                                </Link>

                                <Link
                                    href="/products"
                                    :class="[
                                        $page.url.startsWith('/products')
                                            ? 'border-blue-600 text-gray-900'
                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                        'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition'
                                    ]"
                                >
                                    Produits
                                </Link>

                                <Link
                                    v-if="$page.props.auth.user.is_seller"
                                    href="/seller/products"
                                    :class="[
                                        $page.url.startsWith('/seller')
                                            ? 'border-blue-600 text-gray-900'
                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                        'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition'
                                    ]"
                                >
                                    Mes Ventes
                                </Link>

                                <Link
                                    href="/purchases"
                                    :class="[
                                        $page.url.startsWith('/purchases')
                                            ? 'border-blue-600 text-gray-900'
                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                        'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition'
                                    ]"
                                >
                                    Mes Achats
                                </Link>

                                <Link
                                    href="/messages"
                                    :class="[
                                        $page.url.startsWith('/messages')
                                            ? 'border-blue-600 text-gray-900'
                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                        'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition'
                                    ]"
                                >
                                    Messages
                                </Link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <button
                                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                >
                                    <span>{{ $page.props.auth.user.name }}</span>

                                    <svg
                                        class="ml-2 -mr-0.5 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>

                                <div
                                    v-show="showingNavigationDropdown"
                                    class="absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                                    @click="showingNavigationDropdown = false"
                                >
                                    <Link
                                        href="/profile"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg"
                                    >
                                        Mon Profil
                                    </Link>

                                    <Link
                                        v-if="!$page.props.auth.user.is_seller"
                                        href="/seller/register"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    >
                                        Devenir Vendeur
                                    </Link>

                                    <Link
                                        href="/logout"
                                        method="post"
                                        as="button"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg"
                                    >
                                        Déconnexion
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <Link
                            href="/dashboard"
                            :class="[
                                $page.url === '/dashboard'
                                    ? 'bg-blue-50 border-blue-600 text-blue-700'
                                    : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800',
                                'block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition'
                            ]"
                        >
                            Dashboard
                        </Link>

                        <Link
                            href="/products"
                            :class="[
                                $page.url.startsWith('/products')
                                    ? 'bg-blue-50 border-blue-600 text-blue-700'
                                    : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800',
                                'block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition'
                            ]"
                        >
                            Produits
                        </Link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <Link
                                href="/profile"
                                class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition"
                            >
                                Mon Profil
                            </Link>

                            <Link
                                href="/logout"
                                method="post"
                                as="button"
                                class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition"
                            >
                                Déconnexion
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow-sm pt-16 border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="pt-16">
                <slot />
            </main>
        </div>
    </div>
</template>