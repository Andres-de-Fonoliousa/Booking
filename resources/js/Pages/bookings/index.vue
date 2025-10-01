<script setup>
import ml from '@/Layouts/ml.vue';
import { Link } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';

const props = defineProps({
    bookings:Object,
    myBookings:Object,
    money_paid:Number,
    myPendingBookings:Object,
    pending_money:Number,
});

const formatDate = (dateString) => {
    const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

const confirmBooking = (bookingId) => {
    // Implement confirmation logic
};

const cancelBooking = (bookingId) => {
    // Implement cancellation logic
};


</script>

<template>
    <ml>
        <main class="grid w-full max-w-6xl grid-cols-3 gap-10 p-6 place-self-end-safe pt-35">
            <div id="bookings grid" class="grid grid-cols-1 col-span-2 gap-10 px-20 border-r border-slate-300 ">
                <h5 class="font-serif text-5xl text-[var(--deep-ocean)] pb-2  px-7 text-center place-self-start -translate-x-3 text-shadow-stone-400 text-shadow-lg ">Your bookings</h5>
                <div v-for="booking in myBookings" :key="booking.id" class="flex flex-col h-full bg-[var(--pearl-white)]/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-[var(--sea-glass)]/30 transition-all duration-500 ease-out hover:shadow-2xl hover:translate-y-[-4px]">
<!-- Service Name -->
                <h2 class="text-xl font-serif text-[var(--deep-ocean)] mb-3 leading-tight">{{ booking.service.name }}</h2>

<!-- Booking Details -->
                <div class="text-[var(--driftwood)] mb-4 space-y-2">
                    <p class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ formatDate(booking.booking_time) }}
                    </p>
                    <p class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        Booked by: {{ booking.client.username }}
                    </p>
                </div>

<!-- Price & Status -->
                <div class="flex items-center justify-between mb-4">
                    <span class="text-lg font-semibold text-[var(--vintage-gold)]">${{ booking.service.price }}</span>
                    <span :class="{'px-3 py-1 rounded-full text-xs font-medium': true,'bg-yellow-100 text-yellow-800': booking.status === 'pending','bg-green-100 text-green-800': booking.status === 'confirmed','bg-red-100 text-red-800': booking.status === 'cancelled','bg-gray-100 text-gray-800': !['pending', 'confirmed', 'cancelled'].includes(booking.status)}">
                        {{ booking.status }}
                    </span>
                </div>

<!-- Provider Info -->
                <div v-if="booking.provider" class="mt-4 pt-4 border-t border-[var(--sea-glass)]/20">
                    <p class="text-sm text-[var(--deep-ocean)]/70 font-medium">Provided by: {{ booking.provider.username }}</p>
                </div>

<!-- Action Buttons -->
                <div class="grid grid-cols-3 gap-4 pt-6 mt-auto">
                    <Button class="col-span-1" :danger="true" v-if="booking.status === 'pending' || booking.status === 'confirmed'" @click="cancelBooking(booking.id)">
                        Cancel
                    </Button>
                    <Button class="col-span-1 col-start-3 rounded-xl ">
                    <Link :href="route('bookings.show', booking.id)"  >
                        Details
                    </Link>
                    </Button>
                </div>
            </div>
        </div>

        <div id="stats" class="w-full ">
            <h5 class="font-serif text-4xl text-[var(--sea-glass)] pb-6 border-b-2 border-[var(--deep-ocean)]/80 px-17 text-center place-self-center-safe text-shadow-lg ">Records</h5>
            <p class="px-3 pt-6 pb-2 font-light border-b backdrop-blur-3xl border-slate-400 text-shadow-lg place-self-center-safe text-slate-600">Hover there!</p>
            <div class="mt-5 stat-item relative overflow-hidden group px-7 py-5 rounded-xl bg-gradient-to-br from-[var(--pearl-white)]/80 to-[var(--coastal-mist)]/80 border-b-1 border-[var(--sea-glass)]/30 transition-all duration-500 ease-out-expo hover:shadow-2xl hover:translate-y-[-4px]">
<!-- Ocean Depth Background -->
            <span class="absolute inset-0 bg-gradient-to-br from-[var(--deep-ocean)]/70 via-[var(--sea-glass)]/40 to-[var(--vintage-gold)]/10 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-700  rounded-2xl"></span>
<!-- Golden Coral Underline -->
            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-[var(--vintage-gold)]/80 to-transparent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-1000 "></span>
