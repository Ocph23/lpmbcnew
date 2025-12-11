<!-- resources/js/Pages/Monevs/Index.vue -->
<script setup>
import { computed, ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction, VTIconPlus } from '@ocph23/vtocph23'
import FlashMessage from '../commponents/FlashMessage.vue'


const props = defineProps({
    monevs: Array,
    periodes: Array,
    auth: Object
})

const isAdmin = computed(() => {
    if (!props.auth || !props.auth.user) return false;
    return props.auth.user.roles.includes('admin');
});
const search = ref(usePage().props.filters?.search || '')
const periodeFilter = ref(usePage().props.filters?.periode_id || '')

// Watch search
let searchTimeout
watch(search, (newVal) => {
    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(() => {
        router.get(route('monevs.index'), {
            search: newVal || null,
            periode_id: periodeFilter.value || null
        }, {
            preserveState: true,
            replace: true,
        })
    }, 300)
})

// Watch periode filter
watch(periodeFilter, (newVal) => {
    router.get(route('monevs.index'), {
        search: search.value || null,
        periode_id: newVal || null
    }, {
        preserveState: true,
        replace: true,
    })
})
const route = window.route;

const destroy = (id) => {
    if (confirm('Yakin hapus data Monev ini?')) {
        router.delete(route('monevs.destroy', id))
    }
}
</script>

<template>

    <AdminLayout>
        <div class="p-2">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Data Monev</h1>
                <VTButtonAction v-if="isAdmin" :url="route('monevs.create')" :style="'success'">
                    <VTIconPlus />
                </VTButtonAction>
            </div>

            <!-- Pencarian & Filter -->
            <div class="flex justify-end gap-4 mb-6">
                <!-- Filter Periode -->
                <select v-model="periodeFilter"
                    class="w-64 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Periode</option>
                    <option v-for="p in periodes" :key="p.id" :value="p.id">
                        {{ p.year }}/{{ p.year + 1 }} {{ p.semester == 1 ? 'Ganjil' : 'Genap' }}
                    </option>
                </select>
                <!-- Pencarian -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input v-model="search" type="text" placeholder="Cari kode atau nama Monev..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                </div>


            </div>

            <!-- Tabel -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Periode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dokumen</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="monev in monevs" :key="monev.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ monev.kode_monev }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ monev.nama_monev }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ monev.periode ? `${monev.periode.year}/${monev.periode.year + 1} -
                                ${monev.periode.semester == 1 ? 'Ganjil' : 'Genap'}` : '–' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ monev.status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">

                                <a v-if="monev.document_path" :href="monev.document_path" target="_blank"
                                    class="text-blue-600 hover:underline">
                                    📄
                                </a>
                                <span v-else>–</span>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                <VTButtonAction :url="route('monevs.edit', monev.id)" type="edit" :style="'warning'" />
                                <VTButtonAction @click="destroy(monev.id)" type="delete" :style="'danger'" />
                            </td>
                        </tr>
                        <tr v-if="monevs.length === 0">
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
