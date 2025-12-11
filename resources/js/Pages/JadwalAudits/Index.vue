<!-- resources/js/Pages/JadwalAudits/Index.vue -->
<script setup>
import { computed, ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction, VTIconPlus } from '@ocph23/vtocph23'
import ActionComponent from '../commponents/ActionComponent.vue'

const props = defineProps({
    jadwalAudits: Array,
    periodes: Array,
    auth: Object
})


const isAdmin = computed(() => {
    if (!props.auth || !props.auth.user) return false;
    return props.auth.user.roles.includes('admin');
});

const periodeFilter = ref(usePage().props.filters?.periode_id || '')

watch(periodeFilter, (newVal) => {
    router.get(route('jadwal-audits.index'), { periode_id: newVal || null }, {
        preserveState: true,
        replace: true,
    })
})

const destroy = (id) => {
    if (confirm('Yakin ingin menghapus jadwal ini?')) {
        router.delete(route('jadwal-audits.destroy', id))
    }
}

const route = window.route

const formatStatus = (status) => {
    const map = {
        terjadwal: { text: 'Terjadwal', class: 'bg-yellow-100 text-yellow-800' },
        terlaksana: { text: 'Terlaksana', class: 'bg-green-100 text-green-800' },
    }
    return map[status] || { text: status, class: 'bg-gray-100 text-gray-800' }
}
</script>

<template>
    <AdminLayout>
        <div class="p-2">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Jadwal Audit</h1>
                <VTButtonAction v-if="isAdmin" :url="route('jadwal-audits.create')" :style="'success'">
                    <VTIconPlus />
                </VTButtonAction>
            </div>

            <!-- 🔍 Filter Periode -->
            <div class="mb-6 flex justify-end">
                <select v-model="periodeFilter"
                    class="block w-64 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Periode</option>
                    <option v-for="p in periodes" :key="p.id" :value="p.id">
                        {{ p.year }}/{{ p.year + 1 }} {{ p.semester == 1 ? 'Ganjil' : 'Genap' }}
                    </option>
                </select>
            </div>

            <!-- 📋 Tabel -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Auditi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Auditor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <!-- <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hasil Audit</th> -->
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        <tr v-for="jadwal in jadwalAudits" :key="jadwal.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ new
                                Date(jadwal.start_date).toLocaleDateString('id-ID') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ jadwal.auditi?.name || '–' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>1. {{ jadwal.auditor?.name || '–' }}</div>
                                <div>2. {{ jadwal.auditor2?.name || '–' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="[
                                    'px-2 inline-flex text-xs font-semibold rounded-full',
                                    formatStatus(jadwal.status).class
                                ]">
                                    {{ formatStatus(jadwal.status).text }}
                                </span>

                                <!-- Tampilkan ikon dokumen jika ada -->

                            </td>
                            <!-- <td class="text-center">
                                <a v-if="jadwal.document_path" :href="'/storage/' + jadwal.document_path"
                                    target="_blank" class="ml-2 text-blue-600 hover:text-blue-800"
                                    title="Lihat dokumen">
                                    📄
                                </a>

                                <div v-else>
                                    <span>-</span>
                                </div>
                            </td> -->
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                <ActionComponent :is-authenticated="isAdmin">
                                    <VTButtonAction :url="route('jadwal-audits.edit', jadwal.id)" type="edit"
                                        :style="'warning'" />
                                    <VTButtonAction @click="destroy(jadwal.id)" type="delete" :style="'danger'" />
                                </ActionComponent>
                            </td>
                        </tr>
                        <tr v-if="jadwalAudits.length === 0">
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada jadwal ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
