<template>
    <div :class="[
        'flex justify-start items-center gap-2 mb-2 hover:bg-amber-600/10 rounded-md px-2 py-1',
        isActive ? 'bg-amber-600/20' : ''
    ]">
        <slot name="icon"></slot>
        <Link :href="xUrl">{{ title }}</Link>
    </div>
    <slot name="default"></slot>


</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps(['url', 'link', 'title', 'param', 'active']);

let xUrl = '';

if (props.url) {
    xUrl = route(props.url);
}

if (props.link) {
    xUrl = props.link;
}

if (props.param) {
    const queryString = encodeURIComponent(JSON.stringify(props.param || {}));
    xUrl = `${xUrl}` + (props.param ? `?filter=${queryString}` : '');
}


const isActive = computed(() => {
    try {
        const currentUrl = window.location.href;
        return currentUrl === xUrl;
    } catch (error) {
        return false;
    }
});
</script>

<style scoped></style>