<!-- Shimmering Light Reflection -->
            <span class="absolute inset-0 bg-gradient-to-r from-transparent via-[var(--pearl-white)]/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 "></span>
            <div class="relative z-10 flex items-center justify-between">
                <p class="text-xl font-medium text-[var(--deep-ocean)] group-hover:text-[var(--pearl-white)] transition-colors duration-500">Total services booked</p>
                <p class="stat-value text-xl font-bold text-[var(--vintage-gold)]">{{myBookings.length}}</p>
            </div>
            </div>
            <div class="mt-10 stat-item relative overflow-hidden group px-7 py-5 rounded-xl bg-gradient-to-br from-[var(--pearl-white)]/80 to-[var(--coastal-mist)]/80 border-b-1 border-[var(--sea-glass)]/30 transition-all duration-500 ease-out-expo hover:shadow-2xl hover:translate-y-[-4px]">
<!-- Ocean Depth Background -->
                <span class="absolute inset-0 bg-gradient-to-br from-[var(--deep-ocean)]/70 via-[var(--sea-glass)]/40 to-[var(--vintage-gold)]/10 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-700  rounded-2xl"></span>
<!-- Golden Coral Underline -->
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-[var(--vintage-gold)]/80 to-transparent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-1000 "></span>
<!-- Shimmering Light Reflection -->
                <span class="absolute inset-0 bg-gradient-to-r from-transparent via-[var(--pearl-white)]/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 "></span>
                <div class="relative z-10 flex items-center justify-between">
                    <p class="text-xl font-medium text-[var(--deep-ocean)] group-hover:text-[var(--pearl-white)] transition-colors duration-500">Total money paid</p>
                    <p class="stat-value text-xl font-bold text-[var(--vintage-gold)]">{{money_paid}} $</p>
                </div>
            </div>
            <div class="mt-10 stat-item relative overflow-hidden group px-7 py-5 rounded-xl bg-gradient-to-br from-[var(--pearl-white)]/80 to-[var(--coastal-mist)]/80 border-b-1 border-[var(--sea-glass)]/30 transition-all duration-500 ease-out-expo hover:shadow-2xl hover:translate-y-[-4px]">
<!-- Ocean Depth Background -->
                <span class="absolute inset-0 bg-gradient-to-br from-[var(--deep-ocean)]/70 via-[var(--sea-glass)]/40 to-[var(--vintage-gold)]/10 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-700  rounded-2xl"></span>
<!-- Golden Coral Underline -->
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-[var(--vintage-gold)]/80 to-transparent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-1000 "></span>
<!-- Shimmering Light Reflection -->
                <span class="absolute inset-0 bg-gradient-to-r from-transparent via-[var(--pearl-white)]/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 "></span>
                <div class="relative z-10 flex items-center justify-between">
                    <p class="text-xl font-medium text-[var(--deep-ocean)] group-hover:text-[var(--pearl-white)] transition-colors duration-500">Pending Bookings</p>
                    <p class="stat-value text-xl font-bold text-[var(--vintage-gold)]">{{myPendingBookings.length}}</p>
                </div>
            </div>
            <div class="mt-10 stat-item relative overflow-hidden group px-7 py-5 rounded-xl bg-gradient-to-br from-[var(--pearl-white)]/80 to-[var(--coastal-mist)]/80 border-b-1 border-[var(--sea-glass)]/30 transition-all duration-500 ease-out-expo hover:shadow-2xl hover:translate-y-[-4px]">
<!-- Ocean Depth Background -->
                <span class="absolute inset-0 bg-gradient-to-br from-[var(--deep-ocean)]/70 via-[var(--sea-glass)]/40 to-[var(--vintage-gold)]/10 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-700  rounded-2xl"></span>
<!-- Golden Coral Underline -->
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-[var(--vintage-gold)]/80 to-transparent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-1000 "></span>
<!-- Shimmering Light Reflection -->
                <span class="absolute inset-0 bg-gradient-to-r from-transparent via-[var(--pearl-white)]/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 "></span>
                <div class="relative z-10 flex items-center justify-between">
                    <p class="text-xl font-medium text-[var(--deep-ocean)] group-hover:text-[var(--pearl-white)] transition-colors duration-500">Upcoming payments</p>
                    <p class="stat-value text-xl font-bold text-[var(--vintage-gold)]">{{pending_money}} $</p>
                </div>
            </div>
        </div>
        </main>
    </ml>
</template>
<style scoped>
.stat-item {
            transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .stat-value {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.7s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .stat-item:hover .stat-value {
            opacity: 1;
            transform: translateY(0);
        }

        .ease-out-expo {
            transition-timing-function: cubic-bezier(0.19, 1, 0.22, 1);
        }
        </style>
