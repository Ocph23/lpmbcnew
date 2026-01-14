<!-- resources/js/Pages/JadwalAudits/Edit.vue -->
<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'

const route = window.route
const props = defineProps({
    jadwalAudit: Object,
    auditis: Array,
    periodes: Array,
    auditors: Array,
})

const form = useForm({
    id: props.jadwalAudit.id,
    auditi_id: props.jadwalAudit.auditi_id,
    periode_id: props.jadwalAudit.periode_id,
    auditor_id: props.jadwalAudit.auditor_id,
    auditor2_id: props.jadwalAudit.auditor2_id,
    start_date: props.jadwalAudit.start_date,
    status: props.jadwalAudit.status,
    document: null
})

const submit = () => {
    if (form.status === 'terlaksana' && !form.document && !hasExistingDocument) {
        alert('Dokumen wajib diunggah untuk status "Terlaksana"')
        return
    }

    const formData = {
        auditi_id: form.auditi_id,
        periode_id: form.periode_id,
        auditor_id: form.auditor_id,
        auditor2_id: form.auditor2_id,
        start_date: form.start_date,
        status: form.status,
        document: form.document
    }

    form.post(route('jadwal-audits.update', form.data), {
        forceFormData: true, // 🔑 KUNCI UTAMA
        preserveScroll: true,
    })
}

const hasExistingDocument = props.jadwalAudit.document_path
</script>

<template>
    <AdminLayout>
        <div class="p-6 ">
            <div class="flex items-center mb-6">
                <h1 class="text-2xl font-bold ml-3">Edit Jadwal Audit</h1>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Auditi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Auditi *</label>
                    <select v-model="form.auditi_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih Auditi</option>
                        <option v-for="a in auditis" :key="a.id" :value="a.id">
                            {{ a.name }}
                        </option>
                    </select>
                    <div v-if="form.errors.auditi_id" class="text-red-500 text-sm mt-1">{{ form.errors.auditi_id }}
                    </div>
                </div>

                <!-- Periode -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode *</label>
                    <select v-model="form.periode_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih Periode</option>
                        <option v-for="p in periodes" :key="p.id" :value="p.id">
                            {{ p.year }} - Semester {{ p.semester }}
                        </option>
                    </select>
                    <div v-if="form.errors.periode_id" class="text-red-500 text-sm mt-1">{{ form.errors.periode_id }}
                    </div>
                </div>

                <!-- Auditor -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Auditor 1</label>
                    <select v-model="form.auditor_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option :value="null">– Tidak ada –</option>
                        <option v-for="u in auditors.filter(x => x.kategori == 1)" :key="u.id" :value="u.id">
                            {{ u.name }}
                        </option>
                    </select>
                    <div v-if="form.errors.auditor_id" class="text-red-500 text-sm mt-1">{{ form.errors.auditor_id }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Auditor 2</label>
                    <select v-model="form.auditor2_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option :value="null">– Tidak ada –</option>
                        <option v-for="u in auditors.filter(x => x.kategori == 2)" :key="u.id" :value="u.id">
                            {{ u.name }}
                        </option>
                    </select>
                    <div v-if="form.errors.auditor2_id" class="text-red-500 text-sm mt-1">{{ form.errors.auditor2_id }}
                    </div>
                </div>



                <!-- Tanggal Mulai -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal *</label>
                    <input v-model="form.start_date" type="date"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    <div v-if="form.errors.start_date" class="text-red-500 text-sm mt-1">{{ form.errors.start_date }}
                    </div>
                </div>

                <!-- Status -->


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <div class="flex items-center space-x-4">
                        <label class="inline-flex items-center">
                            <input v-model="form.status" type="radio" value="terjadwal"
                                class="text-blue-600 focus:ring-blue-500" @change="form.document = null" />
                            <span class="ml-2">Terjadwal</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input v-model="form.status" type="radio" value="terlaksana"
                                class="text-green-600 focus:ring-green-500" />
                            <span class="ml-2">Terlaksana</span>
                        </label>
                    </div>
                    <div v-if="form.errors.status" class="text-red-500 text-sm mt-1">{{ form.errors.status }}</div>
                </div>
                <div v-if="form.status === 'terlaksana'" class="border-t pt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Dokumen Audit *
                        <span class="text-xs text-gray-500 ml-2">( max 10MB)</span>
                    </label>

                    <!-- Preview dokumen lama -->
                    <div v-if="hasExistingDocument" class="mb-2">
                        <a :href="jadwalAudit.document_url" target="_blank"
                            class="text-blue-600 hover:underline text-sm">
                            Lihat dokumen saat ini
                        </a>
                    </div>

                    <input type="file" @input="form.document = $event.target.files[0]"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <div v-if="form.errors.document" class="text-red-500 text-sm mt-1">{{ form.errors.document }}</div>
                    <p v-else-if="!hasExistingDocument && form.status === 'terlaksana'"
                        class="text-sm text-gray-500 mt-1">
                        Dokumen wajib diunggah saat status "Terlaksana".
                    </p>
                </div>

                <!-- Aksi -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        Perbarui
                    </button>
                    <Link :href="route('jadwal-audits.index')"
                        class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        Batal
                    </Link>
                </div>
            </form>


        </div>
    </AdminLayout>
</template>
