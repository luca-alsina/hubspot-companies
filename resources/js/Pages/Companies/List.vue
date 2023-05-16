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
                <TVTable :fields="fields" :items="props.companies.data" @row-clicked="rowClicked" />
            </div>
        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ShowCompanyModal from "@/Pages/Companies/Partials/ShowCompanyModal.vue";
import Select from "@/Components/Select.vue";
import {defineProps, ref, toRaw} from "vue";
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
// const companies = ref(props.companies.data);

const fields = [
    {
        key: "name",
        label: "Nom de l'enreprise",
    },
    {
        key: "industry",
        label: "Secteur d'activité",
    },
    {
        key: "city",
        label: "Ville",
    },
    {
        key: "country",
        label: "Pays",
    }
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
const allCompanies = props.companies.data;

const selectTitle = "Séléctionnez un secteur d'activité";
const selectActionMessage = "Tous les secteurs d'activité";

async function getCompaniesByIndustry(industry) {
    return await axios.get(route('companies.industries.search', industry));
}

const showOnlyIndustry = (value) => {
    if (value) {
        getCompaniesByIndustry(value).then(response => {
            props.companies.data = response.data.data;
        });
    } else {
        props.companies.data = allCompanies;
    }
};

</script>

<style scoped>

</style>

