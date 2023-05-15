<template>

    <ShowCompanyModal :show="showCompanyModal" :company="selectedCompany" @close="closeCompanyModal" />

    <AppLayout title="Companies">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Entreprises
            </h2>
        </template>

        <!-- Sélécteur de secteur d'activité "industry" -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <Select
                    :title="selectTitle"
                    :actionMessage="selectActionMessage"
                    :data="props.industries"
                    @update:data="showOnlyIndustry"
                />

            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <TVTable :fields="fields" :items="companies" @row-clicked="rowClicked" />
            </div>
        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ShowCompanyModal from "@/Pages/Companies/Partials/ShowCompanyModal.vue";
import Select from "@/Components/Select.vue";
import { defineProps, ref } from "vue";
import { TVTable } from "@bitthecat/tailwind-vue-data-table";
import "@bitthecat/tailwind-vue-data-table/dist/library.css";

const props = defineProps({
    companies: {
        type: Array,
        required: true,
    },
    industries: {
        type: Array,
        required: true,
        schema: {
            value: {
                type: String,
                required: true,
            },
            name: {
                type: String,
                required: true,
            },
        },
    },
});

/* Chargement des données dans le tableau */
const companies = props.companies.data;

const fields = [
    {
        key: "id",
        label: "ID",
        sortable: true,
    },
    {
        key: "name",
        label: "Name",
        sortable: true,
    },
    {
        key: "email",
        label: "Email",
        sortable: true,
    },
    {
        key: "website",
        label: "Website",
        sortable: false,
    },
    {
        key: "phone",
        label: "Phone",
        sortable: false,
    },
    {
        key: "city",
        label: "City",
        sortable: true,
    },
];

/* Gestion du modal */

const selectedCompany = ref(null);
const showCompanyModal = ref(false);

const rowClicked = (row) => {
    selectedCompany.value = row;
    showCompanyModal.value = true;
};

const closeCompanyModal = () => {
    showCompanyModal.value = false;
};

/* Gestion du sélécteur de secteur d'activité */
const selectTitle = "Séléctionnez un secteur d'activité";
const selectActionMessage = "Tous les secteurs d'activité";
const selectData = [
    {
        value: 1,
        name: "Agriculture",
    },
    {
        value: 2,
        name: "Industrie",
    },
    {
        value: 3,
        name: "Services",
    },
];

const showOnlyIndustry = (value) => {
    console.log(value);
};

</script>

<style scoped>

</style>

