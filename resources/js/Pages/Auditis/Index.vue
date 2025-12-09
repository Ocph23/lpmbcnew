<!-- resources/js/Pages/Auditis/Index.vue -->
<template>

    <AdminLayout>
        <div class="p-6 ">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Daftar Auditi</h1>

                <VTButtonAction :url="route('auditis.create')" :style="'success'">
                    <VTIconPlus></VTIconPlus>
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
                    <input v-model="search" type="text" placeholder="Cari nama auditi..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                </div>
            </div>

            <!-- 📋 Tabel -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kepala</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="auditi in auditis" :key="auditi.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ auditi.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ auditi.head?.name || '–' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ auditi.head?.email || '–' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end">
                                <VTButtonAction :url="route('auditis.edit', auditi.id)" :type="'edit'"
                                    :style="'warning'">
                                </VTButtonAction>
                                <VTButtonAction @click="destroy(auditi.id)" :type="'delete'" :style="'danger'">
                                </VTButtonAction>
                            </td>
                        </tr>
                        <tr v-if="auditis.length === 0">
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>

</template>

<script setup>
import { Link, router, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction, VTIconAddUser, VTIconPlus, VTToastService } from '@ocph23/vtocph23'
// Ambil nilai search dari props (jika ada di URL)
const props = defineProps({
    auditis: Array,
})

// Inisialisasi reactive search
const search = ref(usePage().props.filters?.search || '')

// Watch perubahan search → kirim ke backend (debounced)
let searchTimeout
watch(search, (newVal) => {
    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(() => {
        router.get(route('auditis.index'), { search: newVal || null }, {
            preserveState: true,
            replace: true,
        })
    }, 300) // debounce 300ms
})

const destroy = (id) => {

    VTToastService.info("test");
    if (confirm('Yakin ingin menghapus auditi ini?')) {
        router.delete(route('auditis.destroy', id))
    }
}


const route = window.route;

</script>
