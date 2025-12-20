<!-- resources/js/Pages/Admin/News/Index.vue -->
<script setup>
import { ref, watch } from 'vue'
import { router, usePage, Link } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction, VTIconEye, VTIconPlus } from '@ocph23/vtocph23'

const props = defineProps({
    news: Object, // { data: [...], meta: {...}, links: {...} }
})


const route = window.route

// Filter state
const search = ref(usePage().props.filters?.search || '')
const statusFilter = ref(usePage().props.filters?.status || '')
const categoryFilter = ref(usePage().props.filters?.category || '')

// Debounce search
let searchTimeout
const updateFilters = () => {
    router.get(route('news.index'), {
        search: search.value || null,
        status: statusFilter.value || null,
        category: categoryFilter.value || null,
        page: 1 // reset ke halaman 1 saat filter berubah
    }, {
        preserveState: true,
        replace: true,
    })
}

watch(search, (newVal) => {
    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(updateFilters, 300)
})

watch([statusFilter, categoryFilter], updateFilters)

// Hapus berita
const destroy = (id) => {
    if (confirm('Yakin ingin menghapus berita ini?')) {
        router.delete(route('news.destroy', id))
    }
}

// Format kategori
const formatCategory = (category) => {
    const map = {
        umum: 'Umum',
        kegiatan: 'Kegiatan',
        pengumuman: 'Pengumuman',
        artikel: 'Artikel'
    }
    return map[category] || category
}

// Status badge
const statusBadge = (status) => {
    const map = {
        draft: { text: 'Draft', class: 'bg-gray-100 text-gray-800' },
        published: { text: 'Terbit', class: 'bg-green-100 text-green-800' }
    }
    return map[status] || { text: status, class: 'bg-gray-100 text-gray-800' }
}

// Format tanggal
const formatDate = (isoString) => {
    if (!isoString) return '–'
    const date = new Date(isoString)
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    })
}
</script>

<template>
    <AdminLayout>
        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Manajemen Berita</h1>
                <VTButtonAction :url="route('news.create')" :style="'success'">
                    <VTIconPlus />
                </VTButtonAction>
            </div>

            <!-- Filter & Pencarian -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Pencarian -->
                <div class="md:col-span-2">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input v-model="search" type="text" placeholder="Cari judul atau isi..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <!-- Status -->
                <select v-model="statusFilter"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="draft">Draft</option>
                    <option value="published">Terbit</option>
                </select>

                <!-- Kategori -->
                <select v-model="categoryFilter"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Kategori</option>
                    <option value="umum">Umum</option>
                    <option value="kegiatan">Kegiatan</option>
                    <option value="pengumuman">Pengumuman</option>
                    <option value="artikel">Artikel</option>
                </select>
            </div>

            <!-- Tabel Berita -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Thumbnail</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Penulis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Terbit</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="item in news.data" :key="item.id">
                            <!-- Thumbnail -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-16 h-16 rounded overflow-hidden border">
                                    <img :src="'/storage/' + item.thumbnail_path" alt="Thumbnail"
                                        class="w-full h-full object-cover" />
                                </div>
                            </td>

                            <!-- Judul -->
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ item.title }}</div>
                                <div v-if="item.excerpt" class="text-sm text-gray-500 mt-1 line-clamp-2">
                                    {{ item.excerpt }}
                                </div>
                            </td>

                            <!-- Kategori -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ formatCategory(item.category) }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    :class="['px-2 inline-flex text-xs font-semibold rounded-full', statusBadge(item.status).class]">
                                    {{ statusBadge(item.status).text }}
                                </span>
                            </td>

                            <!-- Penulis -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ item.author.name }}
                            </td>

                            <!-- Tanggal Terbit -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ item.published_at ? formatDate(item.published_at) : '–' }}
                            </td>

                            <!-- Aksi -->
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center justify-end gap-1">
                                <!-- Lihat di Publik -->
                                <VTButtonAction :url="route('berita.show', item.slug)" type="edit" :style="'info'">
                                    <VTIconEye></VTIconEye>
                                </VTButtonAction>
                                <VTButtonAction :url="route('news.edit', item.id)" type="edit" :style="'warning'" />

                                <!-- Hapus -->
                                <VTButtonAction @click="destroy(item.id)" type="delete" :style="'danger'" />
                            </td>
                        </tr>

                        <tr v-if="news.data.length === 0">
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada berita ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div v-if="news.last_page > 1" class="mt-6 flex justify-center">
                <nav class="inline-flex space-x-1 rounded-md shadow-sm" aria-label="Pagination">
                    <!-- Previous -->
                    <Link v-if="news.prev_page_url" :href="news.prev_page_url" preserve-scroll
                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </Link>

                    <!-- Pages -->
                    <Link v-for="(link, key) in news.links" v-if="!link.url" :key="key"
                        :class="['relative inline-flex items-center px-4 py-2 border text-sm font-medium', link.active ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700']"
                        as="button" disabled v-html="link.label" />
                    <Link v-for="(link, key) in news.links" v-if="link.url" :key="key" :href="link.url" preserve-scroll
                        :class="['relative inline-flex items-center px-4 py-2 border text-sm font-medium hover:bg-gray-50', link.active ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700']"
                        v-html="link.label" />

                    <!-- Next -->
                    <Link v-if="news.next_page_url" :href="news.next_page_url" preserve-scroll
                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </Link>
                </nav>
            </div>
        </div>
    </AdminLayout>
</template>
