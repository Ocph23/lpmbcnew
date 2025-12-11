<!-- resources/js/Pages/JadwalAudits/Create.vue -->
<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction, VTIconBack } from '@ocph23/vtocph23'
import { watch } from 'vue'

const route = window.route

const props = defineProps({
    auditis: Array,
    periodes: Array,
    auditors: Array,
})

const form = useForm({
    auditi_id: null,
    periode_id: null,
    auditor_id: null,
    auditor2_id: null,
    start_date: '',
    status: 'terjadwal',
})

const submit = () => {
    form.post(route('jadwal-audits.store'))
}

watch(
    () => props.auditis,
    (newAuditis) => {
        if (newAuditis.length > 0 && !form.auditi_id) {
            form.auditi_id = newAuditis[0].id
        }
    },
    { immediate: true }
)



</script>

<template>
    <AdminLayout>
        <div class="p-6 max-w-2xl mx-auto">
            <div class="flex items-center mb-6">
                <h1 class="text-2xl font-bold">Tambah Jadwal Audit</h1>
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
                            {{ p.year }}/{{ p.year + 1 }} {{ p.semester == 1 ? 'Ganjil' : 'Genap' }}
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

                <!-- Auditor 2 -->
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
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
                                class="text-blue-600 focus:ring-blue-500" />
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

                <!-- Aksi -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        Simpan
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
