<template>
    <div>
        <div class="flex justify-between">
            <a
                href="/"
                class="w-20"
            >
                <img
                    alt="Logo"
                    src="/assets/logo.png"
                >
            </a>

            <!-- Mobile menu button -->
            <button
                @click="toggleNav"
                type="button"
                class="hover:text-gray-400 focus:outline-none focus:text-gray-400"
            >
                <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                    <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                </svg>
            </button>
        </div>

        <nav>
            <ul :class="showMenu ? 'flex' : 'hidden'" class="flex-col p-8 mt-8 space-y-4 lg:flex lg:space-y-0 lg:items-center lg:mt-0">
                <li class="hover:text-indigo-400">Home</li>
                <li class="hover:text-indigo-400">About</li>
                <li class="hover:text-indigo-400">Blogs</li>
                <li class="hover:text-indigo-400">Contact Us</li>
            </ul>
        </nav>
    </div>
</template>

<script setup>
    import { ref } from 'vue';

    let showMenu = ref(false);
    const toggleNav = () => (showMenu.value = !showMenu.value);
</script>
