<script setup>
    const props = defineProps({
        placeholder:String,
    });

    const model=defineModel({
        type:String,
        required:true,
    });
</script>
<template>
    <select v-model="model" pattern="Provider|Client" required placeholder="type" :placeholder="placeholder" class="appearance-none optio shadow-lg shadow-blue-600/40  relative focus:bg-[var(--sea-glass)] focus:text-[var(--deep-ocean)] focus:border-[var(--deep-ocean)] focus:border-3 focus:scale-105 hover:brightness-105 transition-all duration-300 will-change-auto border-2 border-[var(--sea-glass)]  col-span-1 row-span-1 row-start-5 place-self-center-safe h-15 rounded-full px-8 py- text-lg font-semibold bg-[var(--deep-ocean)] text-[var(--sea-glass)] outline-0 w-7/12">

       <option class="hidden" value="" selected disabled>Type</option>
        <option  value="Client" class="selection:bg-[var(--sea-glass)] border-2">Client</option>
        <option value="Provider">Provider</option>
    </select>
</template>
