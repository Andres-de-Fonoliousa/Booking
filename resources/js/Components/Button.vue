<template>
    <button
        :value="value"
        :class="{
            'bg-[var(--sunset-coral)] text-[var(--driftwood)] border-[var(--driftwood)] rounded-xl': danger,
            'bg-[var(--deep-ocean)] text-[var(--sea-glass)] border-[var(--sea-glass)] rounded-xl': success,
            'bg-gradient-to-br from-[var(--deep-ocean)]/70 via-[var(--sea-glass)]/50 to-[var(--coastal-mist)]/50 text-[var(--deep-ocean)] border-[var(--deep-ocean)]': !danger && !success
        }"
        class="px-3 py-2 text-xl font-semibold transition-all duration-300 ease-in-out border-2 shadow-lg active:scale-90 hover:brightness-95 hover:scale-95 will-change-auto rounded-3xl"
    >
        <slot />
    </button>
</template>

<script setup>
defineProps({
    danger: Boolean,
    success: Boolean,
    value: String
});
</script>
