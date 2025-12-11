<!-- resources/js/Pages/Identitas/Edit.vue -->
<template>
    <AdminLayout>
        <div class="p-2">
            <PageTitle title="Visi & Misi"></PageTitle>
            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kontent</label>
                    <TinyMCEEditor v-model="form.visimisi" class="mb-6" />
                </div>


                <div class="flex items-center gap-4">
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
    identitas: Object,
    errors: Object,
    auth: Object,
})

const form = useForm({
    visimisi: props.identitas?.visimisi || '',
})

const submit = () => {
    form.post(route('identitas.updatevisimisi'), {
        forceFormData: true, // 🔑 KUNCI UTAMA
        preserveScroll: true,
    })
}
</script>
