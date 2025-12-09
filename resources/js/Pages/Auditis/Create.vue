<!-- resources/js/Pages/Auditis/Create.vue -->
<template>
    <AdminLayout>
        <div class="p-6 ">
            <h1 class="text-2xl font-bold mb-6">Tambah Auditi</h1>

            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Auditi</label>
                    <input v-model="form.name" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan nama" />
                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kepala (Opsional)</label>
                    <select v-model="form.head_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option :value="null">– Pilih Kepala –</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        Simpan
                    </button>
                    <Link :href="route('auditis.index')" class="text-gray-600 hover:text-gray-800">
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
    name: '',
    head_id: null,
})

const submit = () => {
    form.post(route('auditis.store'))
}
</script>
