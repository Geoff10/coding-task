<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Shopping List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <shopping-list :user="user" :items="items" :errors="errors"></shopping-list>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import ShoppingList from '@/Components/ShoppingList/List'

    export default {
        components: {
            BreezeAuthenticatedLayout,
            ShoppingList,
        },

        props: {
            auth: Object,
            errors: Object,
            items: Array,
            user: Object,
        },
    }
</script>
