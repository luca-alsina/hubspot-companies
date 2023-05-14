<script setup>

import Modal from "@/Components/Modal.vue";

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    company: {
        type: Object,
        default: () => ({}),
    },
});

const close = () => {
    emit('close');
};

</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >

        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900">
                <h2>{{ company.name }}</h2>
            </div>

            <div class="mt-4 text-sm text-gray-600">
                <h3><a href="mailto:{{ company.email }}">{{ company.email }}</a></h3>
                <h3><a href="{{ company.website }}">{{ company.website }}</a></h3>
            </div>

            <div class="mt-4 text-sm text-gray-600">
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        </div>

    </Modal>
</template>

<style scoped>

</style>
