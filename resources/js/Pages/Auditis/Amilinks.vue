<!-- resources/js/Pages/Identitas/Edit.vue -->
<template>
    <AdminLayout>
        <div class="p-2">
            <PageTitle title="Audit Document Link"></PageTitle>
            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Instrument AMI</label>
                    <VTInput v-model="form.instrumenami"></VTInput>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Unggah Dokument Hasil AMI</label>
                    <VTInput v-model="form.dokumenhasilami"></VTInput>
                </div>
                <!-- <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Instrument Ami</label>
                    <VTInput v-model="form.link1"></VTInput>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Instrument Ami</label>
                    <VTInput v-model="form.link2"></VTInput>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Instrument Ami</label>
                    <VTInput v-model="form.link3"></VTInput>
                </div> -->


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
import { VTInput } from '@ocph23/vtocph23'

const route = window.route //
const props = defineProps({
    amilink: Object,
    errors: Object,
    auth: Object,
})

const form = useForm({
    instrumenami: props.amilink?.instrumenami || '',
    dokumenhasilami: props.amilink?.dokumenhasilami || '',
    link1: props.amilink?.link1 || '',
    link2: props.amilink?.link2 || '',
    link3: props.amilink?.link3 || '',
})

const submit = () => {
    form.post(route('amilinks.update'), {
    })
}
</script>
