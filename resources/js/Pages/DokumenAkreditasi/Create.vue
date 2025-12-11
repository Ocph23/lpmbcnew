<!-- resources/js/Pages/DokumenAkreditasi/Create.vue -->
<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction } from '@ocph23/vtocph23'

const props = defineProps({
    auditis: Array,
})
const route = window.route
const form = useForm({
    auditi_id: null,
    lembaga_akreditasi: 'BAN-PT',
    jenjang: 'S1',
    peringkat: 'Unggul',
    tanggal_sk: '',
    tanggal_mulai: '',
    tanggal_berakhir: '',
    link_sk: '',
    link_sertifikat: '',
})

const submit = () => {
    form.post(route('dokumen-akreditasi.store'), {
        preserveScroll: true,
    })
}

// Opsi dropdown
const lembagaOptions = ['BAN-PT', 'LAM-PTKes', 'LAMDIK', 'LAINNYA']
const jenjangOptions = ['Profesi', 'D3', 'D4', 'S1', 'S2', 'S3']
const peringkatOptions = ['Unggul', 'A', 'Baik Sekali', 'Baik', 'B', 'C', 'Terakreditasi Sementara', 'Tidak Memenuhi Syarat']
</script>

<template>
    <AdminLayout>
        <div class="p-6 max-w-3xl mx-auto">
            <div class="flex items-center mb-6">
                <h1 class="text-2xl font-bold ">Tambah Dokumen Akreditasi</h1>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Auditi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Auditi</label>
                    <select v-model="form.auditi_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option :value="null">– Pilih Auditi –</option>
                        <option v-for="a in auditis" :key="a.id" :value="a.id">
                            {{ a.name }}
                        </option>
                    </select>
                    <div v-if="form.errors.auditi_id" class="text-red-500 text-sm mt-1">{{ form.errors.auditi_id }}
                    </div>
                </div>

                <!-- Lembaga Akreditasi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lembaga Akreditasi *</label>
                    <select v-model="form.lembaga_akreditasi"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option v-for="opt in lembagaOptions" :key="opt" :value="opt">
                            {{ opt }}
                        </option>
                    </select>
                    <div v-if="form.errors.lembaga_akreditasi" class="text-red-500 text-sm mt-1">{{
                        form.errors.lembaga_akreditasi }}</div>
                </div>

                <!-- Jenjang -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenjang *</label>
                    <select v-model="form.jenjang"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option v-for="j in jenjangOptions" :key="j" :value="j">
                            {{ j }}
                        </option>
                    </select>
                    <div v-if="form.errors.jenjang" class="text-red-500 text-sm mt-1">{{ form.errors.jenjang }}</div>
                </div>

                <!-- Peringkat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Peringkat *</label>
                    <select v-model="form.peringkat"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option v-for="p in peringkatOptions" :key="p" :value="p">
                            {{ p }}
                        </option>
                    </select>
                    <div v-if="form.errors.peringkat" class="text-red-500 text-sm mt-1">{{ form.errors.peringkat }}
                    </div>
                </div>

                <!-- Tanggal SK -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal SK</label>
                    <input v-model="form.tanggal_sk" type="date"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    <div v-if="form.errors.tanggal_sk" class="text-red-500 text-sm mt-1">{{ form.errors.tanggal_sk }}
                    </div>
                </div>

                <!-- Tanggal Mulai & Berakhir -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input v-model="form.tanggal_mulai" type="date"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <div v-if="form.errors.tanggal_mulai" class="text-red-500 text-sm mt-1">{{
                            form.errors.tanggal_mulai }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berakhir</label>
                        <input v-model="form.tanggal_berakhir" type="date"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <div v-if="form.errors.tanggal_berakhir" class="text-red-500 text-sm mt-1">{{
                            form.errors.tanggal_berakhir }}</div>
                    </div>
                </div>

                <!-- Link SK -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Link SK (opsional)</label>
                    <input v-model="form.link_sk" type="url" placeholder="https://example.com/sk.pdf"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    <div v-if="form.errors.link_sk" class="text-red-500 text-sm mt-1">{{ form.errors.link_sk }}</div>
                </div>

                <!-- Link Sertifikat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Link Sertifikat (opsional)</label>
                    <input v-model="form.link_sertifikat" type="url" placeholder="https://example.com/sertifikat.pdf"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    <div v-if="form.errors.link_sertifikat" class="text-red-500 text-sm mt-1">{{
                        form.errors.link_sertifikat }}</div>
                </div>

                <!-- Aksi -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        Simpan
                    </button>

                    <Link :href="route('dokumen-akreditasi.index')"
                        class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        Batal
                    </Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
