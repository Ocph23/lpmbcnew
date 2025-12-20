<!-- resources/js/Pages/News/Show.vue -->
<template>
    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Gambar Utama -->
            <img :src="news.thumbnail_url" :alt="news.title" class="w-full h-64 object-cover rounded-lg mb-6" />

            <!-- Detail Berita -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <h1 class="text-3xl font-bold text-gray-900">{{ news.title }}</h1>
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                        {{ news.category }}
                    </span>
                </div>

                <div class="text-gray-500 text-sm mb-6">
                    Oleh {{ news.author.name }} • {{ new Date(news.published_at).toLocaleDateString('id-ID') }}
                </div>

                <div v-html="news.content" class="prose prose-lg max-w-none"></div>
            </div>

            <!-- Berita Terkait -->
            <div v-if="relatedNews.length" class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Berita Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div v-for="item in relatedNews" :key="item.id" class="bg-white rounded-lg shadow overflow-hidden">
                        <img :src="item.thumbnail_url" alt="Thumbnail" class="w-full h-32 object-cover" />
                        <div class="p-3">
                            <h3 class="font-bold text-gray-900 text-sm">
                                <a :href="route('news.show', item.slug)" class="hover:text-blue-600">
                                    {{ item.title }}
                                </a>
                            </h3>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ new Date(item.published_at).toLocaleDateString('id-ID') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    news: Object,
    relatedNews: Array,
})
</script>

<style scoped>
:deep(.prose) {
    @apply max-w-none;
}

:deep(.prose h2) {
    @apply text-2xl font-bold mt-8 mb-4;
}

:deep(.prose p) {
    @apply mb-4;
}
</style>
