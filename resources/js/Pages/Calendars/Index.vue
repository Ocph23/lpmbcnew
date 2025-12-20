<!-- resources/js/Pages/calendars/Index.vue -->
<script setup>
import { computed, ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction, VTIconDelete, VTIconPlus } from '@ocph23/vtocph23'

const props = defineProps({
    calendars: Array,
    calendarDays: Array,
    weeks: Array,
    currentMonth: String,
    month: Number,
    year: Number,
    auth: Object,
})


const isAdmin = computed(() => {
    if (!props.auth || !props.auth.user) return false;
    return props.auth.user.roles.includes('admin');
});

const route = window.route

const search = ref(usePage().props.filters?.search || '')
const selectedView = ref('month') // 'day', 'week', 'month'

let searchTimeout
watch(search, (newVal) => {
    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(() => {
        router.get(route('calendars.index'), {
            search: newVal || null,
            month: props.month,
            year: props.year,
        }, {
            preserveState: true,
            replace: true,
        })
    }, 300)
})

const changeMonth = (direction) => {
    let newMonth = Number(props.month) + Number(direction)
    let newYear = props.year
    if (newMonth > 12) {
        newMonth = 1
        newYear++
    } else if (newMonth < 1) {
        newMonth = 12
        newYear--
    }
    router.get(route('calendars.index'), {
        search: search.value || null,
        month: newMonth,
        year: newYear,
    }, {
        preserveState: true,
        replace: true,
    })
}

const formatDate = (isoString) => {
    if (!isoString) return '–'
    const date = new Date(isoString)
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    })
}

const formatTime = (isoString) => {
    if (!isoString) return '–'
    const date = new Date(isoString)
    return date.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit'
    })
}


const destroy = (event) => {
    if (confirm('Yakin hapus data Acara/Kegiatan ini?')) {
        router.delete(route('calendars.destroy', event.id))
    }
}
</script>

<template>
    <AdminLayout>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Kalender</h1>

            </div>

            <!-- Header Kalender -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center space-x-4">
                    <button @click="changeMonth(-1)" class="p-2 text-gray-600 hover:text-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <h2 class="text-xl font-semibold">{{ currentMonth }}</h2>
                    <button @click="changeMonth(1)" class="p-2 text-gray-600 hover:text-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- View Toggle -->
                <div class="flex rounded-md shadow-sm">
                    <VTButtonAction v-if="isAdmin" :url="route('calendars.create')" :style="'success'">
                        <VTIconPlus />
                    </VTButtonAction>
                </div>
            </div>

            <!-- Pencarian -->
            <div class="mb-6 max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-calendars-none">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input v-model="search" type="text" placeholder="Cari judul atau deskripsi..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                </div>
            </div>

            <!-- Layout Dua Kolom -->
            <div class="grid grid-cols-1 lg:grid-cols-3! gap-2">
                <!-- Daftar Acara -->
                <div class="lg:col-span-1 bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-medium mb-4">Daftar Acara/Kegiatan</h3>
                    <div class="space-y-4">
                        <div v-for="event in calendars" :key="event.id"
                            class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 "
                            @click="$router.push(route('calendars.edit', event.id))">
                            <div class="flex  justify-between">
                                <div class="flex items-start">
                                    <div class="w-3 h-3 rounded-full mt-1" :style="{ backgroundColor: event.color }">
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm text-gray-500">
                                            ({{ formatDate(event.start_time) }} - {{ formatTime(event.start_time) }}) -
                                            ({{ formatDate(event.end_time) }} {{ formatTime(event.end_time) }})
                                        </div>
                                        <h4 class="font-medium">{{ event.title }}</h4>
                                        <p v-if="event.description" class="text-sm text-gray-600 mt-1 truncate">
                                            {{ event.description }}
                                        </p>
                                    </div>

                                </div>
                                <VTIconDelete @click="destroy(event)" class="cursor-pointer fill-red-800">
                                </VTIconDelete>
                            </div>
                        </div>
                        <div v-if="calendars.length === 0" class="text-center text-gray-500 py-4">
                            Tidak ada acara ditemukan.
                        </div>
                    </div>
                </div>

                <!-- Kalender Bulanan -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sun</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mon</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tue</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Wed</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Thu</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fri</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sat</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="(week, weekIndex) in weeks" :key="weekIndex">
                                    <td v-for="day in week" :key="day.day" :class="[
                                        'px-4 py-3 text-center text-sm',
                                        !day.isCurrentMonth ? 'text-gray-400 bg-gray-50' : '',
                                        day.calendars.length > 0 ? 'bg-blue-50' : ''
                                    ]">
                                        <div class="relative">
                                            <span :class="day.isCurrentMonth ? 'font-medium' : 'text-gray-400'">
                                                {{ day.day }}
                                            </span>
                                            <div class="mt-1 space-y-1">
                                                <div v-for="event in day.calendars.slice(0, 2)" :key="event.id" :class="[
                                                    'text-xs px-2 py-1 rounded text-white truncate',
                                                    `bg-${event.color.substring(1)}`
                                                ]" :style="{ backgroundColor: event.color }">
                                                    {{ event.title }}

                                                </div>
                                                <div v-if="day.calendars.length > 2" class="text-xs text-gray-500">
                                                    +{{ day.calendars.length - 2 }} lainnya
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
