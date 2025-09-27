<script setup>
import side from '@/Components/side.vue';
</script>
<template>
    <div class="">
        <side class="w-1/7 place-self-start shadow-2xl drop-shadow-2xl" :values="['Services','Bookings','Logout']" :routes="['/services/index','/bookings/index','/logout']"></side>
    <div class="bg-[var(--coastal-mist)] pt-12 px-10 w-6/7 place-self-end-safe min-h-screen">
        <slot  />
</div>
</div>
</template>
