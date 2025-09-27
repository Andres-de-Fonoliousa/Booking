<script setup>
import Button from 'C:/Users/LENOVO/Desktop/WebProjects/Booking/resources/js/Components/Button.vue';
import { route } from 'ziggy-js';

const props = defineProps({
    message:String,
});

const back = () => {
route(back);
}

</script>
<template>
    <main id="wall" class="w-auto h-auto my-20 border-t-8 border-red-800 rounded-t-sm rounded-b-lg shadow-2xl bg-slate-950 shadow-black mx-35">
    <div id="container" class="grid grid-cols-1 grid-rows-4 gap-5 pt-4">
        <p id="title" class="w-5/6 row-span-1 row-start-1 px-2 py-4 font-mono text-xl font-bold text-left text-purple-800 border-b-2 border-slate-600 text-shadow-red-800 place-self-center-safe">Unexpected error happened!</p>
    <div id="message" class="w-5/6 row-span-2 row-start-2 px-4 py-2 font-mono text-lg text-left border-s-2 border-slate-600 font-semi-bold text-amber-600 text-shadow-amber-800 place-self-center-safe">{{ message }}</div>
    <div id="retry" class="flex justify-between w-5/6 row-span-1 row-start-4 px-2 py-2 font-mono font-medium text-gray-700 text-md text-shadow-white place-self-center-safe"><p class=""></p><p class="text-center place-self-center-safe">please bress Esc or return back and retry again</p><Button class="relative place-self-end " @click="back()">Back</Button></div>
    </div>
    </main>
</template>
