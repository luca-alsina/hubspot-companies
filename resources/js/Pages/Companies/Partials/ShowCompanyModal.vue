<script setup>
import Modal from "@/Components/Modal.vue";
import {ref, watch} from "vue";

const emit = defineEmits(['close']);

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: 'lg',
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

const company   = ref({});
const isLoading = ref(false);

// Récupération des détails de la société sélectionnée depuis la route 'companies.show' avec le paramètre 'id'
async function getCompany(id) {
    isLoading.value = true;
    return await axios.get(route('companies.show', id));
}

watch(() => props.company, () => {

    company.value = props.company;

    getCompany(props.company.id).then(response => {
        company.value = response.data.data;
        console.log(response.data);
        isLoading.value = false;
    })
});

</script>

<script>
    export default {

        emits: ['close'],
        methods: {
            close() {
                this.$emit('close');
            }
        },

    };
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="$emit('close')"
    >

        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900">
                <h1>{{ company.name }}</h1>
            </div>

            <div class="row-auto flex justify-between">
                <div class="flex-col">
                    <div class="mt-4 text-sm text-gray-600">
                        <h3><a class="underline" href="{{ company.website }}">{{ company.website }}</a></h3>
                        <h3><a href="tel:{{ company.phone }}">{{ company.phone }}</a></h3>
                    </div>

                    <div class="flex flex-row justify-between mt-4">
                        <a href="mailto:{{ company.email }}" v-if="company.email" class="rounded-full bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 flex items-center justify-center">
                            <svg class="p-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 7.00005L10.2 11.65C11.2667 12.45 12.7333 12.45 13.8 11.65L20 7" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <rect x="3" y="5" width="18" height="14" rx="2" stroke="#000000" stroke-width="2" stroke-linecap="round"></rect> </g></svg>                </a>
                        <a href="tel:{{ company.phone }}" v-if="company.phone" class="rounded-full bg-green-500 hover:bg-green-600 text-white w-8 h-8 flex items-center justify-center">
                            <svg class="p-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Communication / Phone"> <path id="Vector" d="M9.50246 4.25722C9.19873 3.4979 8.46332 3 7.64551 3H4.89474C3.8483 3 3 3.8481 3 4.89453C3 13.7892 10.2108 21 19.1055 21C20.1519 21 21 20.1516 21 19.1052L21.0005 16.354C21.0005 15.5361 20.5027 14.8009 19.7434 14.4971L17.1069 13.4429C16.4249 13.1701 15.6483 13.2929 15.0839 13.7632L14.4035 14.3307C13.6089 14.9929 12.4396 14.9402 11.7082 14.2088L9.79222 12.2911C9.06079 11.5596 9.00673 10.3913 9.66895 9.59668L10.2363 8.9163C10.7066 8.35195 10.8305 7.57516 10.5577 6.89309L9.50246 4.25722Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
                        </a>
                    </div>
                </div>
                <div class="flex-col">
                    <div class="mt-4 text-md text-gray-600">
                        <h3>{{ company.city }}</h3>
                        <h3>{{ company.zip }} </h3>
                        <h3>{{ company.country }}</h3>
                    </div>
                </div>
            </div>

            <div class="row-auto flex justify-between mt-4">
                <h3 v-if="company.industry">{{ company.industry }}</h3>
                <h3 v-if="company.number_employees">{{ company.number_employees }} employés</h3>
                <h3 v-if="company.annual_revenue">{{ company.annual_revenue }} € / an</h3>
            </div>

            <div v-if="company.description" class="mt-4 text-sm text-gray-600">
                <h3>{{ company.description }}</h3>
            </div>

            <!-- Liste des contacts -->
            <div class="mt-4 text-sm text-gray-600">
                <h2 class="text-md">Contacts</h2>

                <div v-for="contact in company.contacts" class="p-2 border border-gray-500 mt-1">
                    <h3>{{ contact.first_name }} {{ contact.last_name }}</h3>
                    <h3 v-if="contact.email"><a href="mailto:{{ contact.email }}">{{ contact.email }}</a></h3>
                    <h3 v-if="contact.phone"><a href="tel:{{ contact.phone }}">{{ contact.phone }}</a></h3>
                </div>
            </div>

        </div>

        <div class="flex flex-row justify-center px-6 py-4 bg-gray-100 text-right">
            <template v-if="isLoading">
                <span class="mr-2">Chargement des données...</span>
                <svg class="animate-spin h-5 w-5 mr-2 inline-block text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647zM12 20a8 8 0 008-8h-4a4 4 0 01-4 4v4zm5.657-9.657A6 6 0 1012 2.343v4.243a3 3 0 014.243 0l1.414-1.414z"></path>
                </svg>
            </template>
        </div>
    </Modal>
</template>

<style scoped>

</style>
