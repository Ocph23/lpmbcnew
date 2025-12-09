<script setup lang="ts">
import { ref } from 'vue'
import AdminSidebar from './AdminSidebar.vue'
import { VTBusyProgressView, VTDialogView, VTToastView, VTCard } from '@ocph23/vtocph23'
import FlashMessage from '../FlashMessage.vue'

const showMenu = ref(true)
const menuClass = ref('md:ml-64')

const clickMenu = () => {
    if (showMenu.value) {
        menuClass.value = 'md:ml-0'
    } else {
        menuClass.value = 'md:ml-64'
    }
    showMenu.value = !showMenu.value
}
</script>

<template class="no-print">
    <VTBusyProgressView />
    <VTToastView />
    <VTDialogView />
    <FlashMessage />
    <MainHeader id="header" @on-click-menu="clickMenu"></MainHeader>
    <AdminSidebar v-if="showMenu" @on-click-menu="clickMenu"></AdminSidebar>
    <div :class="menuClass" class="min-h-screen p-4 bg-[#ffffff] shadow-md dark:bg-gray-600" id="xbody">
        <VTCard>
            <slot></slot>
        </VTCard>
    </div>
</template>
