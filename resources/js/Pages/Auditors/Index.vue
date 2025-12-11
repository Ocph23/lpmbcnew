<!-- resources/js/Pages/Auditors/Index.vue -->
<script setup>
import { computed, ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction, VTIconPlus } from '@ocph23/vtocph23'
import ActionComponent from '../commponents/ActionComponent.vue'

const props = defineProps({
    auditors: Array,
    auth: Object,
})

const route = window.route

const search = ref(usePage().props.filters?.search || '')

const isAdmin = computed(() => {
    if (!props.auth || !props.auth.user) return false;
    return props.auth.user.roles.includes('admin');
});

let searchTimeout
watch(search, (newVal) => {
    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(() => {
        router.get(route('auditors.index'), { search: newVal || null }, {
            preserveState: true,
            replace: true,
        })
    }, 300)
})

const destroy = (id) => {
    if (confirm('Yakin hapus auditor ini?')) {
        router.delete(route('auditors.destroy', id))
    }
}

const kategoriLabel = (kategori) => {
    const labels = { 1: 'Auditor 1', 2: 'Auditor 2' }
    return labels[kategori] || '–'
}
</script>

<template>
    <AdminLayout>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Daftar Auditor</h1>
                <VTButtonAction v-if="isAdmin" :url="route('auditors.create')" :style="'success'">
                    <VTIconPlus />
                </VTButtonAction>
            </div>

            <!-- Pencarian -->
            <div class="mb-6 max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input v-model="search" type="text" placeholder="Cari nama, email, atau telepon..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                </div>
            </div>

            <!-- Tabel -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="auditor in auditors" :key="auditor.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ auditor.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ auditor.email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <ActionComponent :is-authenticated="auth.isAuthenticated">
                                    {{ auditor.phone || '–' }}
                                </ActionComponent>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ kategoriLabel(auditor.kategori) }}
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                <ActionComponent :is-authenticated="isAdmin">
                                    <VTButtonAction :url="route('auditors.edit', auditor.id)" type="edit"
                                        :style="'warning'" />
                                    <VTButtonAction @click="destroy(auditor.id)" type="delete" :style="'danger'" />
                                </ActionComponent>

                            </td>
                        </tr>
                        <tr v-if="auditors.length === 0">
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
