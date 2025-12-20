<!-- resources/js/Pages/News/Index.vue -->
<script setup>
import { router, usePage } from '@inertiajs/vue3'

const props = defineProps({
    news: Object,
    categories: Array,
})

const route = window.route

const changeCategory = (category) => {
    router.get(route('berita.index'), { category })
}
</script>

<template>
    <div class="bg-gray-50 min-h-screen">
        <!-- Header -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Berita Terbaru</h1>
            </div>
        </div>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <!-- Filter Kategori -->
            <div class="mb-8 flex flex-wrap gap-2">
                <button @click="changeCategory('')" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm">
                    Semua
                </button>
                <button v-for="cat in categories" :key="cat" @click="changeCategory(cat)"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm hover:bg-gray-300">
                    {{ cat }}
                </button>
            </div>

            <!-- Daftar Berita -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="item in news.data" :key="item.id" class="bg-white rounded-lg shadow overflow-hidden">
                    <img :src="item.thumbnail_url" alt="Thumbnail" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full mb-2">
                            {{ item.category }}
                        </span>
                        <h2 class="text-xl font-bold text-gray-900 mb-2">
                            <a :href="route('news.show', item.slug)" class="hover:text-blue-600">
                                {{ item.title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 text-sm mb-3">
                            {{ item.excerpt || item.content.substring(0, 100) + '...' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="news.last_page > 1" class="mt-8 flex justify-center">
                <nav class="inline-flex space-x-1">
                    <button v-if="news.current_page > 1" @click="router.visit(news.prev_page_url)"
                        class="px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-100">
                        Sebelumnya
                    </button>
                    <span v-for="page in news.last_page" :key="page"
                        @click="router.visit(page < 1 ? news.path : `${news.path}?page=${page}`)" :class="[
                            'px-3 py-1 rounded-md text-sm',
                            news.current_page === page
                                ? 'bg-blue-600 text-white'
                                : 'bg-white text-gray-700 hover:bg-gray-100'
                        ]">
                        {{ page }}
                    </span>
                    <button v-if="news.current_page < news.last_page" @click="router.visit(news.next_page_url)"
                        class="px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-100">
                        Berikutnya
                    </button>
                </nav>
            </div>
        </div>
    </div>
</template>
