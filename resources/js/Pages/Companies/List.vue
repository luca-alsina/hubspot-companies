<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ShowCompanyModal from "@/Pages/Companies/Partials/ShowCompanyModal.vue";
// import Table from "@/Components/Table.vue";

import { TVTable, TVPagination } from '@bitthecat/tailwind-vue-data-table'
import "@bitthecat/tailwind-vue-data-table/dist/library.css";

const fields = [
    {
        key: 'id',
        label: 'ID',
        sortable: true,
    },
    {
        key: 'name',
        label: 'Name',
        sortable: true,
    },
    {
        key: 'email',
        label: 'Email',
        sortable: true,
    },
    {
        key: 'website',
        label: 'Website',
        sortable: false,
    },
    {
        key: 'phone',
        label: 'Phone',
        sortable: false,
    },
    {
        key: 'created_at',
        label: 'Created At',
        sortable: true,
    },
    {
        key: 'updated_at',
        label: 'Updated At',
        sortable: true,
    },
];

const data = [
    {
        id: 1,
        name: 'Leanne Graham',
        email: 'contact@company.com',
        website: 'company.com',
        phone: '1-770-736-8031 x56442',
        created_at: '2021-08-01 12:00:00',
        updated_at: '2021-08-01 12:00:00',
    },
    {
        id: 2,
        name: 'Ervin Howell',
        email: 'contact@company.com',
        website: 'company.com',
        phone: '010-692-6593 x09125',
        created_at: '2021-08-01 12:00:00',
        updated_at: '2021-08-01 12:00:00',
    },
    {
        id: 3,
        name: 'Clementine Bauch',
        email: 'contact@company.com',
        website: 'company.com',
        phone: '1-463-123-4447',
        created_at: '2021-08-01 12:00:00',
        updated_at: '2021-08-01 12:00:00',
    },
    {
        id: 4,
        name: 'Patricia Lebsack',
        email: 'contact@company.com',
        website: 'company.com',
        phone: '493-170-9623 x156',
        created_at: '2021-08-01 12:00:00',
        updated_at: '2021-08-01 12:00:00',
    },
];

</script>

<script>
export default {
    data() {
        return {
            selectedCompany: null,
            showCompanyModal: false,
        }
    },
    methods: {
        rowClicked(row) {
            console.log(row);

            this.selectedCompany = row;
            this.showCompanyModal = true;
        },
    },
}
</script>

<template>

    <ShowCompanyModal :show="showCompanyModal" :company="selectedCompany" />

    <AppLayout title="Companies">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Companies
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <TVTable :fields="fields" :items="data" @row-clicked="rowClicked" />
            </div>
        </div>

    </AppLayout>
</template>

<style scoped>

</style>

