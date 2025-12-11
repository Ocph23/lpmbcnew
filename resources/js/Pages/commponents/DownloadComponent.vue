<template>
    <div class="flex items-center gap-1">
        <div v-if="isAuthenticated">
            <slot></slot>
        </div>
        <div v-else class="bg-teal-400 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
            <a :href="link" class="flex gap-1" target="_blank" rel="noopener noreferrer">
                <svg class="w-3" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 210.7-41.4-41.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l96 96c12.5 12.5 32.8 12.5 45.3 0l96-96c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 242.7 256 32zM64 320c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-46.9 0-56.6 56.6c-31.2 31.2-81.9 31.2-113.1 0L110.9 320 64 320zm304 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                </svg>
                <span class="text-white">{{ title }}</span>
            </a>
        </div>
    </div>
</template>

<script setup lang="ts">
import { VTIconEyeSlash, VTIconSupport } from '@ocph23/vtocph23';

const props = defineProps<{
    link: String,
    title: String
}>()

</script>

<style scoped></style>
