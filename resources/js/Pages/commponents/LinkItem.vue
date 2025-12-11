<template>
    <div @click="openMenu" :class="[
        'cursor-pointer flex justify-between items-center gap-2 mb-2 hover:bg-amber-500 rounded-md px-2 py-1',
        isActive ? 'bg-amber-400' : ''
    ]">
        <div class="flex items-center gap-2">
            <slot name="icon"></slot>
            <div class="cursor-pointer">{{ title }}</div>
        </div>
        <svg class="w-3 " fill="white" v-if="isParent" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
            <path
                d="M169.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 306.7 54.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
        </svg>
    </div>
    <div :id="id" class="hidden">
        <slot name="default"></slot>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps(['url', 'link', 'title', 'param', 'active', 'isParent', 'id', 'parent']);
const emit = defineEmits(['click']);


let xUrl = '';

if (props.url) {
    xUrl = route(props.url, props.param);;
}

if (props.link) {
    xUrl = props.link;
}



const isActive = computed(() => {
    try {
        const currentUrl = window.location.href;
        return currentUrl === xUrl;
    } catch (error) {
        return false;
    }
});



onMounted(() => {
    setTimeout(() => {
        if (isActive.value && !props.isParent) {
            emit('click', props.parent);
        }
    }, 2000);

});

const openMenu = () => {
    if (props.isParent) {
        emit('click', props.id);
    } else {
        window.location.href = xUrl;
    }
}

</script>

<style scoped></style>
