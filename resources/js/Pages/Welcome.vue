<script setup>
import {Head} from "@inertiajs/vue3";
import Card from "../Components/Card.vue";
import guest from "../Layouts/guest.vue";
</script>
<template>
    <Head title="Welcome"/>
    <guest>
        <div id="wall" class=" relative grid w-9/12 px-40 grid-cols-2 gap-5 pt-25 place-self-center-safe bg-[var(--coastal-mist)] h-full min-h-screen">
            <Card id="sign up" rout="register" title="sign up" des="Create new account" class="w-full col-span-1"/>
            <Card id="login" rout="login" title="login" des="sign in to an existing account" class="w-full col-span-1"/>
            <Card id="about" title="what is this?" des="A Technical coast for Booking!" class=" relative w-full border-t-3 px-4 border-[var(--sea-glass)] col-span-2 pt-15 py-5"><div class="hover:border-[var(--sunset-coral)] hover:translate-x-1 transition-all duration-300 ease-in-out cursor-cell size-35 place-self-center-safe bg-cover rounded-e-2xl bg-[url(C:\Users\LENOVO\Desktop\WebProjects\Booking\public\images\coastalLogo.jpeg)] absolute right-4 border-r-2 border-[var(--sea-glass)]"></div></Card>
        </div>
    </guest>
</template>
