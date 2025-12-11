<!-- resources/js/Pages/Identitas/Edit.vue -->
<template>
    <AdminLayout>
        <div class="p-2">
            <PageTitle title="Struktur Organisasi"></PageTitle>

            <form @submit.prevent="submit">
                <div class="pt-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        File Dokumen *
                        <span class="text-xs text-gray-500 ml-2">( JPG, PNG; max 10MB)</span>
                    </label>
                    <input type="file" @input="form.struktur_organisasi = $event.target.files[0]"
                        @change="previewFile($event)"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        accept=".jpg,.jpeg,.png" />
                    <div v-if="form.errors.struktur_organisasi" class="text-red-500 text-sm mt-1">{{
                        form.errors.struktur_organisasi }}</div>
                </div>
                <div id="preview-container" class="w-full min-h-[60%]" style=" margin-top:10px;">
                    <img id="preview" class="h-full w-full" :src="`/storage/${identitas}`" alt="Preview" style="">
                </div>

                <div class="flex justify-end items-center gap-4 mt-10">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        :disabled="form.processing">
                        Simpan
                    </button>

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
import TinyMCEEditor from '../commponents/TinyMCEEditor.vue'

const route = window.route //
const props = defineProps({
    identitas: String,
    errors: Object,
})

const form = useForm({
    struktur_organisasi: null,
})

const submit = () => {
    form.post(route('identitas.organisasi'), {
        forceFormData: true, // 🔑 KUNCI UTAMA
        preserveScroll: true,
    })
}

const previewFile = (event) => {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
        preview.style.display = 'none';
    }
}
</script>
