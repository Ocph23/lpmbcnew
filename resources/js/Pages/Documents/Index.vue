<!-- resources/js/Pages/documents/Index.vue -->
<script setup>
import { computed, ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction, VTIconEye, VTIconEyeSlash, VTIconPlus, VTStatus } from '@ocph23/vtocph23'
import ActionComponent from '../commponents/ActionComponent.vue'
import helper from '../../helper'

const props = defineProps({
    documents: Array,
    auth: Object,
    param: String
})

const isAdmin = computed(() => {
    if (!props.auth || !props.auth.user) return false;
    return props.auth.user.roles.includes('admin');
});
const search = ref(usePage().props.filters?.search || '')

let searchTimeout
watch(search, (newVal) => {
    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(() => {
        router.get(route('documents.index',), { search: newVal || null }, {
            preserveState: true,
            replace: true,
        })
    }, 300)
})

const route = window.route

const destroy = (id) => {
    if (confirm('Yakin hapus dokumen ini?')) {
        router.delete(route('documents.destroy', id))
    }
}
</script>

<template>
    <AdminLayout>
        <div class="p-2">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">{{helper.downloadOptions.find(x => x.kode == param).kategori}}</h1>
                <VTButtonAction v-if="isAdmin" :url="route('documents.create', param)" :style="'success'">
                    <VTIconPlus />
                </VTButtonAction>
            </div>
            <!-- Pencarian -->
            <div class="mb-6 flex justify-end">
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input v-model="search" type="text" placeholder="Cari "
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
                                Sasaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Akses</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="doc in documents" :key="doc.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ doc.kode }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ doc.nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <VTStatus :text="doc.sasaran"
                                    :type="doc.sasaran === 'Internal' ? 'warning' : 'success'" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a v-if="doc.sasaran != 'Internal' || auth.isAuthenticated" :href="doc.document_path"
                                    target="_blank" class="text-blue-600 hover:underline">
                                    <VTIconEye @click="route(doc.document_path)" :color="'success'" :size="'lg'" />
                                </a>
                                <VTIconEyeSlash class="text-gray-400" v-else :size="'lg'" />
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                <ActionComponent :is-authenticated="isAdmin">
                                    <VTButtonAction :url="route('documents.edit', doc.id)" :type="'edit'"
                                        :style="'warning'" />
                                    <VTButtonAction @click="destroy(doc.id)" type="delete" :style="'danger'" />
                                </ActionComponent>

                            </td>
                        </tr>
                        <tr v-if="documents?.length === 0">
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
