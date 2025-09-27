<script setup>
import guest from '@/Layouts/guest.vue';
import Input from '@/Components/Input.vue';
import Button from '@/Components/Button.vue';
import { useForm } from '@inertiajs/vue3';
import { route } from "ziggy-js";

const props = defineProps({
    user_id: Number,
});

const form = useForm({
    name: '',
    provider_id: '',
    status: 'active', // Default to active
    duration: '',
    price: '',
    description: '',
});

const submit = () => {
    form.provider_id = props.user_id;
    form.post(route('services.store'));
};
</script>

<template>
    <guest>
        <div id="wall" class="relative w-9/12 px-40 mx-auto bg-[var(--coastal-mist)] min-h-screen py-12">
            <!-- Logo -->
            <div id="logo" class="shadow-indigo-400 shadow-2xl absolute right-0 rounded-b-3xl place-self-end-safe  size-45 bg-cover bg-[url(C:\Users\LENOVO\Desktop\WebProjects\Booking\public\images\coastalLogo.jpeg)]"/>
            <p class="bg-gradient-to-l from-[var(--sea-glass)]/30 to-[var(--coastal-mist)] pb-10 absolute top-0 left-0 w-4/5 pt-10 translate-x-6 text-5xl text-[var(--deep-ocean)] rounded-br-4xl text-shadow-lg  pl-50 place-self-start font-mono">Create a service
                <span id="wraper" class="absolute inset-0 bg-gradient-to-t from-[var(--coastal-mist)] to-15% rounded-br-4xl "></span>
                <p class="pt-5 pl-10 text-sm text-[var(--sea-glass)] text-shadow-lg ">Let your services be shown on our coast!</p>
            </p>

            <!-- Form Card -->
            <div class="mt-40 bg-[var(--pearl-white)]/80 backdrop-blur-sm rounded-2xl p-8 shadow-lg border border-[var(--sea-glass)]/30 transition-all duration-500 ease-out hover:shadow-2xl hover:translate-y-[-4px]">
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Service Name -->
                    <div>
                        <label class="block text-sm font-medium text-[var(--deep-ocean)] mb-2">
                            Service Name
                        </label>
                        <Input
                            v-model="form.name"
                            type="text"
                            autofocus
                            required
                            name="name"
                            id="name"
                            placeholder="e.g., Coastal Massage Therapy"
                            class="w-full px-4 py-3 border border-[var(--sea-glass)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--sea-glass)]"
                            :class="{ 'border-red-500': form.errors.name }"
                        />
                        <p class="mt-1 text-xs text-red-500" v-if="form.errors.name">
                            {{ form.errors.name }}
                        </p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-[var(--deep-ocean)] mb-2">
                            Description
                        </label>
                        <textarea
                            v-model="form.description"
                            name="description"
                            type="text"
                            required
                            autofocus
                            id="description"
                            rows="3"
                            placeholder="Describe your service in detail..."
                            class="lg:h-15 focus:lg:h-30 bg-[var(--deep-ocean)] text-[var(--sea-glass)] text-lg  font-semi-bold transition-all duration-400 ease-in-out w-full px-6 py-3 border border-[var(--sea-glass)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--sea-glass)] resize-none"
                            :class="{ 'border-red-500': form.errors.description }"
                        ></textarea>
                        <p class="mt-1 text-xs text-red-500" v-if="form.errors.description">
                            {{ form.errors.description }}
                        </p>
                    </div>

                    <!-- Price and Duration -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-[var(--deep-ocean)] mb-2">
                                Price ($)
                            </label>
                            <Input
                                v-model="form.price"
                                type="number"
                                name="price"
                                required
                                autofocus
                                id="price"
                                placeholder="0.00"
                                step="0.01"
                                class="w-full px-4 py-3 border border-[var(--sea-glass)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--sea-glass)]"
                                :class="{ 'border-red-500': form.errors.price }"
                            />
                            <p class="mt-1 text-xs text-red-500" v-if="form.errors.price">
                                {{ form.errors.price }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[var(--deep-ocean)] mb-2">
                                Duration (minutes)
                            </label>
                            <Input
                                v-model="form.duration"
                                type="number"
                                required
                                autofocus
                                name="duration"
                                id="duration"
                                placeholder="e.g., 60"
                                class="w-full px-4 py-3 border border-[var(--sea-glass)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--sea-glass)]"
                                :class="{ 'border-red-500': form.errors.duration }"
                            />
                            <p class="mt-1 text-xs text-red-500" v-if="form.errors.duration">
                                {{ form.errors.duration }}
                            </p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-[var(--deep-ocean)] mb-2">
                            Status
                        </label>
                        <select
                            v-model="form.status"
                            name="status"
                            id="status"
                            required
                            autofocus
                            class="bg-[var(--deep-ocean)] text-[var(--sea-glass)]  text-lg font-semibold px-6 py-3 w-full  border-2 border-[var(--sea-glass)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--sea-glass)] transition-all duration-400 ease-in-out "
                            :class="{ 'border-red-500': form.errors.status }"
                        >
                            <option  value="active">Active</option>
                            <option class="px-9" value="inactive">Inactive</option>
                        </select>
                        <p class="mt-1 text-xs text-red-500" v-if="form.errors.status">
                            {{ form.errors.status }}
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <Button
                            :class="[
                                'w-full text-center bg-gradient-to-r from-[var(--vintage-gold)]/90 to-[var(--vintage-gold)]/70 text-[var(--pearl-white)] py-3 rounded-lg transition-all duration-500 ease-out hover:from-[var(--vintage-gold)] hover:to-[var(--deep-ocean)] hover:shadow-lg font-medium tracking-wide relative overflow-hidden group',
                                form.processing ? 'opacity-70' : 'opacity-100'
                            ]"
                            :disabled="form.processing"
                        >
                            <span class="relative z-10">
                                {{ form.processing ? 'Creating Service...' : 'Create Service' }}
                            </span>
                            <span class="absolute inset-0 bg-[var(--deep-ocean)] opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"></span>
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </guest>
</template>

<style scoped>
#wraper {
    z-index: -1;
}
</style>
