<template>
    <div v-if="hasItems">
        <div class="py-2 font-bold">
            <div class="px-1">Item</div>
        </div>
        <shopping-list-item v-for="(item, id) in items" :key="id" v-model:item="items[id]" :id="'shopping-item-' + id"></shopping-list-item>
    </div>
    <div v-else>No items on the shopping list yet.</div>
</template>

<script>
    import ShoppingListItem from '@/Components/ShoppingList/Item'

    export default {
        components: {
            ShoppingListItem,
        },

        props: {
            items: {
                type: Array,
                default: null
            }
        },

        computed: {
            hasItems() {
                return this.items && (this.items.length > 0);
            }
        },
    }
</script>

