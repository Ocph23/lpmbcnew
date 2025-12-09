<template>


    <div class="mt-4 mb-6">
        <h1 class="text-3xl font-bold ">{{ title }}</h1>
    </div>
</template>

<script setup lang="ts">
defineProps<{ title: string }>()
</script>
