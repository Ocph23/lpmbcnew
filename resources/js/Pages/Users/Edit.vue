<!-- resources/js/Pages/Users/Create.vue -->
<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction } from '@ocph23/vtocph23'



const props = defineProps({
    roles: Array,
    user: Object,
})

const form = useForm({
    name: props.user.name || '',
    username: props.user.username || '',
    email: props.user.email || '',
    password: '',
    password_confirmation: '',
    role: '',
})



const route = window.route
const submit = () => {
    form.put(route('users.update', props.user.id), {
        preserveScroll: true,
    })
}
</script>

<template>
    <AdminLayout>
        <div class="p-6 max-w-2xl mx-auto">
            <div class="flex items-center mb-6">
                <h1 class="text-2xl font-bold ">Tambah Pengguna</h1>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input v-model="form.name" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan nama" />
                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                </div>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username *</label>
                    <input v-model="form.username" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: johndoe" />
                    <div v-if="form.errors.username" class="text-red-500 text-sm mt-1">{{ form.errors.username }}</div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input v-model="form.email" type="email"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="johndoe@example.com" />
                    <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select v-model="form.role"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option v-for="role in roles" :key="role.role_name" :value="role.role_name">
                            {{ role.role_name }}
                        </option>
                    </select>
                    <div v-if="form.errors.jenis_document" class="text-red-500 text-sm mt-1">{{
                        form.errors.jenis_document }}</div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                    <input v-model="form.password" type="password"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Minimal 8 karakter" />
                    <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password *</label>
                    <input v-model="form.password_confirmation" type="password"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    <div v-if="form.errors.password_confirmation" class="text-red-500 text-sm mt-1">{{
                        form.errors.password_confirmation }}</div>
                </div>

                <!-- Aksi -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        Simpan
                    </button>
                    <Link :href="route('users.index')"
                        class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        Batal
                    </Link>

                </div>
            </form>
        </div>
    </AdminLayout>
</template>
