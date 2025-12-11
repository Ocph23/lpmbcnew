<script setup>
import Editor from '@tinymce/tinymce-vue'
import { ref, watch } from 'vue';

const uploadUrl = '/api/upload-image' // route API Laravel
const formData = new FormData()

const content = ref(`
  <p>Ini adalah editor TinyMCE Vue 3 lengkap.</p>
  <p>Anda dapat menambahkan konten awal di sini.</p>
`)

const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    }
})

content.value = props.modelValue

const emit = defineEmits(['update:modelValue'])
watch(content, (newValue) => {
    emit('update:modelValue', newValue)
})


</script>

<template>
    <main id="sample">
        <Editor v-model="content" api-key="lwhucj9f45uana41awc6buuw14f2ncf0rrcvojsmkw3sshun" :init="{
            toolbar_mode: 'sliding',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            image_caption: true,
            image_title: true,
            image_dimensions: true, // drag-resize
            automatic_uploads: true,
            images_upload_url: uploadUrl,
            images_upload_handler: function (blobInfo, success, failure) {

                formData.append('file', blobInfo.blob(), blobInfo.filename())

                fetch(uploadUrl, {
                    method: 'POST',
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {
                        success(data.location) // TinyMCE butuh key location
                    })
                    .catch(err => {
                        failure('Gagal upload gambar: ' + err.message)
                    })
            }
        }" initial-value="Welcome to TinyMCE!" />
    </main>
</template>
