<script setup>
    const props = defineProps({
        placeholder:String,
        class:{
            type:String,
        },
        label:{
            type:String,
        }
    });

    const model =defineModel({
        type:String,
        required:true,
    });
</script>
<template>

    <input :class="class" required  v-model="model" :placeholder="placeholder" class="relative place-self-center-safe  peer shadow-lg shadow-blue-600/40  focus:bg-[var(--sea-glass)] focus:text-[var(--deep-ocean)] focus:border-[var(--deep-ocean)] focus:border-3 focus:scale-105 hover:brightness-105 transition-all duration-300 will-change-auto border-2 border-[var(--sea-glass)] h-15 px-8  text-lg font-semibold bg-[var(--deep-ocean)] text-[var(--sea-glass)] outline-0">
</input>

    </template>
