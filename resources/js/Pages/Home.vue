<template>

    <AdminLayout>
        <div class="p-2">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Home</h1>
            </div>

            <!-- 🔍 Search Input -->
            <div class="flex justify-end mb-6">

                <div>
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-fluid">
                            <div class="card mb-5">
                                <div class="card-body pt-0 pb-0">
                                    <div class="card-body p-3">
                                        <h3><b>Selamat Datang di Sistem Informasi Layanan BPM</b></h3>
                                        <br>
                                        <p>Melalui sistem ini, kami mencoba untuk memberikan pelayanan terbaik
                                            terkait
                                            dengan
                                            Penjaminan Mutu di Universitas Muhammadiyah Papua, khususnya dalam
                                            bidang:
                                            <br>a. Monev, Audit Mutu, dan Akreditasi Nasional
                                            <br>b. Akreditasi Internasional
                                            <br>c. Pengembangan Sistem Penjaminan Mutu
                                            <br>d. Administrasi &amp; Layanan
                                        </p>
                                        <p>Sistem ini masih terus dalam pengembangan, sampai dapat mengakomodir
                                            sebagian
                                            besar
                                            kebutuhan stakeholder kami. Untuk itu, kami membuka diri untuk menerima
                                            kritik &amp;
                                            saran dari Bapak/Ibu, yang dapat dikirimkan ke email <b></b>.
                                        </p>
                                        <p>Terimakasih :-)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Container-->
                    </div>
                </div>


            </div>
        </div>




    </AdminLayout>

</template>

<script setup>
import { FwbButtonGroup, FwbButton } from 'flowbite-vue'
import AdminLayout from './commponents/layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    // ... field lain
    searchQuery: '', // asumsikan ada kolom ini
})

</script>
