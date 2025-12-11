<!-- resources/js/Pages/DokumenAkreditasi/Index.vue -->
<script setup>
import { computed, ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction, VTIconPlus, VTStatus } from '@ocph23/vtocph23'
import ActionComponent from '../commponents/ActionComponent.vue'
import helper from '../../helper'
import PeringkatStatusComponent from '../commponents/PeringkatStatusComponent.vue'
import DownloadComponent from '../commponents/DownloadComponent.vue'

const props = defineProps({
    dokumenAkreditasis: Array,
    auditis: Array,
    auth: Object,
})


const route = window.route

const search = ref(usePage().props.filters?.search || '')
const auditiFilter = ref(usePage().props.filters?.auditi_id || '')

const isAdmin = computed(() => {
    if (!props.auth || !props.auth.user) return false;
    return props.auth.user.roles.includes('admin');
});

let searchTimeout
watch(search, (newVal) => {
    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(() => {
        router.get(route('dokumen-akreditasi.index'), {
            search: newVal || null,
            auditi_id: auditiFilter.value || null
        }, {
            preserveState: true,
            replace: true,
        })
    }, 300)
})

watch(auditiFilter, (newVal) => {
    router.get(route('dokumen-akreditasi.index'), {
        search: search.value || null,
        auditi_id: newVal || null
    }, {
        preserveState: true,
        replace: true,
    })
})

const destroy = (id) => {
    if (confirm('Yakin hapus data akreditasi ini?')) {
        router.delete(route('dokumen-akreditasi.destroy', id))
    }
}
</script>

<template>
    <AdminLayout>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Sertifikat</h1>
                <VTButtonAction v-if="isAdmin" :url="route('dokumen-akreditasi.create')" :style="'success'">
                    <VTIconPlus />
                </VTButtonAction>
            </div>

            <!-- Pencarian & Filter -->
            <div class="flex gap-4 mb-6">
                <!-- Pencarian -->
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input v-model="search" type="text" placeholder="Cari lembaga, jenjang, atau peringkat..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Filter Auditi -->
                <select v-model="auditiFilter"
                    class="w-64 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Prodi/Institusi</option>
                    <option v-for="a in auditis" :key="a.id" :value="a.id">
                        {{ a.name }}
                    </option>
                </select>
            </div>

            <!-- Tabel -->
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Prodi/Institusi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Lembaga Akreditasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenjang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Peringkat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal SK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Berlaku</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dokumen</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 ">
                        <tr v-for="(doc, index) in dokumenAkreditasis" :key="doc.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ index + 1 }}.</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ doc.auditi?.name || '–' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ doc.lembaga_akreditasi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ doc.jenjang }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <PeringkatStatusComponent :peringkat="doc.peringkat" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ helper.formatDate(doc.tanggal_sk) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ helper.formatDate(doc.tanggal_mulai) }} – {{ helper.formatDate(doc.tanggal_berakhir)
                                }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex  gap-1">
                                    <DownloadComponent v-if="doc.link_sk" :link="doc.link_sk" :title="'SK'" />
                                    <DownloadComponent v-if="doc.link_sertifikat" :link="doc.link_sertifikat"
                                        :title="'Sertifikat'" />

                                </div>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                <ActionComponent :is-authenticated="isAdmin">
                                    <VTButtonAction :url="route('dokumen-akreditasi.edit', doc.id)" type="edit"
                                        :style="'warning'" />
                                    <VTButtonAction @click="destroy(doc.id)" type="delete" :style="'danger'" />

                                </ActionComponent>

                            </td>
                        </tr>
                        <tr v-if="dokumenAkreditasis.length === 0">
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
