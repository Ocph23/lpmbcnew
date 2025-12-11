<!-- resources/js/Pages/Periodes/Create.vue -->
<template>
    <AdminLayout>
        <div class="p-6 ">
            <h1 class="text-2xl font-bold mb-6">Tambah Periode</h1>

            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran/Periode</label>
                    <input v-model="form.year" type="number"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan tahun" />
                    <div v-if="form.errors.year" class="text-red-500 text-sm mt-1">{{ form.errors.year }}</div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama semester</label>
                    <select
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        v-model="form.semester">
                        <option>Pilih Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                    </select>
                    <div v-if="form.errors.year" class="text-red-500 text-sm mt-1">{{ form.errors.year }}</div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea v-model="form.description"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">

                    </textarea>

                    <div v-if="form.errors.year" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</div>
                </div>

                <div class="mb-6 ">
                    <div class="flex justify-start items-center gap-2">
                        <input v-model="form.is_active" type="checkbox"
                            class="p-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <label class="block text-sm font-medium text-gray-700">Status Aktif</label>
                    </div>
                    <div v-if="form.errors.year" class="text-red-500 text-sm mt-1">{{ form.errors.is_active }}</div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        Simpan
                    </button>
                    <Link :href="route('periodes.index')"
                        class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        Batal
                    </Link>
                </div>
            </form>
        </div>

    </AdminLayout>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue';
const route = window.route;
const props = defineProps({
    users: Array,
})

const form = useForm({
    year: '',
    semester: '',
    description: '',
    is_active: true
})



const submit = () => {
    form.post(route('periodes.store'))
}
</script>
