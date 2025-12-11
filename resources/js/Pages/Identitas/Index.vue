<!-- resources/js/Pages/Identitas/Index.vue -->
<template>
    <AdminLayout>
        <FwbCard>
            <div class="p-2">
                <h1 class="text-2xl font-bold mb-6">Identitas LPMD</h1>
                {{ roles }}

                <div v-if="identitas" class="space-y-6">
                    <div>
                        <h2 class="text-lg font-semibold">Visi & Misi</h2>
                        <p class="mt-2 text-gray-700">{{ identitas.visimisi || 'Belum diisi' }}</p>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold">Sejarah</h2>
                        <p class="mt-2 text-gray-700">{{ identitas.sejarah || 'Belum diisi' }}</p>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold">Deskripsi LPMD</h2>
                        <p class="mt-2 text-gray-700">{{ identitas.deskripsilpm || 'Belum diisi' }}</p>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold">Struktur Organisasi</h2>
                        <div v-if="identitas.struktur_organisasi_path" class="mt-2">
                            <a :href="`/storage/${identitas.struktur_organisasi_path}`" target="_blank"
                                class="text-blue-600 hover:underline">
                                Lihat Dokumen/ Gambar
                            </a>
                        </div>
                        <p v-else class="mt-2 text-gray-500">Belum diunggah</p>
                    </div>

                    <div class="mt-6">
                        <Link :href="route('identitas.edit')"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Edit Identitas
                        </Link>
                    </div>
                </div>

                <div v-else class="text-center py-10">
                    <p class="text-gray-500">Belum ada data identitas.</p>

                </div>
            </div>
        </FwbCard>
    </AdminLayout>

</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AdminLayout from '../commponents/layouts/AdminLayout.vue';
import { FwbCard } from 'flowbite-vue';

const route = window.route // 👈 ambil dari global
const props = defineProps({
    identitas: Object,
})




if (!props.identitas)



</script>
