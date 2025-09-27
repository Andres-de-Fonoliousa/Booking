<script setup>
import {Head} from "@inertiajs/vue3";
import guest from "../Layouts/guest.vue";
import Input from "../Components/Input.vue";
import Button from "../Components/Button.vue";
import {useForm} from "@inertiajs/vue3";
import { errorMessages } from "vue/compiler-sfc";

const form = useForm({
email:'',
password:'',
});

const submit = () => {
    form.errors='',
    form.post(route('login'),{
        onFinish: () => form.reset('password'),
    });
};
</script>
<template>
    <Head title="login"/>
    <guest>
        <div class="absolute z-10 grid grid-cols-1 gap-3 w-70 right-5 top-5">
        <div v-if="form.errors.email" class="transition-all duration-700 starting:opacity-0 starting:-translate-x-20  z-10 font-semibold text-center p-3 bg-[var(--driftwood)] rounded-xl border-2 border[var(--)] text-[var(--sunset-coral)] text-md w-full">{{ form.errors.email }}</div>
        <div v-if="form.errors.password" class="delay-200 z-10 font-semibold text-center p-3 bg-[var(--driftwood)] rounded-xl border-2 border[var(--)] text-[var(--sunset-coral)] text-md transition-all duration-700 starting:opacity-0 starting:-translate-x-20">{{ form.errors.password }}</div>
        </div>
        <div id="wall" class="grid-rows-20 relative grid w-9/12 px-40 grid-cols-1  place-self-center-safe bg-[var(--coastal-mist)] h-screen min-h-screen">
            <div id="logo" class="shadow-indigo-400 shadow-2xl row-span-9 col-span-1 rounded-3xl place-self-center-safe size-45 bg-cover bg-[url(C:\Users\LENOVO\Desktop\WebProjects\Booking\public\images\coastalLogo.jpeg)]"/>
            <form class="grid row-span-11 grid-rows-11" @submit.prevent="submit">
                <Input v-model="form.email" type="email" autofocus name="email" id="email"  placeholder="Email" label="Email" class="w-7/12 col-span-1 row-span-2 row-start-1 rounded-full place-self-center-safe"/>
                <Input v-model="form.password" type="password" name="password" id="password"  placeholder="Password" label="Password" class="w-7/12 col-span-1 row-span-2 row-start-4 rounded-full place-self-center-safe"/>
             <Button :class="form.processing?'opacity-70':'opacity-100'" :disabled="form.processing" class="w-3/12 col-span-1 row-span-2 row-start-7 place-self-center-safe">{{form.processing?'logging in':'login'}}</Button>
            </form>
        </div>
    </guest>
</template>
