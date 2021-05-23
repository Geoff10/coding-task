<template>
    <breeze-unauthenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Shopping List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <shopping-list :items="items" :errors="errors" @addItem="addItem($event)" @deleteItem="deleteItem($event)"></shopping-list>
                    </div>
                </div>
            </div>
        </div>
    </breeze-unauthenticated-layout>
</template>

<script>
    import BreezeUnauthenticatedLayout from '@/Layouts/Unauthenticated'
    import ShoppingList from '@/Components/ShoppingList/List'

    export default {
        components: {
            BreezeUnauthenticatedLayout,
            ShoppingList,
        },

        props: {
            auth: Object,
            errors: Object,
            items: Array,
        },

        methods: {
            addItem(e) {
                if (!this.itemExists(e.name)) {
                    this.items.unshift(e);
                }
            },
            deleteItem(id) {
                this.items.splice(id, 1);
            },
            itemExists(name) {
                return (this.items.filter(item => item.name == name).length > 0);
            }
        }
    }
</script>
