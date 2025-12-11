<template>
    <div class="flex items-center gap-1">
        <div v-if="isAuthenticated" class="flex">
            <slot></slot>
        </div>
        <div v-else class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
            <VTIconEyeSlash></VTIconEyeSlash>
            <button>Akses Tertutup</button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { VTIconEyeSlash, VTIconSupport } from '@ocph23/vtocph23';


const props = defineProps<{
    isAuthenticated: boolean;
}>()

</script>

<style scoped></style>
