<template>
    <div class="py-2 font-bold">
        <div class="px-1">Item</div>
    </div>
    <add-shopping-list-item :user="user" :errors="errors"></add-shopping-list-item>
    <div v-if="hasItems">
        <shopping-list-item :user="user" v-for="(item, id) in items" :key="id" v-model:item="items[id]" :id="'shopping-item-' + item.id"></shopping-list-item>
    </div>
    <div v-else class="px-1 py-2">No items on the shopping list yet.</div>
</template>

<script>
    import ShoppingListItem from '@/Components/ShoppingList/Item'
    import AddShoppingListItem from '@/Components/ShoppingList/AddItem'

    export default {
        components: {
            ShoppingListItem,
            AddShoppingListItem,
        },

        props: {
            user: Object,
            items: {
                type: Array,
                default: null
            },
            errors: Object,
        },

        computed: {
            hasItems() {
                return this.items && (this.items.length > 0);
            }
        },
    }
</script>

