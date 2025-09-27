<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    values:Array,
    routes:Array,
});
</script>
<template>
    <nav class="place-self-start fixed h-full w-1/7 py-3 bg-gradient-to-br from-[var(--deep-ocean)]/50 via-[var(--sea-glass)]/50 to-[var(--deep-ocean)]/20 rounded-bl-xl z-50 backdrop-blur-lg border-b border-[var(--vintage-gold)]/30 shadow-2xl overflow-hidden">
        <div id="container" class=" flex-col pt-35 flex space-y-7 h-full max-h-4xl">
            <div class="fixed top-0  w-full h-35 grid grid-cols-2 text-lg font-serif "><p class="col-span-1 border-r text-center pt-5 text-[var(--deep-ocean)] font-bold h-1/2 text-shadow-lg underline underline-offset-32 ">Client</p><p class="underline underline-offset-32 h-1/2 col-span-1 border-l text-center pt-5 text-[var(--deep-ocean)] text-shadow-lg font-bold">Online</p><div class="size-5 rounded-full -translate-x-2.5 border-b-1 border-[var(--deep-ocean)]  -translate-y-2.5 absolute  bg-gradient-to-r from-[var(--deep-ocean)] to-[var(--sea-glass)] shadow-2xl top-1/2 left-1/2"></div></div>
            <Link v-for="(value,index) in values" :key="value.id" :href="routes[index]" class="bg-[var(--deep-ocean)]/10 text-shadow-lg font-serif text-xl shadow-[var(--vintage-gold)] group hover:shadow-lg hover:drop-shadow-lg transform-gpu will-change-auto transition-all duration-200 ease-in-out hover:cnotrast-110  border-t border-b border-[var(--sea-glass)] text-center py-5 w-full">
                <span class="absolute inset-0 bg-gradient-to-br from-[var(--deep-ocean)]/70 via-[var(--sea-glass)]/40 to-[var(--vintage-gold)]/10 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-400 rounded-xlg"></span>

                <!-- Golden Coral Underline -->
                <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[var(--vintage-gold)]/80 to-transparent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-1000 ease-out-expo"></span>

                <!-- Shimmering Light Reflection -->
                <span class="absolute inset-0 bg-gradient-to-r from-transparent via-[var(--pearl-white)]/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out-expo"></span>

                {{ value }}
            </Link>
            </div>
    </nav>
</template>
