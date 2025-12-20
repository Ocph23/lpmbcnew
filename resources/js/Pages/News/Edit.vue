<!-- resources/js/Pages/Admin/News/Create.vue -->
<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction } from '@ocph23/vtocph23'
import TinyMCEEditor from '../commponents/TinyMCEEditor.vue'


const props = defineProps({
    news: Object,
});


const route = window.route
const form = useForm({
    title: props.news.title || '',
    excerpt: props.news.excerpt || '',
    content: props.news.content || '<p>Mulai menulis berita...</p>',
    thumbnail: props.news.thumbnail || null,
    status: props.news.status || 'draft',
    category: props.news.category || 'umum',
})

const submit = () => {
    form.post(route('news.update', props.news.id), {
        forceFormData: true,
        preserveScroll: true,
    })
}

// Opsi kategori (sesuaikan dengan kebutuhan)
const categories = [
    { value: 'umum', label: 'Umum' },
    { value: 'kegiatan', label: 'Kegiatan' },
    { value: 'pengumuman', label: 'Pengumuman' },
    { value: 'artikel', label: 'Artikel' },
]

const statuses = [
    { value: 'draft', label: 'Draft' },
    { value: 'published', label: 'Terbitkan' },
]
</script>

<template>
    <AdminLayout>
        <div class="p-6 max-w-4xl mx-auto">
            <div class="flex items-center mb-6">
                <h1 class="text-2xl font-bold">Edit Berita</h1>
            </div>

            <form @submit.prevent="submit" class="space-y-8">
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul *</label>
                    <input v-model="form.title" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan judul berita" />
                    <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
                </div>

                <!-- Ringkasan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ringkasan (Opsional)</label>
                    <textarea v-model="form.excerpt" rows="2"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Deskripsi singkat untuk preview"></textarea>
                    <div v-if="form.errors.excerpt" class="text-red-500 text-sm mt-1">{{ form.errors.excerpt }}</div>
                </div>

                <!-- Konten Utama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konten Berita *</label>
                    <TinyMCEEditor v-model="form.content" class="mb-6" />
                    <div v-if="form.errors.content" class="text-red-500 text-sm mt-1">{{ form.errors.content }}</div>
                </div>

                <!-- Gambar Thumbnail -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail (Opsional)</label>
                    <div class="mt-1 flex items-center space-x-4">
                        <div v-if="form.thumbnail" class="w-32 h-32 rounded-md overflow-hidden border border-gray-300">
                            <img :src="URL.createObjectURL(form.thumbnail)" alt="Preview thumbnail"
                                class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <input type="file" @input="form.thumbnail = $event.target.files[0]" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF (max 2MB)</p>
                            <div v-if="form.errors.thumbnail" class="text-red-500 text-sm mt-1">{{ form.errors.thumbnail
                                }}</div>
                        </div>
                    </div>
                </div>

                <!-- Kategori & Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                        <select v-model="form.category"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option v-for="cat in categories" :key="cat.value" :value="cat.value">
                                {{ cat.label }}
                            </option>
                        </select>
                        <div v-if="form.errors.category" class="text-red-500 text-sm mt-1">{{ form.errors.category }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select v-model="form.status"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option v-for="stat in statuses" :key="stat.value" :value="stat.value">
                                {{ stat.label }}
                            </option>
                        </select>
                        <div v-if="form.errors.status" class="text-red-500 text-sm mt-1">{{ form.errors.status }}</div>
                    </div>
                </div>

                <!-- Aksi -->
                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        <span v-if="form.processing">Menyimpan...</span>
                        <span v-else>Simpan</span>
                    </button>
                    <Link :href="route('news.index')"
                        class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        Batal
                    </Link>

                </div>
            </form>
        </div>
    </AdminLayout>
</template>
