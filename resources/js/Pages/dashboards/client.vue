<script setup>
import Dashl from '@/Layouts/Dashl.vue';
import Button from '@/Components/Button.vue';
import { Link } from '@inertiajs/vue3';

const formatDate = (dateString) => {
    const options = {
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

const props =defineProps({
    active_bookings:Array,
    pending_bookings:Array,
})
</script>
<template>
<Dashl>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div id="active_bookings" class="rounded-sm bg-slate-300/70 shadow-xl hover:shadow-2xl hover:scale-101 transition-all duration-300 ease-in  border-l-2 border-slate-300 rounded-bl-xl col-span-1 h-fit">
            <div id="title" class="shadow-md rounded-t-sm w-full bg-gradient-to-br from-[var(--deep-ocean)] via-[var(--sea-glass)] to-[var(--coastal-mist)] text-xl text-shadow-lg  text-[var(--pearl-white)] font-thin text-center py-3">Active Bookings</div>
            <div v-if="active_bookings" id="bookings" class="space-y- space-x-2 px-5 py-5 grid grid-cols-1 text-cent">
                <div  v-for="booking in active_bookings.data" :key="booking.id"  class="hover:bg-[var(--coastal-mist)]/50 border-b-1 pb-3 border-slate-400/60 gap-2 py-2  grid grid-cols-5"><div class="col-span-4 grid grid-cols-1 gap-2 "><p class="text-[var(--deep-ocean)]">{{ booking.service.name}}</p><p class="text-[var(--driftwood)] flex items-center text-sm">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ formatDate(booking.booking_time) }}
                    </p></div>
                    <div class="col-span-1 grid grid-cols-1">
                    <p class="col-span-1 text-[var(--vintage-gold)] text-sm font-bold text-center align-baseline py-2">${{ booking.service.price }}</p>
                    <p class=" text-sm px-2 py-1 bg-green-400/30 rounded-xl text-green font-bold text-green-600">{{ booking.status }}</p>
                </div>
                </div>
            </div>
            <div v-else class="px-8 py-8 text-center text-[var(--deep-ocean)]/70 space-y-10"><div class="text-lg">you don't have any confirmed bookings right now!<br/>discover our services if you want to book some!</div><Button class="px-4 rounded-xl"><Link class="" href="/services/index">Explore some!</Link></Button></div>
        </div>
        <div id="pending_bookings" class=" bg-slate-300/70 shadow-xl border-l-2 border-slate-300 rounded-sm col-span-1 hover:shadow-2xl hover:scale-101 transition-all duration-300 ease-in">
            <div id="title" class="shadow-md w-full bg-gradient-to-br from-[var(--deep-ocean)] via-[var(--sea-glass)] to-[var(--coastal-mist)] text-xl text-shadow-lg  rounded-t-sm text-[var(--pearl-white)] font-thin text-center py-3">Pending Bookings</div>
            <div id="bookings" v-if="pending_bookings"  class=" px-5 py-5">
                <div  v-for="booking in pending_bookings.data" :key="booking.id"  class="hover:bg-[var(--coastal-mist)]/50 border-b-1 pb-3 border-slate-400/60 gap-2 py-2  grid grid-cols-5"><div class="col-span-4 grid grid-cols-1 gap-2 "><p class="text-[var(--deep-ocean)]">{{ booking.service.name}}</p><p class="text-[var(--driftwood)] flex items-center text-sm">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ formatDate(booking.booking_time) }}
                    </p></div>
                    <div class="col-span-1 grid grid-cols-1">
                    <p class="col-span-1 text-[var(--vintage-gold)] text-sm font-bold text-center align-baseline py-2">${{ booking.service.price }}</p>
                    <p class=" text-sm px-2 py-1 bg-yellow-300/30 rounded-xl text-green font-bold text-yellow-600 text-center">{{ booking.status }}</p>
                </div>
                </div>
                </div>
            <div v-else class="px-8 py-8 text-center text-[var(--deep-ocean)]/70 space-y-10"><div class="text-lg">you don't have any pending bookings right now!<br/>discover our services if you want to book some!</div><Button class="px-4 rounded-xl"><Link class="" href="/services/index">Explore some!</Link></Button></div>
            <div v-if="loading">loading</div>
        </div>
</div>
</Dashl>
</template>
