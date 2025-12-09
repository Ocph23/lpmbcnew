<script setup>
import { usePage } from '@inertiajs/vue3'
import { ref, watch, onUnmounted } from 'vue'

const page = usePage()
const messages = ref([])
let timers = new Map()

const DURATION = 2500

const getMessageClass = (type) => {
    const classes = {
        success: 'bg-green-500 border-green-600',
        error: 'bg-red-500 border-red-600',
        warning: 'bg-yellow-500 border-yellow-600',
        info: 'bg-blue-500 border-blue-600'
    }
    return classes[type] || classes.info
}

const getIcon = (type) => {
    const icons = {
        success: 'M5 13l4 4L19 7',
        error: 'M6 18L18 6M6 6l12 12',
        warning: 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.308 16.5c-.77.833.192 2.5 1.732 2.5z',
        info: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
    }
    return icons[type] || icons.info
}

const addMessage = (type, text) => {
    const id = Date.now() + Math.random()
    const message = { id, type, text }

    messages.value.push(message)

    // Auto remove setelah durasi
    const timer = setTimeout(() => {
        removeMessage(id)
    }, DURATION)

    timers.set(id, timer)
}

const removeMessage = (id) => {
    messages.value = messages.value.filter(msg => msg.id !== id)

    // Clear timer
    if (timers.has(id)) {
        clearTimeout(timers.get(id))
        timers.delete(id)
    }
}


setTimeout(() => {
    // Clear semua message sebelumnya
    messages.value.forEach(msg => {
        if (timers.has(msg.id)) {
            clearTimeout(timers.get(msg.id))
        }
    })
    messages.value = []
    timers.clear()

    // Tambahkan message baru berdasarkan tipe
    const messageTypes = ['success', 'error', 'warning', 'info']
    messageTypes.forEach(type => {
        if (page.props?.flash[type]) {
            addMessage(type, page.props?.flash[type])
        }
    })
}, 500)

// Watch untuk semua tipe flash message
watch(() => page.props.flash, (newFlash) => {
    // Clear semua message sebelumnya
    messages.value.forEach(msg => {
        if (timers.has(msg.id)) {
            clearTimeout(timers.get(msg.id))
        }
    })
    messages.value = []
    timers.clear()

    // Tambahkan message baru berdasarkan tipe
    const messageTypes = ['success', 'error', 'warning', 'info']
    messageTypes.forEach(type => {
        if (newFlash?.[type]) {
            addMessage(type, newFlash[type])
        }
    })
}, { deep: true })

onUnmounted(() => {
    // Cleanup semua timers
    timers.forEach(timer => clearTimeout(timer))
    timers.clear()
})
</script>

<template>
    <div class="fixed top-4 right-4 z-50 space-y-2 max-w-sm">
        <TransitionGroup name="message-list" tag="div" class="space-y-2">
            <div v-for="message in messages" :key="message.id"
                :class="['px-4 py-3 text-white rounded-md shadow-lg border-l-4 animate-fade-in', getMessageClass(message.type)]">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-2">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                :d="getIcon(message.type)" />
                        </svg>
                        <span class="text-sm">{{ message.text }}</span>
                    </div>
                    <button @click="removeMessage(message.id)"
                        class="ml-2 text-white hover:opacity-75 transition-opacity">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </TransitionGroup>
    </div>
</template>

<style scoped>
.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Transition group animations */
.message-list-move,
.message-list-enter-active,
.message-list-leave-active {
    transition: all 0.3s ease;
}

.message-list-enter-from,
.message-list-leave-to {
    opacity: 0;
    transform: translateX(20px);
}

.message-list-leave-active {
    position: absolute;
}
</style>
