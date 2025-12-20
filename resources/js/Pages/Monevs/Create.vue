<!-- resources/js/Pages/Monevs/Create.vue -->
<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
// ... komponen lain

const props = defineProps({ periodes: Array })
const form = useForm({
    kode_monev: '',
    nama_monev: '',
    periode_id: null,
    status: 'Akademik',
    document: null,
})
const route = window.route;
const submit = () => {
    form.post(route('monevs.store'), { forceFormData: true })
}
</script>

<template>
    <AdminLayout>
        <div class="p-6 max-w-2xl mx-auto">
            <div class="flex items-center mb-6">
                <h1 class="text-2xl font-bold ml-3">Tambah Monev</h1>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Code -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode</label>
                    <input v-model="form.kode_monev" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan Kode Monev" />
                    <div v-if="form.errors.kode_monev" class="text-red-500 text-sm mt-1">{{ form.errors.kode_monev }}
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Dokumen</label>
                    <input v-model="form.nama_monev" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan Nama Dokumen" />
                    <div v-if="form.errors.nama_monev" class="text-red-500 text-sm mt-1">{{ form.errors.nama_monev }}
                    </div>
                </div>

                <!-- Periode -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode *</label>
                    <select v-model="form.periode_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih Periode</option>
                        <option v-for="p in periodes" :key="p.id" :value="p.id">
                            {{ p.year }}/{{ p.year + 1 }} {{ p.semester == 1 ? 'Ganjil' : 'Genap' }}
                        </option>
                    </select>
                    <div v-if="form.errors.periode_id" class="text-red-500 text-sm mt-1">{{ form.errors.periode_id }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <div class="flex items-center space-x-4">
                        <label class="inline-flex items-center">
                            <input v-model="form.status" type="radio" value="Akademik"
                                class="text-blue-600 focus:ring-blue-500" />
                            <span class="ml-2">Akademik</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input v-model="form.status" type="radio" value="Non Akademik"
                                class="text-green-600 focus:ring-green-500" />
                            <span class="ml-2">Non Akademik</span>
                        </label>
                    </div>
                    <div v-if="form.errors.status" class="text-red-500 text-sm mt-1">{{ form.errors.status }}</div>
                </div>

                <div class="border-t pt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Dokumen Monev *
                        <span class="text-xs text-gray-500 ml-2">( max 10MB)</span>
                    </label>

                    <!-- Preview dokumen lama -->
                    <div v-if="form.document_url" class="mb-2">
                        <a :href="form.document_url" target="_blank" class="text-blue-600 hover:underline text-sm">
                            Lihat dokumen saat ini
                        </a>
                    </div>

                    <input type="file" @input="form.document = $event.target.files[0]"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <div v-if="form.errors.document" class="text-red-500 text-sm mt-1">{{ form.errors.document }}</div>
                    <p class="text-sm text-gray-500 mt-1">
                        Dokumen wajib diunggah ".
                    </p>
                </div>

                <!-- Aksi -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        Simpan
                    </button>
                    <VTButtonAction :url="route('monevs.akademik')" :style="'secondary'">
                        Batal
                    </VTButtonAction>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
