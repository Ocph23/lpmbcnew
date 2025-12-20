<template>
    <aside class="sidebg p-4 absolute top-0 left-0 z-40 w-64 h-screen transition-transform overflow-auto">
        <a href="/">
            <fwb-sidebar-logo :name="isAdmin ? 'Admin' : isPimpinan ? 'Ketua' : 'Layanan LPM'"
                logo="/images/UMPPapua.png" tag="router-link" :link="'/'" />

        </a>

        <LinkItem :link="'/layananlpm'" title="Dashboard">
            <template #icon>
                <svg class="w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path
                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                    <path
                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                </svg>
            </template>
        </LinkItem>

        <LinkItem v-if="isAdmin" :url="'periodes.index'" title="Periode">
            <template #icon>
                <svg class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path
                        d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                </svg>
            </template>
        </LinkItem>
        <LinkItem :url="'calendars.index'" title="Kalender">
            <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                    class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    <path
                        d="M120 0c13.3 0 24 10.7 24 24l0 40 160 0 0-40c0-13.3 10.7-24 24-24s24 10.7 24 24l0 40 32 0c35.3 0 64 28.7 64 64l0 288c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 128C0 92.7 28.7 64 64 64l32 0 0-40c0-13.3 10.7-24 24-24zm0 112l-56 0c-8.8 0-16 7.2-16 16l0 48 352 0 0-48c0-8.8-7.2-16-16-16l-264 0zM48 224l0 192c0 8.8 7.2 16 16 16l320 0c8.8 0 16-7.2 16-16l0-192-352 0z" />
                </svg>
            </template>
        </LinkItem>
        <LinkItem v-if="isAdmin" :url="'news.index'" title="Berita">
            <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                    class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="currentColor">
                    <path
                        d="M0 416L0 120c0-13.3 10.7-24 24-24s24 10.7 24 24l0 288c0 13.3 10.7 24 24 24s24-10.7 24-24L96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64zM160 128l0 64c0 17.7 14.3 32 32 32l64 0c17.7 0 32-14.3 32-32l0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32zm24 240c-13.3 0-24 10.7-24 24s10.7 24 24 24l240 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-240 0zm-24-72c0 13.3 10.7 24 24 24l240 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-240 0c-13.3 0-24 10.7-24 24zM360 176c-13.3 0-24 10.7-24 24s10.7 24 24 24l64 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-64 0z" />
                </svg>
            </template>
        </LinkItem>


        <LinkItem v-if="isAdmin" title="Identias" is-parent="true" id="identitas" v-on:click-menu="onClickMenu">
            <template #icon>
                <svg class="flex-shrink-0 w-4 h-4  text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M271.9 20.2c-9.8-5.6-21.9-5.6-31.8 0l-224 128c-12.6 7.2-18.8 22-15.1 36S17.5 208 32 208l32 0 0 208 0 0-51.2 38.4C4.7 460.4 0 469.9 0 480 0 497.7 14.3 512 32 512l448 0c17.7 0 32-14.3 32-32 0-10.1-4.7-19.6-12.8-25.6l-51.2-38.4 0-208 32 0c14.5 0 27.2-9.8 30.9-23.8s-2.5-28.8-15.1-36l-224-128zM400 208l0 208-64 0 0-208 64 0zm-112 0l0 208-64 0 0-208 64 0zm-112 0l0 208-64 0 0-208 64 0zM256 96a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                </svg>
            </template>
            <template #default>
                <div class="ml-6">
                    <LinkItem :url="'identitas.visimisi'" title="Visi & Misi" parent="identitas">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                    <LinkItem :url="'identitas.sejarah'" title="Sejarah & Deskripsi LPM" parent="identitas">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                    <LinkItem :url="'identitas.organisasi'" title="Struktur Organisasi" parent="identitas">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                </div>
            </template>
        </LinkItem>
        <LinkItem id="akreditasi" title="Akreditasi" is-parent="true" v-on:click-menu="onClickMenu">
            <template #icon>
                <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>certificate-ssl</title>
                        <g id="Layer_2" data-name="Layer 2">
                            <g id="invisible_box" data-name="invisible box">
                                <rect width="48" height="48" fill="none"></rect>
                                <rect width="48" height="48" fill="none"></rect>
                            </g>
                            <g id="icons_Q2" data-name="icons Q2">
                                <g>
                                    <path
                                        d="M20,39H6V9H40a2,2,0,0,0,0-4H4A2,2,0,0,0,2,7V41a2,2,0,0,0,2,2H20a2,2,0,0,0,0-4Z">
                                    </path>
                                    <path
                                        d="M46,24A13,13,0,0,0,33,11a12.8,12.8,0,0,0-8.3,3H12a2,2,0,0,0,0,4h9.5a11.1,11.1,0,0,0-1.3,4H12a2,2,0,0,0,0,4h8.2a11.1,11.1,0,0,0,1.3,4H12a2,2,0,0,0,0,4H24.7l1.3.9v9.7A2.3,2.3,0,0,0,28,47a1.8,1.8,0,0,0,1.3-.6L33,43l3.7,3.4A1.8,1.8,0,0,0,38,47a2.3,2.3,0,0,0,2-2.4V35A13.2,13.2,0,0,0,46,24ZM36,32.5v7.8l-3-2.8-3,2.8V32.5A9.1,9.1,0,0,1,24,24a9,9,0,0,1,18,0A9.1,9.1,0,0,1,36,32.5Z">
                                    </path>
                                    <circle cx="33" cy="24" r="5"></circle>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>

            </template>
            <template #default>
                <div class="ml-6">
                    <LinkItem v-if="isAdmin" :url="'akreditasi.index'" title="Skor Akreditasi" parent="akreditasi">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                    <LinkItem :url="'dokumen-akreditasi.index'" title="Sertifikat  Akreditasi" parent="akreditasi">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                    <LinkItem :url="'instrumen-akreditasis.index'" title="Instrumen Akreditasi" parent="akreditasi">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                </div>
            </template>
        </LinkItem>

        <LinkItem v-if="auth.isAuthenticated" title="Pengelolaan Mutu" is-parent="true" id="pengelolaan-mutu"
            v-on:click-menu="onClickMenu">
            <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                    class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    <path
                        d="M133.8 36.3c10.9 7.6 13.5 22.6 5.9 33.4l-56 80c-4.1 5.8-10.5 9.5-17.6 10.1S52 158 47 153L7 113C-2.3 103.6-2.3 88.4 7 79S31.6 69.7 41 79l19.8 19.8 39.6-56.6c7.6-10.9 22.6-13.5 33.4-5.9zm0 160c10.9 7.6 13.5 22.6 5.9 33.4l-56 80c-4.1 5.8-10.5 9.5-17.6 10.1S52 318 47 313L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l19.8 19.8 39.6-56.6c7.6-10.9 22.6-13.5 33.4-5.9zM224 96c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32l288 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-288 0c-17.7 0-32-14.3-32-32zM64 376a40 40 0 1 1 0 80 40 40 0 1 1 0-80z" />
                </svg>

            </template>
            <template #default>
                <div class="ml-6">
                    <h6 class="ml-1!"> <strong>SPMI</strong> </h6>
                    <LinkItem v-for="value in helper.kategoriOptions.filter(x => x.kode == 'spmi')"
                        parent="pengelolaan-mutu" :url="'dokumen-mutus.filter'" :param="value.kategori"
                        :title="value.title">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>

                    <h6 class="ml-1! mt-5"> <strong>SPME</strong> </h6>
                    <LinkItem v-for="value in helper.kategoriOptions.filter(x => x.kode == 'spme')"
                        parent="pengelolaan-mutu" :url="'dokumen-mutus.filter'" :param="value.kategori"
                        :title="value.title">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                </div>
            </template>
        </LinkItem>

        <LinkItem title="Audit" is-parent="true" id="audit" v-on:click-menu="onClickMenu">
            <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor"
                    class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    <path
                        d="M249.9 66.8c10.4-14.3 7.2-34.3-7.1-44.7s-34.3-7.2-44.7 7.1l-106 145.7-37.5-37.5c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l64 64c6.6 6.6 15.8 10 25.1 9.3s17.9-5.5 23.4-13.1l128-176zm128 136c10.4-14.3 7.2-34.3-7.1-44.7s-34.3-7.2-44.7 7.1l-170 233.7-69.5-69.5c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l96 96c6.6 6.6 15.8 10 25.1 9.3s17.9-5.5 23.4-13.1l192-264z" />
                </svg>

            </template>
            <template #default>
                <div class="ml-6">
                    <LinkItem url="auditis.index" title="Daftar Auditi" parent="audit">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                    <LinkItem url="jadwal-audits.index" title="Jadwal Audit" parent="audit">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>

                    <LinkItem url="auditors.index" title="Daftar Auditor" parent="audit">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                    <LinkItem v-if="auth.isAuthenticated" url="jadwal-audits.hasil" title="Hasil Audit" parent="audit">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                </div>
            </template>
        </LinkItem>
        <LinkItem v-if="auth.isAuthenticated" title="Monev" is-parent="true" id="monev" v-on:click-menu="onClickMenu">
            <template #icon>
                <svg class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path
                        d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                </svg>

            </template>
            <template #default>
                <div class="ml-6">
                    <LinkItem url="monevs.akademik" title="Bidang Akademik" parent="audit">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>
                    <LinkItem url="monevs.nonakademik" title="Bidang Non Akademik" parent="audit">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>

                </div>
            </template>
        </LinkItem>

        <LinkItem v-if="isAdmin" url="users.index" title="Users">
            <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    viewBox="0 0 640 512">
                    <path
                        d="M320 16a104 104 0 1 1 0 208 104 104 0 1 1 0-208zM96 88a72 72 0 1 1 0 144 72 72 0 1 1 0-144zM0 416c0-70.7 57.3-128 128-128 12.8 0 25.2 1.9 36.9 5.4-32.9 36.8-52.9 85.4-52.9 138.6l0 16c0 11.4 2.4 22.2 6.7 32L32 480c-17.7 0-32-14.3-32-32l0-32zm521.3 64c4.3-9.8 6.7-20.6 6.7-32l0-16c0-53.2-20-101.8-52.9-138.6 11.7-3.5 24.1-5.4 36.9-5.4 70.7 0 128 57.3 128 128l0 32c0 17.7-14.3 32-32 32l-86.7 0zM472 160a72 72 0 1 1 144 0 72 72 0 1 1 -144 0zM160 432c0-88.4 71.6-160 160-160s160 71.6 160 160l0 16c0 17.7-14.3 32-32 32l-256 0c-17.7 0-32-14.3-32-32l0-16z" />
                </svg>
            </template>

        </LinkItem>
        <LinkItem title="Download" is-parent="true" id="download" v-on:click-menu="onClickMenu">
            <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                    class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    <path
                        d="M133.8 36.3c10.9 7.6 13.5 22.6 5.9 33.4l-56 80c-4.1 5.8-10.5 9.5-17.6 10.1S52 158 47 153L7 113C-2.3 103.6-2.3 88.4 7 79S31.6 69.7 41 79l19.8 19.8 39.6-56.6c7.6-10.9 22.6-13.5 33.4-5.9zm0 160c10.9 7.6 13.5 22.6 5.9 33.4l-56 80c-4.1 5.8-10.5 9.5-17.6 10.1S52 318 47 313L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l19.8 19.8 39.6-56.6c7.6-10.9 22.6-13.5 33.4-5.9zM224 96c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32l288 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-288 0c-17.7 0-32-14.3-32-32zM64 376a40 40 0 1 1 0 80 40 40 0 1 1 0-80z" />
                </svg>

            </template>
            <template #default>
                <div class="ml-6">
                    <LinkItem v-for="value in helper.downloadOptions" parent="download" :url="'documents.index'"
                        :param="value.kode" :title="value.kategori">
                        <template #icon>
                            <ItemIcon />
                        </template>
                    </LinkItem>


                </div>
            </template>
        </LinkItem>

        <div v-if="auth.isAuthenticated" :class="[
            'cursor-pointer flex justify-start items-center gap-2 mb-2 hover:bg-amber-500 rounded-md px-2 py-1'
        ]">
            <svg class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                <path
                    d="M160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0zM502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
            </svg>
            <button @click="logout" class="bg-teal-400">Logout</button>
        </div>


        <LinkItem v-else :link="'/login'" title="Login">
            <template #icon>
                <svg class="flex-shrink-0 w-4 h-4 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                    <path
                        d="M160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0zM502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
                </svg>
            </template>

        </LinkItem>




    </aside>
