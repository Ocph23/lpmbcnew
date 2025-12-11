<!-- resources/js/Pages/Auditis/Edit.vue -->
<template>
    <AdminLayout>
        <div class="p-2">
            <h1 class="text-2xl font-bold mb-6">Edit Auditi</h1>

            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Auditi</label>
                    <input v-model="form.name" type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
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
                        Perbarui
                    </button>
                    <Link :href="route('auditis.index')"
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
    auditi: Object,
    users: Array,
})

const form = useForm({
    name: props.auditi.name,
    head_id: props.auditi.head_id,
})

const submit = () => {
    form.put(route('auditis.update', props.auditi.id))
}
</script>
