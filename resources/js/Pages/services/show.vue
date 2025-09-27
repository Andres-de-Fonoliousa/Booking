<script setup>
import guest from '@/Layouts/guest.vue';
import { Link } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';

const props = defineProps({
    service: Object,
    user_id: Number,
});

// Check if current user is the service provider
const isProvider = props.user_id === props.service.provider_id;
</script>

<template>
    <guest>
        <div id="wall" class="relative w-9/12 px-40 mx-auto bg-[var(--coastal-mist)] min-h-screen py-12">
            <!-- Logo -->
            <div id="logo" class="shadow-indigo-400 shadow-2xl absolute right-0 rounded-b-3xl place-self-end-safe size-45 bg-cover bg-[url('C:\Users\LENOVO\Desktop\WebProjects\Booking\public\images\coastalLogo.jpeg')]"/>

            <!-- Header -->
            <p class="bg-gradient-to-l from-[var(--sea-glass)]/30 to-[var(--coastal-mist)] pb-10 absolute top-0 left-0 w-4/5 pt-10 translate-x-6 text-5xl text-[var(--deep-ocean)] rounded-br-4xl text-shadow-lg pl-50 place-self-start font-mono">
                {{ service.name }}
                <span id="wraper" class="absolute inset-0 bg-gradient-to-t from-[var(--coastal-mist)] to-15% rounded-br-4xl"></span>
                <p class="pt-5 pl-10 text-sm text-[var(--sea-glass)] text-shadow-lg">{{ service.description }}</p>
            </p>

            <!-- Service Details Card -->
            <div class="mt-50 bg-[var(--pearl-white)]/80 backdrop-blur-sm rounded-2xl p-8 shadow-lg border border-[var(--sea-glass)]/30">
                <!-- Main content grid -->
                <div class="grid grid-cols-1 gap-8 mb-8 md:grid-cols-3">
                    <!-- Service Info -->
                    <div class="md:col-span-2">
                        <h2 class="text-2xl font-serif text-[var(--deep-ocean)] mb-6 pb-2 border-b border-[var(--sea-glass)]/30">
                            Service Information
                        </h2>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 mt-1 text-[var(--sea-glass)] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.093a3.5 3.5 0 00-2.672 3.812 1.007 1.007 0 00.242.477L10 11.5l.354.354a1.01 1.01 0 00.242.477 3.5 3.5 0 00-2.672-3.812V5zm-3 5.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-[var(--sea-glass)] font-medium">Price</p>
                                    <p class="text-[var(--deep-ocean)]">${{ parseFloat(service.price).toFixed(2) }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 mt-1 text-[var(--sea-glass)] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-[var(--sea-glass)] font-medium">Duration</p>
                                    <p class="text-[var(--deep-ocean)]">{{ service.duration }} minutes</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 mt-1 text-[var(--sea-glass)] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-[var(--sea-glass)] font-medium">Status</p>
                                    <span :class="{
                                        'px-3 py-1 rounded-full text-sm font-medium': true,
                                        'bg-green-100 text-green-800': service.status === 'active',
                                        'bg-yellow-100 text-yellow-800': service.status === 'pending',
                                        'bg-red-100 text-red-800': service.status === 'inactive',
                                        'bg-gray-100 text-gray-800': !['active', 'pending', 'inactive'].includes(service.status)
                                    }">
                                        {{ service.status }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 mt-1 text-[var(--sea-glass)] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-[var(--sea-glass)] font-medium">Created</p>
                                    <p class="text-[var(--deep-ocean)]">{{ new Date(service.created_at).toLocaleDateString() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Provider Info -->
                    <div class="md:col-span-1">
                        <h2 class="text-2xl font-serif text-[var(--deep-ocean)] mb-6 pb-2 border-b border-[var(--sea-glass)]/30">
                            Provider Details
                        </h2>

                        <div class="space-y-6">
                            <div v-if="service.provider">
                                <p class="text-sm text-[var(--sea-glass)] font-medium">Provider Name</p>
                                <p class="text-[var(--deep-ocean)]">{{ service.provider.username }}</p>
                            </div>

                            <div v-if="service.provider">
                                <p class="text-sm text-[var(--sea-glass)] font-medium">Contact Email</p>
                                <p class="text-[var(--deep-ocean)]">{{ service.provider.email }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-[var(--sea-glass)] font-medium">Service ID</p>
                                <p class="text-[var(--deep-ocean)]">#{{ service.id }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Full Description -->
                <div class="mt-8 pt-6 border-t border-[var(--sea-glass)]/30">
                    <h3 class="text-xl font-serif text-[var(--deep-ocean)] mb-4">Full Description</h3>
                    <p class="text-[var(--driftwood)] leading-relaxed">{{ service.description }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="pt-6 border-t border-[var(--sea-glass)]/30 flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                    <div class="space-x-4" v-if="isProvider">
                        <Button :success="true">
                            <Link :href="route('services.edit', service.id)">
                                Edit Service
                            </Link>
                        </Button>

                        <Button :danger="true">
                            <Link :href="route('services.delete', service.id)" method="delete">
                                Delete Service
                            </Link>
                        </Button>
                    </div>

                    <div>
                        <Button success="true">
                            <Link :href="route('bookings.create', service)">
                                Book This Service
                            </Link>
                        </Button>
                    </div>

                    <Button class="rounded-xl" danger="true">
                        <Link :href="route('services.index')">
                            Back to Services
                        </Link>
                    </Button>
                </div>
            </div>
        </div>
    </guest>
</template>

<style scoped>
#wraper {
    z-index: -1;
}
</style>
