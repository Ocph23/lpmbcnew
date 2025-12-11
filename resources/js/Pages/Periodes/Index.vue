<!-- resources/js/Pages/Periodes/Index.vue -->
<script setup>
import { ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { VTButtonAction, VTIconPlus } from '@ocph23/vtocph23'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import ActionComponent from '../commponents/ActionComponent.vue'

const props = defineProps({
    Periodes: Array,
    auth: Object,
})

const route = window.route
const search = ref(usePage().props.filters?.search || '')

let searchTimeout
watch(search, (newVal) => {
    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(() => {
        router.get(route('periodes.index'), { search: newVal || null }, {
            preserveState: true,
            replace: true,
        })
    }, 300)
})

const destroy = (id) => {
    if (confirm('Yakin ingin menghapus periode ini?')) {
        router.delete(route('periodes.destroy', id))
    }
}


</script>

<template>
    <AdminLayout>
        <div class="p-2">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Daftar Periode</h1>

                <VTButtonAction v-if="auth.isAuthenticated" :url="route('periodes.create')" :style="'success'">
                    <VTIconPlus />
                </VTButtonAction>
            </div>

            <!-- 🔍 Search Input -->
            <div class="flex justify-end mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input v-model="search" type="text" placeholder="Cari tahun atau semester..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                </div>
            </div>

            <!-- 📋 Tabel -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Periode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="periode in Periodes" :key="periode.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ periode.year }}/{{ periode.year + 1 }} {{
                                periode.semester == 1 ? 'Ganjil' : 'Genap' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap max-w-xs truncate">
                                {{ periode.description || '–' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="[
                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                    periode.is_active
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-gray-100 text-gray-800'
                                ]">
                                    {{ periode.is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                <ActionComponent :is-authenticated="auth.isAuthenticated">
                                    <VTButtonAction :url="route('periodes.edit', periode.id)" type="edit"
                                        :style="'warning'" />
                                    <VTButtonAction @click="destroy(periode.id)" type="delete" :style="'danger'" />
                                </ActionComponent>


                            </td>
                        </tr>
                        <tr v-if="periodes?.length === 0">
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
