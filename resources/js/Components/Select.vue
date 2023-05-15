<template>
    <label v-if="props.title" for="countries" class="block mb-2 text-sm font-medium text-gray-600">{{ props.title }}</label>
    <select
        id="countries"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        @change="$emit('update:data', $event.target.value)"
    >
        <option v-if="props.actionMessage" value="" selected>{{ props.actionMessage }}</option>
        <option v-for="option in props.data" :value="option.value">{{ option.name }}</option>
    </select>
</template>

<script setup>

const props = defineProps({
    data: {
        type: Array,
        default: () => [],
    },
    title: {
        type: String,
        default: null,
    },
    actionMessage: {
        type: String,
        default: null,
    },
});

const emit = defineEmits(['update:data']);

</script>

<style scoped>

</style>
