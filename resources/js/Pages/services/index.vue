<script setup>
import ml from '@/Layouts/ml.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    services:Array,
    message:String,
    user_id:String,
});

</script>

<template>
    <ml>
       <main class="w-full max-w-6xl p-6 place-self-end-safe pt-35">
            <!-- Header  -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl text-shadow-lg font-semibold font-serif text-[var(--deep-ocean)] tracking-wide">Our Services</h1>
                <p class="text-[var(--sea-glass)] mt-2 text-lg font-light">Discover our coastal luxury treatments</p>
            </div>

            <!-- Services Grid -->
            <div v-if="services.length" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Service Card -->
                <div v-for="service in services " :key="service.id"
                     class="flex flex-col h-full bg-[var(--pearl-white)]/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-[var(--sea-glass)]/30 transition-all duration-500 ease-out hover:shadow-2xl hover:translate-y-[-4px]">

                    <!-- Service Name -->
                    <h2 class="text-xl font-serif text-[var(--deep-ocean)] mb-3 leading-tight">{{ service.name }}</h2>

                    <!-- Service Description -->
                    <p class="text-[var(--driftwood)] mb-4 leading-relaxed line-clamp-3">{{ service.description }}</p>

                    <!-- Price & Status -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg font-semibold text-[var(--vintage-gold)]">${{ service.price }}</span>
                        <span :class="{
                            'px-3 py-1 rounded-full text-xs font-medium': true,
                            'bg-green-100 text-green-800': service.status === 'active',
                            'bg-gray-100 text-gray-800': service.status !== 'active'}">
                            {{ service.status }}
                        </span>
                    </div>

                    <!-- Provider Info (if available) -->
                    <div v-if="service.provider" class="mt-4 pt-4 border-t border-[var(--sea-glass)]/20">
                        <p class="text-sm text-[var(--deep-ocean)]/70 font-medium">Provided by: {{ service.provider.username }}</p>
                    </div>

                    <!-- Book Button with Enhanced Hover -->
                    <div class="flex pt-6 mt-auto space-x-8">
                        <Link
                            :href="route('bookings.create',[service])"
                            class="block w-full text-center bg-gradient-to-r from-[var(--vintage-gold)]/90 to-[var(--vintage-gold)]/70 text-[var(--pearl-white)] py-3 rounded-lg transition-all duration-500 ease-out hover:from-[var(--vintage-gold)] hover:to-[var(--deep-ocean)] hover:shadow-lg font-medium tracking-wide relative overflow-hidden group"
                        >
                            <span class="relative z-10">Book Now</span>
                            <span class="absolute inset-0 bg-[var(--deep-ocean)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"></span>
                        </Link>
                        <Link
                            :href="service ? route('services.show', service.id) : ''"
                            class="block w-full text-center bg-gradient-to-r from-[var(--deep-ocean)]/90 to-[var(--deep-ocean)]/70 text-[var(--pearl-white)] py-3 rounded-lg transition-all duration-500 ease-out hover:from-[var(--deep-ocean)] hover:to-[var(--vintage-gold)] hover:shadow-lg font-medium tracking-wide relative overflow-hidden group"
                        >
                            <span class="relative z-10">Details</span>
                            <span class="absolute inset-0 bg-[var(--vintage-gold)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"></span>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="py-12 text-center">
                <div class="text-[var(--sea-glass)] text-6xl mb-4">🌊</div>
                <h3 class="text-xl text-[var(--deep-ocean)] font-serif">No services available yet</h3>
                <p class="text-[var(--driftwood)] mt-2 text-lg">Check back later or contact us to create one</p>
            </div>
        </main>
    </ml>
</template>