</template>
<script setup>

import { Link, router, usePage } from '@inertiajs/vue3';
import { VTSidebarItem } from '@ocph23/vtocph23'
import { FwbSidebar, FwbSidebarItem, FwbSidebarDropdownItem, FwbSidebarLogo } from 'flowbite-vue'
import LinkItem from '../LinkItem.vue';
import ItemIcon from '../ItemIcon.vue';
import helper from '../../../helper';
import { computed, onMounted, ref } from 'vue';
import LinkItemPost from '../LinkItemPost.vue';

const route = window.route;

const auth = usePage().props.auth;

const goto = (url) => {
    route(url);
}




const isPimpinan = computed(() => {
    if (!auth || !auth.user) return false;
    return auth.user.roles.includes('pimpinan');
});

const isAdmin = computed(() => {
    if (!auth || !auth.user) return false;
    return auth.user.roles.includes('admin');
});

onMounted(() => {
    const activeMenu = window.localStorage.getItem('activeMenu');
    tempMenu.value = activeMenu;
    if (activeMenu) {
        const element = document.getElementById(activeMenu);
        window.localStorage.setItem('activeMenu', activeMenu);
        if (element) {
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
            }
        }
    }
});


const tempMenu = ref('');

const onClickMenu = (id) => {
    const element = document.getElementById(id);
    window.localStorage.setItem('activeMenu', id);
    tempMenu.value = id;
    if (element.classList.contains('hidden')) {
        element.classList.remove('hidden');
    } else {
        element.classList.add('hidden');
    }
};

function logout() {
    router.post(route('logoutfromvue'))
}
</script>


<style scoped>
a {
    font-size: 10px !important;
}


.sidebg {
    /* background-image: linear-gradient(148.6deg, rgba(180, 214, 242, 1) 11.2%, rgba(72, 67, 221, 0.72) 100.2%) !important; */
    /* 1. Pengaturan Dimensi */
    width: 250px;
    height: 100vh;
    /* Mengisi tinggi layar penuh */
    position: fixed;
    /* Jika sidebar berada di sebelah kiri/kanan */
    z-index: 100;

    /* 2. Latar Belakang Gradien */
    background: linear-gradient(180deg,
            #1A2035 0%,
            /* Warna awal: Biru tua */
            #121524 100%
            /* Warna akhir: Ungu gelap kehitaman */
        );

    /* 3. Aksen Pemisah (Shadow/Border) */
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.4);
    /* Shadow samar di sisi kanan */

    /* 4. Warna Teks Default */
    color: #E0E0E0;
    /* Teks harus sangat terang */

    /* Font dan padding lainnya dapat ditambahkan di sini */
}
</style>
