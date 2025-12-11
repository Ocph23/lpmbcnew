<template>
    <div class="flex items-center gap-1">
        <div :class="color" class=" text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
            <span>{{ peringkat }}</span>
        </div>
    </div>
</template>

<script setup lang="ts">
import { VTIconEyeSlash, VTIconSupport } from '@ocph23/vtocph23';
import { computed } from 'vue';


const props = defineProps<{
    peringkat: String;
}>()


const color = computed(() => {
    switch (props.peringkat) {
        case 'Unggul':
            return 'bg-teal-400';
        case 'A':
            return 'bg-blue-300';
        case 'Baik Sekali':
            return 'bg-green-600';
        case 'Baik':
            return 'bg-yellow-300';
        case 'B':
            return 'bg-green-400';
        case 'C':
            return 'bg-yellow-400';
        case 'Terakreditasi Sementara':
            return 'bg-yellow-600';
        case 'Tidak Memenuhi Syarat':
            return 'bg-red-500';
        default:
            return 'bg-gray-500';
    }
});

</script>

<style scoped></style>
