<!-- resources/js/Pages/Identitas/Edit.vue -->
<template>
    <AdminLayout>
        <div class="p-2">
            <fwb-breadcrumb solid>
                <fwb-breadcrumb-item home href="#">
                    Home
                </fwb-breadcrumb-item>
                <fwb-breadcrumb-item href="#">
                    Projects
                </fwb-breadcrumb-item>
                <fwb-breadcrumb-item>
                    Flowbite
                </fwb-breadcrumb-item>
            </fwb-breadcrumb>
            <PageTitle title="Identitas"></PageTitle>

            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Visi & Misi</label>
                    <textarea v-model="form.visimisi" rows="4"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    <div v-if="errors.visimisi" class="text-red-500 text-sm mt-1">{{ errors.visimisi }}</div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sejarah</label>
                    <textarea v-model="form.sejarah" rows="6"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    <div v-if="errors.sejarah" class="text-red-500 text-sm mt-1">{{ errors.sejarah }}</div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi LPMD</label>
                    <textarea v-model="form.deskripsilpm" rows="4"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    <div v-if="errors.deskripsilpm" class="text-red-500 text-sm mt-1">{{ errors.deskripsilpm }}</div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Struktur Organisasi (PDF/Gambar)</label>
                    <input type="file" @input="form.struktur_organisasi = $event.target.files[0]"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <div v-if="errors.struktur_organisasi" class="text-red-500 text-sm mt-1">{{
                        errors.struktur_organisasi
                        }}</div>

                    <!-- Preview if already uploaded -->
                    <div v-if="identitas?.struktur_organisasi_path" class="mt-2">
                        <p class="text-sm text-gray-600">File saat ini:</p>
                        <a :href="`/storage/${identitas.struktur_organisasi_path}`" target="_blank"
                            class="text-blue-600 hover:underline text-sm">
                            Lihat file
                        </a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        :disabled="form.processing">
                        Simpan
                    </button>

                    <Link :href="route('identitas.index')" class="text-gray-600 hover:text-gray-800">
                        Batal
                    </Link>
                </div>
            </form>
        </div>
    </AdminLayout>

</template>

<script setup>
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { FwbBreadcrumb, FwbBreadcrumbItem } from 'flowbite-vue'
import PageTitle from '../commponents/PageTitle.vue'

const route = window.route //
const props = defineProps({
    identitas: Object,
    errors: Object,
})

const form = useForm({
    visimisi: props.identitas?.visimisi || '',
    sejarah: props.identitas?.sejarah || '',
    deskripsilpm: props.identitas?.deskripsilpm || '',
    struktur_organisasi: null,
})

const submit = () => {
    form.post(route('identitas.update'), {
        forceFormData: true, // 🔑 KUNCI UTAMA
        preserveScroll: true,
    })
}
</script>
