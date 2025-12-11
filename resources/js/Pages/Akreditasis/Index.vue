<!-- resources/js/Pages/akreditasi/Index.vue -->
<template>

    <AdminLayout>
        <div class="p-6 ">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">SKOR AKREDITASI</h1>
            </div>
            <form @submit.prevent="submit">


                <div class="flex gap-2">
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Unggul</label>
                        <input type="number" v-model="form.unggul"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <div v-if="form.errors.unggul" class="text-red-500 text-sm mt-1">{{ form.errors.unggul }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Peringkat A</label>
                        <input type="number" v-model="form.peringkat_a"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <div v-if="form.errors.peringkat_a" class="text-red-500 text-sm mt-1">{{ form.errors.peringkat_a
                            }}
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Baik Sekali</label>
                        <input type="number" v-model="form.baik_sekali"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <div v-if="form.errors.baik_sekali" class="text-red-500 text-sm mt-1">{{ form.errors.baik_sekali
                            }}
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Peringkat B</label>
                        <input type="number" v-model="form.peringkat_baik"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <div v-if="form.errors.peringkat_baik" class="text-red-500 text-sm mt-1">{{
                            form.errors.peringkat_baik }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Auditi</label>
                        <input type="number" v-model="form.peringkat_b"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <div v-if="form.errors.peringkat_b" class="text-red-500 text-sm mt-1">{{ form.errors.peringkat_b
                            }}
                        </div>
                    </div>

                </div>
                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :disabled="form.processing">
                        Perbarui
                    </button>

                </div>
            </form>

        </div>

    </AdminLayout>

</template>

<script setup>
import { Link, router, useForm, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import AdminLayout from '../commponents/layouts/AdminLayout.vue'
import { VTButtonAction, VTIconAddUser, VTIconPlus, VTToastService } from '@ocph23/vtocph23'
// Ambil nilai search dari props (jika ada di URL)
const props = defineProps({
    data: Object,
})





const form = useForm({
    unggul: props.data.unggul,
    peringkat_a: props.data.peringkat_a,
    baik_sekali: props.data.baik_sekali,
    peringkat_baik: props.data.peringkat_baik,
    peringkat_b: props.data.peringkat_b,
})

const submit = () => {
    form.post(route('akreditasi.update'))
}

const route = window.route;

</script>
