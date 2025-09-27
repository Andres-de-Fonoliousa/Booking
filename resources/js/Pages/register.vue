<script setup>
import {Head} from "@inertiajs/vue3";
import guest from "../Layouts/guest.vue";
import Input from "../Components/Input.vue";
import Button from "../Components/Button.vue";
import InputList from "../Components/InputList.vue";
import {useForm} from "@inertiajs/vue3";
import { route } from "ziggy-js";

const form = useForm({
username:'',
email:'',
password:'',
type:'',
});

const submit = () => {
    form.errors='',
    form.post(route('register'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
<template>
    <Head title="login"/>

    <guest >
        <div class="absolute z-10 grid grid-cols-1 gap-3 w-70 right-5 top-5">
        <div v-if="form.errors.email" class="transition-all duration-700 starting:opacity-0 starting:-translate-x-20  z-10 font-semibold text-center p-3 bg-[var(--driftwood)] rounded-xl border-2 border[var(--)] text-[var(--sunset-coral)] text-md w-full">{{ form.errors.email }}</div>
        <div v-if="form.errors.password" class="delay-200 z-10 font-semibold text-center p-3 bg-[var(--driftwood)] rounded-xl border-2 border[var(--)] text-[var(--sunset-coral)] text-md transition-all duration-700 starting:opacity-0 starting:-translate-x-20">{{ form.errors.password }}</div>
        </div>
        <div id="wall" class="py-5 grid-rows-8 relative grid w-9/12 px-40 grid-cols-1  place-self-center-safe bg-[var(--coastal-mist)] h-screen min-h-screen">

            <div id="logo" class="shadow-indigo-400  shadow-2xl row-span-2 col-span-1 rounded-3xl place-self-center-safe size-45 bg-cover bg-[url(C:\Users\LENOVO\Desktop\WebProjects\Booking\public\images\coastalLogo.jpeg)]"/>
            <form class="grid grid-cols-1 grid-rows-6 row-span-6" @submit.prevent="submit">
                <Input v-model="form.username" type="name" id="username" autocomplete="username" placeholder="username" label="Username" class="relative w-7/12 col-span-1 row-span-1 row-start-2 rounded-full place-self-center-safe"/>
            <InputList v-model="form.type"  id="type" placeholder="type" label="type" class="w-7/12 col-span-1 row-span-1 rounded-full place-self-center-safe"/>
            <div class="relative w-7/12 col-span-1 row-span-1 row-start-3 place-self-center-safe">
            <Input v-model="form.email" type="email" id="email" placeholder="Email" label="Email" class="w-full rounded-full"/>
            </div>
            <div class="relative w-7/12 col-span-1 row-span-1 row-start-4 place-self-center-safe">
            <Input v-model="form.password" type="password" id="password" placeholder="Password" label="Password" class="w-full rounded-full"/>
            </div>
            <Button :class="form.processing?'opacity-70':'opacity-100'" :disabled="form.processing" class="w-3/12 col-span-1 row-span-1 row-start-6 cursor-pointer place-self-center-safe">{{form.processing? 'sigining up':'sign up'}}</Button>
            </form>

        </div>
    </guest>
</template>
