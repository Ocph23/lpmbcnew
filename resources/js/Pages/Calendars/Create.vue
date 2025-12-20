<!-- resources/js/Pages/calendars/Create.vue -->
<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction } from '@ocph23/vtocph23'

const route = window.route

const form = useForm({
    title: '',
    description: '',
    start_time: '',
    end_time: '',
    color: '#60A5FA',
})

const submit = () => {
    form.post(route('calendars.store'), {
        preserveScroll: true,
    })
}
</script>

<template>
    <AdminLayout>
        <div class="p-6 max-w-2xl mx-auto">
            <div class="flex items-center mb-6">
                <h1 class="text-2xl font-bold ">Tambah Acara</h1>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul *</label>
                    <input v-model="form.title" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Meeting Tim" />
                    <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea v-model="form.description" rows="3"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Detail acara..."></textarea>
                    <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai *</label>
                        <input v-model="form.start_time" type="datetime-local"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <div v-if="form.errors.start_time" class="text-red-500 text-sm mt-1">{{ form.errors.start_time
                            }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai *</label>
                        <input v-model="form.end_time" type="datetime-local"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <div v-if="form.errors.end_time" class="text-red-500 text-sm mt-1">{{ form.errors.end_time }}
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                    <input v-model="form.color" type="color"
                        class="w-10 h-10 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    <div v-if="form.errors.color" class="text-red-500 text-sm mt-1">{{ form.errors.color }}</div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        Simpan
                    </button>
                    <Link :href="route('calendars.index')"
                        class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        Batal
                    </Link>

                </div>
            </form>
        </div>
    </AdminLayout>
</template>
