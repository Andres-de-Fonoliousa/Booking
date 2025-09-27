<script setup>
import guest from '@/Layouts/guest.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

// Add min and max dates to prevent selecting dates in the past or too far in the future
const minDate = computed(() => {
  const now = new Date();
  return now.toISOString().slice(0, 16);
});

const maxDate = computed(() => {
  const max = new Date();
  max.setMonth(max.getMonth() + 12);
  return max.toISOString().slice(0, 16);
});

const props = defineProps({
    user_id:'',
    service:Object,
})

const now = new Date();
// Format: YYYY-MM-DDTHH:MM
const formattedDate = now.toISOString().slice(0, 16);

const form = useForm({
    service_id: props.service.id,
    provider_id: props.service.provider?.id,
    user_id: props.user_id,
    booking_time: formattedDate,
    status: 'pending',
});

// form.service_id=props.service.id;
// form.provider_id=props.service.provider.id;
// form.user_id=props.service.client.id;
// form.booking_time=props.service.created_at;

const submit = ()=>{
    form.post(route('bookings.store'));
}

</script>
<template>
    <guest>
        <div id="wall" class="relative  w-9/12 px-40 place-self-center-safe bg-[var(--coastal-mist)] h-screen min-h-screen ">
        <div id="logo" class="shadow-indigo-400 shadow-2xl absolute right-0 rounded-b-3xl place-self-end-safe  size-45 bg-cover bg-[url(C:\Users\LENOVO\Desktop\WebProjects\Booking\public\images\coastalLogo.jpeg)]"/>
            <p class="bg-gradient-to-l from-[var(--sea-glass)]/30 to-[var(--coastal-mist)] pb-10 absolute top-0 left-0 w-4/5 pt-10 translate-x-6.5 text-5xl text-[var(--deep-ocean)] rounded-br-4xl text-shadow-lg  pl-50 place-self-start font-mono">{{ service.name }}
                <span id="wraper" class="absolute inset-0 bg-gradient-to-t from-[var(--coastal-mist)] to-15% rounded-br-4xl "></span>
                <p class="pt-5 pl-10 text-sm text-[var(--sea-glass)] text-shadow-lg ">{{ service.description }}</p>
            </p>

            <div id="grid" class="w-full p-3 pt-60" >
                <div
                     class="flex flex-col h-full bg-[var(--pearl-white)]/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-[var(--sea-glass)]/30 transition-all duration-500 ease-out hover:shadow-2xl hover:translate-y-[-4px]">

                    <!-- Service Name -->
                    <h2 class="text-2xl font-serif text-[var(--deep-ocean)] mb-3  leading-tight">{{ service.price }} $</h2>

                    <!-- Service Description -->
                    <p class="text-[var(--driftwood)] mb-4 leading-relaxed line-clamp-3 font-semibold">Would you like to book <span class="text-xl text-shadow-2xs text-[var(--sea-glass)]">{{service.name}}</span>?</p>

                    <!-- Price & Status -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg font-semibold text-[var(--vintage-gold)]">It will last for <span class="font-semibold text-[var(--sea-glass)] ">{{ service.duration }}</span> minutes, once accepted</span>
                        <span :class="{
                            'px-3 py-1 rounded-full text-xs font-medium': true,
                            'bg-green-100 text-green-800': service.status === 'active',
                            'bg-gray-100 text-gray-800': service.status !== 'active'}">
                            {{ service.status }}
                        </span>
                    </div >
<div class="mb-4">
    <input
      id="booking_time"
      v-model="form.booking_time"
      type="datetime-local"
      class="w-full outline-none  px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[var(--sea-glass)] focus:border-[var(--sea-glass)] transition-all duration-300 ease-in-out"
      :min="minDate"
      :max="maxDate"
       step="1800"
    >
    <p v-if="form.errors.booking_time" class="mt-1 text-sm text-red-600">
      {{ form.errors.booking_time }}
    </p>
    <p v-else class="mt-1 text-sm text-gray-500">
      Please select a date and time for your booking
    </p>
  </div>
                    <!-- Provider Info (if available) -->
                    <div v-if="service.provider" class="mt-4 pt-4 border-t border-[var(--sea-glass)]/20">
                        <p class="text-sm text-[var(--deep-ocean)]/70 font-medium">Provided by: {{ service.provider.username }}</p>
                    </div>

                    <!-- Book Button with Enhanced Hover -->
                    <div class="pt-6 mt-auto">
                        <button
                        @click="submit"
                            class="block w-full text-center bg-gradient-to-r from-[var(--vintage-gold)]/90 to-[var(--vintage-gold)]/70 text-[var(--pearl-white)] py-3 rounded-lg transition-all duration-500 ease-out hover:from-[var(--vintage-gold)] hover:to-[var(--deep-ocean)] hover:shadow-lg font-medium tracking-wide relative overflow-hidden group"
                        >
                            <span class="relative z-10">Book Now</span>
                            <span class="absolute inset-0 bg-[var(--deep-ocean)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"></span>
                    </button>
                    </div>
                </div>
            </div>
            </div>
    </guest>
</template>
