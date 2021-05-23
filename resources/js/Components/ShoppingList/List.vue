<template>
    <div class="py-2 font-bold">
        <div class="px-1">Item</div>
    </div>
    <add-shopping-list-item @addItem="$emit('addItem', $event)"></add-shopping-list-item>
    <div v-if="hasItems">
        <shopping-list-item v-for="(item, id) in items" :key="id" v-model:item="items[id]" :id="'shopping-item-' + item.id" @deleteItem="$emit('deleteItem', item.id)"></shopping-list-item>
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

