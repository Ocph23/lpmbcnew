<!-- resources/js/Pages/DokumenMutus/Create.vue -->
<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction } from '@ocph23/vtocph23'
import helper from '../../helper';

const props = defineProps({
    auditis: Array,
    kategori: String,
    hasauditi: Boolean,
})

const route = window.route

const form = useForm({
    kode: '',
    nama: '',
    sasaran: 'Internal',
    auditi_id: null,
    kategori: props.kategori,
    jenis_document: 'Upload',
    document_path: '',
    document: null,
})

const submit = () => {
    form.post(route('dokumen-mutus.store'), {
        forceFormData: true,
        preserveScroll: true,
    })
}



// Opsi dropdown
const sasaranOptions = ['Internal', 'Eksternal']
const jenisDocumentOptions = ['Upload', 'Link Eksternal']
</script>

<template>
    <AdminLayout>
        <div class="p-6 max-w-3xl mx-auto">
            <div class="flex items-center mb-6">
                <h1 class="text-2xl font-bold ">Tambah {{ kategori }}</h1>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Kode -->
                <!-- Kategori -->
                <!-- <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                    <select v-model="form.kategori"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option v-for="kat in helper.kategoriOptions" :key="kat" :value="kat.kategori">
                            {{ kat.kategori }}
                        </option>
                    </select>
                    <div v-if="form.errors.kategori" class="text-red-500 text-sm mt-1">{{ form.errors.kategori }}</div>
                </div> -->

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode *</label>
                    <input v-model="form.kode" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Kode-001" />
                    <div v-if="form.errors.kode" class="text-red-500 text-sm mt-1">{{ form.errors.kode }}</div>
                </div>

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Dokumen *</label>
                    <input v-model="form.nama" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan nama dokumen" />
                    <div v-if="form.errors.nama" class="text-red-500 text-sm mt-1">{{ form.errors.nama }}</div>
                </div>

                <!-- Sasaran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sasaran *</label>
                    <select v-model="form.sasaran"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option v-for="opt in sasaranOptions" :key="opt" :value="opt">
                            {{ opt }}
                        </option>
                    </select>
                    <div v-if="form.errors.sasaran" class="text-red-500 text-sm mt-1">{{ form.errors.sasaran }}</div>
                </div>

                <!-- auditi -->
                <div v-if="hasauditi">
                    <label class="block text-sm font-medium text-gray-700 mb-2">auditi</label>
                    <select v-model="form.auditi_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option :value="null">– Pilih auditi –</option>
                        <option v-for="auditi in auditis" :key="auditi.id" :value="auditi.id">
                            {{ auditi.name }}
                        </option>
                    </select>
                    <div v-if="form.errors.auditi_id" class="text-red-500 text-sm mt-1">{{ form.errors.auditi_id }}
                    </div>
                </div>


                <!-- Jenis Dokumen -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Dokumen *</label>
                    <select v-model="form.jenis_document"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option v-for="jenis in jenisDocumentOptions" :key="jenis" :value="jenis">
                            {{ jenis }}
                        </option>
                    </select>
                    <div v-if="form.errors.jenis_document" class="text-red-500 text-sm mt-1">{{
                        form.errors.jenis_document }}</div>
                </div>

                <!-- Upload Dokumen (hanya jika jenis = Upload) -->
                <div v-if="form.jenis_document === 'Upload'" class="pt-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        File Dokumen *
                        <span class="text-xs text-gray-500 ml-2">(PDF, DOC, JPG, PNG; max 10MB)</span>
                    </label>
                    <input type="file" @input="form.document = $event.target.files[0]"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" />
                    <div v-if="form.errors.document" class="text-red-500 text-sm mt-1">{{ form.errors.document }}</div>
                </div>

                <!-- Nama -->
                <div v-else>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Link Dokumen External *</label>
                    <input v-model="form.document_path" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan Link External" />
                    <div v-if="form.errors.document_path" class="text-red-500 text-sm mt-1">{{ form.errors.document_path
                        }}</div>
                </div>

                <!-- Aksi -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        Simpan
                    </button>

                    <!-- <Link :href="route('dokumen-mutus.filter', kategori)"
                        class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        Batal
                    </Link> -->

                </div>
            </form>
        </div>
    </AdminLayout>
</template>
