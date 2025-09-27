<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    values:{
        type:Array,
        default:()=>[],
    },
    routes:Array,
})
</script>
<template>
    <nav class="place-self-end-safe fixed flex justify-center w-full p-3 bg-gradient-to-b from-[var(--sea-glass)]/50 to-[var(--deep-ocean)]/20 rounded-bl-xl z-50 backdrop-blur-lg border-b border-[var(--vintage-gold)]/30 shadow-lg shadow-[var(--sea-glass)]/25 px-3">
        <div class="flex items-center justify-around w-full max-w-4xl">
            <Link
                v-for="(value, index) of values"
                :key="value.id"
                :href="routes[index]"
                class="text-[var(--pearl-white)] px-6 py-3 rounded-lg text-lg font-medium transition-all duration-500 ease-out-expo relative overflow-hidden group mx-2"
            >
                <!-- Ocean Depth Background -->
                <span class="absolute inset-0 bg-gradient-to-br from-[var(--deep-ocean)]/70 via-[var(--sea-glass)]/40 to-[var(--vintage-gold)]/10 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-700 rounded-xlg"></span>

                <!-- Golden Coral Underline -->
                <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[var(--vintage-gold)]/80 to-transparent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-1000 ease-out-expo"></span>

                <!-- Shimmering Light Reflection -->
                <span class="absolute inset-0 bg-gradient-to-r from-transparent via-[var(--pearl-white)]/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out-expo"></span>

                <!-- Content with Coastal Typography -->
                <span class="group relative z-10 flex-col items-center tracking-wide font-serif text-shadow-md shadow-[var(--deep-ocean)]/50">
                    {{ value }}
                </span>
            </Link>
        </div>
    </nav>
</template>
