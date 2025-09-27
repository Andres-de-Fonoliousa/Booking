<script setup>
import { route } from 'ziggy-js';
import { Link } from "@inertiajs/vue3";


    const responsive = defineProps({
        title:{
            type:String,
            default:'title',
        },
        des:{
            type:String,
            default:'des',
        },
        rout:{
            type:String,
        },
    });
</script>
<template>
    <div id="container" class="w-5/12">
    <div id="card" class="overflow-hidden cursor-pointer shadow-2xl shadow-indigo-900/60 grid grid-cols-1 bg-[var(--deep-ocean)] rounded-2xl border-3 border-[var(--sea-glass)]">
        <Link :href="rout" id="title" class="hover:translate-x-1 hover:text-[var(--sunset-coral)] hover:border-[var(--sunset-coral)] will-change-auto duration-300 transition-all ease-in-out col-span-1 px-3 py-3 text-3xl text-left pl-8 text-[var(--sea-glass)] border-b-2 border-[var(--sea-glass)]">{{ title }}</Link>
        <Link :href="rout" id="des" class="cursor-cell hover:text-[var(--sunset-coral)] hover:border-[var(--sunset-coral)] will-change-auto duration-300 ease-in-out col-span-1 px-3  py-6 text-xl text-left pl-12 text-[var(--sea-glass)] ">{{ des }}</Link>
        <slot class="absolute right-1" />
    </div>
    </div>
</template>
