<script setup>
import Navy from '../Components/Navy.vue';
</script>
<template>
<div id="body" class="min-h-svw h-full w-full bg-gradient-to-r from-[var(--sea-glass)]  via-12%  via-[var(--coastal-mist)] to-[var(--coastal-mist)] relative ">
        <p class="fixed bg-[var(--deep-ocean)] rounded-lg px-3 py-2  z-90 font-serif font-semibold opacity-100 transition-all duration-700 will-change-auto contrast-125 text-[var(--sea-glass)] border-1 border-[var(--sea-glass)] cursor-cell hover:text-[var(--sunset-coral)] text-md bottom-3 right-3">A.D.Fonoliousa</p>
        <Navy class="max-w-2/3" :values="['Dashboard','Srevices','Bookings']" :routes="['/dashboard','/services/index','/bookings/index']"></Navy>
    <slot />
</div>
</template>
